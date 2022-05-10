<?php

namespace App\Http\Livewire\Master\Prodi;

use App\Models\Prodi;
use Exception;
use Livewire\Component;

class Update extends Component
{
    public $name;
    public $prodiId;
    
    protected $listeners = [
        'updateProdi' => 'handleGetProdiById'
    ];

    public function render()
    {
        return view('livewire.master.prodi.update');
    }

    public function handleGetProdiById($prodiId) {
        try {
            $prodi = Prodi::findOrFail($prodiId);
            $this->name = $prodi->name;
            $this->prodiId = $prodiId;

           
            $this->emit('successGetProdiById');
            
        } catch (Exception $e) {
            $this->emit('failedGetProdiById');
        }
    }

    public function update() {
        $this->validate([
            'name' => 'required|min:5|string'
        ]);

        try {
            $prodi = Prodi::findOrFail($this->prodiId);
            $prodi->name = $this->name;
            $prodi->save();
            $this->resetProperty();
            $this->emit('successUpdateProdi');
        } catch (Exception $e) {
            $this->emit('failedUpdateProdiById');
        }
    }

    private function resetProperty() {
        $this->name = null;
        $this->prodiId = null;
    }
}
