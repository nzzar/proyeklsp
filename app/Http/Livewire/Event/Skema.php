<?php

namespace App\Http\Livewire\Event;

use App\Models\Skema as ModelsSkema;
use Livewire\Component;

class Skema extends Component
{
    public $skemaId;
    
    public function mount($id) {
        $this->skemaId = $id;        
    }
    
    public function render()
    {
        $skema = ModelsSkema::with('unitKompetensi.element.unjukKerja')->findOrFail($this->skemaId);
        return view('livewire.event.skema', compact('skema'));
    }
}
