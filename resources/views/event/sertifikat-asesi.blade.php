@extends('layout')


@section('page-title')
Sertifikat Asesi
@endsection


@section('main-content')
@livewire('event.sertifikat.index', ['id' => $id])
@stop