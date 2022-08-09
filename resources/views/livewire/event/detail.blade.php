
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Data Event | @switch($status)
                        @case('Waiting')
                        <span class="badge badge-warning"> Menunggu Persetujuan </span>
                        @break
                        @case('Approved')
                        <span class="badge badge-success"> Disetujui </span>
                        @break
                        @case('Unapproved')
                        <span class="badge badge-danger"> Tidak Disetujui </span>
                        @break
                        @default
                        <span class="badge badge-secondary"> Draft </span>
                        @endswitch
                        |
                        <span class="badge {{$active ? 'badge-success' : 'badge-danger'}} badge-info"> {{$active ? 'Aktif' : 'Tidak aktif'}} </span>
                    </h6>
                </div>
                <div class="card-body">
                    @if($status == 'Unapproved')
                    <div class="alert alert-danger" role="alert">
                        {{$desc}}
                    </div>
                    @endif
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Judul Event</label>
                            <input wire:model="title" @if(!in_array($status, ['Draft', 'Unapproved' ])) disabled @endif type="text" class="form-control  @error('title') is-invalid @enderror" placeholder="Masukanm judul Event">
                            @error('title') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Quota Peserta</label>
                            <input wire:model="qty" @if(!in_array($status, ['Draft', 'Unapproved' ])) disabled @endif type="number" class="form-control  @error('qty') is-invalid @enderror" placeholder="Masukanm Quota Peserta">
                            @error('qty') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tempat Uji Kompetensi (TUK)</label>
                            <input wire:model="tuk" @if(!in_array($status, ['Draft', 'Unapproved' ])) disabled @endif type="text" class="form-control  @error('nik') is-invalid @enderror" placeholder="Masukanm TUK">
                            @error('tuk') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label>Pilih Skema</label>
                            <select @if(!in_array($status, ['Draft', 'Unapproved' ])) disabled @endif class="form-control select-skema  @error('skemaId') is-invalid @enderror" style="width: 100%;" name="skemaId">
                                <option></option>
                                @foreach ($skemas as $skema)
                                <option value="{{$skema->id}}" {{$skema->id == $skemaId ? 'selected' : ''}}>{{$skema->nomor}} | {{$skema->name}}</option>
                                @endforeach
                            </select>
                            @error('skemaId') <span class="text-danger">{{ $message }}</span>@enderror

                        </div>

                        <label for="exampleInputEmail1">Waktu Pelaksanaan</label>
                        <div class="row">
                            <div class="col-12 col-md-5">
                                <div class="form-group">
                                    <input readonly type="text" value="{{$startDate}}" class="form-control  @error('startDate') is-invalid @enderror" id="start-date">
                                    @error('startDate') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-2 text-center">Sampai</div>
                            <div class="col-12 col-md-5">
                                <div class="form-group">
                                    <input readonly type="text" value="{{$endDate}}" class="form-control  @error('endDate') is-invalid @enderror" id="end-date">
                                    @error('endDate') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                        @if(in_array($status, ['Draft', 'Unapproved']))
                        <button class="btn btn-primary btn-block" wire:click.prevent="edit()">Simpan Perubahan</button>
                        @endif
                        <small class="form-text text-muted">* Perubahan hanya dapat dilakukan ketika status Draft atau Tidak disetujui</small>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <div>
                            <button class="btn btn-primary btn-sm" wire:click.prevent="$set('tabActive', 'skema')"><i class="fas fa-clipboard-list"></i> Data Skema</button>
                            <button class="btn btn-primary btn-sm" wire:click.prevent="$set('tabActive', 'asesor')"><i class="fas fa-user-tie"></i> Data Asesor</button>
                            <button class="btn btn-primary btn-sm" wire:click.prevent="$set('tabActive', 'asesi')"><i class="fas fa-users"></i> Data Asesi</button>
                        </div>
                        <div>
                            @if(in_array($status, ['Draft', 'Unapproved']))
                            <button class="btn btn-info btn-sm" onclick="proposeEvent()">Ajukan Event</button>
                            @endif
                            @if($active)
                            <button class="btn btn-danger btn-sm" wire:click.prevent="nonActive()">Nonaktifkan Event</button>
                            @else
                            <button class="btn btn-success btn-sm" wire:click.prevent="active()">Aktifkan Event</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($skemaId && $tabActive == 'skema')
    @livewire('event.skema', ['id' => $skemaId])
    @endif

    @if($tabActive == 'asesor')
    @livewire('event.asesor', ['id' => $eventId])
    @endif

    @if($tabActive == 'asesi')
    @livewire('event.asesi', ['id' => $eventId])
    @endif
</div>

@section('script')

<script>
    window.addEventListener('swal', function(e) {
        Swal.fire(e.detail);
    });

    $('#start-date').daterangepicker({
        timePicker: true,
        singleDatePicker: true,
        locale: {
            format: 'DD/MM/YYYY HH:mm'
        },
    })

    $('#end-date').daterangepicker({
        timePicker: true,
        singleDatePicker: true,
        locale: {
            format: 'DD/MM/YYYY HH:mm'
        },
    })

    function proposeEvent() {
        Swal.fire({
            icon: 'question',
            title: 'Ajukan Event ?',
            text: 'Pastikan semua data sudah diisi dengan benar!',
            showCancelButton: true,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                Livewire.emit('propose-event')
            }
        })
    }
</script>

@endsection