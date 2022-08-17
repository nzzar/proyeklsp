@extends('layout')


@section('page-title')
Event Sertifikasi Management
@endsection


@section('main-content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
            @switch(Auth::user()->role)
                @case('admin')
                    @livewire('event.index')
                    @break
                @case('ms')
                    @livewire('ms.event.index')
                    @break
                @case('asesor')
                    @livewire('asesor.event.index')
                    @break
                @default
                    @livewire('asesi.event.index')
            @endswitch
            </div>
        </div>
    </div>
</div>
@if(Auth::user()->role == 'admin')
    @livewire('event.create')
    @livewire('event.update')
    @livewire('event.delete')
@endif
@endsection

@if(Auth::user()->role == 'admin')


@section('script')


<script>
    $(document).ready(function() {
        let now = moment().format('DD/MM/YYYY HH:mm')
        console.log(now)
        Livewire.emit('event-set-start-date', now)
        Livewire.emit('event-set-end-date', now)
    })

    $('.select-skema').select2({
        theme: 'bootstrap4',
        dropdownParent: "#create-event-modal",
        multiple: false,
        allowClear: true,
        tags: true,
        placeholder: "Pilih skema"
    })

    //Date picker
    $('#start-date').daterangepicker({
        singleDatePicker: true,
        timePicker: true,
        locale: {
            format: 'DD/MM/YYYY HH:mm'
        },
    })
    $('#end-date').daterangepicker({
        singleDatePicker: true,
        timePicker: true,
        locale: {
            format: 'DD/MM/YYYY HH:mm'
        },
    })

    $('#update-start-date').daterangepicker({
        singleDatePicker: true,
        locale: {
            format: 'DD/MM/YYYY HH:mm'
        },
    })
    $('#update-end-date').daterangepicker({
        singleDatePicker: true,
        locale: {
            format: 'DD/MM/YYYY HH:mm'
        },
    })

    $('.select-skema').change(function(e) {
        Livewire.emit('event-select-skema-handling', $(this).val())
    })

    $('#start-date').change(function() {
        Livewire.emit('event-set-start-date', $(this).val())
    })

    $('#update-end-date').change(function() {
        Livewire.emit('event-set-end-date', $(this).val())
    })

    $('#update-start-date').change(function() {
        Livewire.emit('event-set-start-date', $(this).val())
    })

    $('#end-date').change(function() {
        Livewire.emit('event-set-end-date', $(this).val())
    })

    window.livewire.on('event-create-created', () => {
        $('#create-event-modal').modal('hide')
        Toast.fire({
            icon: 'success',
            title: `Berhasil menambahkan event`
        })

    })
    window.livewire.on('event-update-set-event-by-id-success', () => {
        $('#update-event-modal').modal('show')
    })

    window.livewire.on('event-update-set-event-by-id-failed', () => {
        Toast.fire({
            icon: 'error',
            title: `Gagal mendapatkan data event`
        })
    })

    window.livewire.on('event-update-updated', () => {
        $('#create-event-modal').modal('hide')
        Toast.fire({
            icon: 'success',
            title: `Berhasil memperbarui data event`
        })

    })
    window.livewire.on('error-validation', () => {
        if (!$('.select-skema').hasClass("select2-hidden-accessible")) {
            $('.select-skema').select2({
                theme: 'bootstrap4',
                dropdownParent: "#create-event-modal",
                multiple: false,
                allowClear: true,
                tags: true,
                placeholder: "Pilih skema"
            })
        }
    })

    window.livewire.on('event-reinit', () => {
        if (!$('.select-skema').hasClass("select2-hidden-accessible")) {
            $('.select-skema').select2({
                theme: 'bootstrap4',
                dropdownParent: "#create-event-modal",
                multiple: false,
                allowClear: true,
                tags: true,
                placeholder: "Pilih skema"
            })
        }
    })

    window.livewire.on('event-success-set-event-by-id', data => {
        console.log(name)
        Swal.fire({
            icon: 'question',
            html: `Yakin ingin menghapus <strong> ${data.nomor} | ${data.name} </strong>?`,
            showCancelButton: true,
            cancelButtonText: 'TidaK',
            confirmButtonText: 'Ya',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                Livewire.emit('eventDeleted')
            } 
        })
    })

    window.livewire.on('event-failed-set-event-by-id', (message) => {
        Swal.fire({
            icon: 'error',
            text: message

        })
    })


    window.livewire.on('event-success-delete-event', () => {
        Toast.fire({
            icon: 'success',
            title: `Berhasil menghapus event`
        })

    })

    window.livewire.on('event-failed-delete-event', () => {
        Toast.fire({
            icon: 'error',
            title: `event-failed-delete-event`
        })

    })
</script>
@endsection

@endif