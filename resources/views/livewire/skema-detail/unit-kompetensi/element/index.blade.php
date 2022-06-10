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
                                <button wire:click.prevent="getElementById('{{$element->id}}', false)" class="btn btn-xs btn-warning mr-2 btn-reset" data-toggle="modal" data-target="#update-element"> Edit</button>
                                <button onclick="deleteElement('{{$element->id}}')" class="btn btn-xs btn-danger mr-2 btn-reset"> Hapus</button>
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
                <button class="btn btn-primary float-right mb-2" data-toggle="modal" data-target="#create-unjuk">Tambah Unjuk Kerja</button>
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
                        <tr>
                            <td>{{$no}}.</td>
                            <td>{{$kerja->description}}</td>
                            <td>
                                <button wire:click.prevent="getUnjukKerjaId('{{$kerja->id}}', false)" class="btn btn-xs btn-warning mr-2 btn-reset" data-toggle="modal" data-target="#update-unjuk"> Edit</button>
                                <button onclick="deleteUnjukKerja('{{$kerja->id}}')" class="btn btn-xs btn-danger mr-2 btn-reset"> Hapus</button>
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
    <div>
        <div wire:ignore.self class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="create-element" aria-hidden="true" id="create-element">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Element</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Element</label>
                            <input wire:model="element" type="text" class="form-control" placeholder="Enter Element">
                            @error('element') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" wire:click.prevent="createElement()" data-dismiss="modal">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div wire:ignore.self class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="update-element" aria-hidden="true" id="update-element">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Element</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Element</label>
                            <input wire:model="element" type="text" class="form-control" placeholder="Enter Element">
                            @error('element') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" wire:click.prevent="updateElement()" data-dismiss="modal">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div wire:ignore.self class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="create-unjuk" aria-hidden="true" id="create-unjuk">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tamabah Unjuk Kerja</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Unjuk Kerja</label>
                            <input wire:model="unjuk" type="text" class="form-control" placeholder="Enter unjuk kerja">
                            @error('unjuk') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" wire:click.prevent="createUnjukKerja()" data-dismiss="modal">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div wire:ignore.self class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="update-unjuk" aria-hidden="true" id="update-unjuk">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Unjuk Kerja</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Unjuk Kerja</label>
                            <input wire:model="unjuk" type="text" class="form-control" placeholder="Unjuk Kerja">
                            @error('unjuk') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" wire:click.prevent="updateUnjukKerja()" data-dismiss="modal">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>