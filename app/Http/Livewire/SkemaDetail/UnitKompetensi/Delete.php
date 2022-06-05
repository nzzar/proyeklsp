<?php

namespace App\Http\Livewire\SkemaDetail\UnitKompetensi;

use App\Models\UnitKompetensi;
use Livewire\Component;

class Delete extends Component
{
    public $unitId;

    public $listeners = [
        'delete-set-unit-id' => 'setId',
        'detete-unit' => 'deleteData'
    ];
    
    public function render()
    {
        return view('livewire.skema-detail.unit-kompetensi.delete');
    }

    public function setId($unitId) {

        $this->unitId = $unitId;
        $data = UnitKompetensi::findOrFail($unitId);
        $this->emit('delete-set-unit-id-success', $data->judul);
    }

    public function deleteData() {
        UnitKompetensi::where('id', $this->unitId)->delete();
        $this->emit('unit-deleted');
    }
}
