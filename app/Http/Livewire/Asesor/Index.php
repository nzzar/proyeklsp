<?php

namespace App\Http\Livewire\Asesor;

use App\Models\Asesor;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{

    public $search = '';

    protected $listeners = [
        'successAsesorCreated'
    ];
    
    public function render()
    {
        return view('livewire.asesor.index', [
            'data' => Asesor::with('user')->get(),
        ]);
    }

    public function successAsesorCreated() {
        return null;
    }
}
