<div wire:ignore.self class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="create-unit" aria-hidden="true" id="create-unit">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
                <h4 class="modal-title">Tambah Unit Kompetensi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Kode</label>
                    <input wire:model="kode" type="text" class="form-control" placeholder="Enter kode">
                    @error('kode') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Judul</label>
                    <input wire:model="judul" type="text" class="form-control" placeholder="Enter name">
                    @error('judul') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" wire:click.prevent="save()" data-dismiss="modal">Save changes</button>
            </div>
        </div>
    </div>
</div>