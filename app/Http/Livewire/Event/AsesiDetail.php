<?php

namespace App\Http\Livewire\Event;

use App\Models\Event;
use App\Models\PersyaratanAsesi;
use App\Models\PersyaratanSkema;
use App\Models\SkemaAsesi;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AsesiDetail extends Component
{

    public $skemaAsesiId;
    public $tabActive;
    public $validPersyaratan;

    protected $listeners = [
        'refress-parent' => 'refress',
        'approveAsesi',
        'rejectAsesi'
    ];
    
    public function mount($id) {
        
        $this->tabActive = 'form';
        $this->skemaAsesiId = $id;
    }
    
    public function render()
    {

        try {
            $skemaAsesi = SkemaAsesi::findOrFail($this->skemaAsesiId);
            $event = Event::where('id', $skemaAsesi->event_id)
            ->firstOrFail();

            $skema = PersyaratanSkema::where('skema_id', $event->skema_id)->count();
            $asesi = PersyaratanAsesi::where('event_id', $event->id)
            ->where('status', 'Memenuhi Syarat')->count();

            if($asesi == $skema) {
                $this->validPersyaratan = true;
            } else {
                $this->validPersyaratan = false;
            }
            
        } catch(Exception $err) {
            abort(404);
        }
        
        return view('livewire.event.asesi-detail', compact('event','skemaAsesi'));
    }

    public function approveAsesi($id) {
        try {

            $data = SkemaAsesi::findOrFail($id);
            $data->admin_id = Auth::user()->admin->id;
            $data->status = 'Diterima';
            $data->tgl_ttd_admin = Carbon::now()->format('Y-m-d');
            $data->save();

            $this->dispatchBrowserEvent('swal', [
                'title' => 'Success!',
                'text' => 'Asesi berhasil diterima',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);

        } catch (Exception $err) {
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error !',
                'text' => 'Gagal update skema asesi',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        }

        $this->emit('refress');
    }

    public function rejectAsesi($id) {
        try {

            $data = SkemaAsesi::findOrFail($id);
            $data->admin_id = Auth::user()->admin->id;
            $data->status = 'Tidak Diterima';
            $data->tgl_ttd_admin = Carbon::now()->format('Y-m-d');
            $data->save();

            $this->dispatchBrowserEvent('swal', [
                'title' => 'Success!',
                'text' => 'Asesi berhasil ditolak',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);

        } catch (Exception $err) {
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error !',
                'text' => 'Gagal update skema asesi',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        }

        $this->emit('refress');
    }

    public function changeTab($tab) {
        $this->tabActive = $tab;
        $this->emit('tab-'.$this->tabActive);
    }

    public function refress(){}
}
