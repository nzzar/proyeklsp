@extends('layout')

@section('page-title')
    Checklist Observasi
@endsection


@section('main-content')
    @livewire('asesi.event.observasi', ['id' => $id])
@stop