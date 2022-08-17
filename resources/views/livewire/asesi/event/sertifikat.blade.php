<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Data Asesi</h6>
                </div>
                <div class="card-body ">
                    <div class="table-responsive">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Skema</th>
                                    <th>Waktu pelaksanaan</th>
                                    <th>Tempat Uji Kompetensi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0 ?>
                                @foreach($skemaAsesi as $event)
                                <?php $no++ ?>
                                <tr>
                                    <td>{{$no}}.</td>
                                    <td>{{$event->event->skema->name}}</td>
                                    <td>{{$event->event->start_date}} - {{$event->event->end_date}}</td>
                                    <td>{{$event->event->tuk}}</td>
                                    <td>
                                        @if($event->sertifikat)
                                        <a href="#" class="btn btn-primary btn-sm" wire:click.prevent="downloadSertifikat('{{$event->sertifikat->id}}')" >Download Sertifikat</a>
                                        @else
                                        Sertifikat belum tersedia
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
</script>
@endsection