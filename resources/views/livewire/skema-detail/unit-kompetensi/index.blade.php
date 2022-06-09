<div class="card-body">
    <button class="btn btn-primary float-right mb-2" data-toggle="modal" data-target="#create-unit">Tambah Unit Kompetensi</button>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Kode Unit</th>
                <th>Unit Kompetensi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0 ?>
            @foreach($unitKompetensi as $unit)
            <?php $no++ ?>
            <tr>
                <td>{{$no}}.</td>
                <td>{{$unit->kode}}</td>
                <td>{{$unit->judul}}</td>
                <td>
                    <a href="{{url('/skema/'.$unit->id.'/unit-kompetensi')}}" class="btn btn-xs btn-info mr-2 btn-reset"> Detail</a>
                    <button wire:click.prevent="update('{{$unit->id}}')" class="btn btn-xs btn-warning mr-2 btn-reset" data-toggle="modal" data-target="#update-unit"> Edit</button>
                    <button wire:click.prevent="delete('{{$unit->id}}')" class="btn btn-xs btn-danger mr-2 btn-reset"> Hapus</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>