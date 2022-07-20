<?php

namespace App\Http\Livewire\Asesi\Event;

use App\Models\Asesi;
use App\Models\Event;
use App\Models\PersyaratanAsesi;
use App\Models\PersyaratanSkema;
use App\Models\SkemaAsesi;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Detail extends Component
{

    use WithFileUploads;

    public $eventId;

    public $persyaratan_id;
    public $persyaratan_name;
    public $file;

    public $view_file;
    public $validRegister = false;
    public $errorMessage;

    public $signature;
    public $tujuan;

    public $validAsesmen;


    public function mount($id)
    {
        $this->eventId = $id;


        try {

            $skema = SkemaAsesi::where([
                'event_id' => $id,
                'asesi_id' => Auth::user()->asesi->id
            ])
                ->first();
            
            if ($skema) {
                $this->tujuan = $skema->tujuan_asesmen;
                $now = Carbon::now();
                $startDate = Carbon::createFromFormat('d/m/Y h:i', $skema->event->start_date);

                if ($now->gte($startDate)) {
                    $this->validAsesmen = true;
                } else {
                    $this->validAsesmen = false;
                }
            }
        } catch (Exception $err) {
            abort('500');
        }
    }


    public function render()
    {

        try {
            $eventId = $this->eventId;
            $asesi = Asesi::where('user_id', Auth::user()->id)->firstOrFail();
            $event = Event::where('status', 'Approved')
                ->with([
                    'skema.unitKompetensi',
                    'asesi' => function ($query) use ($eventId) {
                        $query->where('event_id', $eventId);
                    },
                    'skema.persyaratan.asesi' => function ($query) use ($eventId) {
                        $query->where('event_id', $eventId);
                    }
                ])
                ->where('id', $eventId)
                ->firstOrFail();

            if ($event->asesi) {
                $this->signature = $event->asesi->ttd_asesi;
            }
            $countUpload = PersyaratanAsesi::where('event_id', $this->eventId)->count();
            $countSyarat = count($event->skema->persyaratan);

            if ($countSyarat != $countUpload) {
                $this->validRegister = false;
                $this->errorMessage = '* Upload semua kelengkapan dokumen yang dibutuhkan';
            } else if (!$this->tujuan) {
                $this->validRegister = false;
                $this->errorMessage = '* Pilih tujuan asesmen terlebih dahulu';
            } else if (!$this->signature) {
                $this->validRegister = false;
                $this->errorMessage = '* Tanda tangan tidak boleh kosong';
            } else {
                $this->validRegister = true;
                $this->errorMessage = null;
            }
        } catch (Exception $err) {
            dd($err);
            abort(404);
        }

        return view('livewire.asesi.event.detail', compact('asesi', 'event',));
    }

    public function uploadPersyaratan()
    {

        try {
            $this->validate([
                'file' => 'required|max:10000|mimes:jpg,jpeg,png'
            ]);

            $asesi = Auth::user()->asesi;

            $syarat = PersyaratanSkema::findOrFail($this->persyaratan_id);


            $data = PersyaratanAsesi::where([
                'persyaratan_id' => $syarat->id,
                'asesi_id' => $asesi->id,
                'event_id' => $this->eventId,
            ])->first();

            if (!$data) {
                $data = new PersyaratanAsesi();
            } else {
                Storage::delete($data->file);
            }

            $file_name = 'persyaratan_' . time() . '_' . $asesi->id . '.' . $this->file->getClientOriginalExtension();
            $file_path = $this->file->storeAs("public/event/" . $this->eventId . "/asesi" . "/" . $asesi->id . "/", $file_name);

            $data->file = $file_path;
            $data->asesi_id = $asesi->id;
            $data->event_id = $this->eventId;
            $data->persyaratan_id = $syarat->id;
            $data->skema_id = $syarat->skema_id;
            $data->status = 'Sedang diperiksa';
            $data->save();

            $this->dispatchBrowserEvent('swal', [
                'title' => 'Success!',
                'title' => 'Persyaratan berhasil diupload',
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
                'title' => 'Persyaratan gagal diupload',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        }
    }

    public function getPeryaratan($persyaratanId)
    {
        try {
            $data = PersyaratanSkema::findOrFail($persyaratanId);
            $this->persyaratan_id = $data->id;
            $this->persyaratan_name = $data->name;
            $this->emit('get-persyaratan-success', ['type' => 'upload']);
        } catch (Exception $err) {
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error!',
                'title' => 'Gagal mengambil data persyaratan',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        }
    }

    public function registerSkema()
    {

        DB::beginTransaction();
        try {
            $asesi = Auth::user()->asesi;
            $event = Event::findOrFail($this->eventId);

            $data = new SkemaAsesi();

            $file_name = 'signature_' . time() . '_' . $asesi->id . '.' . $this->signature->getClientOriginalExtension();
            $file_path = $this->signature->storeAs("public/event/" . $this->eventId . "/asesi" . "/" . $asesi->id . "/", $file_name);

            $data->ttd_asesi = $file_path;
            $data->asesi_id = $asesi->id;
            $data->event_id = $event->id;
            $data->tujuan_asesmen   = $this->tujuan;
            $data->tgl_ttd_asesi = Carbon::now()->format('Y-m-d');
            $data->save();

            DB::commit();
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Success!',
                'title' => 'Pendaftaran Skema Berhasil',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        } catch (Exception $err) {
            DB::rollBack();
            dd($err);
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error!',
                'title' => 'Gagal mendaftarkan skema',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        }
    }
}
