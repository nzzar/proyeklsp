<?php

namespace App\Http\Livewire\Asesi\Event;

use App\Models\SkemaAsesi;
use Illuminate\Support\Facades\Auth;
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
}
