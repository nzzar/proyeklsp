<?php

namespace App\Http\Livewire\Master\Prodi;

use App\Models\Prodi;
use Exception;
use Livewire\Component;

class Delete extends Component
{
    public $prodiId;
    
    protected $listeners = [
        'deleteProdi' => 'handleGetProdiById',
        'confirmDelete' => 'delete'
    ];
    
    public function render()
    {
        return view('livewire.master.prodi.delete');
    }

    public function handleGetProdiById($prodiId) {
        try {
            $prodi = Prodi::findOrFail($prodiId);
            $this->prodiId = $prodiId;

           
            $this->emit('successSetProdiDeleted', $prodi->name);
            
        } catch (Exception $e) {
            $this->emit('failedSetProdiDeleted');
        }
    }

    public function delete() {
        try {
            $prodi = Prodi::findOrFail($this->prodiId);
            $prodi->delete();

            $this->emit('successDeletedProdi');
            $this->resetProperty();
        } catch(Exception $e) {
            $this->emit('failedDeletedProdi');
        }
    }

    private function resetProperty() {
        $this->prodiId = null;
    }
}
