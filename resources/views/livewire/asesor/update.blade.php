<div wire:ignore.self class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="edit-asesor-modal" aria-hidden="true" id="edit-asesor-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-2 p-md-3">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Asesor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <h6>Informasi akun</h6>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input wire:model="email" type="email" class="form-control" placeholder="Masukan email">
                            @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input wire:model="password" type="password" class="form-control" placeholder="Masukan password">
                            @error('password') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Confirm password</label>
                            <input wire:model="cPassword" type="password" class="form-control" placeholder="Confirm password" autocomplete="FALSE">
                            @error('cPassword') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col"></div>
                    <div class="col-12 col-md-6">
                        <h6>Informasi Profil</h6>
                        <div class="form-group">
                            <label for="exampleInputEmail1">NIK</label>
                            <input wire:model="nik" type="number" class="form-control" placeholder="Masukan NIK">
                            @error('nik') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input wire:model="name" type="text" class="form-control" placeholder="Masukan nama">
                            @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <label for="exampleInputEmail1">Jenis Kelamin</label>
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline mr-2">
                                <input type="radio" wire:click="toggleGender('l')" id="updateGender1" name="gender">
                                <label for="updateGender1">
                                    Laki - Laki
                                </label>
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" wire:click="toggleGender('p')" id="updateGender2" name="gender">
                                <label for="updateGender2">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                        @error('gender') <span class="text-danger">{{ $message }}</span>@enderror
                        <div class="form-group">
                            <label for="exampleInputEmail1">Telepon</label>
                            <input wire:model="phone" type="text" class="form-control" placeholder="Masukan No. Telepon">
                            @error('phone') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label>Tgl. Lahir</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input id="update-birth-date-input-mask" type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric">
                            </div>
                            @error('birthDate') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat</label>
                            <input wire:model="address" type="text" class="form-control" placeholder="Masukan alamat">
                            @error('address') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" wire:click.prevent="save()">Simpan</button>
            </div>
        </div>
    </div>
</div>


