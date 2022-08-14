<?php

namespace App\Http\Livewire\Asesi\Event;

use App\Models\SkemaAsesi;
use App\Models\UmpanBalik;
use App\Models\UmpanBalikNote;
use Carbon\Carbon;
use Exception;
use Livewire\Component;

class FeedBack extends Component
{
    public $skemaAsesiId;

    public $notes;
    public $komponen;
    public $result = false;
    public $itemId;

    public $otherNotes;

    protected $listeners = [
        'save'
    ];


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
            

            return view('livewire.asesi.event.feed-back', compact('skemaAsesi', 'umpanBalik'));
        } catch (Exception $err) {
            abort(404);
        }
    }

    public function umpanBalik($id)
    {
        try {
            $item = UmpanBalik::findOrFail($id);
            $this->notes = $item->notes;
            $this->itemId = $item->id;
            $this->komponen = $item->komponen;
            $this->result = $item->result;

            $this->emit('feedback', ['type' => 'get']);
        } catch (Exception $err) {
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error!',
                'title' => 'Gagal mendapatkan data',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        }
    }

    public function setFeedback()
    {
        try {
            $item = UmpanBalik::findOrFail($this->itemId);
            $item->notes = $this->notes;
            $item->id = $this->itemId;
            $item->hasil = $this->result;
            $item->save();


            $this->dispatchBrowserEvent('swal', [
                'title' => 'Success!',
                'title' => 'Umpan balik berhasil diperbarui',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        } catch (Exception $err) {
            dd($err);
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error!',
                'title' => 'Gagal meperbarui data',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        }
    }

    public function save() {
        try {
            $item = new UmpanBalikNote();
            $item->notes = $this->otherNotes;
            $item->skema_asesi_id = $this->skemaAsesiId;
            $item->datetime = Carbon::now()->toIso8601String();
            $item->save();


            $this->dispatchBrowserEvent('swal', [
                'title' => 'Success!',
                'title' => 'Umpan balik berhasil diperbarui',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        } catch (Exception $err) {
            dd($err);
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error!',
                'title' => 'Gagal meperbarui data',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        }
    } 
}
