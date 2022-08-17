<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Data Asesi</div>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-4 col-md-2">
                            NIM
                        </div>
                        <div class="col">
                            : {{$skemaAsesi->asesi->nim}}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 col-md-2">
                            Jurusan
                        </div>
                        <div class="col">
                            : {{$skemaAsesi->asesi->prodi->name}}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 col-md-2">
                            Nama Lengkap
                        </div>
                        <div class="col">
                            : {{$skemaAsesi->asesi->name}}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 col-md-2">
                            Event
                        </div>
                        <div class="col">
                            : {{$event->title}}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 col-md-2">
                            Skema
                        </div>
                        <div class="col">
                            : {{$event->skema->name}}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 col-md-2">
                            Nomor Skema
                        </div>
                        <div class="col">
                            : {{$event->skema->nomor}}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 col-md-2">
                            Asesor
                        </div>
                        <div class="col">
                            : {{$skemaAsesi->asesor->name ?? '-'}}
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4 col-md-2">
                            Rekomendasi
                        </div>
                        <div class="col d-flex">
                            : @switch($skemaAsesi->status)
                            @case('Menunggu Keputusan')
                            <h5 class="ml-2"> <span class="badge badge-lg badge-secondary">{{$skemaAsesi->status}}</span> </h5>
                            @break
                            @case('Diterima')
                            <h5 class="ml-2"> <span class="badge badge-lg badge-success">{{$skemaAsesi->status}}</span> </h5>
                            @break
                            @default
                            <h5 class="ml-2"> <span class="badge badge-lg badge-danger">{{$skemaAsesi->status}}</span> </h5>
                            @endswitch
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <div>
                            <button class="btn btn-sm btn-primary mr-1 mb-2 mb-md-1" wire:click="changeTab('form')"><i class="fas fa-list-ul"></i> FR.APL.01</button>
                            @if($skemaAsesi->status == 'Diterima')
                            <button class="btn btn-sm btn-primary mr-1 mb-2 mb-md-1" wire:click="changeTab('asesmen')"><i class="fas fa-tasks"></i>Asessment mandiri</button>
                            @endif
                            @if($skemaAsesi->asesmentMandiri->continue ?? null)
                            <button class="btn btn-sm btn-primary mr-1 mb-2 mb-md-1" wire:click="changeTab('observasi')"><i class="fas fa-tasks"></i> Checklist observasi</button>
                            @endif
                            @if($skemaAsesi->asesmentMandiri->continue ?? null)
                            <button class="btn btn-sm btn-primary mr-1 mb-2 mb-md-1" wire:click="changeTab('tinjau')"><i class="fas fa-list-ul"></i> Menijau Asesi</button>
                            @endif
                            @if($skemaAsesi->asesmentMandiri->continue ?? null)
                            <button class="btn btn-sm btn-primary mr-1 mb-2 mb-md-1" wire:click="changeTab('feedback')"><i class="far fa-comment-alt"></i>Umpan Balik Asesi</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($tabActive == 'form')
    @livewire('asesor.event.asesi.form', ['id' => $skemaAsesiId])
    @elseif($tabActive == 'asesmen')
    @livewire('asesor.event.asesi.asesment-mandiri', ['id' => $skemaAsesiId])
    @elseif($tabActive == 'observasi')
    @livewire('asesor.event.asesi.observasi', ['id' => $skemaAsesiId])
    @elseif($tabActive == 'feedback')
    @livewire('asesor.event.asesi.feedback', ['id' => $skemaAsesiId])
    @elseif($tabActive == 'tinjau')
    @livewire('asesor.event.asesi.meninjau-asesmen', ['id' => $skemaAsesiId])
    @endif
</div>

@section('script')
<script src="{{asset('/assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('/assets/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>
<script src="{{asset('/assets/plugins/signature/js/jquery.signature.min.js')}}"></script>

<script>
    window.addEventListener('swal', function(e) {
        Swal.fire(e.detail);
    });

    $('#save-container').on('click', '.btn-save', function() {
            Swal.fire({
                icon: 'question',
                title: `Simpan Data Meninjau Instrumen Asesmen ?`,
                html: 'Pastikan semua data telah diisi dengan benar, tidak dapat melakukan perubahan data setelah disimpan!',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Simpan',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Livewire.emit('save')
                }
            })
        })
</script>

@stop