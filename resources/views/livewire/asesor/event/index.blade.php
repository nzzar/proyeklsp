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
                <th style="width: 5%;">Quota Peserta </th>
                <th style="width: 5%;">Jumlah Asesi</th>
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
</div>