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
                                        <a href="#" class="btn btn-primary btn-sm" wire:click.prevent="$set('view_file', '{{$event->sertifikat->sertifikat}}')" data-toggle="modal" data-target="#view-file-modal">Lihat Sertifikat</a>
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
</script>
@endsection