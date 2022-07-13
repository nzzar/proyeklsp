<?php

namespace App\Http\Livewire\Event;

use App\Models\SkemaAsesi;
use Livewire\Component;

class Asesi extends Component
{
    public $eventId;
    
    public function mount($id) {
        $this->eventId = $id;
    }
    
    public function render()
    {
        
        $asesis = SkemaAsesi::where('event_id', $this->eventId)->get();
        
        return view('livewire.event.asesi', compact('asesis'));
    }
}
