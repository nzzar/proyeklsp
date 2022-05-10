<?php

namespace App\Http\Livewire\Master\Prodi;

use App\Models\Prodi;
use Livewire\Component;

class Index extends Component
{
    public $search;
    public $name;


    protected $listeners = [
        'successUpdateProdi' => 'successUpdateHandle',
        'successCreateProdi' => 'successCreateHandle',
        'successDeletedProdi' => 'successDeletedHandle'
    ];

    public function render()
    {
        $data = Prodi::whereRaw("UPPER(name) like '%" . trim($this->search ? strtoupper($this->search) : '') . "%'")
            ->get();
        return view('livewire.master.prodi.index', ['data' => $data]);
    }

    public function update($prodId) {
        $this->emit('updateProdi', $prodId);
    }

    public function delete($prodId) {
        $this->emit('deleteProdi', $prodId);
    }

    public function successUpdateHandle() {
        return null;
    }

    public function successCreateHandle() {
        return null;
    }

    public function successDeletedHandle() {
        return;
    }



}
