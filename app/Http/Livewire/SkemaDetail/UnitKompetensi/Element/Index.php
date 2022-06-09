<?php

namespace App\Http\Livewire\SkemaDetail\UnitKompetensi\Element;

use App\Models\Element;
use App\Models\UnjukKerja;
use Livewire\Component;

class Index extends Component
{
    public $unitId;
    public $elementId;
    
    public function mount($unitId) {
        $this->unitId = $unitId;
    }
    
    public function render()
    {
        $data = Element::where('unit_kompetensi_id', $this->unitId)->get();

        $unjukKerja = UnjukKerja::where('element_id', $this->elementId)->get();
        
        return view('livewire.skema-detail.unit-kompetensi.element.index', compact('data', 'unjukKerja'));
    }

    public function setElementId($elementId) {
        $this->elementId = $elementId;
    }

    
}
