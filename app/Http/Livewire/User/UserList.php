<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;



class UserList extends Component
{
    public $data;
    public $userSelected;
    public $password;
    public $cpassword;
    public $search;

    public function render()
    {

        $this->data = User::where('id','!=', Auth::id())
        ->where('email', 'like', "%". trim($this->search ? $this->search : ''). "%")
        ->get();

        return view('livewire.user.user-list');
    }

    public function resetForm($userId) {
        $this->userSelected = User::find($userId);
    }

    public function resetPassword() {
        $this->validate([
            'password' => 'required|min:6',
            'cpassword' => 'required|same:password'
        ]);


        
        
        $user = User::findOrFail($this->userSelected->id);
        $user->password = Hash::make($this->password);
        $user->save();

        $this->password = null;
        $this->cpassword = null;
        
        $this->emit('passwordReseted',  $this->userSelected->email);

    }




}
