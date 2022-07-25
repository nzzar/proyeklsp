<?php

namespace App\Http\Livewire\Event\Asesi;

use App\Models\AsesmentMandiri;
use App\Models\AsesmentMandiriResult;
use App\Models\PersyaratanSkema;
use App\Models\Skema;
use App\Models\SkemaAsesi;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class AsesmenMandiri extends Component
{
    use WithFileUploads;

    public $skemaAsesi;
    public $view_file;
    public $signature;
    public $continue;

    public $errorMessage;

    protected $listeners = [
        'init-asesmen-mandiri' => 'initTtd',
        'save-rekomendasi' => 'saveRekomendasi'
    ];

    public function mount($id)
    {
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

        if (is_null($this->continue) && !$this->signature) {
            $this->errorMessage = '* Rekomendasi dan tanda tangan tidak boleh kosong';
        } else {
            $this->errorMessage = null;
        }

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
            abort('404');
        }

        return view('livewire.event.asesi.asesmen-mandiri', compact('skema'));
    }

    public function initTtd()
    {
        // dd('test');
        $this->emit('init-ttd');
    }

    public function saveRekomendasi()
    {
        DB::beginTransaction();

        try {

            $skemaAsesi = SkemaAsesi::with('asesmentMandiri')
                ->findOrFail($this->skemaAsesi->id);

            if($skemaAsesi->asesor) {
                throw new Exception("Asesi sudah diberi rekomendasi");
            }
            $skemaAsesi->asesor_id = Auth::user()->asesor->id;

            $file_name = 'signature_asesor' . time() . '_' . Auth::user()->asesor->id . '.' . $this->signature->getClientOriginalExtension();
            $file_path = $this->signature->storeAs("public/event/" . $this->skemaAsesi->event_id . "/asesi" . "/" . $skemaAsesi->asesi_id . "/", $file_name);

            $skemaAsesi->ttd_asesor = $file_path;
            $skemaAsesi->save();

            $asesmenResult = AsesmentMandiriResult::findOrFail($skemaAsesi->asesmentMandiri->id);
            $asesmenResult->continue = $this->continue;
            $asesmenResult->tgl_ttd_asesor = Carbon::now()->format('Y-m-d');
            $asesmenResult->save();

            DB::commit();

            $this->emit('refress-parent');

            $this->dispatchBrowserEvent('swal', [
                'title' => 'Success!',
                'text' => 'Berhasil menyimpan rekomendasi',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        } catch (Exception $err) {
            dd($err);
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error !',
                'text' => 'Gagal menyimpan rekomendasi',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'top-right'
            ]);
        }
    }
}
