<?php

namespace App\Http\Livewire\Skema;

use App\Models\Skema;
use Exception;
use Livewire\Component;

class Delete extends Component
{
    public $skemaId;

    protected $listeners = [
        'setDeleteSkemaId' => 'handleGetSkemaById',
        'confirmDelete' => 'delete'
    ];
    
    public function render()
    {
        return view('livewire.skema.delete');
    }

    public function handleGetSkemaById($skemaId) {
        try {
            $skema = Skema::findOrFail($skemaId);
            $this->skemaId = $skemaId;

           
            $this->emit('successSetSkemaDeleted', $skema->name);
            
        } catch (Exception $e) {
            $this->emit('failedSetSkemaDeleted');
        }
    }

    public function delete() {
        try {
            $skema = Skema::findOrFail($this->skemaId);
            $skema->delete();

            $this->emit('successDeletedSkema');
            $this->resetProperty();
        } catch(Exception $e) {
            $this->emit('failedDeletedSkema');
        }
    }

    private function resetProperty() {
        $this->skemaId = null;
    }
}
