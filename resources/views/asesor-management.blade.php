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
@livewire('asesor.update')
@endsection

@section('script') 
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });


        // create new asesor from create component success
        window.livewire.on('successAsesorCreated', () => {
            $('#create-asesor-modal').modal('hide')
            Toast.fire({
                icon: 'success',
                title: `Data asesor berhasil disimpan`
            })

        })


        // craete new asesor from create component failed
        window.livewire.on('errorAsesorCreated', () => {
            Toast.fire({
                icon: 'error',
                title: `Gagal menyimpan data asesor`
            })

        })
        
        // get data asesor by id from update componet success
        window.livewire.on('foundDataAsesor', asesor => {
            $('#updateGender1').removeAttr('checked')
            $('#updateGender2').removeAttr('checked')
            
            // manual set birth date (problem with wire model)
            $('#update-birth-date-input-mask').val(asesor.birthDate)
            
            // manual set gender
            asesor.gender == 'l' ? $('#updateGender1').attr('checked', 'checked') : $('#updateGender2').attr('checked', 'checked')
            $('#edit-asesor-modal').modal('show')
        })
        
        // get data asesor by id from update component failed
        window.livewire.on('asesorDataNotFound', () => {
            Toast.fire({
                icon: 'error',
                title: `Data asesor tidak ditemukan`
            })

        })

        // update data asesor by id from update component success
        window.livewire.on('updateAsesorSuccess', () => {
            $('#edit-asesor-modal').modal('hide')
            Toast.fire({
                icon: 'success',
                title: `Data asesor berhasil diperbarui`
            })

        })

        // update data asesor by id from update component failed
        window.livewire.on('updateAsesorFailed', () => {
            Toast.fire({
                icon: 'error',
                title: `Gagal memperbarui data asesor`
            })

        })


        
        $('#birt-date-input-mask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        $('#update-birth-date-input-mask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })

        $('#birt-date-input-mask').on('input', function() {
            Livewire.emit('birthDateInputHandle', $(this).val())
        })
        $('#update-birth-date-input-mask').on('input', function() {
            Livewire.emit('birthDateInputHandle', $(this).val())
        })
    </script>
@endsection

