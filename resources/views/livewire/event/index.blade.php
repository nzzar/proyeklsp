<div class="table-responsive p-2 p-md-5">
    <div class="row mb-2">
        <div class="col">
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#create-event-modal"> + Tambah Event </button>
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
                <th>Nomor</th>
                <th>Skema</th>
                <th>Waktu pelaksanaan</th>
                <th style="width: 5%;">Asesi terdaftar</th>
                <th style="width: 5%;">Asesor terdafatr</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0 ?>
            @foreach($event as $data)
            <?php $no++ ?>
            <tr>
                <td>{{$no}}.</td>
                <td>{{$data->skema->nomor}}</td>
                <td>{{$data->skema->name}}</td>
                <td>{{$data->start_date}} - {{$data->end_date}}</td>
                <td>{{$data->asesi_count}}</td>
                <td>{{$data->asesor_count}}</td>
                <td> <span class="badge {{$data->active ? 'badge-success' : 'badge-danger'}} badge-info"> {{$data->active ? 'Aktif' : 'Tidak aktif'}} </span></td>
                <td>
                    <button class="btn btn-sm btn-warning" wire:click.prevent="update('{{$data->id}}')"><i class="fas fa-pen-square"></i> Update Event</button>
                    <button class="btn btn-sm btn-info"><i class="fas fa-pen-square"></i> Update asesor</button>
                    <button class="btn btn-sm btn-primary"><i class="fas fa-pen-square"></i> Update asesi</button>
                    <button class="btn btn-sm btn-danger" wire:click.prevent="deleteEvent('{{$data->id}}')"> <i class="fas fa-trash-alt"></i> Delete Event</button>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>