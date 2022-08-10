<?php

namespace App\Http\Livewire\Event;

use App\Models\Asesor as ModelsAsesor;
use App\Models\SkemaAsesor;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Asesor extends Component
{
    use WithFileUploads;
    public $file;
    
    public $eventId;
    public $asesorId;
    public $asesor;

    public $skemaAsesorId;

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

    public function uploadSurat() {

        DB::beginTransaction();
        try {
            $asesor = SkemaAsesor::findOrFail($this->skemaAsesorId);

            $file_name = 'surat_tugas_' . time() . '_' . $asesor->id . '.' . $this->file->getClientOriginalExtension();
            $file_path = $this->file->storeAs("public/event/asesor/" . $asesor->asesor->id , $file_name);

            if($asesor->surat_tugas) {
                Storage::delete($asesor->surat_tugas);
            }

            $asesor->surat_tugas = $file_path;
            $asesor->save();

            DB::commit();


            $this->dispatchBrowserEvent('swal', [
                'title' => 'Success !',
                'text' => 'Success upload surat tugas',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
            
        } catch(Exception $err) {
            DB::rollBack();
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error!',
                'text' => 'Gagal upload surat tugas',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);

        }
    }

    public function downloadSurat($id) {
        try {
            $asesor = SkemaAsesor::findOrFail($id);
            
            return Storage::download($asesor->surat_tugas);
        } catch (Exception $err) {
            dd($err);
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error!',
                'text' => 'Gagal download surat tugas',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        }
    }
}
