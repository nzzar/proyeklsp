<?php

namespace App\Http\Livewire\Asesor;

use App\Models\Asesor;
use App\Models\User;
use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
    public $userId;

    protected $listeners = [
        "updateAsesorHandle"
    ];
    
    public function render()
    {
        return view('livewire.asesor.update');
    }

    public function save() {
        $this->validate([
            'email' => 'required|email|unique:users,email,'.$this->userId.',id',
            'password' => 'nullable|min:6',
            'cPassword' => 'same:password',
            'name' => 'required',
            'nik' => 'required|min:10|unique:asesors,nik,'.$this->asesorId.',id',
            'gender' => 'required',
            'phone' => 'required|numeric',
            'birthDate' => 'required|date_format:d/m/Y',
            'address' => 'required|min:8|max:500'

        ]);


        DB::beginTransaction();

        try {

            $user = User::findOrFail($this->userId);

            $user->email = $this->email;
            $this->password ? $user->password = Hash::make($this->password) : null;
            $user->save();


            $asesor = Asesor::findOrFail($this->asesorId);
            $asesor->name = $this->name;
            $asesor->nik = $this->nik;
            $asesor->phone = $this->phone;
            $asesor->birth_date =  DateTime::createFromFormat('d/m/Y', $this->birthDate)->format('Y-m-d');
            $asesor->gender = $this->gender;
            $asesor->address = $this->address;
            $asesor->save();

            DB::commit();
            $this->resetProperty();
            $this->emit('updateAsesorSuccess'); 
        } catch(Exception $e) {
            DB::rollBack();
            $this->emit('updateAsesorFailed');
            
        }
    }

    public function toggleGender($value) {
        $this->gender = $value;
    }

    public function birthDateInputHandle($value)
    {
        $this->birthDate = $value;
    }

    public function updateAsesorHandle($asesorId) {
        try {

            $asesor = Asesor::with('user')->findOrFail($asesorId);
            $this->email = $asesor->user->email;
            $this->asesorId = $asesorId;
            $this->name = $asesor->name;
            $this->gender = $asesor->gender;
            $this->nik = $asesor->nik;
            $this->phone = $asesor->phone;
            $this->birthDate = DateTime::createFromFormat('Y-m-d', $asesor->birth_date)->format('d/m/Y');
            $this->address = $asesor->address;
            $this->userId = $asesor->user->id;



            $this->emit('foundDataAsesor', [
                'gender' => $this->gender,
                'birthDate' => $this->birthDate,
            ]);
            
        } catch (Exception $e) {
            $this->emit('asesorDataNotFound');
        }
    }

    private function resetProperty() {
        $this->email = null;
        $this->password = null;
        $this->cPassword = null;
        $this->nik = null;
        $this->name = null;
        $this->gender = "l";
        $this->phone = null;
        $this->birthDate = null;
        $this->address = null;
    }
}
