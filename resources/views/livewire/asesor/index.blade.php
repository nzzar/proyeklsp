<div class="table-responsive p-2 p-md-5">
    <div class="row mb-2">
        <div class="col">
            <a href="{{url('/asesor/create')}}" class="btn btn-primary btn-sm"> + Tambah Asesor</a>
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
                <th>NIK</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0 ?>
            @foreach($data as $asesor)
            <?php $no++ ?>
            <tr>
                <td>{{$no}}.</td>
                <td>{{$asesor->nik}}</td>
                <td>{{$asesor->name}}</td>
                <td>{{$asesor->user->email}}</td>
                <td>{{$asesor->phone}}</td>
                <td>
                    <a href="{{url('/asesor/update/'.$asesor->id)}}" class="btn btn-xs btn-warning mr-2 btn-reset" >Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>