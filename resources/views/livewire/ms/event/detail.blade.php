<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Data Event | @switch($status)
                        @case('Waiting')
                        <span class="badge badge-warning"> Menunggu Persetujuan </span>
                        @break
                        @case('Approved')
                        <span class="badge badge-success"> Disetujui </span>
                        @break
                        @case('Unapproved')
                        <span class="badge badge-danger"> Tidak Disetujui </span>
                        @break
                        @default
                        <span class="badge badge-secondary"> Draft </span>
                        @endswitch
                        |
                        <span class="badge {{$active ? 'badge-success' : 'badge-danger'}} badge-info"> {{$active ? 'Aktif' : 'Tidak aktif'}} </span>
                    </h6>
                </div>
                <div class="card-body">
                    @if($status == 'Unapproved')
                    <div class="alert alert-danger" role="alert">
                        {{$desc}}
                    </div>
                    @endif
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Judul Event</label>
                            <input wire:model="title" disabled type="text" class="form-control" placeholder="Masukanm judul Event">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kuota Peserta</label>
                            <input wire:model="qty" disabled type="number" class="form-control" placeholder="Masukan Jumlah Kuota Peserta">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tempat Uji Kompetensi (TUK)</label>
                            <input wire:model="tuk" disabled type="text" class="form-control" placeholder="Masukan TUK">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Skema</label>
                            <input value="{{$skema->nomor}} | {{$skema->name}}" disabled type="text" class="form-control" placeholder="Masukan TUK">
                        </div>


                        <label for="exampleInputEmail1">Waktu Pelaksanaan</label>
                        <div class="row">
                            <div class="col-12 col-md-5">
                                <div class="form-group">
                                    <input readonly disabled type="text" value="{{$startDate}}" class="form-control" id="start-date">
                                    @error('startDate') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-2 text-center">Sampai</div>
                            <div class="col-12 col-md-5">
                                <div class="form-group">
                                    <input readonly disabled type="text" value="{{$endDate}}" class="form-control" id="end-date">
                                    @error('endDate') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <div>
                            <button class="btn btn-primary btn-sm" wire:click.prevent="$set('tabActive', 'skema')"><i class="fas fa-clipboard-list"></i> Data Skema</button>
                            <button class="btn btn-primary btn-sm" wire:click.prevent="$set('tabActive', 'asesor')"><i class="fas fa-user-tie"></i> Data Asesor</button>
                            <button class="btn btn-primary btn-sm"><i class="fas fa-users"></i> Data Asesi</button>
                        </div>
                        <div>
                            @if($status == 'Waiting')
                            <button class="btn btn-sm  mb-1 btn-success" onclick="approveEvent('{{$eventId}}')"> <i class="fas fa-check"></i> Approve </button>
                            <button class="btn btn-sm  mb-1 btn-danger" data-toggle="modal" data-target="#unapprove-event-modal"><i class="fas fa-times"></i> Unapprove </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @if($skemaId && $tabActive == 'skema')
    @livewire('event.skema', ['id' => $skemaId])
    @endif

    @if($tabActive == 'asesor')
    @livewire('event.asesor', ['id' => $eventId])
    @endif

    <div wire:ignore.self class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="create-unit" aria-hidden="true" id="unapprove-event-modal">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Unapprove Event</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Keterangan</label>
                        <input wire:model="desc" type="text" class="form-control  @error('desc') is-invalid @enderror" placeholder="Masukan Keterangan">
                        @error('desc') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class=" modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="unApproved()" data-dismiss="modal">Unapprove</button>
                </div>
            </div>
        </div>
    </div>

</div>

@section('script')

<script>
    window.addEventListener('swal', function(e) {
        Swal.fire(e.detail);
    });

    window.livewire.on('unapproved-success', function() {
        $('unapprove-event-modal').modal('hide')
    })

    $('#start-date').daterangepicker({
        timePicker: true,
        singleDatePicker: true,
        locale: {
            format: 'DD/MM/YYYY hh:mm'
        },
    })

    function approveEvent(id) {
        Swal.fire({
            icon: 'question',
            title: 'Approve event ?',
            text: 'Pastikan semua data sudah diisi dengan benar!',
            showCancelButton: true,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                Livewire.emit('approve-event', id)
            }
        })
    }
</script>

@endsection