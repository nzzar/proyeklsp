<?php

namespace App\Http\Livewire\Asesor\Event\Asesi;

use App\Models\CeklisObservasi;
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
    
    public function mount($id) {
        try {
            $this->skemaAsesi = SkemaAsesi::with(['event','asesmentMandiri', 'asesor', 'asesi'])->findOrFail($id);

            
        } catch(Exception $err) {
            abort(404);
        }
    }
    
    public function render()
    {
        $skemaAsesi = $this->skemaAsesi;
        $skema = Skema::with([
            'unitKompetensi.element.unjukKerja.asesi' => function($query) use($skemaAsesi) {
                $query->where([
                    'asesi_id' => $skemaAsesi->asesi_id,
                    'event_id' => $skemaAsesi->event_id,
                ]);
            } 
        ])
        ->findOrFail($skemaAsesi->event->skema->id);
        return view('livewire.asesor.event.asesi.observasi', compact('skema'));
    }

    public function ceklis($id, $value) {
        
        DB::beginTransaction();
        try {
            
            $ceklis = CeklisObservasi::where([
                'event_id' => $this->skemaAsesi->event_id,
                'unjuk_kerja_id' => $id,
                'asesi_id' => $this->skemaAsesi->asesi_id,
            ])
            ->first();


            if(!$ceklis) {
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
            DB::rollBack();
        }
    }
}
