<?php

namespace App\Http\Livewire\Asesor\Event;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $search;
    
    public function render()
    {
        $user = Auth::user();
        
        $event = Event::with(
            'skema'
         )
             ->whereHas(
                 'skema',
                 function ($skema) {
                     return $skema->whereRaw("UPPER(name) like '%" . trim($this->search ? strtoupper($this->search) : '') . "%'");
                 }
             )
             ->whereHas('asesor', function($query) use($user) {
                $query->where('asesor_id', $user->asesor->id);
             })
             ->withCount('asesi')
             ->get();
        
        return view('livewire.asesor.event.index', compact('event'));
    }
}
