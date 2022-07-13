<?php

namespace App\Http\Livewire\Asesi\Event;

use App\Models\Asesi;
use App\Models\Event;
use App\Models\PersyaratanAsesi;
use App\Models\PersyaratanSkema;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Detail extends Component
{

    use WithFileUploads; 

    public $eventId;

    public $persyaratan_id;
    public $persyaratan_name;
    public $file;

    public $view_file;

    public $tujuan;

    public function mount($id)
    {
        $this->eventId = $id;
    }


    public function render()
    {

        try {
            $eventId = $this->eventId;
            $asesi = Asesi::where('user_id', Auth::user()->id)->firstOrFail();
            $event = Event::where('status', 'Approved')
                ->with([
                    'skema.unitKompetensi',
                    'skema.persyaratan.asesi' => function($query) use($eventId){
                        $query->where('event_id', $eventId);
                    }
                ])
                ->where('id', $eventId)
                ->firstOrFail();


            // dd($event);

        } catch (Exception $err) {
            abort(404);
        }

        return view('livewire.asesi.event.detail', compact('asesi', 'event', ));
    }

    public function uploadPersyaratan() {

        try {
            $this->validate([
                'file' => 'required|max:10000|mimes:jpg,jpeg,png'
            ]);

            $asesi = Auth::user()->asesi;

            $syarat = PersyaratanSkema::findOrFail($this->persyaratan_id);


            $data = PersyaratanAsesi::where([
                'persyaratan_id' => $syarat->id,
                'asesi_id' => $asesi->id,
                'event_id' => $this->eventId,
            ])->first(); 
            
            if(!$data) {
                $data = new PersyaratanAsesi();
            } else {
                Storage::delete($data->file);
            }

            $file_name = 'persyaratan_' . time() . '_' . $asesi->id . '.' . $this->file->getClientOriginalExtension();
            $file_path = $this->file->storeAs("public/event/". $this->eventId . "/asesi" ."/". $asesi->id . "/persyaratan". "/", $file_name);

            $data->file = $file_path;
            $data->asesi_id = $asesi->id;
            $data->event_id = $this->eventId;
            $data->persyaratan_id = $syarat->id;
            $data->skema_id = $syarat->skema_id;
            $data->save();

            $this->dispatchBrowserEvent('swal', [
                'title' => 'Success!',
                'title' => 'Persyaratan berhasil diupload',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);

             
        } catch(Exception $err) {
            dd($err);
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error!',
                'title' => 'Persyaratan gagal diupload',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);


        }
        
    } 

    public function getPeryaratan($persyaratanId) {
        try {
            $data = PersyaratanSkema::findOrFail($persyaratanId);
            $this->persyaratan_id = $data->id;
            $this->persyaratan_name = $data->name;
            $this->emit('get-persyaratan-success', ['type' => 'upload']);
        } catch(Exception $err) {
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error!',
                'title' => 'Gagal mengambil data persyaratan',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);

        }
    }
}
