<?php

namespace App\Http\Livewire\Event;

use App\Models\Event;
use App\Models\SkemaAsesi;
use Exception;
use Livewire\Component;

class Laporan extends Component
{
    public $event;

    public function mount($id)
    {
        try {
            $this->event = Event::findOrFail($id);
        } catch (Exception $err) {
            abort(404);
        }
    }
    
    public function render()
    {
        $skemaAsesi = SkemaAsesi::where([
            'event_id' => $this->event->id,
        ])
            ->get();
        return view('livewire.event.laporan', compact('skemaAsesi'));
    }
}
