<?php

namespace App\Http\Livewire\Ms\Event;

use App\Models\Event;
use Exception;
use Livewire\Component;

class Index extends Component
{
    public $search;

    public $eventId;
    public $desc;
    
    protected $listeners = [
        'approve-event' => 'approveEvent'
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
             ->where('status', '!=' , 'Draft')
             ->withCount('asesi')
             ->withCount('asesor')
             ->get();
 
        
        return view('livewire.ms.event.index', compact('event'));
    }

    public function approveEvent($id) {

        try {
            $event = Event::findOrFail($id);
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

    public function unApproved() {

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

            $this->eventId = null;
            $this->desc = null;

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
