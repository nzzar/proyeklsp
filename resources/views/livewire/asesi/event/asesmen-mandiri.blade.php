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
                                                    <th>Action</th>
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
                                                    <td class="text-center align-middle"><button class="btn btn-info btn-sm" wire:click.prevent="asesmen('{{$element->id}}')" )>Rekomendasi</button></td>
                                                </tr>
                                                @empty
                                                -
                                                @endforelse

                                            </tbody>
                                        </table>
                                        <?php $no = 0 ?>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <h6 class="text-secondary">Tidak ada data unit kompetensi</h6>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" form="" class="btn btn-primary" wire:click.prevent="setAsesment()" data-dismiss="modal">Save changes</button>
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

    $('#select-syarat').change(function() {
        @this.set('persyaratan_id', $(this).val())
    })
</script>
@stop