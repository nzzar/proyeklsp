<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">FR.AK.05 LAPORAN ASESMEN</h6>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="col-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 5% ;">No</th>
                                    <th>Kode Unit</th>
                                    <th>Judul Unit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($event->skema->unitKompetensi as $index => $unit)
                                <tr>
                                    <td>{{$index + 1}}</td>
                                    <td>{{$unit->kode}}</td>
                                    <td>{{$unit->judul}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th style="width: 5%;" rowspan="2" class="align-middle text-center">No</th>
                                    <th rowspan="2" class="align-middle text-center">Nama Asesi</th>
                                    <th colspan="2" style="width:10%;" class="align-middle text-center">Rekomendasi</th>
                                </tr>
                                <tr>
                                    <th class="align-middle text-center">K</th>
                                    <th class="align-middle text-center">BK</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($skemaAsesi as $key => $skemaAsesi)
                                    <td>{{$key + 1}}</td>
                                    <td>{{$skemaAsesi->asesi->name}}</td>
                                    <td class="align-middle text-center"><i class="far @if($skemaAsesi->skema_status == 'Kompeten') fa-check-square @else fa-square @endif"></i></td>
                                    <td class="align-middle text-center"><i class="far @if($skemaAsesi->skema_status == 'Belum Komepeten') fa-check-square @else fa-square @endif"></i></td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
