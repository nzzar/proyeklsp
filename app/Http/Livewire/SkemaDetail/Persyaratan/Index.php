<?php

namespace App\Http\Livewire\SkemaDetail\Persyaratan;

use App\Models\PersyaratanSkema;
use Livewire\Component;

class Index extends Component
{
    public $persyaratan;
    
    public function mount($skemaId)
    {

        $this->persyaratan = PersyaratanSkema::where('skema_id', $skemaId)->get();
        
        return view('livewire.skema-detail.persyaratan.index');
    }
}
