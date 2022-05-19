<div wire:ignore.self class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="create-asesor-modal" aria-hidden="true" id="create-skema-modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content p-2 p-md-3">
            <div class="modal-header">
                <h4 class="modal-title">Buat Skema</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nomor</label>
                    <input wire:model="nomor" type="text" class="form-control" placeholder="Masukan nomor skema">
                    @error('nomor') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Skema</label>
                    <input wire:model="name" type="text" class="form-control" placeholder="Masukan nama skema">
                    @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <label for="exampleInputEmail1">Status</label>
                <div class="form-group clearfix">
                    <div class="icheck-primary d-inline">
                        <input type="radio" wire:click="toggleStatus('y')" id="radioPrimary1" name="gender" checked="">
                        <label for="radioPrimary1">
                            Active
                        </label>
                    </div>
                    <div class="icheck-primary d-inline">
                        <input type="radio" wire:click="toggleStatus('n')" id="radioPrimary2" name="gender">
                        <label for="radioPrimary2">
                            Nonactive
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Waktu pelaksanaan:</label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control float-right" id="daterange" readonly  autocomplete="off" >
                    </div>
                    <!-- /.input group -->
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" wire:click.prevent="save()">Save changes</button>
            </div>
        </div>
    </div>
</div>