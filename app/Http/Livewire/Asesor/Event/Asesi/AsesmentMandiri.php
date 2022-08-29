<?php

namespace App\Http\Livewire\Asesor\Event\Asesi;

use App\Models\AsesmentMandiriResult;
use App\Models\CeklisObservasiResult;
use App\Models\PersetujuanAsesmen;
use App\Models\PersyaratanSkema;
use App\Models\Skema;
use App\Models\SkemaAsesi;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class AsesmentMandiri extends Component
{
    use WithFileUploads;

    public $skemaAsesi;
    public $view_file;
    public $signature;
    public $continue;
    public $canEdit = true;

    public $errorMessage;

    protected $listeners = [
        'init-asesmen-mandiri' => 'initTtd',
        'save-rekomendasi' => 'saveRekomendasi'
    ];

    public function mount($id)
    {
        try {


            $skemaAsesi = SkemaAsesi::findOrFail($id);
            $this->document = PersyaratanSkema::with([
                'asesi' => function ($query) use ($skemaAsesi) {
                    $query->where([
                        'asesi_id' => $skemaAsesi->asesi_id,
                        'event_id' => $skemaAsesi->event_id,
                    ]);
                }
            ])
                ->where([
                    'skema_id' => $skemaAsesi->event->skema->id,
                ])
                ->get();

            
            


            $this->skemaAsesi = $skemaAsesi;
        } catch (Exception $err) {
            abort('404');
        }
    }

    public function render()
    {

        if (is_null($this->continue) && !$this->signature) {
            $this->errorMessage = '* Rekomendasi dan tanda tangan tidak boleh kosong';
        } else {
            $this->errorMessage = null;
        }

        try {
            $skemaAsesi = SkemaAsesi::findOrFail($this->skemaAsesi->id);
            // dd($skemaAsesi->assent);
            $this->skemaAsesi = $skemaAsesi;
            $skema = Skema::with([
                'unitKompetensi.element.asesi' =>  function ($query) use ($skemaAsesi) {
                    $query->where([
                        'event_id' => $skemaAsesi->event_id,
                        'asesi_id' => $skemaAsesi->asesi_id,
                        'skema_id' => $skemaAsesi->event->skema->id
                    ]);
                },
                'unitKompetensi.element.asesi.syarat'
            ])
                ->withCount('element')
                ->where('id', $skemaAsesi->event->skema->id)
                ->firstOrFail();
        } catch (Exception $err) {
            abort('404');
        }

        return view('livewire.asesor.event.asesi.asesment-mandiri', compact('skema'));
    }

    public function saveRekomendasi()
    {
        DB::beginTransaction();

        try {

            $skemaAsesi = SkemaAsesi::with('asesmentMandiri')
                ->findOrFail($this->skemaAsesi->id);

            if ($skemaAsesi->asesor) {
                throw new Exception("Asesi sudah diberi rekomendasi");
            }
            $skemaAsesi->asesor_id = Auth::user()->asesor->id;

            $file_name = 'signature_asesor' . time() . '_' . Auth::user()->asesor->id . '.' . $this->signature->getClientOriginalExtension();
            $file_path = $this->signature->storeAs("public/event/" . $this->skemaAsesi->event_id . "/asesi" . "/" . $skemaAsesi->asesi_id . "/", $file_name);

            $skemaAsesi->ttd_asesor = $file_path;
            $skemaAsesi->save();

            $asesmenResult = AsesmentMandiriResult::findOrFail($skemaAsesi->asesmentMandiri->id);
            $asesmenResult->continue = $this->continue;
            $asesmenResult->tgl_ttd_asesor = Carbon::now()->format('Y-m-d');
            $asesmenResult->save();

            $units = [
                [
                    'skema_asesi_id' => $skemaAsesi->id,
                    'unit_kompetensi' => 'Merencanakan Aktifitas dan proses asesmen',
                ],
                [
                    'skema_asesi_id' => $skemaAsesi->id,
                    'unit_kompetensi' => 'Melaksanakan Asesmen',
                ],
                [
                    'skema_asesi_id' => $skemaAsesi->id,
                    'unit_kompetensi' => 'Memberikan kontribusi dalam validasi asesmen',
                ],
            ];

            CeklisObservasiResult::insert($units);

            DB::commit();

            $this->emit('refress-parent');

            $this->dispatchBrowserEvent('swal', [
                'title' => 'Success!',
                'text' => 'Berhasil menyimpan rekomendasi',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        } catch (Exception $err) {
            DB::rollBack();
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error !',
                'text' => 'Gagal menyimpan rekomendasi',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        }
    }

    public function savePersetujuan($field, $value = false) {
        try {
            $skemaAsesi = SkemaAsesi::findOrFail($this->skemaAsesi->id);
            $this->skemaAsesi = $skemaAsesi;
            if($skemaAsesi->asesor) {
                return;
            }
            
            $persetujuan = PersetujuanAsesmen::where('skema_asesi_id', $skemaAsesi->id)
            ->firstOrFail();

            $persetujuan->{$field} = $value;
            $persetujuan->save();

            $this->dispatchBrowserEvent('swal', [
                'title' => 'Success!',
                'text' => 'Berhasil update persetujuan',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);

        } catch(Exception $err) {
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error !',
                'text' => 'Gagal update persetujuan',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        }
    }
}
