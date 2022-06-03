<?php

namespace App\Http\Livewire\Skema;

use App\Models\Skema;
use DateTime;
use Exception;
use Livewire\Component;

class Update extends Component
{
    public $nomor;
    public $name;
    public $active = 0;
    public $skemaId;


    protected $listeners = [
        'getSkemaById'
    ];

    public function render()
    {
        return view('livewire.skema.update');
    }

    public function toggleStatus($value)
    {
        $this->active = $value == 'y' ? true : false;
    }


    public function save()
    {
        $this->validate([
            'nomor' => 'required|unique:skemas,nomor,' . $this->skemaId . ',id',
            'name' => 'required|min:5',
        ]);


        try {
            $skema = Skema::findOrFail($this->skemaId);
            $skema->nomor = $this->nomor;
            $skema->name = $this->name;
            $skema->active = $this->active;
            $skema->save();

            $this->resetProperty();
            $this->emit('successUpdateSkema');
        } catch (Exception $e) {
            $this->emit('failedUpdateSkema');
        }
    }

    public function getSkemaById($skemaId)
    {
        try {

            $skema = Skema::findOrFail($skemaId);
            $this->skemaId = $skema->id;
            $this->nomor = $skema->nomor;
            $this->name = $skema->name;
            $this->active = $skema->active;

            $this->emit(
                'successGetSkemaById',
                [
                    'active'=> $this->active,
                ]
            );
        } catch (Exception $e) {
            $this->emit('failedGetSkemaById');
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
