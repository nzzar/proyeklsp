@extends('layout')

@section('page-title')
Profile
@endsection


@section('main-content')
 @livewire('asesi.profile.form')
<!-- <div class="container-fluid card p-sm-3">
    <form action="{{url('/asesi/profile')}}" method="post" enctype="multipart/form-data">
        @csrf
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
                    @if(!$asesi->profile)
                    <div class="text-center">
                        <i class="fas fa-user" style="font-size:50px"></i>
                        <p class="text-secondary">Profile image not upload</p>
                    </div>
                    @else
                        <img src="{{Storage::url($asesi->profile)}}" alt="" srcset="" class="img-thumbnail mb-3 w-25 mx-auto">
                    @endif
                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input @error('profile') is-invalid @enderror" id="customFile" name="profile">
                        <label class="custom-file-label" for="customFile">Upload foto profile</label>
                        @error('profile') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    
                </div>
                <div class="card p-2 p-md-3">
                    <h5>Bio data</h5>
                    <div class="form-group">
                        <label for="exampleInputEmail1">NIK</label>
                        <input name="nik" type="text" class="form-control  @error('nik') is-invalid @enderror" placeholder="Masukan NIK" value="{{$asesi->nik ?? old('nik')}}">
                        @error('nik') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Lengkap</label>
                        <input name="name" type="text" class="form-control  @error('name') is-invalid @enderror" placeholder="Masukan nama lengkap" value="{{$asesi->name ?? old('name')}}">
                        @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <label for="exampleInputEmail1">Jenis Kelamin</label>
                    <div class="form-group clearfix">
                        <div class="icheck-primary d-inline">
                            <input type="radio" value="l" id="radioPrimary1" name="gender" @if(!$asesi->gender || $asesi->gender == 'l') checked="" @endif>
                            <label for="radioPrimary1">
                                Laki - Laki
                            </label>
                        </div>
                        <div class="icheck-primary d-inline">
                            <input type="radio" value="p" id="radioPrimary2" name="gender" @if($asesi->gender == 'p') checked="" @endif>
                            <label for="radioPrimary2">
                                Perempuan
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tempat Lahir</label>
                        <input name="tmpt_lahir" type="text" class="form-control  @error('tmpt_lahir') is-invalid @enderror" placeholder="Masukan tempat lahir" value="{{$asesi->tmpt_lahir ?? old('tmpt_lahir')}}">
                        @error('tmpt_lahir') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal Lahir</label>
                        <input name="birth_date" type="text" class="form-control @error('birth_date') is-invalid @enderror" placeholder="Masukan tgl. lahir" value="{{$asesi->birth_date ?? old('birth_date')}}">
                        @error('birth_date') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kebangsaan</label>
                        <input name="kebangsaan" type="text" class="form-control @error('kebangsaan') is-invalid @enderror" placeholder="Masukan kebangsaan" value="{{$asesi->kebangsaan ?? old('kebangsaan')}}">
                        @error('kebangsaan') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="col p-md-3">
                <div class="card p-3 mb-3 mb-md-4">
                    <h5>Pendidikan</h5>
                    <div class="form-group">
                        <label for="exampleInputEmail1">NIM</label>
                        <input name="nim" type="text" class="form-control @error('nim') is-invalid @enderror" placeholder="Masukan NIM" value="{{$asesi->nim ?? old('nim')}}">
                        @error('nim') <span class=" text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Prodi</label>
                        <select name="prodi" class="custom-select @error('prodi') is-invalid @enderror">
                            <option selected disabled>Pilih prodi</option>
                            @foreach($prodis as $prodi)
                            <option value="{{$prodi->id}}" @if($asesi->prodi_id == $prodi->id) selected @endif>{{$prodi->name}}</option>
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
                        <input name="kualifikasi_pendidikan" type="text" class="form-control @error('kualifikasi_pendidikan') is-invalid @enderror" placeholder="Contoh: D3, S1, D4" value="{{$asesi->kualifikasi_pendidikan ?? old('kualifikasi_pendidikan')}}">
                        @error('kualifikasi_pendidikan') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                </div>

                <div class="card p-3 mb-3">
                    <h5>Alamat</h5>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input name="email" type="text" class="form-control" placeholder="" disabled value="{{$asesi->user->email}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">No. Tlp</label>
                        <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Masukan nomor telepon" value="{{$asesi->phone ?? old('phone')}}">
                        @error('phone') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Alamat</label>
                        <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" placeholder="Masukan alamat" value="{{$asesi->phone ?? old('phone')}}">
                        @error('address') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kode Pos</label>
                        <input name="kode_pos" type="text" class="form-control  @error('kode_pos') is-invalid @enderror" placeholder="Masukan kode pos" value="{{$asesi->kode_pos ?? old('kode_pos')}}">
                        @error('kode_pos') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right">Simpan perubahan</button>

            </div>
        </div>
    </form>
</div> -->
@endsection