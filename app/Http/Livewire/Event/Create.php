<?php

namespace App\Http\Livewire\Event;

use App\Models\Event;
use App\Models\Skema;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Livewire\Component;

class Create extends Component
{
    public $skemas;
    public $skemaId;
    public $startDate;
    public $endDate;
    public $status = true;
    public $qty;
    public $tuk;
    public $title;


    protected $listeners = [
        'event-select-skema-handling' => 'selectSkema',
        'event-set-start-date' => 'setStartDate',
        'event-set-end-date' => 'setEndDate',
    ];

    public function render()
    {

        $this->skemas =  Skema::all();

        return view('livewire.event.create');
    }

    public function save()
    {
        try {
            $this->validate(
                [
                    'skemaId' => 'required|exists:skemas,id',
                    'startDate' => 'required|date_format:d/m/Y h:i|after_or_equal:' . date('d/m/Y h:i'),
                    'endDate' => 'required|date_format:d/m/Y h:i|after:startDate',
                    'status' => 'required',
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
        } catch (Exception $e) {
            $this->emit('error-validation');
            throw $e;
        }



        $event = new Event();
        $event->skema_id = $this->skemaId;
        $event->start_date =  Carbon::createFromFormat('d/m/Y h:i', $this->startDate)->format('Y-m-d h:i');
        $event->end_date = Carbon::createFromFormat('d/m/Y h:i', $this->endDate)->format('Y-m-d h:i');
        $event->active = $this->status;
        $event->status = 'Draft';
        $event->qty = $this->qty;
        $event->title = $this->title;
        $event->tuk = $this->tuk;
        $event->save();


        $this->resetForm();
        $this->emit('event-create-created');
    }


    public function selectSkema($skemaId)
    {
        $this->emit('event-reinit');
        $this->skemaId = $skemaId;
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
        $this->skemaId = null;
        $this->startDate = Carbon::now()->format('d/m/Y');
        $this->endDate = Carbon::now()->format('d/m/Y');
        $this->status = true;
    }
}
