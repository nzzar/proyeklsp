<div wire:ignore.self class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="create-event-modal" aria-hidden="true" id="create-event-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-2 p-md-3">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Event</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Pilih Skema</label>
                    <select class="form-control select-skema" style="width: 100%;" name="skemaId">
                        <option></option>
                        @foreach ($skemas as $skema)
                        <option value="{{$skema->id}}" {{$skema->id == $skemaId ? 'selected' : ''}}>{{$skema->nomor}} | {{$skema->name}}</option>
                        @endforeach
                    </select>
                    @error('skemaId') <span class="text-danger">{{ $message }}</span>@enderror

                </div>

                <label for="exampleInputEmail1">Waktu Pelaksanaan</label>
                <div class="row">
                    <div class="col-12 col-md-5">
                        <div class="form-group">
                            <input readonly type="email" class="form-control" id="start-date">
                            @error('startDate') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-2 text-center">Sampai</div>
                    <div class="col-12 col-md-5">
                        <div class="form-group">
                            <input readonly type="email" class="form-control" id="end-date">
                            @error('endDate') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <label for="exampleInputEmail1">Status</label>

                <div class="form-group clearfix">
                    <div class="icheck-primary d-inline mr-3">
                        <input type="radio" id="radioPrimary1" wire:click="setStatus(true)" name="status" {{$status == true ? 'checked' : ''}}>
                        <label for="radioPrimary1">
                            Aktif
                        </label>
                    </div>
                    <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary2" wire:click="setStatus(false)" name="status" {{$status == false ? 'checked' : ''}}>
                        <label for="radioPrimary2">
                            Tidak Aktif
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" form="" class="btn btn-primary" wire:click.prevent="save()">Save changes</button>
            </div>
        </div>
    </div>
</div>