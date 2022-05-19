<?php

namespace App\Http\Controllers;

use App\Models\Asesi;
use App\Models\Prodi;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AsesiController extends Controller
{
    public function profile(Request $request)
    {
        $asesi = $request->user()->asesi;
        if($asesi->birth_date) {
            $asesi->birth_date = DateTime::createFromFormat('Y-m-d', $asesi->birth_date)->format('d/m/Y');
        }

        if ($request->method() == 'POST') {

            $validateRule = [
                'nik' => 'required|numeric|min:10|unique:asesis,nik,'.$asesi->id.',id',
                'name' => 'required|min:3|max:50',
                'gender' => 'required|max:1',
                'tmpt_lahir' => 'required|min:3|max:30',
                'birth_date' => 'required|min:10|max:10',
                'kebangsaan' => 'required|max:40',
                'nim' => 'required|numeric|min:5|unique:asesis,nim,'.$asesi->id.',id',
                'prodi' => 'required',
                'kualifikasi_pendidikan' => 'required',
                'phone' => 'required|min:10|max:15',
                'address' => 'required|min:5|max:50',
                'kode_pos' => 'required|min:4|max:10',
            ];

            $attributes = [
                'nik' => 'NIK',
                'name' => 'Nama Lengkap',
                'gender' => 'Jenis Kelamin',
                'tmpt_lahir' => 'Tempat Lahir',
                'brth_date' => 'Tanggal Lahir',
                'kebangsaan' => 'Kebangsaan',
                'nim' => 'NIM',
                'prodi' => 'Prodi',
                'kualifikasi_pendidikan' => 'Kualifikasi Pendidikan',
                'phone' => 'Telepon',
                'address' => 'Alamat',
                'kode_pos' => 'Kode Pos'
            ];

            
            if(!$asesi->profile && !$request->profile) {
                $validateRule['profile'] = 'required|image|mimes:jpg,jpeg';
            }
            
            $request->validate($validateRule, [], $attributes);

            DB::beginTransaction();
            try {
                $data = Asesi::findOrFail($asesi->id);

                if($request->hasFile('profile')) {
                    // delete if file availabel
                    if($asesi->profile) {
                        Storage::delete($asesi->profile);
                    }
                    
                    // insert new file into storage
                    $file = $request->file('profile');
                    $fileName = 'profile_'.time().'_'.$request->user()->id.'.'.$file->getClientOriginalExtension();
                    $path = $file->storeAs("public/".$request->user()->id, $fileName);
                    $data->profile = $path;
                }



                $data->nik = $request->nik;
                $data->name = $request->name;
                $data->gender = $request->gender;
                $data->tmpt_lahir = $request->tmpt_lahir;
                $data->birth_date = DateTime::createFromFormat('d/m/Y', $request->birth_date)->format('Y-m-d');
                $data->kebangsaan = $request->kebangsaan;
                $data->nim = $request->nim;
                $data->prodi_id = $request->prodi;
                $data->kualifikasi_pendidikan = $request->kualifikasi_pendidikan;
                $data->phone = $request->phone;
                $data->address = $request->address;
                $data->kode_pos = $request->kode_pos;
                $data->is_filled = true;
                $data->save();
                
                DB::commit();
                Artisan::call('view:clear');
                return redirect('/asesi/profile')->with('success', 'Berhasil update data profile');
                
            } catch (Exception $e) {
                DB::rollBack();
                dd($e);
                return redirect('/asesi/profile')->with('Gagal', 'Gagal melakukan update data profile');


            }
            
        }



        $deletedProperty = ['created_at', 'updated_at', 'deleted_at', 'is_filled'];

        foreach ($deletedProperty as $property) {
            unset($asesi->{$property});
        }

        // cek kelengkapan data
        $isValidated = true;
        foreach ($asesi->getAttributes() as $key => $value) {
            if ($value == null) {
                $isValidated = false;
                break;
            }
        }

        if (!$isValidated) {
            Session::flash('incompleteProfile', 'Harap lengkapi semua data untuk dapat mengkases fitur lain nya!');
        }

        $prodis = Prodi::all();


        return view('profile-asesi', compact('asesi', 'prodis'));
    }
}
