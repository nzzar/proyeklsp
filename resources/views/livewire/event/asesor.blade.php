<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Data Asesor</h6>
            </div>
            <div class="card-body">
                @if(Auth::user()->role == 'ms')
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add-asesor-modal">Tambah Asesor</button>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No. Registrasi</th>
                            <th>Nama Lengkap</th>
                            <th>Masa Berlaku Sertifikat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0 ?>
                        @forelse($asesors as $asesorItem)
                        <?php $no++ ?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$asesorItem->asesor->reg_number}}</td>
                            <td>{{$asesorItem->asesor->name}}</td>
                            <td>{{$asesorItem->asesor->start_date}} - {{$asesorItem->asesor->expired_date}}</td>
                            <td>
                                @if(Auth::user()->role == 'ms')
                                    <button class="btn btn-danger btn-sm mt-1" wire:click.prevent="deleteAsesor('{{$asesorItem->id}}')"><i class="fas fa-trash-alt"></i> delete</button>
                                @endif
                                @if(Auth::user()->role == 'admin')
                                    <button class="btn btn-info btn-sm mt-1" data-toggle="modal" data-target="#upload-modal" wire:click="$set('skemaAsesorId', '{{$asesorItem->id}}')"><i class="fas fa-file-upload"></i> Upload surat tugas</button>
                                @endif
                                @if($asesorItem->surat_tugas) 
                                    <button class="btn btn-warning btn-sm mt-1" wire:click="downloadSurat('{{$asesorItem->id}}')"><i class="fas fa-file-download"></i> Download surat tugas</button>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-secondary">Tidak ada data asesor</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="add-asesor-modal" aria-hidden="true" id="add-asesor-modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content p-2 p-md-3">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Asesor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form wire:submit.prevent="addAsesor()">
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Pilih Asesor</label>
                            <select wire:model="asesorId" wire:change="getAsesorById()" class="form-control select-skema  @error('skemaId') is-invalid @enderror" style="width: 100%;" name="skemaId">
                                <option value="" selected class="text-secondary">pilih asesor</option>
                                @forelse ($asesorsExists as $item)
                                <option value="{{$item->id}}">{{$item->reg_number}} | {{$item->name}}</option>
                                @empty
                                <option disabled class="text-secondary">Data asesor tidak ditemukan</option>
                                @endforelse
                            </select>

                        </div>
                        @if($asesor)
                        <div class="form-group row my-0">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Nomor Registrasi</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value=": {{$asesor->reg_number}}">
                            </div>
                        </div>
                        <div class="form-group row my-0">
                            <label for="staticEmail" class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value=": {{$asesor->nik}}">
                            </div>
                        </div>
                        <div class="form-group row  my-0">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Nama Lengkap</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value=": {{$asesor->name}}">
                            </div>
                        </div>
                        <div class="form-group row  my-0">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Masa Berlaku Sertifikat</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value=": {{$asesor->start_date}} - {{$asesor->expired_date}}">
                            </div>
                        </div>
                        <div class="form-group row  my-0">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value=": {{$asesor->user->email}}">
                            </div>
                        </div>
                        <div class="form-group row  my-0">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value=": {{$asesor->address}}">
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        @if($asesor)
                        <button type="submit" form="" class="btn btn-primary" wire:click.prevent="addAsesor()" data-dismiss="modal">Simpan</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="create-unit" aria-hidden="true" id="upload-modal">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header"><h6>Upload Surat tugas</h6></div>
                <div class="modal-body">
                    <div class="custom-file mb-3">
                        <input type="file" wire:model="file" class="custom-file-input @error('file') is-invalid @enderror" id="customFile" name="file">
                        <label class="custom-file-label" for="customFile">@if($file) {{$file->getClientOriginalName()}} @else Upload surat tugas @endif</label>
                        @error('file') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="uploadSurat()" data-dismiss="modal">Upload</button>
                </div>
            </div>
        </div>
    </div>
</div>