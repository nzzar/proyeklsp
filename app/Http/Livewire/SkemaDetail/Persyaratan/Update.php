<?php

namespace App\Http\Livewire\SkemaDetail\Persyaratan;

use App\Models\PersyaratanSkema;
use Livewire\Component;

class Update extends Component
{

    public $persyaratanId;
    public $name;
    protected $listeners = [
        'set-persyaratan-id' => 'setId'
    ];

    public function render()
    {
        return view('livewire.skema-detail.persyaratan.update');
    }

    public function setId($persyaratanId)
    {
        $data = PersyaratanSkema::where('id', $persyaratanId)->first();
        $this->persyaratanId = $data->id;
        $this->name = $data->name;
    }

    public function update()
    {
        $data = PersyaratanSkema::findOrFail($this->persyaratanId);
        $data->name = $this->name;
        $data->save();
        $this->emit('update-success');
    }
}
