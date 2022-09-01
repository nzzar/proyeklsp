<div>
    @section('page-title')
    Asesmen Mandiri
    @stop


    @section('style')

    <link rel="stylesheet" href="{{asset('/assets/plugins/signature/css/jquery.signature.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/plugins/jquery-ui/jquery-ui.min.js')}}">

    @stop

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Data Skema Asesi</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-6 col-md-3">Nama Lengkap</div>
                            <div class="col ml-2">: {{$skemaAsesi->asesi->name}}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 col-md-3">NIM</div>
                            <div class="col ml-2">: {{$skemaAsesi->asesi->nim}}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 col-md-3">Skema</div>
                            <div class="col ml-2">: {{$skemaAsesi->event->skema->name}}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 col-md-3">Nomor Skema</div>
                            <div class="col ml-2">: {{$skemaAsesi->event->skema->nomor}}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 col-md-3">Waktu Pelaksanaan</div>
                            <div class="col ml-2">: {{$skemaAsesi->event->start_date}} sampai {{$skemaAsesi->event->end_date}}</div>
                        </div>
                        @if($skemaAsesi->asesmentMandiri)
                        <div class="row mb-2">
                            <div class="col-6 col-md-3">Rekomendasi</div>
                            <div class="col ml-2">:
                                @if(is_null($skemaAsesi->asesmentMandiri->continue ?? null))
                                <span class="badge badge-secondary"> Sedang ditinjau oleh asesor </span>
                                @elseif($skemaAsesi->asesmentMandiri->continue ?? null)
                                <span class="badge badge-success"> Asesmen dapat dilanjutkan </span>
                                @else
                                <span class="badge badge-danger"> Asesmen tidak dapat dilanjutkan </span>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">FR.APL.02 Asessment Mandiri</h6>
                    </div>
                    <div class="card-body">
                        <div id="accordion">
                            @forelse($skema->unitKompetensi as $kompetensi)
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center" id="heading-{{$kompetensi->id}}" data-toggle="collapse" data-target="#collapse-{{$kompetensi->id}}" aria-expanded="true" aria-controls="collapseOne">
                                    <div class="mr-auto">
                                        <div class="text-secondary">Kode Unit : {{$kompetensi->kode}}</div>
                                        <h6 class="mb-0">
                                            {{$kompetensi->judul}}
                                        </h6>
                                    </div>
                                    <i class="fas fa-angle-down"></i>
                                </div>

                                <div id="collapse-{{$kompetensi->id}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                    
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 60%;">Dapatkah saya .....?</th>
                                                    <th>K</th>
                                                    <th>BK</th>
                                                    <th>Bukti yang relevan</th>
                                                    @if(!$skemaAsesi->asesmentMandiri)
                                                    <th>Action</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 0 ?>
                                                @forelse($kompetensi->element as $element)
                                                <tr>
                                                    <td>
                                                        <?php $no++ ?>
                                                        {{$no}}. Elemen: {{$element->name}}
                                                        <div>
                                                            <ul>
                                                                <li>
                                                                    <div>Kriteria Unjuk Kerja:</div>
                                                                    <?php $subno = 0 ?>
                                                                    @forelse($element->unjukKerja as $unjukKerja)
                                                                    <?php $subno++ ?>
                                                                    <ol start="{{$no}}">
                                                                        <li>{{$subno}} {{$unjukKerja->description}}</li>
                                                                    </ol>
                                                                    @empty
                                                                    -
                                                                    @endforelse
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle"> @if($element->asesi->kompeten ?? null) <i class="far fa-check-square"></i> @else <i class="far fa-square"></i> @endif </td>
                                                    <td class="align-middle"> @if($element->asesi && (!$element->asesi->kompeten ?? false)) <i class="far fa-check-square"></i> @else <i class="far fa-square"></i> @endif</td>
                                                    <td class="text-center align-middle">
                                                        @if($element->asesi)
                                                        <button class="btn btn-sm btn-primary" wire:click="$set('view_file', '{{$element->asesi->syarat->file}}')" data-toggle="modal" data-target="#view-file-modal">
                                                            Lihat File
                                                        </button>
                                                        @endif
                                                    </td>
                                                    @if(!$skemaAsesi->asesmentMandiri)
                                                    <td class="text-center align-middle"><button class="btn btn-info btn-sm" wire:click.prevent="asesmen('{{$element->id}}')" )>Rekomendasi</button></td>
                                                    @endif
                                                </tr>
                                                @empty
                                                -
                                                @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <h6 class="text-secondary">Tidak ada data unit kompetensi</h6>
                            @endforelse
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center" id="heading-ttd" data-toggle="collapse" data-target="#collapse-ttd" aria-expanded="true" aria-controls="collapseOne">
                                    <div class="mr-auto">
                                        <h6 class="mb-0">
                                            Tanda tangan dan keputusan
                                        </h6>
                                    </div>
                                    <i class="fas fa-angle-down"></i>
                                </div>
                                <div id="collapse-ttd" class="collapse show">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4 border border-right-0">
                                                <div class="font-weight-bold mb-2">Nama Asesi:</div>
                                                {{$skemaAsesi->asesi->name}}
                                            </div>
                                            <div class="col-4 border border-right-0">
                                                <div class="font-weight-bold mb-2">Tanggal:</div>
                                                {{($skemaAsesi->asesmentMandiri->tgl_ttd_asesi ?? null) ? \Carbon\Carbon::parse($skemaAsesi->asesmentMandiri->tgl_ttd_asesi)->format('d F Y') : '-'}}
                                            </div>
                                            <div class="col-4 border">
                                                <div class="font-weight-bold mb-2">Tanda Tangan Asesi:</div>
                                                <div style="width:150px; height: 100px;">
                                                    <img src="{{Storage::url($skemaAsesi->ttd_asesi)}}" class="h-100" alt="" srcset="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 border border-top-0 p-2 font-weight-bold">Ditinjau Oleh Asesor</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 border border-right-0 border-top-0">
                                                <div class="font-weight-bold mb-2">Nama Asesor:</div>
                                                {{$skemaAsesi->asesi->name}}
                                            </div>
                                            <div class="col-4 border border-right-0 border-top-0">
                                                <div class="font-weight-bold mb-2">Rekomendasi:</div>
                                                @if(is_null($skemaAsesi->asesmentMandiri->continue ?? null))
                                                    -
                                                @else
                                                Asesmen <span class="font-weight-bold">{{($skemaAsesi->asesmentMandiri->continue ?? null) ? 'Dapat dilanjutkan' : 'Tidak dapat dilanjutkan'}}</span>
                                                @endif
                                            </div>
                                            <div class="col-4 border border-top-0">
                                                <div class="font-weight-bold mb-2">Tanda Tangan dan Tangal:</div>
                                                <div style="width:150px; height: 100px;">
                                                    <img src="{{Storage::url($skemaAsesi->ttd_asesi)}}" class="h-100" alt="" srcset="">
                                                </div>
                                                <div>Tanggal: {{($skemaAsesi->asesmentMandiri->tgl_ttd_asesor ?? null) ?  \Carbon\Carbon::parse($skemaAsesi->asesmentMandiri->tgl_ttd_asesor)->format('d F Y') : '-'}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title">FR.AK.01 PERSETUJUAN ASESMEN DAN KERAHASIAAN</h6>
                            </div>
                            <div class="card-body">
                                @if($skemaAsesi->assent)
                                <div class="row">
                                    <div class="col-12 border p-2">Persetujuan Asesmen ini untuk menjamin bahwa asesi telah diberi arahan secara rinci tentang perencanaan dan proses asesmen</div>
                                </div>
                                <div class="row">
                                    <div class="col-4 border border-top-0">Skema Sertifikasi</div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-3 border-right border-bottom p-1">judul</div>
                                            <div class="col ml-2 font-weight-bold p-1 border-right border-bottom">{{$skemaAsesi->event->skema->name}}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3 border-right border-bottom p-1">Nomor</div>
                                            <div class="col ml-2 font-weight-bold p-1 border-right border-bottom">{{$skemaAsesi->event->skema->nomor}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 border border-top-0 p-1">TUK</div>
                                    <div class="col-6 border-right border-bottom p-1">{{$skemaAsesi->event->tuk}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6 border border-top-0 p-1">Nama Asesor</div>
                                    <div class="col-6 border-right border-bottom p-1">{{$skemaAsesi->asesor->name ?? '-'}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6 border border-top-0 p-1">Nama Asesi</div>
                                    <div class="col-6 border-right border-bottom p-1">{{$skemaAsesi->asesi->name}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6 border border-top-0">Bukti yang akan dikumpulkan</div>
                                    <div class="col-6 border-right border-bottom">
                                        <div class="row">
                                            <div class="col-6 border-right border-bottom p-1"> <i class="far @if($skemaAsesi->assent->portofolio) fa-check-square @else fa-square @endif"></i> TL: Verifikasi Portofolio</div>
                                            <div class="col-6 p-1 border-bottom"> <i class="far @if($skemaAsesi->assent->observasi_langsung) fa-check-square @else fa-square @endif"></i> L: Observasi Langsung</div>
                                        </div>
                                        <div class="row">
                                            <div class="col p-1 border-bottom"> <i class="far @if($skemaAsesi->assent->tes_tulis) fa-check-square @else fa-square @endif"></i> TL: Hasil Tes Tulis</div>
                                        </div>
                                        <div class="row">
                                            <div class="col p-1 border-bottom"> <i class="far @if($skemaAsesi->assent->tes_lisan) fa-check-square @else fa-square @endif"></i> TL: Hasil Tes Lisan</div>
                                        </div>
                                        <div class="row">
                                            <div class="col p-1 border-bottom"><i class="far @if($skemaAsesi->assent->wawancara) fa-check-square @else fa-square @endif"></i> TL: Hasil Wawancara</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 border-right border-bottom p-1">Hari/Tanggal</div>
                                            <div class="col p-1 border-bottom">{{\Carbon\Carbon::parse($skemaAsesi->assent->updated_at)->format('d F Y')}}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 border-right border-bottom p-1">Waktu</div>
                                            <div class="col p-1 border-bottom">{{\Carbon\Carbon::parse($skemaAsesi->assent->updated_at)->format('h:i')}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 border border-top-0 p-1">
                                        <div class="font-weight-bold">Asesi:</div>
                                        Bahwa Saya Sudah Mendapatkan Penjelasan Hak Dan Prosedur Banding Oleh Asesor
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 border border-top-0 p-1">
                                        <div class="font-weight-bold">Asesor:</div>
                                        Menyatakan tidak akan membuka hasil pekerjaan yang saya peroleh karena penugasan saya sebagai Asesor
                                        dalam pekerjaan Sesmen kepada siapapun atau organisasi manapun selain kepada pihak yang berwenang sehubungan dengan kewajiban
                                        saya sebagai Asesor yang ditugaskan oleh LSP.
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 border border-top-0 p-1">
                                        <div class="font-weight-bold">Asesi:</div>
                                        Saya setuju mengikuti asesmen dengan pemahaman bahwa informasi yang dikumpulkan hanya digunakan untuk pengembangan
                                        profesional dan hanya dapat diakses oleh orang tertentu saja
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 border border-top-0 p-1">
                                        <div>
                                            <span>Tanda Tangan Asesi</span>
                                        </div>
                                        <div style="width: 200px; height: 150px;">
                                            <img src="{{Storage::url($skemaAsesi->ttd_asesi)}}" alt="" srcset="" class="h-100">
                                        </div>
                                        <div>Tanggal: {{($skemaAsesi->asesmentMandiri->tgl_ttd_asesi ?? null) ? \Carbon\Carbon::parse($skemaAsesi->asesmentMandiri->tgl_ttd_asesi)->format('d F Y') : '-'}}</div>
                                    </div>
                                    <div class="col-6 border border-top-0 p-1">
                                        <div>
                                            <span>Tanda Tangan Asesor</span>
                                        </div>
                                        <div style="width: 200px; height: 150px;">
                                            @if($skemaAsesi->ttd_asesor)
                                            <img src="{{Storage::url($skemaAsesi->ttd_asesor)}}" alt="" class="rounded w-100 mb-2">
                                            @else
                                            <div></div>
                                            @endif
                                        </div>
                                        <div>Tanggal: {{($skemaAsesi->asesmentMandiri->tgl_ttd_asesor ?? null) ?  \Carbon\Carbon::parse($skemaAsesi->asesmentMandiri->tgl_ttd_asesor)->format('d F Y') : '-'}}</div>
                                    </div>
                                </div>
                                @else
                                <div class="text-center text-secondary">
                                    Asesi belum melakukan asesmen mandiri
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(!$skemaAsesi->asesmentMandiri)
        <div class="row pb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if($errorMessage)
                        <div class="text-danger">{{$errorMessage}}</div>
                        <button class="btn btn-primary btn-block" disabled>Simpan Perubahan</button>
                        @else
                        <button class="btn btn-primary btn-block" onclick="saveAsesment()">Simpan Perubahan</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <div wire:ignore.self class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="rekomendasi-modal" aria-hidden="true" id="rekomendasi-modal">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">Elemen: {{$element->name}}</div>
                <div class="modal-body">
                    <div class="form-check form-check-inline" wire:click="$set('k', true)">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" @if(($elementSelected->asesi ?? null) && ($elementSelected->asesi->kompeten ?? false)) checked @endif>
                        <label class="form-check-label" for="inlineRadio1">Kompeten (K)</label>
                    </div>
                    <div class="form-check form-check-inline" wire:click="$set('k', false)">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" @if(($elementSelected->asesi ?? null) && (!$elementSelected->asesi->kompeten)) checked @endif>
                        <label class="form-check-label" for="inlineRadio2">Belum Kompeten (BK)</label>
                    </div>
                    <div class="form-group">
                        <label>Bukti yang relevan</label>
                        <select class="form-control select-skema  @error('persyaratan_id') is-invalid @enderror" style="width: 100%;" name="skemaId" id="select-syarat">
                            <option disabled @if(!$persyaratan_id) selected @endif>Pilih dokumen</option>
                            @foreach ($document as $doc)
                            <option value="{{$doc->asesi->id}}" @if($doc->asesi->id == $persyaratan_id) selected @endif>{{$doc->name}}</option>
                            @endforeach
                        </select>
                        @error('persyaratan_id') <span class="text-danger">{{ $message }}</span>@enderror

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" form="" class="btn btn-primary" wire:click.prevent="setAsesment()" data-dismiss="modal">Simpan</button>
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

@section('script')
<script>
    window.addEventListener('swal', function(e) {
        Swal.fire(e.detail);
    });

    window.livewire.on('asesment', () => {
        $('#rekomendasi-modal').modal('show')
    })

    function saveAsesment() {
        Swal.fire({
            icon: 'question',
            title: `Simpan Data Asesment ?`,
            html: 'Pastikan semua data telah diisi dengan benar, tidak dapat melakukan perubahan data setelah disimpan!',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Simpan',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                Livewire.emit('saveAsesment')
            }
        })
    }


    $('#select-syarat').change(function() {
        @this.set('persyaratan_id', $(this).val())
    })
</script>
@stop