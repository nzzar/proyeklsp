<?php

namespace App\Http\Livewire\Asesor;

use App\Models\Asesor;
use App\Models\User;
use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Create extends Component
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


    protected $listeners = [
        'birthDateInputHandle'
    ];

    public function render()
    {
        return view('livewire.asesor.create');
    }

    public function save()
    {
        $this->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'cPassword' => 'required|same:password',
            'name' => 'required',
            'nik' => 'required|min:10|unique:asesors,nik',
            'gender' => 'required',
            'phone' => 'required|numeric',
            'birthDate' => 'required|date_format:d/m/Y',
            'address' => 'required|min:8|max:500'

        ]);


        DB::beginTransaction();

        try {

            $userId = User::insertGetId([
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'active' => true,
                'role' => 'asesor',
            ]);


            Asesor::insert([
                'user_id' => $userId,
                'name' => $this->name,
                'nik' => $this->nik,
                'phone' => $this->phone,
                'gender' => $this->gender,
                'birth_date' => DateTime::createFromFormat('d/m/Y', $this->birthDate)->format('Y-m-d'),
                'address' => $this->address,
            ]);

            DB::commit();
            $this->resetField();
            $this->emit('successAsesorCreated');
            
        } catch (Exception $e) {
            DB::rollBack();
            $this->emit('errorAsesorCreated');
        }
    }

    public function toggleGender($value)
    {
        $this->gender = $value;
    }

    public function birthDateInputHandle($value)
    {
        $this->birthDate = $value;
    }

    private function resetField()
    {
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
