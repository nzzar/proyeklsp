<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">FR.APL.01. Permohonan Sertifikasi Kompetensi</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="mb-2">Bagian 1: Rincian Data Pemohon Sertifikasi</h6>
                                <div class="font-weight-bold">a. Data Pribadi</div>
                                <div class="row mb-2">
                                    <div class="col-6 col-md-3">Nama Lengkap</div>
                                    <div class="col ml-2">: {{$skema->asesi->name}}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 col-md-3">NIK/Paspor</div>
                                    <div class="col ml-2">: {{$skema->asesi->nik}}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 col-md-3">Tempat / Tgl. Lahir</div>
                                    <div class="col ml-2">: {{$skema->asesi->tmpt_lahir}}, {{$skema->asesi->birth_date}} </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-12 col-md-3">Jenis Kelamin</div>
                                    <div class="col ml-2">: {{$skema->asesi->gender == 'l' ? 'Laki Laki' : 'Perempuan'}} </div>

                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 col-md-3">Kebangsaan</div>
                                    <div class="col ml-2">: {{$skema->asesi->kebangsaan}}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-12 col-md-3">Alamat Rumah</div>
                                    <div class="col-12 col-md">
                                        <div class="col-12 col-md ml-2">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span>: {{$skema->asesi->address}}</span>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <span>Kode Pos : {{$skema->asesi->kode_pos}}</span>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <span>Tlp. Rumah : {{$skema->asesi->house_phone}}</span>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <span>Tlp. Kantor {{$skema->asesi->office_phone}}</span>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <span>Email : {{$skema->asesi->user->email}}</span>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <span>Hp : {{$skema->asesi->phone}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 col-md-3">Kualifikasi Pendidikan</div>
                                    <div class="col ml-2">: {{$skema->asesi->kualifikasi_pendidikan}}</div>
                                </div>
                                <div class="font-weight-bold">a. Data Pekerjaan Sekarang</div>
                                <div class="row mb-2">
                                    <div class="col-6 col-md-3">Institusi / Perusahaan</div>
                                    <div class="col ml-2">: {{$skema->asesi->office}}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 col-md-3">Jabatan</div>
                                    <div class="col ml-2">: {{$skema->asesi->position}}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 col-md-3">Alamat Kantor</div>
                                    <div class="col ml-2">: {{$skema->asesi->office_address}}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 col-md-3">Kode Pos</div>
                                    <div class="col ml-2">: {{$skema->asesi->kode_pos_office}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h6>Bagian 2 : Data Sertifikasi</h6>
                                <p>Tuliskan Judul dan nomor Skema Sertifikasi yang anda ajukan berikut Daftar Unit Kompetensi <br> sesuai kemasan pada skema sertifikasi untuk mendapatkan pengakuan sesuai dengan latar belakang pendidikanm pelatihan serta pengalaman kerja yang anda miliki</p>

                                <h6>Daftar Unit Kompetensi sesuai kemasan</h6>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Unit</th>
                                            <th>Judul Unit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0 ?>
                                        @forelse($skema->event->skema->unitKompetensi as $unit)
                                        <?php $no++ ?>

                                        <tr>
                                            <td> {{$no}} </td>
                                            <td> {{$unit->kode}} </td>
                                            <td> {{$unit->judul}} </td>
                                        </tr>

                                        @empty

                                        <tr>
                                            <td colspan="3" class="text-secondary text-center"> Tidak Ada Unit Kompetensi </td>
                                        </tr>

                                        @endforelse


                                    </tbody>
                                </table>

                                <table class="table table-bordered mt-5">
                                    <tbody>
                                        <tr>
                                            <td rowspan="2">
                                                Skema Sertifikasi
                                            </td>
                                            <td>
                                                Judul
                                            </td>
                                            <td style="width:5px;">
                                                :
                                            </td>
                                            <td>
                                                {{$skema->event->skema->name}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Nomor
                                            </td>
                                            <td>
                                                :
                                            </td>
                                            <td>
                                                {{$skema->event->skema->nomor}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" rowspan="5">
                                                Tujuan Asesment
                                            </td>
                                            <td>
                                                :
                                            </td>
                                            <td>
                                                @if($skema->tujuan_asesmen == 'Sertifikasi')
                                                <i class="far fa-check-square"></i>
                                                @else
                                                <i class="far fa-square"></i>
                                                @endif
                                                Sertifikasi
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            </td>
                                            <td>
                                                @if($skema->tujuan_asesmen == 'Sertifikasi Ulang')
                                                <i class="far fa-check-square"></i>
                                                @else
                                                <i class="far fa-square"></i>
                                                @endif
                                                Sertifikasi Ulang
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            </td>
                                            <td>
                                                @if($skema->tujuan_asesmen == 'Pengakuan Kompetensi Terkini (PKT)')
                                                <i class="far fa-check-square"></i>
                                                @else
                                                <i class="far fa-square"></i>
                                                @endif
                                                Pengakuan Kompetensi Terkini (PKT)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            </td>
                                            <td>
                                                @if($skema->tujuan_asesmen == 'Rekognisi Pembelaran Lampau')
                                                <i class="far fa-check-square"></i>
                                                @else
                                                <i class="far fa-square"></i>
                                                @endif
                                                Rekognisi Pembelaran Lampau
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            </td>
                                            <td>
                                                @if($skema->tujuan_asesmen == 'Lain nya')
                                                <i class="far fa-check-square"></i>
                                                @else
                                                <i class="far fa-square"></i>
                                                @endif
                                                Lain nya
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="mb-2">Bagian 3 : Bukti Kelengkapan Pemohon</h6>
                                <h6>Bukti Persyaratan Pemohon</h6>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Bukti Persyaratan Dasar</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0 ?>
                                        @forelse($skema->event->skema->persyaratan as $syarat)
                                        <?php $no++ ?>

                                        <tr>
                                            <td> {{$no}} </td>
                                            <td> {{$syarat->name}} </td>
                                            <td>
                                                @if($syarat->asesi)
                                                @switch($syarat->asesi->status)
                                                @case('Sedang diperiksa')
                                                <span class="badge badge-warning">{{$syarat->asesi->status}}</span>
                                                @break
                                                @case('Memenuhi Syarat')
                                                <span class="badge badge-success">{{$syarat->asesi->status}}</span>
                                                @break
                                                @default
                                                <span class="badge badge-danger">{{$syarat->asesi->status}}</span>
                                                @endswitch

                                                @else
                                                <span class="badge badge-secondary">Belum Upload Persyaratan</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm mb-1 btn-info" wire:click="$set('view_file', '{{$syarat->asesi->file}}')" data-toggle="modal" data-target="#view-file-modal">Lihat File</button>
                                                @if(($syarat->asesi->status ?? null) == 'Sedang diperiksa' && Auth::user()->role == 'admin')
                                                <button class="btn btn-success btn-sm mb-1" onclick="approvePersyaratan('{{$syarat->asesi->id}}')">Memenuhi Syarat</button>
                                                <button class="btn btn-danger btn-sm mb-1" onclick="rejectPersyaratan('{{$syarat->asesi->id}}')">TIdak Memenuhi Syarat</button>
                                                @endif
                                            </td>
                                        </tr>

                                        @empty

                                        <tr>
                                            <td colspan="4" class="text-secondary text-center"> Tidak Ada Persyaratan </td>
                                        </tr>

                                        @endforelse


                                    </tbody>
                                </table>

                                <table class="table table-bordered mt-3">
                                <tbody>
                                    <tr>
                                        <td rowspan="9">
                                            <div class="font-weight-bold">
                                                Rekomendasi (diisi oleh LSP)
                                            </div>
                                            <div>
                                                Berdasarkan Ketentuan persyaratan dasar makan pemohon:
                                                <br>
                                                <span class="font-weight-bold">{{$skema->status}} </span>
                                                sebagai perserta sertifikasi
                                            </div>
                                        </td>
                                        <td colspan="2" class="font-weight-bold">Pemohon / Kandidat</td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td>{{$skema->asesi->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanda Tangan</td>
                                        <td>
                                            <div class="d-flex">
                                                <div style="width: 200px; height: 150px;">
                                                    @if($skema->ttd_asesi)
                                                        <img src="{{Storage::url($skema->ttd_asesi)}}" alt="" class="rounded w-100 mb-2">
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal</td>
                                        <td>{{$skema->tgl_ttd_asesi}}</td>
                                    </tr>
                                    @if($skema->admin)
                                    <tr>
                                        <td colspan="2" class="font-weight-bold">Admin LSP:</td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td>{{$skema->admin->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>No. Reg</td>
                                        <td>{{$skema->admin->no_reg}}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanda Tangan</td>
                                        <td>
                                            <div class="d-flex">
                                                <div style="width: 200px; height: 150px;">
                                                    @if($skema->ttd_asesi)
                                                        <img src="{{Storage::url($skema->admin->signature)}}" alt="" class="rounded w-100 mb-2">
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal</td>
                                        <td>{{$skema->tgl_ttd_admin}}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="create-unit" aria-hidden="true" id="view-file-modal">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center">
                        @if($view_file)
                        <img src="{{Storage::url($view_file)}}" alt="" class="rounded w-100 mb-2">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
