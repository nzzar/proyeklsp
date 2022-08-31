<?php

namespace App\Http\Livewire\Asesor\Event\Asesi;

use App\Models\MeninjauAsesmenNotes;
use App\Models\MeninjauAsesment;
use App\Models\SkemaAsesi;
use Carbon\Carbon;
use Exception;
use Livewire\Component;

class MeninjauAsesmen extends Component
{
    public $skemaAsesiId;
    public $kegiatan;
    public $result;
    public $tinjauId;
    public $notes;
    public $otherNotes;
    public $canEdit = true;
    public $skemaAsesi;

    protected $listeners = [
        'save'
    ];
    
    public function mount($id)
    {
        try {
            $this->skemaAsesi  = SkemaAsesi::findOrFail($id);
           $this->skemaAsesiId = $id;

           $endDate =  Carbon::createFromFormat('d/m/Y H:i', $this->skemaAsesi->event->end_date);
           $now = Carbon::now();

           $this->canEdit = $endDate->gte($now);
        } catch (Exception $err) {
            abort(404);
        }
    }
    
    public function render()
    {
        $skemaAsesi = SkemaAsesi::findOrFail($this->skemaAsesiId);
        return view('livewire.asesor.event.asesi.meninjau-asesmen', compact('skemaAsesi'));
    }

    public function tinjau($id) {
        if(!$this->canEdit)  return;
        
        try {

            $tinjau = MeninjauAsesment::findOrFail($id);
            $this->tinjauId = $id;
            $this->notes = $tinjau->komentar;
            $this->kegiatan = $tinjau->kegiatan_asesmen;
            $this->result = $tinjau->result;

            $this->emit('meninjau', ['type' => 'get']);

        } catch(Exception $err) {
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

    public function setTinjau() {
        if(!$this->canEdit)  return;
        try {
            $item = MeninjauAsesment::findOrFail($this->tinjauId);
            $item->komentar = $this->notes;
            $item->result = $this->result;
            $item->save();


            $this->notes = null;
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Success!',
                'title' => 'Data berhasil diperbarui',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        } catch (Exception $err) {
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
        if(!$this->canEdit)  return;
        
        try {

            $data = MeninjauAsesmenNotes::where('skema_asesi_id', $this->skemaAsesiId)->first();

            if(!$data) {
                $data = new MeninjauAsesmenNotes();
            }

            $data->skema_asesi_id = $this->skemaAsesiId;
            $data->komentar = $this->otherNotes;
            $data->save();

            
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Success!',
                'title' => 'Data berhasil disimpan',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        } catch (Exception $err) {
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error!',
                'title' => 'Gagal menyimpan data',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        }
    }
}
