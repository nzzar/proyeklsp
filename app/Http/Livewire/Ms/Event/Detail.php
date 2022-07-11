<?php

namespace App\Http\Livewire\Ms\Event;

use App\Models\Event;
use Exception;
use Livewire\Component;

class Detail extends Component
{
    public $tabActive;


    public $skema;
    public $skemaId;

    public $eventId;
    public $startDate;
    public $endDate;
    public $active;
    public $status;
    public $title;
    public $qty;
    public $desc;

    protected $listeners = [
        'approve-event' => 'approvedEvent'
    ];
    

    public function mount($id)
    {
        try {
            $event = Event::with('skema')
                ->where('id', $id)
                ->firstOrFail();
            $this->eventId = $event->id;
            $this->title = $event->title;
            $this->qty = $event->qty;
            $this->tuk = $event->tuk;
            $this->startDate = $event->start_date;
            $this->endDate = $event->end_date;
            $this->skemaId = $event->skema->id;
            $this->status = $event->status;
            $this->active = $event->active;
            $this->desc = $event->desc;
            $this->skema = $event->skema;
        } catch (Exception $err) {
            abort(404);
        }
    }

    public function render()
    {
        $event = Event::with('skema')
            ->where('id', $this->eventId)
            ->firstOrFail();
        $this->status = $event->status;
        $this->active = $event->active;
        $this->desc = $event->desc;

        return view('livewire.ms.event.detail');
    }

    public function approvedEvent()
    {

        try {
            $event = Event::findOrFail($this->eventId);
            $event->status = 'Approved';
            $event->save();

            $this->dispatchBrowserEvent('swal', [
                'title' => 'Success!',
                'text' => 'Berhasil merubah status event',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        } catch (Exception $err) {
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error!',
                'text' => 'Gagal merubah status event',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        }
    }

    public function unApproved()
    {
        
        $this->validate(
            [
                'desc' => 'required',
            ],
            [],
            [
                'desc' => 'Keterangan'
            ]
        );


        try {
            $event = Event::findOrFail($this->eventId);
            $event->status = 'Unapproved';
            $event->desc = $this->desc;
            $event->save();

            $this->emit('unapproved-success');

            $this->dispatchBrowserEvent('swal', [
                'title' => 'Success!',
                'text' => 'Berhasil merubah status event',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        } catch (Exception $err) {
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error!',
                'text' => 'Gagal merubah status event',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        }
    }
}
