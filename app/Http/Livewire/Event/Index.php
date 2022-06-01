<?php

namespace App\Http\Livewire\Event;

use App\Models\Event;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Index extends Component
{
    public $search;

    protected $listeners = [
        'event-create-created' => 'refress',
        'event-success-delete-event' => 'refress',
        'event-update-updated' => 'refress',
    ];

    public function render()
    {
        $event = Event::with(
           'skema'
        )
            ->whereHas(
                'skema',
                function ($skema) {
                    return $skema->whereRaw("UPPER(name) like '%" . trim($this->search ? strtoupper($this->search) : '') . "%'");
                }
            )
            ->withCount('asesi')
            ->withCount('asesor')
            ->get();

        // dd($event);
        return view('livewire.event.index', compact('event'));
    }

    public function deleteEvent($eventId)
    {
        $this->emit('setEventId', $eventId);
    }

    public function update($eventId) {
        $this->emit('event-set-update-event-id', $eventId);
    }

    public function refress()
    {
    }
}
