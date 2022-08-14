<div class="table-responsive p-2 p-md-5">
    <div class="row mb-2">
        <div class="col">
        </div>
        <div class="col-12 col-md-3">
            <div class="d-flex align-items-center small">
                <i class="fa fa-search fa-fw text-muted position-absolute pl-3"></i>
                <input wire:model.debounce.300ms="search" type="text" class="form-control py-2" placeholder="Search..." style="padding-left: 38px;" />
            </div>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Judul Event</th>
                <th>Waktu pelaksanaan</th>
                <th>Tempat Uji Kompetensi</th>
                <th style="width: 20%;">Kuota Peserta</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0 ?>
            @foreach($events as $event)
            <?php $no++ ?>
            <tr>
                <td>{{$no}}.</td>
                <td>{{$event->title}}</td>
                <td>{{$event->start_date}} - {{$event->end_date}}</td>
                <td>{{$event->tuk}}</td>
                <td>
                    <div class="text-center">
                        {{$event->qty}} Peserta
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: {{($event->asesi_approve * 100 / $event->qty)}}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">{{$event->asesi_approve}} of  {{$event->qty}}</div>
                    </div>
                </td>
                <td>
                    <a href="{{url('/event/'.$event->id)}}/register" class="btn btn-primary btn-sm">Daftar Skema</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>