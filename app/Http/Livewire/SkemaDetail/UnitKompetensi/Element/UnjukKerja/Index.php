<?php

namespace App\Http\Livewire\SkemaDetail\UnitKompetensi\Element\UnjukKerja;

use App\Models\UnjukKerja;
use Livewire\Component;

class Index extends Component
{
    public $elementId;

    public function mount($elementId) {
        $this->elementId = $elementId;
    }
    
    public function render()
    {
        $data = UnjukKerja::where('element_id', $this->elementId)->get();

        return view('livewire.skema-detail.unit-kompetensi.element.unjuk-kerja.index', compact('data'));
    }
}
