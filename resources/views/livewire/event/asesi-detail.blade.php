<div class="container-fluid">
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
                            <button class="btn btn-sm btn-primary mr-1 mb-2 mb-md-1" wire:click="$set('tabActive','form')"><i class="fas fa-list-ul"></i> FR.APL.01</button>
                            @if($skemaAsesi->status == 'Diterima')
                            <button class="btn btn-sm btn-primary mr-1 mb-2 mb-md-1" wire:click="$set('tabActive','asesmen')" ><i class="fas fa-tasks"></i>Asessment mandiri</button>
                            <button class="btn btn-sm btn-primary mr-1 mb-2 mb-md-1"><i class="fas fa-tasks"></i> Checklist observasi</button>
                            <button class="btn btn-sm btn-primary mr-1 mb-2 mb-md-1"><i class="far fa-comment-alt"></i> Feed back</button>
                            @endif
                        </div>
                        @if($skemaAsesi->status == 'Menunggu Keputusan')
                        <div class="d-flex">
                            <span class="font-wight-bold">Rekomendasi :</span>
                            @if($validPersyaratan)
                            <button class="btn btn-sm btn-success ml-1 mr-1 mb-2 mb-md-1" onclick="approveAsesi('{{$skemaAsesiId}}')"><i class="fas fa-check"></i> Diterima</button>
                            @else 
                            <button class="btn btn-sm btn-success ml-1 mr-1 mb-2 mb-md-1" disabled data-toggle="tooltip" data-placement="top" title="Berkas belum memenuhi syarat"><i class="fas fa-check"></i> Diterima</button>
                            @endif
                            <button class="btn btn-sm btn-danger mr-1 mb-2 mb-md-1" onclick="rejectAsesi('{{$skemaAsesiId}}')"><i class="fas fa-times"></i> Tidak Diterima</button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($tabActive == 'form')
        @livewire('event.asesi.form', ['id' => $skemaAsesiId])
    @elseif($tabActive == 'asesmen')
        @livewire('event.asesi.asesmen-mandiri', ['id' => $skemaAsesiId])
    @endif
</div>

@section('script')
<script>
    window.addEventListener('swal', function(e) {
        Swal.fire(e.detail);
    });

    function approveAsesi($id) {
        Swal.fire({
            icon: 'question',
            title: 'Terima asesi ?',
            showCancelButton: true,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                Livewire.emit('approveAsesi', $id)
            }
        })
    
    }

    function rejectAsesi($id) {
        Swal.fire({
            icon: 'question',
            title: 'Tolak asesi ?',
            showCancelButton: true,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                Livewire.emit('rejectAsesi', $id)
            }
        })
    
    }
</script>
@stop