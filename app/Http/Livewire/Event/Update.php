<?php

namespace App\Http\Livewire\Event;

use App\Models\Event;
use Carbon\Carbon;
use Exception;
use Livewire\Component;

class Update extends Component
{


    public $skemas;
    public $startDate;
    public $endDate;
    public $status = true;
    public $eventId;


    protected $listeners = [
        'event-set-start-date' => 'setStartDate',
        'event-set-end-date' => 'setEndDate',
        'event-set-update-event-id' => 'setEventId'
    ];

    public function render()
    {   

        return view('livewire.event.update');
    }

    public function setEventId($eventId) {
        try {

            $event = Event::with('skema')->findOrFail($eventId);

            $this->skemas = $event->skema;
            $this->startDate = $event->start_date;
            $this->endDate = $event->end_date;
            $this->eventId = $event->id;
            $this->emit('event-update-set-event-by-id-success');
        } catch (Exception $e) {
            $this->emit('event-update-set-event-by-id-failed');
        }
    }

    public function save()
    {
        try {
            $this->validate(
                 [
                     'startDate' => 'required|date_format:d/m/Y|after_or_equal:'. date('d/m/Y'),
                     'endDate' => 'required|date_format:d/m/Y|after:startDate',
                     'status' => 'required'
                 ],
                 [],
                 [
                     'skemaId' => 'Skema',
                     'startDate' => 'Tgl. Mulai',
                     'endDate' => 'Tgl. Selesai'
                 ]
             );

        } catch(Exception $e) {
            $this->emit('error-validation');
            throw $e;
        }



        $event = Event::find($this->eventId);
        $event->start_date =  Carbon::createFromFormat('d/m/Y', $this->startDate)->format('Y-m-d');
        $event->end_date = Carbon::createFromFormat('d/m/Y', $this->endDate)->format('Y-m-d');
        $event->active = $this->status;
        $event->save();


        $this->resetForm();
        $this->emit('event-update-updated');
    }



    public function setStartDate($date)
    {
        $this->emit('event-reinit');
        $this->startDate = $date;
    }

    public function setEndDate($date)
    {
        $this->emit('event-reinit');
        $this->endDate = $date;
    }

    public function setStatus($status)
    {
        $this->emit('event-reinit');
        $this->status = $status;
    }

    private function resetForm()
    {
        $this->eventId = null;
        $this->startDate = Carbon::now()->format('d/m/Y');
        $this->endDate = Carbon::now()->format('d/m/Y');
        $this->status = true;
    }
}
