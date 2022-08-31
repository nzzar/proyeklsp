<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">FR.APL.02 Asessment Mandiri</h6>
            </div>
            <div class="card-body">
                @if($skemaAsesi->asesmentMandiri)
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
                                        {{$skemaAsesi->asesmentMandiri->tgl_ttd_asesi}}
                                    </div>
                                    <div class="col-4 border">
                                        <div class="font-weight-bold mb-2">Tanda Tangan Asesi:</div>
                                        <div style="width:150px; height: 100px;">
                                            <img src="{{Storage::url($skemaAsesi->ttd_asesi)}}" class="h-100" alt="" srcset="">
                                        </div>
                                    </div>
                                </div>
                                @if($skemaAsesi->asesor_id || Auth::user()->role == 'asesor')
                                <div class="row">
                                    <div class="col-12 border border-top-0 p-2 font-weight-bold">Ditinjau Oleh Asesor</div>
                                </div>
                                @if(!$skemaAsesi->asesor)
                                <div class="row">
                                    <div class="col-4 border border-right-0 border-top-0">
                                        <div class="font-weight-bold mb-2">Nama Asesor:</div>
                                        -
                                    </div>
                                    <div class="col-4 border border-right-0 border-top-0">
                                        <div class="font-weight-bold mb-2">Rekomendasi:</div>
                                        Asesmen
                                        <div class="form-check" wire:click="$set('continue', true)">
                                            <input class="form-check-input" type="radio" name="radio1" checked="" id="form-check-label1">
                                            <label class="form-check-label" for="form-check-label1">dapat dilanjutkan</label>
                                        </div>
                                        <div class="form-check" wire:click="$set('continue', false)">
                                            <input class="form-check-input" type="radio" name="radio1" checked="" id="form-check-label2">
                                            <label class="form-check-label" for="form-check-label2">tidak dapat dilanjutkan</label>
                                        </div>
                                    </div>
                                    <div class="col-4 border border-top-0">
                                        <div class="font-weight-bold mb-2">Tanda Tangan dan Tangal:</div>
                                        <div style="width: 200px; height: 150px;">
                                            @if($signature)
                                            <img src="{{$signature->temporaryUrl()}}" alt="" class="rounded w-100 mb-2">
                                            @else
                                            <div wire:ignore class="w-100 h-100 border mx-auto" id="signature-pad"></div>
                                            @endif
                                        </div>
                                        @if(!$skemaAsesi->ttd_asesor && !$signature)
                                        <div class="mx-3 my-2">
                                            <button class="btn btn-sm btn-primary btn-block mb-3" id="save-signature">Save Signature</button>
                                            <button class="btn btn-sm btn-danger btn-block mb-3" id="clear-signature">Clear Signature</button>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                @else
                                <div class="row">
                                    <div class="col-4 border border-right-0 border-top-0">
                                        <div class="font-weight-bold mb-2">Nama Asesor:</div>
                                        {{$skemaAsesi->asesor->name}}
                                    </div>
                                    @if(!$canEdit)
                                    <div class="col-4 border border-right-0 border-top-0">
                                        <div class="font-weight-bold mb-2">Rekomendasi:</div>
                                        Asesmen <span class="font-weight-bold"> @if($skemaAsesi->asesmentMandiri->continue) Dapat dilanjutkan @else Tidak dapat dilanjutkan @endif </span>
                                    </div>
                                    @else 
                                    <div class="col-4 border border-right-0 border-top-0">
                                        <div class="font-weight-bold mb-2">Rekomendasi:</div>
                                        Asesmen
                                        <div class="form-check" wire:click="$set('continue', true)">
                                            <input class="form-check-input" type="radio" name="radio1" checked="" id="form-check-label1">
                                            <label class="form-check-label" for="form-check-label1">dapat dilanjutkan</label>
                                        </div>
                                        <div class="form-check" wire:click="$set('continue', false)">
                                            <input class="form-check-input" type="radio" name="radio1" checked="" id="form-check-label2">
                                            <label class="form-check-label" for="form-check-label2">tidak dapat dilanjutkan</label>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-4 border border-top-0">
                                        <div class="font-weight-bold mb-2">Tanda Tangan dan Tangal:</div>

                                        <img src="{{Storage::url($skemaAsesi->ttd_asesor)}}" alt="" class="rounded w-50 mb-2 d-block">
                                        {{\Carbon\Carbon::parse($skemaAsesi->asesmentMandiri->tgl_ttd_asesor)->format('d F Y') }}
                                    </div>
                                </div>
                                @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <h6 class="text-center text-secondary">Asesi belum melakukan asesmen mandiri</h6>
                @endif
            </div>
        </div>
    </div>
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
                                    <div class="col-6 border-right border-bottom p-1" wire:click="savePersetujuan('portofolio', {{!$skemaAsesi->assent->portofolio}})"> <i class="far @if($skemaAsesi->assent->portofolio) fa-check-square @else fa-square @endif"></i> TL: Verifikasi Portofolio</div>
                                    <div class="col-6 p-1 border-bottom" wire:click="savePersetujuan('observasi_langsung', {{!$skemaAsesi->assent->observasi_langsung}})"> <i class="far @if($skemaAsesi->assent->observasi_langsung) fa-check-square @else fa-square @endif"></i> L: Observasi Langsung</div>
                                </div>
                                <div class="row">
                                    <div class="col p-1 border-bottom" wire:click="savePersetujuan('tes_tulis', {{!$skemaAsesi->assent->tes_tulis}})"> <i class="far @if($skemaAsesi->assent->tes_tulis) fa-check-square @else fa-square @endif"></i> TL: Hasil Tes Tulis</div>
                                </div>
                                <div class="row">
                                    <div class="col p-1 border-bottom" wire:click="savePersetujuan('tes_lisan', {{!$skemaAsesi->assent->tes_lisan}})"> <i class="far @if($skemaAsesi->assent->tes_lisan) fa-check-square @else fa-square @endif"></i> TL: Hasil Tes Lisan</div>
                                </div>
                                <div class="row">
                                    <div class="col p-1 border-bottom" wire:click="savePersetujuan('wawancara', {{!$skemaAsesi->assent->wawancara}})"><i class="far @if($skemaAsesi->assent->wawancara) fa-check-square @else fa-square @endif"></i> TL: Hasil Wawancara</div>
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
                                <div>Tanggal: {{$skemaAsesi->asesmentMandiri->tgl_ttd_asesi ?? '-'}}</div>
                            </div>
                            <div class="col-6 border border-top-0 p-1">
                                <div>
                                    <span>Tanda Tangan Asesor</span>
                                </div>
                                <div style="width: 200px; height: 150px;">
                                    @if($skemaAsesi->ttd_asesor)
                                    <img src="{{Storage::url($skemaAsesi->ttd_asesor)}}" alt="" class="rounded w-100 mb-2">
                                    @elseif($signature)
                                    <img src="{{$signature->temporaryUrl()}}" alt="" class="rounded w-100 mb-2">
                                    @else
                                    <div></div>
                                    @endif
                                </div>
                                <div>Tanggal: {{$skemaAsesi->asesmentMandiri->tgl_ttd_asesor ?? '-'}}</div>
                            </div>
                        </div>
                        <div id="test-container">
                            @if($canEdit)
                            @if(!$errorMessage)
                            <button class="btn btn-primary btn-block mt-1" id="save-rekomendasi">Simpan Rekomendasi</button>
                            @else
                            <div class="text-danger">
                                {{$errorMessage}}
                            </div>
                                <button class="btn btn-primary btn-block mt-1" disabled>Simpan Rekomendasi</button>
                            @endif
                            @endif
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
    <script>
        window.livewire.on('tab-asesmen', () => {
            $('#signature-pad').signature()
        })

        $('#save-signature').click(async function() {
            let invalidSignate = $('#signature-pad').signature('isEmpty')

            if (invalidSignate) {
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Tanda tangan tidak boleh kosong',
                    icon: 'warning',
                    timer: 2000,
                    showConfirmButton: false,
                })

                return
            }

            let base64 = $('#signature-pad').signature('toDataURL', 'image/png');
            let resImg = await fetch(base64)
            let blobImg = await resImg.blob()
            @this.upload('signature', blobImg)
        })

        $('#clear-signature').click(function() {
            $('#signature-pad').signature('clear')
        })

        $('#test-container').on('click', '#save-rekomendasi', function() {

            Swal.fire({
                icon: 'question',
                title: `Simpan rekomendasi ?`,
                html: 'pastikan semua data telah diisi dengan benar, data tidak bisa dirubah setelah disimpan!',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Simpan',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {

                    window.livewire.emit('save-rekomendasi')
                }
            })
        })
    </script>
</div>