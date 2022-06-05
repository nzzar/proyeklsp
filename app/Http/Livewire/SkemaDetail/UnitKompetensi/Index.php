<?php

namespace App\Http\Livewire\SkemaDetail\UnitKompetensi;

use App\Models\UnitKompetensi;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = [
        'unit-created' => 'refresh',
        'unit-deleted' => 'refresh',
        'unit-updated' => 'refresh',
    ];
    
    
    public $skemaId;


    public function mount($skemaId) {
        $this->skemaId = $skemaId;
    }
    
    public function render()
    {
        $unitKompetensi = UnitKompetensi::where('skema_id', $this->skemaId)->get();
        return view('livewire.skema-detail.unit-kompetensi.index', compact('unitKompetensi'));
    }

    public function update($unitId) {
        $this->emit('update-unit-set-id', $unitId);
    }

    public function delete($unitId) {
        $this->emit('delete-set-unit-id', $unitId);
    }

    public function refresh() {}
}
