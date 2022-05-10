<?php

namespace App\Http\Livewire\Asesor;

use App\Models\Asesor;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{

    public $search = '';


    // automaticly rerender when event is active
    protected $listeners = [
        'successAsesorCreated',
        'updateAsesorSuccess'
    ];
    
    public function render()
    {
        $data = Asesor::with('user')
        ->whereRaw("UPPER(name) like '%". trim($this->search ? strtoupper($this->search) : '')."%'")
        ->orWhereRaw("UPPER(nik) like '%". trim($this->search ? strtoupper($this->search) : '')."%'")
        ->get();
        return view('livewire.asesor.index', [
            'data' => $data,
        ]);
    }

    public function successAsesorCreated() {
        return null;
    }

    public function updateAsesorSuccess() {

    }

    public function update($asesorId) {
        $this->emit('updateAsesorHandle', $asesorId);
    }
}
