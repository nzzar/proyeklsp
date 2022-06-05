<?php

namespace App\Http\Livewire\SkemaDetail\UnitKompetensi;

use App\Models\UnitKompetensi;
use Livewire\Component;

class Update extends Component
{
    protected $listeners = [
        'update-unit-set-id' => 'setId'
    ];
    
    public $unitId;
    public $kode;
    public $judul;
    
    public function render()
    {
        return view('livewire.skema-detail.unit-kompetensi.update');
    }

    public function setId($unitId) {
        $data = UnitKompetensi::findOrFail($unitId);
        $this->kode = $data->kode;
        $this->judul = $data->judul;
        $this->unitId = $data->id;
    }

    public function update() {
        $this->validate([
            'kode' => 'required',
            'judul' => 'required',
        ]);

        $data = UnitKompetensi::findOrFail($this->unitId);
        $data->kode = $this->kode;
        $data->judul = $this->judul;
        $data->save();

        $this->emit('unit-updated');
    }
}
