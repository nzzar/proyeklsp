<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">
                    FR.IA.11. CEKLIS MENINJAU INSTRUMENT ASESSMEN
                </h6>
            </div>
            <div class="card-body">
            @if($skemaAsesi->meninjauAsesmentNotes)
                <table class="table table table-bordered">
                    <thead>
                        <tr>
                            <th class="align-middle text-center" style="width: 50% ;">Kegiatan Asesmen</th>
                            <th class="text-center" style="width: 10% ;">Ya</th>
                            <th class="text-center " style="width: 10% ;">Tidak</th>
                            <th class="align-middle text-center" style="max-width: 20% ;">Kompentar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($skemaAsesi->meninjauAsesment as $tinjau)
                        <tr>
                            <td>
                                {{$tinjau->kegiatan_asesmen}}
                            </td>
                            <td class="align-middle text-center">
                                <i class="far @if($tinjau->result) fa-check-square @else fa-square @endif"></i>
                            </td>
                            <td class="align-middle text-center">
                                <i class="far @if(!$tinjau->result) fa-check-square @else fa-square @endif"></i>
                            </td>
                            <td>
                                {{$tinjau->komentar}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <table class="mt-3 table table table-bordered">
                    <tr>
                        <td>
                            <div class="font-weight-bold">
                                Nama Peninjau
                            </div>
                            {{$skemaAsesi->asesor->name}}
                        </td>
                        <td>
                            <div class="font-weight-bold">
                                Tanggal Tanda Tangan Peninjau
                            </div>
                            <img src="{{Storage::url($skemaAsesi->ttd_asesor)}}" alt="" srcset="" class="w-25">

                        </td>
                        <td>
                            <div class="font-weight-bold">
                                Komentar
                            </div>
                            {{$skemaAsesi->meninjauAsesmentNotes->komentar}}
                        </td>
                    </tr>
                </table>
            @else 
                <div class="text-center text-secondary">
                    Asesor belum mengisi form
                </div>
            @endif
            </div>
        </div>
    </div>
</div>