<?php

namespace App\Http\Livewire\SkemaDetail\Persyaratan;

use Livewire\Component;

class Create extends Component
{
    public $skemaId;
    
    public function mount($skemaId)
    {

        $this->skemaId = $skemaId;
        
        return view('livewire.skema-detail.persyaratan.create');
    }
}
