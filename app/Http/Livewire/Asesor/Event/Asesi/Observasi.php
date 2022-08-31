<?php

namespace App\Http\Livewire\Asesor\Event\Asesi;

use App\Models\CeklisObservasi;
use App\Models\CeklisObservasiResult;
use App\Models\MeninjauAsesment;
use App\Models\Skema;
use App\Models\SkemaAsesi;
use App\Models\UmpanBalik;
use App\Models\UnjukKerja;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Observasi extends Component
{
    public $skemaAsesi;
    public $isValidAsesor;
    public $rekomendasi;
    public $errorMessage;
    public $validAsesor;
    public $canEdit = true;

    protected $listeners = [
        'save-observasi' => 'saveCeklistObservasi'
    ];

    public function mount($id)
    {
        try {
            $this->skemaAsesi = SkemaAsesi::with(['event', 'asesmentMandiri', 'asesor', 'asesi'])->findOrFail($id);

            $endDate = Carbon::createFromFormat('d/m/Y H:i', $this->skemaAsesi->event->end_date);
            $now = Carbon::now();

            $this->canEdit = $endDate->gte($now);
        } catch (Exception $err) {
            // dd($err);
            abort(404);
        }
    }

    public function render()
    {
        try {
            $skemaAsesi = SkemaAsesi::findOrFail($this->skemaAsesi->id);

            $this->validAsesor = $skemaAsesi->asesor_id == Auth::user()->asesor->id;

            $this->skemaAsesi = $skemaAsesi;
            $skema = Skema::with([
                'unitKompetensi.element.unjukKerja.asesi' => function ($query) use ($skemaAsesi) {
                    $query->where([
                        'asesi_id' => $skemaAsesi->asesi_id,
                        'event_id' => $skemaAsesi->event_id,
                    ]);
                }
            ])
                ->withCount('element')
                ->findOrFail($skemaAsesi->event->skema->id);

            $countAsesi = CeklisObservasi::where([
                'event_id' => $skemaAsesi->event_id,
                'asesi_id' => $skemaAsesi->asesi_id,
            ])
                ->count();

            $count = DB::table('skemas')
                ->select('*')
                ->join('unit_kompetensi', 'skemas.id', '=', 'unit_kompetensi.skema_id')
                ->join('element', 'unit_kompetensi.id', '=', 'element.unit_kompetensi_id')
                ->join('unjuk_kerja', 'element.id', '=', 'unjuk_kerja.element_id')
                ->where('skemas.id', $skemaAsesi->event->skema_id)
                ->count();
            if ($countAsesi < $count) {
                $this->errorMessage = 'Isi semua form FR.APL.02 terlebih dahulu';
            } else if (is_null($this->rekomendasi)) {
                $this->errorMessage = 'Rekomendasi tidak boleh kosong';
            } else {
                $this->errorMessage = null;
            }

            return view('livewire.asesor.event.asesi.observasi', compact('skema'));
        } catch (Exception $err) {
            dd($err);
            abort(404);
        }
    }

    public function ceklis($id, $value)
    {

        if (!$this->canEdit) return;

        DB::beginTransaction();
        try {

            $ceklis = CeklisObservasi::where([
                'event_id' => $this->skemaAsesi->event_id,
                'unjuk_kerja_id' => $id,
                'asesi_id' => $this->skemaAsesi->asesi_id,
            ])
                ->first();


            if (!$ceklis) {
                $skema = $this->skemaAsesi->event->skema;
                $unjukKerja = UnjukKerja::findOrFail($id);

                $ceklis = new CeklisObservasi();
                $ceklis->event_id = $this->skemaAsesi->event_id;
                $ceklis->asesi_id = $this->skemaAsesi->asesi_id;
                $ceklis->skema_id = $skema->id;
                $ceklis->unit_kompetensi_id = $unjukKerja->element->unit_kompetensi_id;
                $ceklis->element_id = $unjukKerja->element_id;
                $ceklis->unjuk_kerja_id = $id;
            }
            $ceklis->kompeten = $value;
            $ceklis->save();

            $this->dispatchBrowserEvent('swal', [
                'title' => 'Success!',
                'text' => 'Ceklist obesevasi berhasil diperbarui',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);

            DB::commit();
        } catch (Exception $err) {
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error!',
                'text' => 'Gagal memperbarui data',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
            DB::rollBack();
        }
    }

    public function ceklisObservasi($id, $field, $value = false)
    {

        try {
            $observasi = CeklisObservasiResult::findOrFail($id);
            $observasi->{$field} = $value;
            $observasi->save();

            $this->dispatchBrowserEvent('swal', [
                'title' => 'Success!',
                'text' => 'Ceklist obesevasi berhasil diperbarui',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        } catch (Exception $err) {
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error!',
                'text' => 'Gagal memperbarui data',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        }
    }

    public function saveCeklistObservasi()
    {

        if(!$this->canEdit) return;
        
        DB::beginTransaction();
        try {
            $skemaAsesi = SkemaAsesi::findOrFail($this->skemaAsesi->id);
            $skemaAsesi->skema_status = $this->rekomendasi;
            $skemaAsesi->save();

            $skemaAsesiId = $this->skemaAsesi->id;

            $availabelFeedback = UmpanBalik::where('skema_asesi_id', $skemaAsesiId)->first();

            if (!$availabelFeedback) {


                $feedbacks = [
                    [
                        'skema_asesi_id' => $skemaAsesiId,
                        'komponen' => 'Saya mendapatkan penjelasan yang cukup memadai mengenai proses asesmen/uji kompetensi',
                    ],
                    [
                        'skema_asesi_id' => $skemaAsesiId,
                        'komponen' => 'Saya diberikan kesempatan untuk mempelajari standar kompetensi yang akan diujikan dan menilai diri sendiri terhadap pencapaiannya',
                    ],
                    [
                        'skema_asesi_id' => $skemaAsesiId,
                        'komponen' => 'Asesor memberikan kesempatan untuk mendiskusikan/menegosiasikan metoda, instrumen dan sumber asesmen serta jadwal asesmen',
                    ],
                    [
                        'skema_asesi_id' => $skemaAsesiId,
                        'komponen' => 'Saya sepenuhnya diberikan kesempatan untuk mendemonstrasikan kompetensi yang saya miliki selama asesmen',
                    ],
                    [
                        'skema_asesi_id' => $skemaAsesiId,
                        'komponen' => 'Asesor memberikan umpan balik yang mendukung setelah asesmen serta tindak lanjutnya',
                    ],
                    [
                        'skema_asesi_id' => $skemaAsesiId,
                        'komponen' => 'Asesor bersama  saya mempelajari semua dokumen asesmen serta menandatanganinya',
                    ],
                    [
                        'skema_asesi_id' => $skemaAsesiId,
                        'komponen' => 'Saya mendapatkan jaminan kerahasiaan hasil asesmen serta penjelasan penanganan dokumen asesmen',
                    ],
                    [
                        'skema_asesi_id' => $skemaAsesiId,
                        'komponen' => 'Asesor menggunakan keterampilan komunikasi yang efektif selama asesmen',
                    ],
                ];


                UmpanBalik::insert($feedbacks);

                $meninjau = [
                    [
                        'skema_asesi_id' => $skemaAsesiId,
                        'kegiatan_asesmen' => 'Instruksi perangkat asesmen dan kondisi asesmen diidentifikasi dengan jelas'
                    ],
                    [
                        'skema_asesi_id' => $skemaAsesiId,
                        'kegiatan_asesmen' => 'Informasi tertulis dituliskan secara tepat'
                    ],
                    [
                        'skema_asesi_id' => $skemaAsesiId,
                        'kegiatan_asesmen' => 'Kegiatan asesmen mebahas persyaratan bukti untuk kompetensi yang diases'
                    ],
                    [
                        'skema_asesi_id' => $skemaAsesiId,
                        'kegiatan_asesmen' => 'Tingkat kesulitan bahasa, literasi, dan berhitung sesuai dengan tingkat unit kompetensi yang dinilai'
                    ],
                    [
                        'skema_asesi_id' => $skemaAsesiId,
                        'kegiatan_asesmen' => 'Tingkat kesulitan bahasa, literasi, dan berhitung sesuai dengan tingkat unit kompetensi yang dinilai'
                    ],
                    [
                        'skema_asesi_id' => $skemaAsesiId,
                        'kegiatan_asesmen' => 'Tingkat kesulitan kegiatan disesuaikan dengan kompetensi atau kompetensi yang diases'
                    ],
                    [
                        'skema_asesi_id' => $skemaAsesiId,
                        'kegiatan_asesmen' => 'Contoh, benchmark dan / atau ceklis asesmen tersedia untuk digunakan dalam pengambilan keputusan asesmen '
                    ],
                    [
                        'skema_asesi_id' => $skemaAsesiId,
                        'kegiatan_asesmen' => 'Diperlukan modifikasi (seperti yang diidentifikasi dalam komentar)'
                    ],
                    [
                        'skema_asesi_id' => $skemaAsesiId,
                        'kegiatan_asesmen' => 'Tugas asesmen siap digunakan'
                    ],
                ];

                MeninjauAsesment::insert($meninjau);
            }
            DB::commit();

            $this->dispatchBrowserEvent('swal', [
                'title' => 'Success!',
                'text' => 'Ceklist obesevasi berhasil diperbarui',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        } catch (Exception $err) {
            DB::rollBack();
            dd($err);
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error!',
                'text' => 'Gagal memperbarui data',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        }
    }
}
