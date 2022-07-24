<div class="row">
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
                                        {{$skemaAsesi->asesi->name}}
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
                                        Asesmen <span class="font-weight-bold">dapat dilanjutkan / tidak dapat dilanjutkan</span>
                                    </div>
                                    <div class="col-4 border border-top-0">
                                        <div class="font-weight-bold mb-2">Tanda Tangan dan Tangal:</div>
                                        <div style="width:150px; height: 100px;">
                                            <img src="{{Storage::url($skemaAsesi->ttd_asesi)}}" class="h-100" alt="" srcset="">
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