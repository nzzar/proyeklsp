<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">FR.IA.01 CEKLIS OBSERVASI AKTIVITAS DI TEMPAT KERJA ATAU TEMPAT KERJA SIMULASI</h6>
            </div>
            <div class="card-body">
                <div id="accordion">
                    @foreach($skema->unitKompetensi as $unit)
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center" id="heading-{{$unit->id}}" data-toggle="collapse" data-target="#collapse-{{$unit->id}}" aria-expanded="true" aria-controls="#collapse-{{$unit->id}}">
                            <div class="mr-auto">
                                <div class="text-secondary">Kode Unit : {{$unit->kode}}</div>
                                <h6 class="mb-0">
                                    {{$unit->judul}}
                                </h6>
                            </div>
                            <i class="fas fa-angle-down"></i>
                        </div>

                        <div id="collapse-{{$unit->id}}" class="collapse show" aria-labelledby="heading-{{$unit->id}}" data-parent="#accordion">
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="align-middle" rowspan="2" style="width: 5%;">No</th>
                                            <th class="align-middle" rowspan="2">Elemen</th>
                                            <th class="align-middle" rowspan="2" style="width: 50%;">Kriteria Unjuk Kerja</th>
                                            <th class="align-middle" colspan="2" style="width: 10%;">Rekomendasi</th>
                                        </tr>
                                        <tr>
                                            <th>K</th>
                                            <th>BK</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0; ?>
                                        @foreach($unit->element as $key => $element)
                                        <?php $no++ ?>
                                        <tr>
                                            <td rowspan="{{count($element->unjukKerja)}}">
                                                {{$key+1}}
                                            </td>
                                            <td rowspan="{{count($element->unjukKerja)}}">
                                                {{$element->name}}
                                            </td>
                                            <td>
                                                @if(count($element->unjukKerja) > 0)

                                                {{ $element->unjukKerja[0]->description}}

                                                @endif
                                            </td>
                                            @if(count($element->unjukKerja) > 0)
                                            <td class="align-middle text-center">
                                                @if($element->unjukKerja[0]->asesi->kompeten ?? false)
                                                <i class="far fa-check-square"></i>
                                                @else
                                                <i class="far fa-square"></i>
                                                @endif

                                            </td>
                                            <td class="align-middle text-center">

                                                @if($element->unjukKerja[0]->asesi && !($element->unjukKerja[0]->asesi->kompeten ?? false))
                                                <i class="far fa-check-square"></i>
                                                @else
                                                <i class="far fa-square"></i>
                                                @endif

                                            </td>
                                            @else
                                            <td>-</td>
                                            <td>-</td>
                                            @endif
                                        </tr>
                                        @foreach($element->unjukKerja as $kerjaKey => $kerja)
                                        @if($kerjaKey > 0)
                                        <tr>
                                            <td>{{$kerja->description}}</td>
                                            <td class="align-middle text-center">
                                                @if($kerja->asesi && $kerja->asesi->kompeten ?? false)
                                                <i class="far fa-check-square"></i>
                                                @else
                                                <i class="far fa-square"></i>
                                                @endif

                                            </td>
                                            <td class="align-middle text-center">
                                                @if($kerja->asesi && !($kerja->asesi->kompeten ?? false))
                                                <i class="far fa-check-square"></i>
                                                @else
                                                <i class="far fa-square"></i>
                                                @endif
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center" id="heading-ttd-observasi" data-toggle="collapse" data-target="#collapse-ttd-observasi" aria-expanded="true" aria-controls="#collapse-collapse-ttd-observasi">
                            <div class="mr-auto">
                                <h6 class="text-header">
                                    Tanda Tangan
                                </h6>
                            </div>
                            <i class="fas fa-angle-down"></i>
                        </div>
                        <div id="collapse-ttd-observasi" class="collapse show" aria-labelledby="heading-heading-ttd-observasi" data-parent="#accordion">
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Asesi:{{$skemaAsesi->asesi->name}}</th>
                                            <th>Asesor: {{$skemaAsesi->asesor->name}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                Tanda tangan
                                            </td>
                                            <td>
                                                <img src="{{Storage::url($skemaAsesi->ttd_asesi)}}" alt="" srcset="">
                                            </td>
                                            <td>
                                                <img src="{{Storage::url($skemaAsesi->ttd_asesor)}}" alt="" srcset="">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">FR.AK.02. FORMULIR REKAMAN ASESMEN KOMPETENSI</h6>
            </div>
            <div class="card-body">
                <p>
                    Beri tanda centang dikolom yang sesuai untuk mencerminkan bukti yang diperoleh untuk menentukan Kompetensi asesi untuk setiap unit kompetensi.
                </p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Unit kompetensi</th>
                            <th>Observasi demonstrasi</th>
                            <th>Portofolio</th>
                            <th>Pertanyaan pihak ketiga</th>
                            <th>Pertanyaan wawancara</th>
                            <th>Pertanyaan lisan</th>
                            <th>Pertanyaan tertulis</th>
                            <th>Proyek kerja</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach($skemaAsesi->ceklisObservasi as $ceklis)
                        <tr>
                            <td>{{$ceklis->unit_kompetensi}}</td>
                            <td class="align-middle text-center">
                                <i class="far @if($ceklis->demonstrasi) fa-check-square @else fa-square @endif"></i>
                            </td>
                            <td class="align-middle text-center">
                                <i class="far @if($ceklis->portofolio) fa-check-square @else fa-square @endif"></i>
                            </td>
                            <td class="align-middle text-center">
                                <i class="far @if($ceklis->pihak_ketiga) fa-check-square @else fa-square @endif"></i>
                            </td>
                            <td class="align-middle text-center">
                                <i class="far @if($ceklis->wawancara) fa-check-square @else fa-square @endif"></i>
                            </td>
                            <td class="align-middle text-center">
                                <i class="far @if($ceklis->lisan) fa-check-square @else fa-square @endif"></i>
                            </td>
                            <td class="align-middle text-center">
                                <i class="far @if($ceklis->tertulis) fa-check-square @else fa-square @endif"></i>
                            </td>
                            <td class="align-middle text-center">
                                <i class="far @if($ceklis->proyek) fa-check-square @else fa-square @endif"></i>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td class="font-weight-bold">Rekomendasi Hasil Asesmen</td>
                            <td colspan="7" class="align-middle">
                                <div class="font-weight-bold">{{$skemaAsesi->skema_status}}</div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>