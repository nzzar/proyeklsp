<div class="table-responsive p-2 p-md-5">
    <div class="row mb-2">
        @userRole(admin)
        <div class="col">
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#create-skema-modal"> + Buat Skema</button>
        </div>
        @endUserRole
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
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0 ?>
            @foreach($data as $skema)
            <?php $no++ ?>
            <tr>
                <td>{{$no}}.</td>
                <td>{{$skema->nomor}}</td>
                <td>{{$skema->name}}</td>
                <td>{{$skema->active ? 'Aktif' : 'Nonaktif'}}</td>
                <td>
                    @userRole(admin)
                    <a href="{{url('skema/'.$skema->id)}}" class="btn btn-xs btn-info mr-2 btn-reset" >Detail</a>
                    <button wire:click.prevent="delete('{{$skema->id}}')" class="btn btn-xs btn-outline-danger mr-2 btn-reset" >Delete</button>
                    @endUserRole
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>