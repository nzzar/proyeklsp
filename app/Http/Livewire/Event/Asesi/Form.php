<?php

namespace App\Http\Livewire\Event\Asesi;

use App\Models\PersyaratanAsesi;
use App\Models\SkemaAsesi;
use Exception;
use Livewire\Component;

class Form extends Component
{

    public $skemaAsesiId;
    public $asesiId;
    public $view_file;


    protected $listeners = [
        'approvePersyaratan',
        'rejectPersyaratan',
        'refress'
    ];
    
    public function mount($id) {

        try {
            $data = SkemaAsesi::findOrFail($id);
            $this->asesiId = $data->asesi_id;
            $this->skemaAsesiId = $id;

        } catch (Exception $err) {
            abort(404);
        }
    }
    
    
    public function render()
    {   
        $asesiId = $this->asesiId;

        try {
            $skema = SkemaAsesi::with([
                'event.skema.persyaratan.asesi' => function($query) use ($asesiId) {
                    $query->where('asesi_id', $asesiId);
                }
            ])
            ->where('id', $this->skemaAsesiId)->firstOrFail();
        } catch (Exception $err) {
            abort(404);
        }
        
        return view('livewire.event.asesi.form', compact('skema'));
    }

    public function approvePersyaratan($id) {
        try {
            $syarat = PersyaratanAsesi::findOrFail($id);
            $syarat->status = 'Memenuhi Syarat';
            $syarat->save();

            $this->dispatchBrowserEvent('swal', [
                'title' => 'Success!',
                'text' => 'Persyaratan berhasil diupdate',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        } catch(Exception $err) {
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error !',
                'text' => 'Failed update persyaratan',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        }

        $this->emit('refress-parent');
    }

    public function rejectPersyaratan($id) {
        try {
            $syarat = PersyaratanAsesi::findOrFail($id);
            $syarat->status = 'Tidak Memenuhi Syarat';
            $syarat->save();

            $this->dispatchBrowserEvent('swal', [
                'title' => 'Success!',
                'text' => 'Persyaratan berhasil diupdate',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        } catch(Exception $err) {
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error !',
                'text' => 'Failed update persyaratan',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        }

        $this->emit('refress-parent');
    }

    public function refress() {}
}
