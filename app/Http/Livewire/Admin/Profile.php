<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use PhpParser\Node\Expr\FuncCall;

class Profile extends Component
{
    use WithFileUploads;

    public $signature;
    public $name;
    public $reg;
    public $errorMessage;

    public function render()
    {

        $admin = Admin::where('user_id', Auth::user()->id)
            ->first();

        if ($admin) {
            $this->signature = $admin->signature;
            $this->name = $admin->name;
            $this->reg = $admin->no_reg;
        }

        if (!$this->signature) {
            $this->errorMessage = '* Tanda tangan tidak boleh kosong';
        } else {
            $this->errorMessage = null;
        }

        return view('livewire.admin.profile');
    }

    public function save()
    {

        $this->validate(
            [
                'name' => 'required',
                'reg' => 'required',
            ],
            [],
            [
                'name' => 'Nama lengkap',
                'reg' => 'Nomor registrasi',
            ]
        );

        DB::beginTransaction();

        try {

            $admin = Admin::where('user_id', Auth::user()->id)
                ->first();

            if (!$admin) {
                $admin = new Admin();
                $admin->user_id = Auth::user()->id;

                if ($admin->signature) {
                    Storage::delete($admin->signature);
                }
            }

            $file_name = 'signature_' . time() . '_' . $admin->id . '.' . $this->signature->getClientOriginalExtension();
            $file_path = $this->signature->storeAs("public/admin/" . $admin->id .  "/", $file_name);
            
            $admin->signature = $file_path;
            $admin->name = $this->name;
            $admin->no_reg = $this->reg;
            $admin->save();

            DB::commit();

            $this->dispatchBrowserEvent('swal', [
                'title' => 'Success!',
                'title' => 'Update data admin berhasil',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        } catch (Exception $err) {
            DB::rollBack();
            dd($err);
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Failed!',
                'title' => 'Update data admin gagal',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        }
    }

    public function test()
    {
        dd('test');
    }
}
