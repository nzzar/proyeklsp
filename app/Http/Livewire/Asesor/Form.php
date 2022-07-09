<?php

namespace App\Http\Livewire\Asesor;

use App\Models\Asesor;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $asesorId;
    public $userId;

    public $nik;
    public $name;
    public $gender;
    public $phone;
    public $birth_date;
    public $profession;
    public $educational;
    public $address;
    public $profile;

    public $blanko;
    public $reg_number;
    public $start_date;
    public $expired_date;
    public $image;

    public $email;
    public $password;
    public $c_password;



    public function mount($asesorId = null)
    {
        if ($asesorId) {
            try {

                $data = Asesor::with('user')
                    ->where('id', $asesorId)
                    ->firstOrFail();
                $this->nik  = $data->nik;
                $this->name = $data->name;
                $this->gender = $data->gender;
                $this->phone = $data->phone;
                $this->birth_date = $data->birth_date;
                $this->profession = $data->profession;
                $this->educational = $data->education;
                $this->address =  $data->address;
                $this->blanko = $data->blanko_number;
                $this->reg_number = $data->reg_number;
                $this->start_date = $data->start_date;
                $this->expired_date = $data->expired_date;
                $this->image = $data->sertificate;
                $this->profile = $data->profile;


                $this->email = $data->user->email;
                $this->asesorId = $asesorId;
                $this->userId = $data->user->id;

            } catch (Exception $err) {
                abort(404, 'Page not found');
            }
        }
    }

    public function render()
    {
        return view('livewire.asesor.form');
    }

    public function save()
    {

        
        $role = [
            'nik' => 'required',
            'name' => 'required',
            'gender' => 'required|in:p,l',
            'phone' => 'required',
            'birth_date' => 'required|date_format:d/m/Y',
            'profession' => 'required',
            'educational' => 'required',
            'address' => 'required',
            'blanko' => 'required',
            'reg_number' => 'required',
            'start_date' =>  'required|date_format:d/m/Y',
            'expired_date' =>  'required|date_format:d/m/Y',
        ];
        
        
        if(!$this->asesorId) {
            
           $role = array_merge($role, [
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'c_password' => 'same:password',
                'image' => 'required|max:10000|mimes:jpg,jpeg,png',
                'profile' => 'required|max:10000|mimes:jpg,jpeg,png'
            ]);
        } else {
           $role = array_merge($role, [
                'email' => 'required|email|unique:users,email,'.$this->userId,
                'password' => 'min:6|nullable',
                'c_password' => 'same:password',
            ]);
        }


        $this->validate(
            $role,
            [],
            [],
        );

        DB::beginTransaction();

        try {
            if ($this->asesorId) {
                $user = User::findOrFail($this->userId);
                $user->email = $this->email;

                $this->password ? $user->password = Hash::make($this->password) : null;
                $user->save();

                $data = Asesor::findOrFail($this->asesorId);

            } else {
                $user = new User();
                $user->email = $this->email;
                $user->password = Hash::make($this->password);
                $user->active = true;
                $user->role = 'asesor';
                $user->save();

                $data = new Asesor();
            }


            $this->asesorId ? null : $data->user_id = $user->id;

            if($this->image && !is_string($this->image)) {

                if($data->sertificate) {
                    Storage::delete($data->sertificate);
                }
                
                
                $file_name = 'sertificate_'.time().'_'.$this->userId.'.'.$this->image->getClientOriginalExtension();
                $path = $this->image->storeAs("public/".$this->userId.'/', $file_name);

                $data->sertificate = $path;
            }

            if($this->profile && !is_string($this->profile)) {

                if($data->profile) {
                    Storage::delete($data->profile);
                }
                
                
                $file_name = 'profile_'.time().'_'.$this->userId.'.'.$this->profile->getClientOriginalExtension();
                $profile_path = $this->profile->storeAs("public/".$this->userId.'/', $file_name);

                $data->profile = $profile_path;
            }
            
            $data->nik = $this->nik;
            $data->name = $this->name;
            $data->gender = $this->gender;
            $data->phone = $this->phone;
            $data->birth_date = Carbon::createFromFormat('d/m/Y', $this->birth_date)->format('Y-m-d');
            $data->profession = $this->profession;
            $data->education = $this->educational;
            $data->address = $this->address;
            $data->blanko_number = $this->blanko;
            $data->reg_number = $this->reg_number;
            $data->start_date = Carbon::createFromFormat('d/m/Y', $this->start_date)->format('Y-m-d');
            $data->expired_date = Carbon::createFromFormat('d/m/Y', $this->expired_date)->format('Y-m-d');
            $data->save();
            DB::commit();

            return redirect('/asesor');
        } catch (Exception $err) {
            DB::rollBack();
            dd($err);
        }
    }
}
