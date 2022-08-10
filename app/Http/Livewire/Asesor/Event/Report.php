<?php

namespace App\Http\Livewire\Asesor\Event;

use App\Models\Event;
use App\Models\SkemaAsesi;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Report extends Component
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
            'asesor_id' => Auth::user()->asesor->id,
        ])
            ->get();

        return view('livewire.asesor.event.report', compact('skemaAsesi'));
    }
}
