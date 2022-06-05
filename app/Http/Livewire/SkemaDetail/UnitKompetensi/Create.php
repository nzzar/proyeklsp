<?php

namespace App\Http\Livewire\SkemaDetail\UnitKompetensi;

use App\Models\UnitKompetensi;
use Livewire\Component;

class Create extends Component
{
    public $skemaId;
    public $kode;
    public $judul;

    public function mount($skemaId) {
        $this->skemaId = $skemaId;
    }
    
    public function render()
    {
        return view('livewire.skema-detail.unit-kompetensi.create');
    }

    public function save() {
        $this->validate([
            'kode' => 'required',
            'judul' => 'required',
        ]);

        $data = new UnitKompetensi();
        $data->skema_id = $this->skemaId;
        $data->kode = $this->kode;
        $data->judul = $this->judul;
        $data->save();

        $this->emit('unit-created');
    }
}
