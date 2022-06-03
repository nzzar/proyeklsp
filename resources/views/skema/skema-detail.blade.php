@extends('layout')

@section('page-title')
{{$skema->nomor}} | {{$skema->name}}
@endsection


@section('main-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Skema</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nomor</label>
                        <input wire:model="nomor" type="text" class="form-control" placeholder="Masukan nomor skema">
                        @error('nomor') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Skema</label>
                        <input wire:model="name" type="text" class="form-control" placeholder="Masukan nama skema">
                        @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <label for="exampleInputEmail1">Status</label>
                    <div class="form-group clearfix">
                        <div class="icheck-primary d-inline">
                            <input type="radio" wire:click="toggleStatus('y')" id="radioPrimary1" name="gender" checked="">
                            <label for="radioPrimary1">
                                Active
                            </label>
                        </div>
                        <div class="icheck-primary d-inline">
                            <input type="radio" wire:click="toggleStatus('n')" id="radioPrimary2" name="gender">
                            <label for="radioPrimary2">
                                Nonactive
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Kelengkapan Document</div>

                </div>
                <div class="card-body">

                </div>

            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Check list observasi</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection