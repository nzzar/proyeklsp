<?php

namespace App\Http\Livewire\Master\Prodi;

use App\Models\Prodi;
use Exception;
use Livewire\Component;

class Create extends Component
{
    public $name;
    
    public function render()
    {
        return view('livewire.master.prodi.create');
    }

    public function save() {
        $this->validate([
            'name' => 'required|min:5|string'
        ]);

        try {
            $prodi = new Prodi();
            $prodi->name = $this->name;
            $prodi->save();
            $this->resetProperty();
            $this->emit('successCreateProdi');
        } catch (Exception $e) {
            $this->emit('failedCreateProdi');
        }
    }

    private function resetProperty() {
        $this->name = null;
        $this->prodiId = null;
    }
}
