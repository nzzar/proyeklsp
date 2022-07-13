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

class Detail extends Component
{

    public $eventId;

    public $persyaratan_id;
    public $file;

    public function mount($id)
    {
        $this->eventId = $id;
    }


    public function render()
    {

        try {
            $asesi = Asesi::where('user_id', Auth::user()->id)->firstOrFail();
            $event = Event::where('status', 'Approved')
                ->with('skema.unitKompetensi')
                ->where('id', $this->eventId)
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
            $file_path = $this->profile->storeAs("public/event/". $this->eventId . "/asesi" ."/". $asesi->id . "/persyaratan". "/", $file_name);

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

    public function getPeryaratan() {

    }
}
