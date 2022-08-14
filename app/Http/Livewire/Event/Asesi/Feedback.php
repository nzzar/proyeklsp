<?php

namespace App\Http\Livewire\Event\Asesi;

use App\Models\SkemaAsesi;
use App\Models\UmpanBalik;
use Exception;
use Livewire\Component;

class Feedback extends Component
{
    public $skemaAsesiId;
    
    public function mount($id)
    {
        try {

            $skemaAsesi = SkemaAsesi::findOrFail($id);
            $this->skemaAsesiId = $skemaAsesi->id;
        } catch (Exception $err) {
            abort(404);
        }
    }
    
    public function render()
    {
        try {
            $id = $this->skemaAsesiId;
            $skemaAsesi = SkemaAsesi::with([
                'feedBackNotes' => function($query) use($id) {
                    $query->where('skema_asesi_id', $id);
                } 
            ])
            ->findOrFail($id);
            $umpanBalik = UmpanBalik::where('skema_asesi_id', $skemaAsesi->id)
            ->get();
            return view('livewire.event.asesi.feedback', compact('skemaAsesi', 'umpanBalik'));

        } catch(Exception $err) {
            abort(404);
        }
    }
}
