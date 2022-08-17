@extends('layout')

@section('page-title')
    Meninjau Asesmen
@endsection


@section('main-content')
    @livewire('asesor.event.asesi.meninjau-asesmen', ['id' => $id])
@stop