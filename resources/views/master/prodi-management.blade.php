@extends('layout')

@section('page-title')
Data Jurusan
@endsection

@section('main-content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                @livewire('master.prodi.index')
            </div>
        </div>
    </div>
</div>
@livewire('master.prodi.update')
@livewire('master.prodi.create')
@livewire('master.prodi.delete')
@endsection

@section('script')
<script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    // success get prodi by id
    window.livewire.on('successGetProdiById', () => {
        console.log('tes');
        $('#update-prodi').modal('show')

    })

    // failed get prodi by id
    window.livewire.on('failedGetProdiById', () => {
        Toast.fire({
            icon: 'error',
            title: `Data jurusan tidak ditemukan`
        })
    })

    // success update prodi
    window.livewire.on('successUpdateProdi', () => {
        $('#update-prodi').modal('hide')
        Toast.fire({
            icon: 'success',
            title: `Data jurusan berhasil diperbarui`
        })

    })

    // failed update prodi
    window.livewire.on('failedUpdateProdiById', () => {
        Toast.fire({
            icon: 'error',
            title: `Gagal memperbarui data jurusan`
        })

    })

    // success create new prodi
    window.livewire.on('successCreateProdi', () => {
        $('#create-prodi').modal('hide')
        Toast.fire({
            icon: 'success',
            title: `Data jurusan berhasil disimpan`
        })

    })

    // failed create new prodi
    window.livewire.on('failedCreateProdi', () => {
        Toast.fire({
            icon: 'error',
            title: `Gagal menyimpan data prodi`
        })

    })

    window.livewire.on('successSetProdiDeleted', name => {
        console.log(name)
        Swal.fire({
            icon: 'question',
            title: `Yakin ingin menghapus prodi ${name}?`,
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

    window.livewire.on('failedSetProdiDeleted', () => {
        Toast.fire({
            icon: 'error',
            title: `Data prodi tidak ditemukan`
        })
    })


    window.livewire.on('successDeletedProdi', () => {
        Toast.fire({
            icon: 'success',
            title: `Berhasil menghapus prodi`
        })

    })

    window.livewire.on('failedDeletedProdi', () => {
        Toast.fire({
            icon: 'error',
            title: `Gagal menghapus data prodi`
        })

    })
</script>
@endsection