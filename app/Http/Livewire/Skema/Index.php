<?php

namespace App\Http\Livewire\Skema;

use App\Models\Skema;
use Livewire\Component;

class Index extends Component
{
    public $search;
    
    protected $listeners = [
        'successSaveSkema' => 'updateTable',
        'successUpdateSkema' => 'updateTable',
        'successDeletedSkema' => 'updateTable',
    ];
    
    public function render()
    {
        $data = Skema::whereRaw("UPPER(name) like '%" . trim($this->search ? strtoupper($this->search) : '') . "%'")
            ->orWhereRaw("UPPER(nomor) like '%" . trim($this->search ? strtoupper($this->search) : '') . "%'")
            ->get();

        return view('livewire.skema.index', [
            'data' => $data,
        ]);
    }

    public function update($skemaId) {
      $this->emit('getSkemaById', $skemaId);
    }

    public function delete($skemaId) {
        $this->emit('setDeleteSkemaId', $skemaId);
    }

    public function updateTable() {
        return null;
    }
}
