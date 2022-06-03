<?php

namespace App\Http\Livewire\Skema;

use App\Models\Skema;
use DateTime;
use Exception;
use Livewire\Component;

class Create extends Component
{
    public $nomor;
    public $name;
    public $startDate;
    public $endDate;
    public $active = true;


    public function render()
    {
        return view('livewire.skema.create');
    }

    public function toggleStatus($value)
    {
        $this->active = $value == 'y' ? true : false;
    }

    public function save()
    {
        $this->validate([
            'nomor' => 'required|unique:skemas,nomor',
            'name' => 'required|min:5',
        ]);


        try {
            Skema::insert([
                'nomor' => $this->nomor,
                'name' => $this->name,
                'active' => $this->active,
            ]);
            
            $this->resetProperty();
            $this->emit('successSaveSkema');
        } catch (Exception $e) {
            $this->emit('failedSaveSkema');
        }
    }

    private function resetProperty()
    {
        $this->nomor = null;
        $this->name = null;
        $this->active = true;
    }
}
