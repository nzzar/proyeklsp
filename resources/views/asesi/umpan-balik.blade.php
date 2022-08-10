@extends('layout')

@section('page-title')
    Umpan Balik Asesmen
@endsection


@section('main-content')
    @livewire('asesi.event.feed-back', ['id' => $id])
@stop