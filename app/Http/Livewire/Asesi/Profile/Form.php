<?php

namespace App\Http\Livewire\Asesi\Profile;

use App\Models\Asesi;
use App\Models\Prodi;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use RealRashid\SweetAlert\Facades\Alert;

class Form extends Component
{

    use WithFileUploads;

    public $prodi_id;
    public $nim;
    public $name;
    public $nik;
    public $phone;
    public $house_phone;
    public $office_phone;
    public $tmpt_lahir;
    public $birth_date;
    public $gender;
    public $address;
    public $kode_pos;
    public $kebangsaan;
    public $kualifikasi_pendidikan;
    public $profile;
    public $office;
    public $position;
    public $office_address;
    public $kode_pos_office;
    public $is_filled = false;

    public $asesiId;

    public $email;

    public function mount()
    {
        $user = Auth::user();
        $profile = $user->asesi;

        $this->asesiId = $profile->id;
        $this->nik = $profile->nik;
        $this->name = $profile->name;
        $this->gender = $profile->gender;
        $this->tmpt_lahir = $profile->tmpt_lahir;
        $this->birth_date = $profile->birth_date;
        $this->kebangsaan = $profile->kebangsaan;
        $this->nim = $profile->nim;
        $this->prodi_id = $profile->prodi->id;
        $this->kualifikasi_pendidikan = $profile->kualifikasi_pendidikan;
        $this->phone = $profile->phone;
        $this->address = $profile->address;
        $this->position = $profile->position;
        $this->kode_pos_office = $profile->kode_pos_office;
        $this->office_address = $profile->office_address;
        $this->kode_pos = $profile->kode_pos;
        $this->profile = $profile->profile;
        $this->is_filled = $profile->is_filled;

        $this->email = $user->email;
    }

    public function render()
    {
        $profile = Auth::user()->asesi;



        $deletedProperty = ['created_at', 'updated_at', 'deleted_at', 'is_filled'];

        foreach ($deletedProperty as $property) {
            unset($profile->{$property});
        }

        // cek kelengkapan data
        foreach ($profile->getAttributes() as $key => $value) {
            if ($value == null) {
                $this->is_filled = false;
                break;
            }
        }

        $prodis = Prodi::all();
        return view('livewire.asesi.profile.form', compact('prodis'));
    }

    public function update()
    {


        $validateRule = [
            'nik' => 'required|numeric|min:10|unique:asesis,nik,' . $this->asesiId . ',id',
            'name' => 'required|min:3|max:50',
            'gender' => 'required|max:1',
            'tmpt_lahir' => 'required|min:3|max:30',
            'birth_date' => 'required|min:10|max:10',
            'kebangsaan' => 'required|max:40',
            'nim' => 'required|numeric|min:5|unique:asesis,nim,' . $this->asesiId . ',id',
            'prodi_id' => 'required|exists:prodis,id',
            'kualifikasi_pendidikan' => 'required',
            'phone' => 'required|min:10|max:15',
            'address' => 'required|min:5|max:50',
            'kode_pos' => 'required|min:4|max:10',
            'kode_pos_office' =>'required|min:4|max:10',
            'office_address' => 'required|min:5|max:50',
            'office' => 'required',
            'position' => 'required'
        ];


        if (!$this->profile) {
            $validateRule = array_merge($validateRule, [
                'profile' => 'required|max:10000|mimes:jpg,jpeg,png'
            ]);
        }

        $attributes = [
            'nik' => 'NIK',
            'name' => 'Nama Lengkap',
            'gender' => 'Jenis Kelamin',
            'tmpt_lahir' => 'Tempat Lahir',
            'brth_date' => 'Tanggal Lahir',
            'kebangsaan' => 'Kebangsaan',
            'nim' => 'NIM',
            'prodi_id' => 'Prodi',
            'kualifikasi_pendidikan' => 'Kualifikasi Pendidikan',
            'phone' => 'Telepon',
            'address' => 'Alamat',
            'kode_pos' => 'Kode Pos',
            'kode_poss_office' => 'Kode Pos',
            'office_address' => 'Alamat Kantor',
            'position' => 'Jabatan'
        ];

        $this->validate($validateRule, [], $attributes);
        try {

            $data = Asesi::findOrFail($this->asesiId);



            if ($this->profile && !is_string($this->profile)) {

                if ($data->profile) {
                    Storage::delete($data->profile);
                }


                $file_name = 'profile_' . time() . '_' . $data->id . '.' . $this->profile->getClientOriginalExtension();
                $profile_path = $this->profile->storeAs("public/asesi/" . $data->id . '/', $file_name);

                $data->profile = $profile_path;
            }

            $data->nik = $this->nik;
            $data->name = $this->name;
            $data->gender = $this->gender;
            $data->tmpt_lahir = $this->tmpt_lahir;
            $data->birth_date = DateTime::createFromFormat('d/m/Y', $this->birth_date)->format('Y-m-d');
            $data->kebangsaan = $this->kebangsaan;
            $data->nim = $this->nim;
            $data->prodi_id = $this->prodi_id;
            $data->kualifikasi_pendidikan = $this->kualifikasi_pendidikan;
            $data->phone = $this->phone;
            $data->office_phone = $this->office_phone;
            $data->house_phone = $this->house_phone;
            $data->office = $this->office;
            $data->position = $this->position;
            $data->address = $this->address;
            $data->kode_pos = $this->kode_pos;
            $data->kode_pos_office = $this->kode_pos_office;
            $data->office_address = $this->office_address;
            $data->is_filled = true;
            $data->save();

            Alert::toast('Berhasil mengupdate data!', 'success');
            return redirect(url('/asesi/profile'));
            
        } catch (Exception $err) {
            dd($err);
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error!',
                'title' => 'Gagal memperbarui data',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        }
    }
}
