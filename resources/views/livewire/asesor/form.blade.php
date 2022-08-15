<div class="container-fluid">
    <form wire:submit.prevent="save">
        <div class="row">
            <div class="col-12 col-md">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Informasi Profil</h6>
                    </div>
                    <div class="card-body">
                        @if($profile)
                        @if(is_string($profile))
                        <div class="text-center"><img src="{{Storage::url($profile)}}" alt="" class="rounded w-25"></div>
                        @else
                        <div class="text-center"><img src="{{$profile->temporaryUrl()}}" alt="" class="rounded w-25"></div>
                        @endif
                        @endif
                        <div class="form-group mt-3">
                            <div class="custom-file">
                                <input wire:model="profile" type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label @error('profile') is-invalid @enderror" for="customFile">Upload photo profile</label>
                                @error('profile') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>NIK</label>
                            <input wire:model="nik" type="number" class="form-control @error('nik') is-invalid @enderror" value="{{$nik ?? old('nik')}}" placeholder="Masukan NIK">
                            @error('nik') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input wire:model="name" type="text" value="{{$name ?? old('name')}}" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan nama lengkap">
                            @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <label>Jenis Kelamin</label>
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline mr-2">
                                <input type="radio" onclick="updategender('l')" id="updateGender1" name="gender">
                                <label for="updateGender1">
                                    Laki - Laki
                                </label>
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" onclick="updategender('p')" id="updateGender2" name="gender">
                                <label for="updateGender2">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                        @error('gender') <span class="text-danger">{{ $message }}</span>@enderror
                        <div class="form-group">
                            <label>Telepon</label>
                            <input wire:model="phone" type="text" value="{{$phone ?? old('phone')}}" class="form-control @error('phone') is-invalid @enderror" placeholder="Masukan No. Telepon">
                            @error('phone') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label>Tgl. Lahir</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input readonly value="{{$birth_date ?? old('birth_date')}}" class="form-control @error('birth_date') is-invalid @enderror" id="birth-date">
                            </div>
                            @error('birth_date') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label>Pendidikan</label>
                            <input wire:model="educational" type="text" value="{{$educational ?? old('educational')}}" class="form-control @error('educational') is-invalid @enderror" placeholder="Masukan pendidikan terakhir">
                            @error('educational') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label>Pekerjaan</label>
                            <input wire:model="profession" value="{{$profession ?? old('profession')}}" type="text" class="form-control @error('profession') is-invalid @enderror" placeholder="Masukan pekerjaan">
                            @error('profession') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input wire:model="address" type="text" value="{{$address ?? old('address')}}" class="form-control @error('address') is-invalid @enderror" placeholder="Masukan alamat">
                            @error('address') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary float-right btn-block" type="submit">Simpan</button>
            </div>
            <div class="col-12 col-md">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h6 class="card-title">Sertifikat</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nomor Blanko</label>
                            <input wire:model="blanko" type="text" value="{{$blanko ?? old('blanko')}}" class="form-control @error('blanko') is-invalid @enderror" placeholder="Masukan nomor blanko">
                            @error('blangko') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label>Nomor Registrasi</label>
                            <input wire:model="reg_number" type="text" value="{{$reg_number ?? old('reg_number')}}" class="form-control @error('reg_number') is-invalid @enderror" placeholder="Masukan nomor registrasi">
                            @error('reg_number') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <label>Masa Berlaku</label>
                        <div class="row">
                            <div class="col-12 col-md-5">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input readonly type="text" value="{{$start_date ?? old('start_date')}}" class="form-control @error('start_date') is-invalid @enderror" id="start-date">
                                    </div>
                                    @error('start_date') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col text-center">Sampai</div>
                            <div class="col-12 col-md-5">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input readonly value="{{$expired_date ?? old('expired_date')}}" class="form-control  @error('expired_date') is-invalid @enderror" id="expired-date">
                                    </div>
                                    @error('expired_date') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <div class="custom-file">
                                <input wire:model="image" type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label @error('expired_date') is-invalid @enderror" for="customFile">Upload sertifikat</label>
                                @error('expired_date') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        @if($image)
                        @if(is_string($image))
                        <div class="text-center"><img src="{{Storage::url($image)}}" alt="" class="rounded w-100"></div>
                        @else
                        <div class="text-center"><img src="{{$image->temporaryUrl()}}" alt="" class="rounded w-100"></div>
                        @endif
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12 col-md">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Informasi akun</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Email</label>
                            <input wire:model="email" type="email" value="{{$email ?? old('email')}}" class="form-control  @error('email') is-invalid @enderror" placeholder="Masukan email">
                            @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input wire:model="password" type="password" value="{{$password ?? old('password')}}" class="form-control  @error('password') is-invalid @enderror" placeholder="Masukan password">
                            @error('password') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label>Confirm password</label>
                            <input wire:model="c_password" type="password" value="{{$c_password ?? old('c_password')}}" class="form-control  @error('c_password') is-invalid @enderror" placeholder="Confirm password" autocomplete="FALSE">
                            @error('c_password') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@section('script')

<script>
    $(document).ready(function() {
        let now = moment().format('DD/MM/YYYY')
        @this.set('gender', l);
        @this.set('birth_date', now);
        @this.set('start_date', now);
        @this.set('expired_date', now);
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


    $('#start-date').daterangepicker({
        singleDatePicker: true,
        locale: {
            format: 'DD/MM/YYYY'
        },
    })

    $('#start-date').change(function() {
        @this.set('start_date', $(this).val());
    })

    $('#expired-date').daterangepicker({
        singleDatePicker: true,
        locale: {
            format: 'DD/MM/YYYY'
        },
    })

    $('#expired-date').change(function() {
        @this.set('expired_date', $(this).val());
    })

    function updategender(val) {
        @this.set('gender', val);
    }
</script>

@stop