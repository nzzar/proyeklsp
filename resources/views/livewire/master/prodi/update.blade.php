<div wire:ignore.self class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="update-prodi">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
                <h4 class="modal-title">Update Jurusan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input wire:model="name" type="text" class="form-control" placeholder="Edit Prodi">
                    @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" wire:click.prevent="update()">Simpan</button>
            </div>
        </div>
    </div>
</div>