<?php

namespace App\Http\Livewire\Asesor\Event\Asesi;

use App\Models\CeklisObservasi;
use App\Models\CeklisObservasiResult;
use App\Models\Skema;
use App\Models\SkemaAsesi;
use App\Models\UnjukKerja;
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

    protected $listeners = [
        'save-observasi' => 'saveCeklistObservasi'
    ];

    public function mount($id)
    {
        try {
            $this->skemaAsesi = SkemaAsesi::with(['event', 'asesmentMandiri', 'asesor', 'asesi'])->findOrFail($id);
        } catch (Exception $err) {
            abort(404);
        }
    }

    public function render()
    {
        try {
            $skemaAsesi = SkemaAsesi::findOrFail($this->skemaAsesi->id);
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

            if($countAsesi < $count) {
                $this->errorMessage = 'Isi semua form FR.APL.02 terlebih dahulu';
            } else if(is_null($this->rekomendasi)) {
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

        try {
            $skemaAsesi = SkemaAsesi::findOrFail($this->skemaAsesi->id);
            $skemaAsesi->skema_status = $this->rekomendasi;
            $skemaAsesi->save();

            $this->dispatchBrowserEvent('swal', [
                'title' => 'Success!',
                'text' => 'Ceklist obesevasi berhasil diperbarui',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        } catch(Exception $err) {
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
