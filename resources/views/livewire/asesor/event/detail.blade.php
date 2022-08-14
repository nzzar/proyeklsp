<div class="container-container">
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
                <div class="card-footer">
                    <button class="btn btn-primary btn-sm" wire:click.prevent="$set('tabActive', 'skema')"><i class="fas fa-clipboard-list"></i> Data Skema</button>
                    <button class="btn btn-primary btn-sm" wire:click.prevent="$set('tabActive', 'asesor')"><i class="fas fa-user-tie"></i> Data Asesor</button>
                    <button class="btn btn-primary btn-sm" wire:click.prevent="$set('tabActive', 'asesi')"><i class="fas fa-users"></i> Data Asesi</button>
                    <button class="btn btn-primary btn-sm" wire:click.prevent="$set('tabActive', 'report')"><i class="fas fa-clipboard-list"></i> Laporan Asesmen</button>
                </div>
            </div>
        </div>
    </div>

    @if($skemaId && $tabActive == 'skema')
        @livewire('event.skema', ['id' => $skemaId])
    @elseif($tabActive == 'asesor')
        @livewire('event.asesor', ['id' => $eventId])
    @elseif($tabActive == 'asesi')
        @livewire('event.asesi', ['id' => $eventId])
    @elseif($tabActive == 'report')
        @livewire('asesor.event.report', ['id' => $eventId])
    @endif
</div>