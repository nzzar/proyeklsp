<?php

namespace App\Http\Livewire\Event;

use App\Models\Asesor as ModelsAsesor;
use App\Models\SkemaAsesor;
use Exception;
use Livewire\Component;

class Asesor extends Component
{
    public $eventId;
    public $asesorId;
    public $asesor;

    public function mount($id)
    {
        $this->eventId = $id;
    }

    public function render()
    {
        $id = $this->eventId;

        $asesorsExists =  ModelsAsesor::whereNotIn('id', function ($query) use ($id) {
            $query->select('asesor_id')->from('skema_asesor')->where('event_id', $id);
        })
            ->get();

        $asesors = SkemaAsesor::where('event_id', $id)
            ->get();

        return view('livewire.event.asesor', compact('asesors', 'asesorsExists'));
    }

    public function getAsesorById() {
        try {
            if($this->asesorId) {
                $this->asesor = ModelsAsesor::findOrFail($this->asesorId);
            } else {
                $this->asesor = null;
            }
        } catch(Exception $err) {
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error !',
                'text' => 'Failed get data asesor',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        }
    }

    public function addAsesor() {
        $asesor = new SkemaAsesor();
        $asesor->asesor_id = $this->asesor->id;
        $asesor->event_id = $this->eventId;
        $asesor->save();

        $this->asesorId = null;
        $this->asesor = null;

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Success !',
            'text' => 'Success menambahkan data asesor',
            'timer' => 3000,
            'icon' => 'success',
            'toast' => true,
            'showConfirmButton' => false,
            'position' => 'top-right'
        ]);
    }

    public function deleteAsesor($id) {
        try {
            $asesor = SkemaAsesor::findOrFail($id);
            $asesor->delete();

            $this->dispatchBrowserEvent('swal', [
                'title' => 'Success !',
                'text' => 'Success menghapus data asesor',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        } catch(Exception $err) {
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error!',
                'text' => 'Gagal menghapus data asesor',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        }
    }
}
