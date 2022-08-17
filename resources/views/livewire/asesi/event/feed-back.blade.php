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
                </div>
            </div>
        </div>
    </div>
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
                                <td><button class="btn btn-sm btn-primary" wire:click="umpanBalik('{{$umpanBalik->id}}')">Umpan Balik</button></td>
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
    <div wire:ignore.self class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="rekomendasi-modal" aria-hidden="true" id="rekomendasi-modal">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">Umpan balik</div>
                <div class="modal-body">
                    <div>
                        <label for="">
                            Komponen:
                        </label>
                        <p>
                            {{$komponen}}
                        </p>
                    </div>
                    <div class="form-group">
                        <div>
                            <label for="">Hasil</label>
                        </div>
                        <div class="form-check form-check-inline" wire:click="$set('result', true)">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" @if($result) checked @endif>
                            <label class="form-check-label" for="inlineRadio1">Ya</label>
                        </div>
                        <div class="form-check form-check-inline" wire:click="$set('result', false)">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" @if(!$result) checked @endif>
                            <label class="form-check-label" for="inlineRadio2">Tidak</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Catatan / Komentar asesi</label>
                        <input wire:model="notes" type="text" class="form-control">
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" form="" class="btn btn-primary" wire:click.prevent="setFeedback()" data-dismiss="modal">Simpan</button>
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

    window.livewire.on('feedback', () => {
        $('#rekomendasi-modal').modal('show')
    })

    function saveFeedback() {
        Swal.fire({
            icon: 'question',
            title: `Simpan Data Umpan Balik ?`,
            html: 'Pastikan semua data telah diisi dengan benar, tidak dapat melakukan perubahan data setelah disimpan!',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Simpan',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                Livewire.emit('save')
            }
        })
    }
</script>
@stop