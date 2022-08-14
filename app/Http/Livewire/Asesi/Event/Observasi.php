<?php

namespace App\Http\Livewire\Asesi\Event;

use App\Models\Skema;
use App\Models\SkemaAsesi;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Observasi extends Component
{
    public $skemaAsesi;
    public function mount($id)
    {
        try {
            $this->skemaAsesi = SkemaAsesi::findOrFail($id);
            if ($this->skemaAsesi->asesi_id != Auth::user()->asesi->id) {
                throw new Exception("Unauthorized", 401);
            }
        } catch (Exception $err) {
            abort(404);
        }
    }

    public function render()
    {
        $skemaAsesi = SkemaAsesi::findOrFail($this->skemaAsesi->id);

        $this->skemaAsesi = $skemaAsesi;
        $skema = Skema::with([
            'unitKompetensi.element.unjukKerja.asesi' => function ($query) use ($skemaAsesi) {
                $query->where([
                    'asesi_id' => $skemaAsesi->asesi_id,
                    'event_id' => $skemaAsesi->event_id,
                ]);
            }
        ])
            ->withCount('element')
            ->findOrFail($skemaAsesi->event->skema->id);

        return view('livewire.asesi.event.observasi', compact('skema'));
    }
}
