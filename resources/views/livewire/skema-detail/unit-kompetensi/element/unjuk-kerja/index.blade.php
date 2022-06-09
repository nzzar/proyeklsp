<div class="card-body">
    <button class="btn btn-primary float-right mb-2" data-toggle="modal" data-target="#create-element">Tambah Element</button>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Unjuk Kerja</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0 ?>
            @foreach($data as $kerja)
            <?php $no++ ?>
            <tr wire:click.prevent="setElementId('{{$kerja->id}}')">
                <td>{{$no}}.</td>
                <td>{{$kerja->description}}</td>
                <td>
                    <button wire:click.prevent="update('{{$kerja->id}}')" class="btn btn-xs btn-warning mr-2 btn-reset" data-toggle="modal" data-target="#update-unit"> Edit</button>
                    <button wire:click.prevent="delete('{{$kerja->id}}')" class="btn btn-xs btn-danger mr-2 btn-reset"> Hapus</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>