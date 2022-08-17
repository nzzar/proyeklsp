<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">
                        FR.IA.11. CEKLIS MENINJAU INSTRUMENT ASESSMEN
                    </h6>
                </div>
                <div class="card-body">
                    <table class="table table table-bordered">
                        <thead>
                            <tr>
                                <th class="align-middle text-center" style="width: 50% ;">Kegiatan Asesmen</th>
                                <th class="text-center" style="width: 10% ;">Ya</th>
                                <th class="text-center " style="width: 10% ;">Tidak</th>
                                <th class="align-middle text-center" style="max-width: 20% ;">Kompentar</th>
                                @if(!$skemaAsesi->meninjauAsesmentNotes)
                                <th class="align-middle text-center">Action</th>
                                @endif
                            </tr>
                            <tr>
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
                                @if(!$skemaAsesi->meninjauAsesmentNotes)
                                <td class="align-middle text-center" style="max-width: 3%;"><button class="btn btn-sm btn-primary" wire:click="tinjau('{{$tinjau->id}}')">Hasil</button></td>
                                @endif
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
                                @if(!$skemaAsesi->meninjauAsesmentNotes)
                                <input wire:model="otherNotes" type="text" class="form-control">
                                @else
                                    {{$skemaAsesi->meninjauAsesmentNotes->komentar}}
                                @endif
                            </td>
                        </tr>
                    </table>
                    @if(!$skemaAsesi->meninjauAsesmentNotes)
                    <div id="save-container">
                        <button class="btn btn-block btn-primary mt-3 btn-save">Simpan</button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="rekomendasi-modal" aria-hidden="true" id="rekomendasi-modal">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">Hasil</div>
                <div class="modal-body">
                    <div>
                        <label for="">
                            Komponen:
                        </label>
                        <p>
                            {{$kegiatan}}
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
                        <label>Komentar</label>
                        <input wire:model="notes" type="text" class="form-control">
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" form="" class="btn btn-primary" wire:click.prevent="setTinjau()" data-dismiss="modal">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('swal', function(e) {
            Swal.fire(e.detail);
        });

        window.livewire.on('meninjau', () => {
            $('#rekomendasi-modal').modal('show')
        })

        $('#save-container').on('click', '.btn-save', function() {
            Swal.fire({
                icon: 'question',
                title: `Simpan Data Meninjau Instrumen Asesmen ?`,
                html: 'Pastikan semua data telah diisi dengan benar, tidak dapat melakukan perubahan data setelah disimpan!',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Simpan',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.livewire.emit('save')
                }
            })
        })
    </script>

</div>