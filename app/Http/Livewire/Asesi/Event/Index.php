<?php

namespace App\Http\Livewire\Asesi\Event;

use App\Models\Event;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {

        $events = Event::where('status', 'Approved')
            ->where('active', true)
            ->withCount([
                'asesi as asesi_approve' => function($query) {
                    $query->where('status', 'Lulus');
                }
            ])
            ->get();
        
        return view('livewire.asesi.event.index', compact('events'));
    }
}
