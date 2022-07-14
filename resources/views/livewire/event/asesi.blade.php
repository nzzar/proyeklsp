<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Data Perserta / Asesi</h6>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIM</th>
                            <th>Nama Lengkap</th>
                            <th>Prodi</th>
                            <th>Status</th>
                            @if(Auth::user()->role == 'admin')
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0 ?>
                        @forelse($asesis as $skema)
                        <?php $no++ ?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$skema->asesi->nim}}</td>
                            <td>{{$skema->asesi->name}}</td>
                            <td>{{$skema->asesi->prodi->name}}</td>
                            <td>
                                @switch($skema->status)
                                    @case('Menunggu Keputusan')
                                        <span class="badge badge-secondary">{{$skema->status}}</span>
                                    @break
                                    @case('Lulus')
                                        <span class="badge badge-success">{{$skema->status}}</span>
                                    @break
                                    @default
                                        <span class="badge badge-danger">{{$skema->status}}</span>
                                @endswitch
                            </td>
                            @if(Auth::user()->role == 'admin')
                            <td><button class="btn btn-info btn-sm" wire:click.prevent=""><i class="fas fa-file-alt"></i> Lihat Berkas</button></td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-secondary">Tidak ada data asesor</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>