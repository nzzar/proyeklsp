<?php

namespace App\Http\Livewire\Event\Sertifikat;

use App\Models\Event;
use App\Models\SertifikatAsesi;
use App\Models\SkemaAsesi;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $eventId;
    public $file;
    public $skemaAsesiId;
    public $view_file;

    public function mount($id)
    {
        try {


            $event = Event::where('id', $id)
                ->firstOrFail();

            $this->eventId = $id;
        } catch (Exception $err) {
            abort(404);
        }
    }

    public function render()
    {
        $event = Event::with([
            'skema',
            'asesis' => function ($query) {
                $query->where('skema_status', 'Kompeten');
            }
        ])
            ->where('id', $this->eventId)
            ->firstOrFail();

        return view('livewire.event.sertifikat.index', compact('event'));
    }

    public function uploadSertificat()
    {
        DB::beginTransaction();
        try {

            $this->validate([
                'file' => 'required|max:10000|mimes:pdf'
            ]);

            $skemaAsesi = SkemaAsesi::findOrFail($this->skemaAsesiId);

            $file_name = 'sertifikat_' . time() . '_' . $this->skemaAsesiId . '.' . $this->file->getClientOriginalExtension();
            $file_path = $this->file->storeAs("public/asesi/" . $skemaAsesi->asesi_id . "/" . "sertifikat", $file_name);

            $sertifikat = SertifikatAsesi::where('skema_asesi_id', $this->skemaAsesiId)
                ->first();

            if (!$sertifikat) {
                $sertifikat = new SertifikatAsesi();
                $sertifikat->skema_asesi_id = $this->skemaAsesiId;
            } else {
                Storage::delete($sertifikat->sertifikat);
            }

            $sertifikat->sertifikat = $file_path;
            $sertifikat->save();

            DB::commit();

            $this->dispatchBrowserEvent('swal', [
                'title' => 'Success!',
                'text' => 'Upload sertifikat berhasil',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        } catch (Exception $err) {
            DB::rollBack();

            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error !',
                'text' => 'Gagal upload sertifikat',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);

        }
    }

    public function downloadSertifikat($id) {
        try {
            $data = SertifikatAsesi::findOrFail($id);
            
            return Storage::download($data->sertifikat);
        } catch (Exception $err) {
            dd($err);
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error!',
                'text' => 'Gagal download surat tugas',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        }
    }
}
