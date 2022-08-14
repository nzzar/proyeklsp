<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">
                    FR.AK.03 UMPAN BALIK DAN CATATAN ASESMEN
                </h6>
            </div>
            <div class="card-body">
                <table class="table table table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2" class="align-middle text-center" style="width: 50% ;">Komponen</th>
                            <th colspan="2" class="text-center">Hasil</th>
                            <th rowspan="2" class="align-middle text-center" style="max-width: 20% ;">Catatan Kompentar Asesi</th>
                            @if(!$skemaAsesi->feedBackNotes)
                            <th rowspan="2" class="align-middle text-center">Action</th>
                            @endif
                        </tr>
                        <tr>
                            <th class="text-center">Ya</th>
                            <th class="text-center">Tidak</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($umpanBalik as $umpanBalik)
                        <tr>
                            <td>{{$umpanBalik->komponen}}</td>
                            <td>
                                <i class="far @if($umpanBalik->hasil) fa-check-square @else fa-square @endif"></i>
                            </td>
                            <td>
                                <i class="far @if(!$umpanBalik->hasil) fa-check-square @else fa-square @endif"></i>
                            </td>
                            <td>
                                {{$umpanBalik->notes}}
                            </td>
                            @if(!$skemaAsesi->feedBackNotes)
                            <td><button class="btn btn-sm btn-primary">Umpan Balik</button></td>
                            @endif
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="5">
                                @if(!$skemaAsesi->feedBackNotes)
                                <div class="form-group">
                                    <label>Catatan / Komentar lainnya (apabila ada):</label>
                                    <input wire:model="otherNotes" type="text" class="form-control">
                                </div>
                                @else
                                <div class="form-group">
                                    <label>Catatan / Komentar lainnya (apabila ada):</label>
                                    <p>{{$skemaAsesi->feedBackNotes->notes}}</p>
                                </div>
                                @endif

                            </td>
                        </tr>
                    </tbody>
                </table>
                @if(!$skemaAsesi->feedBackNotes)
                <button class="btn btn-block btn-primary mt-3" onclick="saveFeedback()">Simpan</button>
                @endif
            </div>
        </div>
    </div>
</div>