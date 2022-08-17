<?php

namespace App\Http\Livewire\Event;

use App\Models\Event;
use App\Models\Skema;
use Carbon\Carbon;
use Exception;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class Detail extends Component
{
    public $tabActive;
    
    
    public $skemas;
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
        'propose-event' => 'proposeEvent'

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

            $this->skemas = Skema::all();
        } catch (Exception $err) {
            abort(404);
        }
    }


    public function render()
    {
        try {
            $event = Event::with('skema')
                ->where('id', $this->eventId)
                ->firstOrFail();
            $this->status = $event->status;
            $this->active = $event->active;
            $this->desc = $event->desc;

            // $this->skemas = Skema::all();
        } catch (Exception $err) {
            abort(404);
        }
        return view('livewire.event.detail');
    }

    public function edit()
    {
        $this->validate(
            [
                'skemaId' => 'required|exists:skemas,id',
                'startDate' => 'required|date_format:d/m/Y H:i',
                'endDate' => 'required|date_format:d/m/Y H:i|after:startDate',
                'title' => 'required',
                'qty' => 'required|integer',
                'tuk' => 'required'
            ],
            [],
            [
                'skemaId' => 'Skema',
                'startDate' => 'Tgl. Mulai',
                'endDate' => 'Tgl. Selesai',
                'title' => 'Judul Event',
                'qty' => 'Quata Peserta',
                'tuk' => 'Tempat Uji Kompentensi'
            ]
        );


        $event = Event::findOrFail($this->eventId);
        $event->skema_id = $this->skemaId;
        $event->start_date = Carbon::createFromFormat('d/m/Y h:i', $this->startDate)->format('Y-m-d h:i');
        $event->end_date = Carbon::createFromFormat('d/m/Y h:i', $this->endDate)->format('Y-m-d h:i');
        $event->title = $this->title;
        $event->qty = $this->qty;
        $event->tuk = $this->tuk;
        $event->save();


        $this->dispatchBrowserEvent('swal', [
            'title' => 'Data updated Saved',
            'timer' => 3000,
            'icon' => 'success',
            'toast' => true,
            'showConfirmButton' => false,
            'position' => 'top-right'
        ]);
    }
    
    public function active() {
        try {
            $event = Event::findOrFail($this->eventId);
            $event->active = true;
            $event->save();
            $this->dispatchBrowserEvent('swal', [
                'text' => 'Success!',
                'title' => 'Event sudah active',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
            
        } catch (Exception $err) {
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error!',
                'title' => 'Gagal mengaktifkan event',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);

        }
    }

    public function nonActive() {
        try {
            $event = Event::findOrFail($this->eventId);
            $event->active = false;
            $event->save();
            $this->dispatchBrowserEvent('swal', [
                'text' => 'Success!',
                'title' => 'Event sudah tidak aktif',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
            
        } catch (Exception $err) {
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error!',
                'title' => 'Gagal menonaktifkan event',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);

        }
    }

    function proposeEvent() {
        try {
            $event = Event::findOrFail($this->eventId);
            $event->status = 'Waiting';
            $event->save();

            $this->dispatchBrowserEvent('swal', [
                'text' => 'Success!',
                'title' => 'Event sudah diajukan',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        } catch(Exception $err) {
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error!',
                'title' => 'Gagal mengajukan event',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);

        }
    }
}
