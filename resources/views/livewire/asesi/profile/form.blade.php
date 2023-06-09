<div class="container-fluid card p-sm-3">
    <div class="row">
        @if($message = Session::get('incompleteProfile'))
        <div class="col-12 p-2 p-md-3">
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-exclamation-triangle"></i>Penting!</h5>
                {{$message}}
            </div>
        </div>
        @endif
        <div class="col-12 col-md-6 p-md-3">
            <div class="card p-3 mb-3 mb-md-4">
                @if($profile)
                @if(is_string($profile))
                <div class="text-center"><img src="{{Storage::url($profile)}}" alt="" class="rounded w-25 mb-2"></div>
                @else
                <div class="text-center"><img src="{{$profile->temporaryUrl()}}" alt="" class="rounded w-25 mb-2"></div>
                @endif
                @endif

                <div class="custom-file mb-3">
                    <input type="file" wire:model="profile" class="custom-file-input @error('profile') is-invalid @enderror" id="customFile" name="profile">
                    <label class="custom-file-label" for="customFile">Upload foto profile</label>
                    @error('profile') <span class="text-danger">{{ $message }}</span>@enderror
                </div>

            </div>
            <div class="card p-2 p-md-3">
                <h5>Data Pribadi</h5>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Lengkap</label>
                    <input name="name" type="text" class="form-control  @error('name') is-invalid @enderror" placeholder="Masukan nama lengkap" wire:model="name">
                    @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">No. KTP/NIK/Paspor</label>
                    <input name="nik" type="text" class="form-control  @error('nik') is-invalid @enderror" placeholder="Masukan NIK" wire:model="nik">
                    @error('nik') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Tempat Lahir</label>
                    <input name="tmpt_lahir" type="text" class="form-control  @error('tmpt_lahir') is-invalid @enderror" placeholder="Masukan tempat lahir" wire:model="tmpt_lahir">
                    @error('tmpt_lahir') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Tanggal Lahir</label>
                    <input value="{{$birth_date}}" name="birth_date" type="text" class="form-control @error('birth_date') is-invalid @enderror" placeholder="Masukan tgl. lahir" id="birth-date">
                    @error('birth_date') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <label for="exampleInputEmail1">Jenis Kelamin</label>
                <div class="form-group clearfix">
                    <div class="icheck-primary d-inline mr-3">
                        <input wire:click="$set('gender', 'l')" type="radio" value="l" id="radioPrimary1" name="gender" @if($gender=='l' ) checked="" @endif>
                        <label for="radioPrimary1">
                            Laki - Laki
                        </label>
                    </div>
                    <div class="icheck-primary d-inline">
                        <input wire:click="$set('gender', 'p')" type="radio" value="p" id="radioPrimary2" name="gender" @if($gender=='p' ) checked="" @endif>
                        <label for="radioPrimary2">
                            Perempuan
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Kebangsaan</label>
                    <input wire:model="kebangsaan" name="kebangsaan" type="text" class="form-control @error('kebangsaan') is-invalid @enderror" placeholder="Masukan kebangsaan">
                    @error('kebangsaan') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Alamat Rumah</label>
                    <textarea class="form-control" rows="3" placeholder="Masukan alamat rumah" wire:model="address"></textarea>
                </div>
                <div class="form-group">
                    <label>Kode Pos</label>
                    <input wire:model="kode_pos" name="kode_pos" type="text" class="form-control @error('kode_pos') is-invalid @enderror" placeholder="Masukan kode pos">
                    @error('kode_pos') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5>Pendidikan</h5>
                    <div class="form-group">
                        <label for="exampleInputEmail1">NISN</label>
                        <input wire:model="nim" name="nim" type="text" class="form-control @error('nim') is-invalid @enderror" placeholder="Masukan NIM">
                        @error('nim') <span class=" text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Jurusan</label>
                        <select name="prodi" class="custom-select @error('prodi') is-invalid @enderror">
                            <option disabled class="text-secondary">Pilih jurusan</option>
                            @foreach($prodis as $prodi)
                            <option value="{{$prodi->id}}" @if($prodi->id == $prodi_id) selected @endif>{{$prodi->name}}</option>
                            @endforeach
                        </select>
                        @error('prodi')
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Kualifikasi Pendidikan</label>
                        <input wire:model="kualifikasi_pendidikan" name="kualifikasi_pendidikan" type="text" class="form-control @error('kualifikasi_pendidikan') is-invalid @enderror" placeholder="Contoh: D3, S1, D4">
                        @error('kualifikasi_pendidikan') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

        </div>
        <div class="col p-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>No. Telepon/E-mail</h5>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> Rumah</label>
                        <input wire:model="house_phone" name="house_phone" type="text" class="form-control @error('house_phone') is-invalid @enderror" placeholder="Masukan telepon rumah">
                        @error('house_phone') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> Kantor</label>
                        <input wire:model="office_phone" name="office_phone" type="text" class="form-control @error('office_phone') is-invalid @enderror" placeholder="Masukan telepon kantor">
                        @error('office_phone') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> HP</label>
                        <input wire:model="phone" name="kebangsaan" type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Masukan nomor hp">
                        @error('phone') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input wire:model="email" name="email" type="text" class="form-control" placeholder="" disabled>
                    </div>
                </div>
            </div>

            <div class="card p-3 mb-3">
                <h5>Data Pekerjaan Sekarang</h5>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Institusi / Perusahaan</label>
                    <input wire:model="office"  type="text" class="form-control @error('office') is-invalid @enderror" placeholder="Masukan nama institusi atau perusahaan">
                    @error('office') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Jabatan</label>
                    <input wire:model="position" type="text" class="form-control @error('position') is-invalid @enderror" placeholder="Masukan jabatan">
                    @error('position') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                
                <div class="form-group">
                    <label>Alamat Institusi/Kantor</label>
                    <textarea class="form-control @error('office_address') is-invalid @enderror" rows="3" placeholder="Masukan alamat institusi kantor" wire:model="office_address"></textarea>
                    @error('office_address') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Kode Pos</label>
                    <input wire:model="kode_pos_office" name="kode_pos_office" type="text" class="form-control  @error('kode_pos_office') is-invalid @enderror" placeholder="Masukan kode pos">
                    @error('kode_pos_office') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary float-right" wire:click.prevent="update()">Simpan perubahan</button>

        </div>
    </div>
</div>

@section('script')

<script>
    window.addEventListener('swal', function(e) {
        Swal.fire(e.detail);
    });

    $(document).ready(function() {
        let now = moment().format('DD/MM/YYYY')
        // @this.set('gender', l);
        // @this.set('birth_date', now);
        // @this.set('start_date', now);
        // @this.set('expired_date', now);
    })

    $('#birth-date').daterangepicker({
        singleDatePicker: true,
        locale: {
            format: 'DD/MM/YYYY'
        },

    })

    $('#birth-date').change(function() {
        @this.set('birth_date', $(this).val());
    })
</script>

@stop