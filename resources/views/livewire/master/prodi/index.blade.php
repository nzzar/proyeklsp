<div class="table-responsive p-2 p-md-5">
    <div class="row mb-2">
        <div class="col">
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#create-prodi"> + Tambah Jurusan</button>
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
                <th style="width: 10px">No</th>
                <th>Name</th>
                <th style="width: 300px">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0 ?>
            @foreach($data as $prodi)
            <?php $no++ ?>
            <tr>
                <td>{{$no}}.</td>
                <td>{{$prodi->name}}</td>
                <td>
                    <button wire:click.prevent="update('{{$prodi->id}}')" class="btn btn-xs btn-warning mr-2 btn-reset">Update</button>
                    <button wire:click.prevent="delete('{{$prodi->id}}')" class="btn btn-outline-danger btn-xs">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>