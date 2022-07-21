@extends('layout')

@section('page-title')
Profile
@endsection


@section('main-content')
    @if(Auth::user()->role == 'asesi')
        @livewire('asesi.profile.form')
    @elseif(Auth::user()->role == 'admin')
        @livewire('admin.profile')
    @endif
@endsection