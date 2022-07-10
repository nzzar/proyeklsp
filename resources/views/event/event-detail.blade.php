@extends('layout')

@section('page-title')
Event Sertifikasi 
@endsection


@section('main-content')

    @livewire('event.detail', ['id' => $id])

@endsection
