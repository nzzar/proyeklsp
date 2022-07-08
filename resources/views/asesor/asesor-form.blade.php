@extends('layout')

@section('title')
Admin | @if($id) Update @else Tambah @endif Asesor
@stop

@section('style')
<link rel="stylesheet" href="{{asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<style>
    input {
        border: none;
        background-color: transparent;
    }

    input:focus,
    select:focus,
    textarea:focus,
    button:focus {
        outline: none;
    }

    .fa-user-circle-o {
        color: gray;
    }
</style>
@endsection

@section('page-title')
  @if($id) Update @else Tambah @endif   Data Asesor
@endsection

@section('main-content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    @livewire('asesor.form', ['asesorId' => $id])
                </div>
            </div>
        </div>
    </div>
</div>
@stop

