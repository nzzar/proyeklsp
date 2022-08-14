<?php

namespace App\Http\Livewire\Asesor\Event\Asesi;

use App\Models\SkemaAsesi;
use Exception;
use Livewire\Component;

class Form extends Component
{
    public $skemaAsesiId;
    public $view_file;

    
    public function mount($id) {
        $this->skemaAsesiId = $id;
    }
    
    public function render()
    {
        try {
            $skema = SkemaAsesi::where('id', $this->skemaAsesiId)->firstOrFail();
        } catch (Exception $err) {
            abort(404);
        }
        
        return view('livewire.asesor.event.asesi.form', compact('skema'));
    }

    
}
