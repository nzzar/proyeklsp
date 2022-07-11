<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Data Skema</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Nomor Skema</label>
                            <input value="{{$skema->nomor}}" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label>Judul Skema</label>
                            <input value="{{$skema->name}}" class="form-control" disabled>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title">Persyaratan Skema</h6>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 20px;">#</th>
                                            <th>Persyaratan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0 ?>
                                        @forelse($skema->persyaratan as $persyaratan)
                                        <?php $no++ ?>
                                        <tr>
                                            <td>{{$no}}</td>
                                            <td>{{$persyaratan->name}}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="2" class="text-center">data persyaratan kosong</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title">Daftar Unit Kompentensi Sesuai Kemasan</h6>
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

                                        <div id="collapse-{{$kompetensi->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                                <?php $no = 0 ?>
                                                <ol>
                                                    @forelse($kompetensi->element as $element)
                                                    <?php $no++ ?>
                                                    <li>
                                                        <div> Elemen: {{$element->name}}</div>
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
                                                    </li>
                                                    @empty
                                                    -
                                                    @endforelse
                                                </ol>
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
        </div>
    </div>
</div>