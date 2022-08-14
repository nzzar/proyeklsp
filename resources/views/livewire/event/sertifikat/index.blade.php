<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Data Skema</div>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-4 col-md-3">Judul Event</div>
                        <div class="col ml-1">: {{$event->title}}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 col-md-3">Kuota Peserta</div>
                        <div class="col ml-1">: {{$event->qty}}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 col-md-3">Tempat Uji Kompetensi (TUK)</div>
                        <div class="col ml-1">: {{$event->tuk}}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 col-md-3">Skema</div>
                        <div class="col ml-1">: {{$event->skema->name}}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 col-md-3">Nomor Skema</div>
                        <div class="col ml-1">: {{$event->skema->nomor}}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 col-md-3">Waktu Pelaksanaan</div>
                        <div class="col ml-1">: {{$event->start_date}} <span class="font-weight-bold">Sampai</span> {{$event->end_date}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                                    <th>NIM</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jurusan</th>
                                    <th>No. tlp</th>
                                    <th>email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($event->asesis as $index => $asesi)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$asesi->asesi->nim}}</td>
                                    <td>{{$asesi->asesi->name}}</td>
                                    <td>{{$asesi->asesi->prodi->name}}</td>
                                    <td>{{$asesi->asesi->phone}}</td>
                                    <td>{{$asesi->asesi->user->email}}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info mt-1" wire:click="$set('skemaAsesiId' , '{{$asesi->id}}')" data-toggle="modal" data-target="#upload-modal">Upload Sertifikat</button>
                                        @if($asesi->sertifikat) 
                                        <button class="btn btn-success btn-sm mt-1" wire:click="$set('view_file', '{{$asesi->sertifikat->sertifikat}}')"  data-toggle="modal" data-target="#view-file-modal">Lihat Sertifikat</button>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td rowspan="4" class="text-center text-secondary">tidak ada data asesi kompeten</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="create-unit" aria-hidden="true" id="upload-modal">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header"><h6>Upload Sertifikat</h6></div>
                <div class="modal-body">

                    @if($file)
                        @if(is_string($file))
                        <div class="text-center"><img src="{{Storage::url($file)}}" alt="" class="rounded w-25 mb-2"></div>
                        @else
                        <div class="text-center"><img src="{{$file->temporaryUrl()}}" alt="" class="rounded w-25 mb-2"></div>
                        @endif
                    @endif

                    <div class="custom-file mb-3">
                        <input type="file" wire:model="file" class="custom-file-input @error('file') is-invalid @enderror" id="customFile" name="file">
                        <label class="custom-file-label" for="customFile">Upload Sertifikat</label>
                        @error('file') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="uploadSertificat" data-dismiss="modal">Upload</button>
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