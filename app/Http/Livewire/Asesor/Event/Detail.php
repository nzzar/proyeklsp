<?php

namespace App\Http\Livewire\Asesor\Event;

use App\Models\Event;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Detail extends Component
{
    public $eventId;
    public $tabActive;
    public $skemaId;
    
    public function mount($id)
    {
        try {


            $event = Event::where('id', $id)
                ->firstOrFail();
            
            $this->eventId = $id;
            $validAsesor = in_array(Auth::user()->asesor->id, array_column($event->asesor->toArray(), 'asesor_id'));

            if (!$validAsesor) {
                abort(404);
            }

            $this->tabActive = 'skema';
            $this->skemaId = $event->skema_id;
        } catch (Exception $err) {
            abort(404);
        }
    }

    public function render()
    {
        $event = Event::with('skema')
            ->where('id', $this->eventId)
            ->firstOrFail();
        return view('livewire.asesor.event.detail', compact('event'));
    }
}
