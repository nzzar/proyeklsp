<?php

namespace App\Http\Livewire\Event\Asesi;

use App\Models\AsesmentMandiri;
use App\Models\PersyaratanSkema;
use App\Models\Skema;
use App\Models\SkemaAsesi;
use Exception;
use Livewire\Component;

class AsesmenMandiri extends Component
{
    public $skemaAsesi;
    public $view_file;

    public function mount($id) {
        try {


            $skemaAsesi = SkemaAsesi::findOrFail($id);
            $this->document = PersyaratanSkema::with([
                'asesi' => function ($query) use ($skemaAsesi) {
                    $query->where([
                        'asesi_id' => $skemaAsesi->asesi_id,
                        'event_id' => $skemaAsesi->event_id,
                    ]);
                }
            ])
                ->where([
                    'skema_id' => $skemaAsesi->event->skema->id,
                ])
                ->get();


            $this->skemaAsesi = $skemaAsesi;
        } catch (Exception $err) {
            abort('404');
        }
    }
    
    public function render()
    {
        try {
            $skemaAsesi = SkemaAsesi::with('asesmentMandiri')->findOrFail($this->skemaAsesi->id);

            $this->skemaAsesi = $skemaAsesi;
            $skema = Skema::with([
                'unitKompetensi.element.asesi' =>  function ($query) use ($skemaAsesi) {
                    $query->where([
                        'event_id' => $skemaAsesi->event_id,
                        'asesi_id' => $skemaAsesi->asesi_id,
                        'skema_id' => $skemaAsesi->event->skema->id
                    ]);
                },
                'unitKompetensi.element.asesi.syarat'
            ])
                ->withCount('element')
                ->where('id', $skemaAsesi->event->skema->id)
                ->firstOrFail();

        } catch (Exception $err) {
            dd($err);
            abort('404');
        }
        
        return view('livewire.event.asesi.asesmen-mandiri', compact('skema'));
    }
}
