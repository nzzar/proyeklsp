<?php

namespace App\Http\Livewire\Event\Asesi;

use App\Models\SkemaAsesi;
use Exception;
use Livewire\Component;

class MeninjauAsesmen extends Component
{
    public $skemaAsesiId;
    
    public function mount($id)
    {
        try {
           SkemaAsesi::findOrFail($id);
           $this->skemaAsesiId = $id;
        } catch (Exception $err) {
            abort(404);
        }
    }
    
    
    public function render()
    {
        $skemaAsesi = SkemaAsesi::findOrFail($this->skemaAsesiId);
        return view('livewire.event.asesi.meninjau-asesmen', compact('skemaAsesi'));
    }
}
