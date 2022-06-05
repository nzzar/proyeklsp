<div class="card-body">
    <button class="btn btn-primary float-right mb-2" data-toggle="modal" data-target="#create-persyaratan">Tambah Persyaratan</button>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Persyaratan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0 ?>
            @foreach($persyaratan as $requirment)
            <?php $no++ ?>
            <tr>
                <td>{{$no}}.</td>
                <td>{{$requirment->name}}</td>
                <td>
                    <button wire:click.prevent="update('{{$requirment->id}}')" class="btn btn-xs btn-warning mr-2 btn-reset" data-toggle="modal" data-target="#update-persyaratan"> Edit</button>
                    <button wire:click.prevent="delete('{{$requirment->id}}')" class="btn btn-xs btn-danger mr-2 btn-reset"> Hapus</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>