<?php

namespace App\Http\Livewire\SkemaDetail\Persyaratan;

use App\Models\PersyaratanSkema;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = [
        'create-success' => 'refress',
        'update-success' => 'refress'
    ];

    public $persyaratan;
    public $skemaId;
    
    public function mount($skemaId)
    {
        $this->skemaId = $skemaId;
    }
    
    public function render() {
        $this->persyaratan = PersyaratanSkema::where('skema_id', $this->skemaId)->get();
        return view('livewire.skema-detail.persyaratan.index');
    }

    public function refress() {
        // dd('test');
    }

    public function update($persyaratanId)
    {
        $this->emit('set-persyaratan-id', $persyaratanId);
    }

}
