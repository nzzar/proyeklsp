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

    protected $listeners = [
        'updateDateRangePicker'
    ];

    public function render()
    {
        return view('livewire.skema.create');
    }

    public function updateDateRangePicker($value)
    {
        $daterange = explode('-', $value);
        $this->startDate = $daterange[0];
        $this->endDate = $daterange[1];
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
                'start_date' => DateTime::createFromFormat('d/m/Y', trim($this->startDate))->format('Y-m-d'),
                'end_date' => DateTime::createFromFormat('d/m/Y', trim($this->endDate))->format('Y-m-d')
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
        $this->startDate = null;
        $this->endDate = null;
        $this->active = true;
    }
}
