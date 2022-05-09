<?php

namespace App\Http\Livewire\Asesor;

use App\Models\Asesor;
use DateTime;
use Exception;
use Livewire\Component;

class Update extends Component
{

    public $email;
    public $password;
    public $cPassword;
    public $nik;
    public $name;
    public $gender = "l";
    public $phone;
    public $birthDate = '';
    public $address;
    public $asesorId;

    protected $listeners = [
        "updateAsesorHandle"
    ];
    
    public function render()
    {
        return view('livewire.asesor.update');
    }

    public function save() {
        
    }

    public function updateAsesorHandle($asesorId) {
        try {

            $asesor = Asesor::findOrFail($asesorId);

            $this->asesorId = $asesorId;
            $this->name = $asesor->name;
            $this->gender = $asesor->gender;
            $this->nik = $asesor->nik;
            $this->phone = $asesor->phone;
            $this->birthDate = DateTime::createFromFormat('Y-m-d', $this->birth_date)->format('d/m/Y');
            $this->address = $asesor->address;


            $this->emit('foundDataAsesor', $asesor);
            
        } catch (Exception $e) {
            $this->emit('asesorDataNotFound');
        }
    }
}
