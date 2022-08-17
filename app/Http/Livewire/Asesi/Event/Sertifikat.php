<?php

namespace App\Http\Livewire\Asesi\Event;

use App\Models\SertifikatAsesi;
use App\Models\SkemaAsesi;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Sertifikat extends Component
{
    public $file;
    public $view_file;
    
    public function render()
    {

        $skemaAsesi = SkemaAsesi::with('sertifikat')
        ->where([
            'asesi_id' => Auth::user()->asesi->id,
            'skema_status' => 'Kompeten'
        ])
        ->get();
        
        // dd($skemaAsesi);
        
        return view('livewire.asesi.event.sertifikat', compact('skemaAsesi'));
    }

    public function downloadSertifikat($id) {
        try {
            $data = SertifikatAsesi::findOrFail($id);
            
            return Storage::download($data->sertifikat);
        } catch (Exception $err) {
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
