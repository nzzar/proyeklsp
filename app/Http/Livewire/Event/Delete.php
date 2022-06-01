<?php

namespace App\Http\Livewire\Event;

use App\Models\Event;
use Exception;
use Livewire\Component;

class Delete extends Component
{

    public $eventId;

    protected $listeners = [
        'setEventId' => 'handleGetEventId',
        'eventDeleted' => 'eventDeleted'
    ];

    public function render()
    {
        return view('livewire.event.delete');
    }

    public function handleGetEventId($eventId)
    {

        try {
            $data = Event::where('id', $eventId)
                ->with('skema')
                ->withCount('asesi')
                ->withCount('asesor')
                ->firstOrFail();

            if ($data->asesi_count  > 0 || $data->asesor_count > 0) {
                $this->emit('event-failed-set-event-by-id', 'Terdapat asesi atau asesor yang sudah terdaftar');
            } else {
                $this->eventId = $eventId;
                $this->emit('event-success-set-event-by-id', $data->skema);
            }

        } catch (Exception $e) {
            $this->emit('event-failed-set-event-by-id', 'Data event tidak ditemukan');
        }
    }

    public function eventDeleted()
    {
        try {

            $data = Event::findOrFail($this->eventId);
            $data->delete();

            $this->emit('event-success-delete-event');
        } catch (Exception $e) {
            $this->emit('event-failed-delete-event', 'Data event tidak ditemukan');
        }
    }
}
