<div class="table-responsive p-2 p-md-5">
    <div class="row mb-2">
        <div class="col">
        </div>
        <div class="col-12 col-md-3">
            <div class="d-flex align-items-center small">
                <i class="fa fa-search fa-fw text-muted position-absolute pl-3"></i>
                <input wire:model.debounce.300ms="search" type="text" class="form-control py-2" placeholder="Search..." style="padding-left: 38px;" />
            </div>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Judul Event</th>
                <th>Skema</th>
                <th>Waktu pelaksanaan</th>
                <th>TUK</th>
                <th style="width: 5%;">Kuota Peserta </th>
                <th style="width: 5%;">Jumlah Asesi</th>
                <th style="width: 5%;">Jumlah Asesor</th>
                <th style="width: 8%;"> Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0 ?>
            @foreach($event as $data)
            <?php $no++ ?>
            <tr>
                <td>{{$no}}.</td>
                <td>{{$data->title}}</td>
                <td>{{$data->skema->nomor}} | {{$data->skema->name}}</td>
                <td>{{$data->start_date}} - {{$data->end_date}}</td>
                <td>{{$data->tuk}}</td>
                <td>{{$data->qty}}</td>
                <td>{{$data->asesi_count}}</td>
                <td>{{$data->asesor_count}}</td>
                <td>
                    @switch($data->status)
                    @case('Waiting')
                    <span class="badge badge-warning"> Menunggu Persetujuan </span>
                    @break
                    @case('Approved')
                    <span class="badge badge-success"> Disetujui </span>
                    @break
                    @default
                    <span class="badge badge-danger"> Tidak Disetujui </span>
                    @endswitch
                    <span class="badge {{$data->active ? 'badge-success' : 'badge-danger'}} badge-info"> {{$data->active ? 'Aktif' : 'Tidak aktif'}} </span>
                </td>
                <td>
                    <a href="{{url('/event/'.$data->id)}}" class="btn btn-sm btn-primary mb-1"><i class="fas fa-folder-open"></i> Detail Event</a>
                    @if($data->status == 'Waiting')
                    <button class="btn btn-sm  mb-1 btn-success" onclick="approveEvent('{{$data->id}}')"> <i class="fas fa-check"></i> Approve </button>
                    <button class="btn btn-sm  mb-1 btn-danger" wire:click="$set('eventId', '{{$data->id}}')" data-toggle="modal" data-target="#unapprove-event-modal"><i class="fas fa-times"></i> Unapprove </button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal" wire:click="$set('eventId', null)">Cancel</button>
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

    function approveEvent(id) {
        Swal.fire({
            icon: 'question',
            title: 'Approve event?',
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
@stop