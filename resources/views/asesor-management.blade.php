@extends('layout')

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
Asesor Management
@endsection

@section('main-content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                @livewire('asesor.index')
            </div>
        </div>
    </div>
</div>

@livewire('asesor.create')
@endsection

@section('script') 
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        window.livewire.on('successAsesorCreated', () => {
            $('#create-asesor-modal').modal('hide')
            Toast.fire({
                icon: 'success',
                title: `Data asesor berhasil disimpan`
            })

        })

        window.livewire.on('errorAsesorCreated', () => {
            Toast.fire({
                icon: 'error',
                title: `Gagal menyimpan data asesor`
            })

        })
        
        
        $('#birt-date-input-mask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        
        $('#birt-date-input-mask').on('input', function() {
            Livewire.emit('birthDateInputHandle', $(this).val())
        })
    </script>
@endsection

