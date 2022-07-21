@extends('layout')


@section('style')
<link rel="stylesheet" href="{{asset('assets/plugins/daterangepicker/daterangepicker.css')}}">
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
Data Skema
@endsection

@section('main-content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                @livewire('skema.index')
            </div>
        </div>
    </div>
</div>

@livewire('skema.create')
@livewire('skema.update')
@livewire('skema.delete')


@endsection

@section('script')
<script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>

<script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    $(document).ready(function() {

        // crud action result

        window.livewire.on('successSaveSkema', () => {
            $('#create-skema-modal').modal('hide')
            Toast.fire({
                icon: 'success',
                title: `Data Skema berhasil disimpan`
            })
        })

        window.livewire.on('failedSaveSkema', () => {
            Toast.fire({
                icon: 'error',
                title: `Gagal menyimpan data skema`
            })
        })

        window.livewire.on('successGetSkemaById', data => {
            $('#statusRadio1').removeAttr('checked')
            $('#statusRadio2').removeAttr('checked')
            data.active ? $('#statusRadio1').attr('checked', 'checked') : $('#statusRadio2').attr('checked', 'checked')
            $('#update-skema-modal').modal('show')
        })

        window.livewire.on('failedGetSkemaById', () => {
            Toast.fire({
                icon: 'error',
                title: `Data skema tidak ditemukan`
            })
        })


        window.livewire.on('successUpdateSkema', () => {
            $('#update-skema-modal').modal('hide')
            Toast.fire({
                icon: 'success',
                title: `Perubahan Data Skema berhasil disimpan`
            })
        })

        window.livewire.on('failedUpdateSkema', () => {
            Toast.fire({
                icon: 'error',
                title: `Gagal menyimpan perubahan data skema`
            })
        })

        window.livewire.on('successSetSkemaDeleted', name => {
            Swal.fire({
                icon: 'question',
                title: `Yakin ingin menghapus Skema ${name}?`,
                showCancelButton: true,
                cancelButtonText: 'TidaK',
                confirmButtonText: 'Ya',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Livewire.emit('confirmDelete')
                }
            })
        })

        window.livewire.on('failedSetSkemaDeleted', () => {
            Toast.fire({
                icon: 'error',
                title: `Data skema tidak ditemukan`
            })
        })


        window.livewire.on('successDeletedSkema', () => {
            Toast.fire({
                icon: 'success',
                title: `Berhasil menghapus skema`
            })

        })

        window.livewire.on('failedDeletedSkema', () => {
            Toast.fire({
                icon: 'error',
                title: `Gagal menghapus data skema`
            })

        })

    })
</script>

@endsection