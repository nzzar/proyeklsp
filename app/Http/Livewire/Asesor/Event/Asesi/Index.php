<?php

namespace App\Http\Livewire\Asesor\Event\Asesi;

use App\Models\Event;
use App\Models\PersyaratanAsesi;
use App\Models\PersyaratanSkema;
use App\Models\SkemaAsesi;
use Exception;
use Livewire\Component;

class Index extends Component
{

    public $skemaAsesiId;
    public $tabActive;
    public $validPersyaratan;

    public function mount($id) {
        $this->tabActive = 'form';
        $this->skemaAsesiId = $id;
    }
    
    public function render()
    {

        try {
            $skemaAsesi =  SkemaAsesi::with('feedBackNotes')->findOrFail($this->skemaAsesiId);
            $event = Event::where('id', $skemaAsesi->event_id)
            ->firstOrFail();

            $skema = PersyaratanSkema::where('skema_id', $event->skema_id)->count();
            $asesi = PersyaratanAsesi::where('event_id', $event->id)
            ->where('status', 'Memenuhi Syarat')->count();

            if($asesi == $skema) {
                $this->validPersyaratan = true;
            } else {
                $this->validPersyaratan = false;
            }
            
        } catch(Exception $err) {
            abort(404);
        }
        
        return view('livewire.asesor.event.asesi.index', compact('skemaAsesi', 'event'));
    }

    public function changeTab($tab) {
        $this->tabActive = $tab;
        $this->emit('tab-'.$this->tabActive);
    }
}
