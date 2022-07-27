<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Ceklis Observasi</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h6>FR.IA.01 CEKLIS OBSERVASI AKTIVITAS DI TEMPAT KERJA ATAU TEMPAT KERJA SIMULASI</h6>
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
                                                            <td >
                                                                @if(count($element->unjukKerja) > 0)

                                                               {{ $element->unjukKerja[0]->description}}

                                                                @endif
                                                            </td>
                                                            @if(count($element->unjukKerja) > 0)
                                                            <td class="align-middle text-center">
                                                                @if($element->unjukKerja[0]->asesi->kompeten ?? false)
                                                                    <i class="far fa-check-square" wire:click="ceklis('{{$element->unjukKerja[0]->id}}', true)"></i>
                                                                @else
                                                                    <i class="far fa-square" wire:click="ceklis('{{$element->unjukKerja[0]->id}}', true)"></i>
                                                                @endif

                                                            </td>
                                                            <td class="align-middle text-center">

                                                                @if($element->unjukKerja[0]->asesi && !($element->unjukKerja[0]->asesi->kompeten ?? false))
                                                                    <i class="far fa-check-square" wire:click="ceklis('{{$element->unjukKerja[0]->id}}', false)"></i>
                                                                @else
                                                                    <i class="far fa-square" wire:click="ceklis('{{$element->unjukKerja[0]->id}}', false)"></i>
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
                                                                        <i class="far fa-check-square" wire:click="ceklis('{{$kerja->id}}', true)"></i>
                                                                    @else
                                                                        <i class="far fa-square" wire:click="ceklis('{{$kerja->id}}', true)"></i>
                                                                    @endif

                                                                </td>
                                                                <td class="align-middle text-center">
                                                                    @if($kerja->asesi && !($kerja->asesi->kompeten ?? false))
                                                                        <i class="far fa-check-square" wire:click="ceklis('{{$kerja->id}}', false)"></i>
                                                                    @else
                                                                        <i class="far fa-square" wire:click="ceklis('{{$kerja->id}}', false)"></i>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>