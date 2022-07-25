@extends('layout')

@section('page-title')
Event Sertifikasi
@endsection


@section('main-content')
    @switch(Auth::User()->role)
        @case('admin')
            @livewire('event.detail', ['id' => $id])
            @break
        @case('ms')
            @livewire('ms.event.detail', ['id' => $id])
            @break
        @case('asesor')
            @livewire('asesor.event.detail', ['id' => $id])
            @break
        @default
            @livewire('asesi.event.detail', ['id' => $id])
    @endswitch
@endsection