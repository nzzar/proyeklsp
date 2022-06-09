<div class="row">
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Element</div>
            </div>
            <div class="card-body">
                <button class="btn btn-primary float-right mb-2" data-toggle="modal" data-target="#create-element">Tambah Element</button>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Element</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0 ?>
                        @foreach($data as $element)
                        <?php $no++ ?>
                        <tr wire:click.prevent="setElementId('{{$element->id}}')" @if($element->id == $elementId) style="background-color:#cadcfc" @endif>
                            <td>{{$no}}.</td>
                            <td>{{$element->name}}</td>
                            <td>
                                <button wire:click.prevent="update('{{$element->id}}')" class="btn btn-xs btn-warning mr-2 btn-reset" data-toggle="modal" data-target="#update-unit"> Edit</button>
                                <button wire:click.prevent="delete('{{$element->id}}')" class="btn btn-xs btn-danger mr-2 btn-reset"> Hapus</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Unjuk Kerja</div>
            </div>
            <div class="card-body">
                @if($elementId)
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
                        @foreach($unjukKerja as $kerja)
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
                @else 
                    <h3>Pilih element untuk menampilkan data</h3>
                @endif
            </div>
        </div>
    </div>
</div>