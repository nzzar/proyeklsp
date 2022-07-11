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
        @default
    @endswitch
@endsection