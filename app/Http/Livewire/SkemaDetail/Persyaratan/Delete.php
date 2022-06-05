<?php

namespace App\Http\Livewire\SkemaDetail\Persyaratan;

use App\Models\PersyaratanSkema;
use Livewire\Component;

class Delete extends Component
{
    public $persyaratanId;

    protected $listeners = [
        'delete-set-id-persyaratan' => 'setId',
        'delete-persyaratan' => 'deleteData'
    ];
    
    public function render()
    {
        return view('livewire.skema-detail.persyaratan.delete');
    }

    public function setId($persyaratanId) {

        $this->persyaratanId = $persyaratanId;
        $data = PersyaratanSkema::findOrFail($persyaratanId);
        $this->emit('delete-set-persyaratan-success', $data->name);
    }

    public function deleteData() {
        PersyaratanSkema::where('id', $this->persyaratanId)->delete();
        $this->emit('persyaratan-deleted');
    }
}
