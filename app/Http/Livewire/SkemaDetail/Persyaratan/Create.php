<?php

namespace App\Http\Livewire\SkemaDetail\Persyaratan;

use App\Models\PersyaratanSkema;
use Livewire\Component;

class Create extends Component
{
    public $skemaId;
    public $name;
    
    public function mount($skemaId)
    {

        $this->skemaId = $skemaId;
        
        return view('livewire.skema-detail.persyaratan.create');
    }


    public function save() {
        $this->validate([
            'name' => 'required|min:5',
        ]);

        $syarat = new PersyaratanSkema();
        $syarat->skema_id = $this->skemaId;
        $syarat->name = $this->name;
        $syarat->save();

        $this->emit('create-success');
    
    }
}
