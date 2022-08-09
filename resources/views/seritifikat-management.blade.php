@extends('layout')

@section('main-content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                @livewire('event.sertifikat.index')
            </div>
        </div>
    </div>
</div>
@endsection