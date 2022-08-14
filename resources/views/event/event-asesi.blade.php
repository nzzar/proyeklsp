@extends('layout')

@section('page-title')
Asesi Detail
@endsection

@section('main-content')
    @switch(Auth::User()->role)
        @case('admin')
            @livewire('event.asesi-detail', ['id' => $id])
            @break
        @case('asesor')
            @livewire('asesor.event.asesi.index', ['id' => $id])
            @break
        @default
            @livewire('asesi.event-detail.detail', ['id' => $id])
    @endswitch
@endsection