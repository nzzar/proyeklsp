<?php

namespace App\Http\Livewire\Asesi\Event;

use App\Models\AsesmentMandiri;
use App\Models\Element;
use App\Models\PersyaratanSkema;
use App\Models\Skema;
use App\Models\SkemaAsesi;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AsesmenMandiri extends Component
{
    public $skemaAsesiId;
    public $skemaAsesi;

    public $elementSelected;
    public $persyaratan_id;
    public $k;

    public $document;

    public $view_file;

    public function mount($id)
    {
        try {

            
            $skemaAsesi = SkemaAsesi::findOrFail($id);
            if ($skemaAsesi->status != 'Diterima') {
                abort('404');
            }

            $this->document = PersyaratanSkema::with([
                'asesi' => function($query) use ($skemaAsesi) {
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
            $this->skemaAsesiId = $skemaAsesi->id;
        } catch (Exception $err) {
            dd($err);
            abort('404');
        }
    }

    public function render()
    {

        try {
            $skemaAsesi = SkemaAsesi::findOrFail($this->skemaAsesiId);

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
                ->where('id', $skemaAsesi->event->skema->id)
                ->firstOrFail();

        } catch (Exception $err) {
            abort('404');
        }

        return view('livewire.asesi.event.asesmen-mandiri', compact('skema', 'skemaAsesi'));
    }

    public function asesmen($id)
    {
        try {

            $skema = $this->skemaAsesi;
            $this->elementSelected = Element::with([
                'asesi' => function ($query) use ($skema) {
                    $query->where([
                        'event_id' => $skema->event_id,
                        'asesi_id' => $skema->asesi_id,
                    ]);
                }
            ])
                ->where('id', $id)
                ->firstOrFail();
            
            if($this->elementSelected->asesi) {
                $this->persyaratan_id =  $this->elementSelected->asesi->persyaratan_asesi_id;
                $this->k = $this->elementSelected->asesi->kompeten;
            } else {
                $this->persyaratan_id = null;
                $this->k = null;
            }

            $this->emit('asesment', ['type' => 'get']);
        } catch (Exception $err) {
            dd($err);
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error!',
                'title' => 'Gagal mendapatkan data asesmen',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        }
    }

    public function setAsesment() {
        $this->validate(
            [
                'k' => 'required',
                'persyaratan_id' => 'required|exists:persyaratan_asesi,id'                
            ]
        );
        

        try {

            $data = AsesmentMandiri::where([
                'asesi_id' => Auth::user()->asesi->id,
                'event_id' => $this->skemaAsesi->event_id,
                'skema_id' => $this->skemaAsesi->event->skema->id,
                'unit_kompetensi_id' => $this->element->unit_kompetensi_id,
                'element_id' => $this->element->id,
            ])
            ->first();
    
    
            if(!$data) {
                $data = new AsesmentMandiri();
            }
    
            $data->asesi_id = Auth::user()->asesi->id;
            $data->event_id = $this->skemaAsesi->event_id;
            $data->skema_id = $this->skemaAsesi->event->skema->id;
            $data->unit_kompetensi_id = $this->element->unit_kompetensi_id;
            $data->element_id = $this->element->id;
            $data->persyaratan_asesi_id = $this->persyaratan_id;
            $data->kompeten = $this->k;
            $data->save();

            $this->persyaratan_id = null;
            $this->k = null;

            $this->dispatchBrowserEvent('swal', [
                'title' => 'Success!',
                'title' => 'data asesmen berhasil diperbarui',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        } catch (Exception $err) {
            dd($err);
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error!',
                'title' => 'Gagal memperbarui data asesmen',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        }


    

    }
}
