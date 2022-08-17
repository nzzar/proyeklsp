@extends('layout')

@section('main-content')
<div class="container-fluid">
    <div class="row">
        @if($message = Session::get('success'))
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{$message}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Unit Kompetensi {{$data->kode}} | {{$data->judul}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">


                            <div class="form-group">
                                <label for="exampleInputEmail1">Skema</label>
                                <input disabled name="nomor" value="{{$data->skema->nomor}} | {{$data->skema->name}}" type="text" class="form-control" placeholder="Masukan nomor skema">
                            </div>
                            <form action="{{url('/skema/'.$data->id.'/unit-kompetensi/update')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kode Unit</label>
                                    <input name="kode" value="{{$data->kode}}" type="text" class="form-control" placeholder="Masukan kode unit">
                                    @error('kode') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Judul</label>
                                    <input name="judul" value="{{$data->judul}}" type="text" class="form-control" placeholder="Masukan judul unit">
                                    @error('judul') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @livewire('skema-detail.unit-kompetensi.element.index', ['unitId' => $data->id])
</div>



@endsection

@section('script')
<script>

    function deleteElement(id) {
        Livewire.emit('get-element-id', id, true)
    }
    
    function deleteUnjukKerja(id) {
        Livewire.emit( 'get-unjuk-kerja-id', id, true)

    }

    window.livewire.on('success-set-element', (data, isDelete) => {
        if(isDelete) {
            Swal.fire({
            icon: 'question',
            title: `Yakin ingin menghapus Element ${data.name}?`,
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                Livewire.emit('delete-element')
            }
        })
        }
    })

    window.livewire.on('success-set-unjuk-kerja', (data, isDelete) => {
        console.log(data);
        if(isDelete) {
            Swal.fire({
            icon: 'question',
            title: `Yakin ingin menghapus Unjuk Kerja`,
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                Livewire.emit('delete-unjuk-kerja')
            }
        })
        }
    })
    // window.livewire.on('delete-set-persyaratan-success', name => {
    //     Swal.fire({
    //         icon: 'question',
    //         title: `Yakin ingin menghapus persyaratan ${name}`,
    //         showCancelButton: true,
    //         cancelButtonText: 'Batal',
    //         confirmButtonText: 'Hapus',
    //     }).then((result) => {
    //         /* Read more about isConfirmed, isDenied below */
    //         if (result.isConfirmed) {
    //             Livewire.emit('delete-persyaratan')
    //         }
    //     })
    // })

    // window.livewire.on('persyaratan-deleted', () => {
    //     Toast.fire({
    //         icon: 'success',
    //         title: `Berhasil menghapus persyaratan`
    //     })
    // })

    // window.livewire.on('delete-set-unit-id-success', name => {
    //     Swal.fire({
    //         icon: 'question',
    //         title: `Yakin ingin menghapus unit ${name}`,
    //         showCancelButton: true,
    //         cancelButtonText: 'Batal',
    //         confirmButtonText: 'Hapus',
    //     }).then((result) => {
    //         /* Read more about isConfirmed, isDenied below */
    //         if (result.isConfirmed) {
    //             Livewire.emit('detete-unit')
    //         }
    //     })
    // })

    // window.livewire.on('unit-deleted', () => {
    //     Toast.fire({
    //         icon: 'success',
    //         title: `Berhasil menghapus unit kompetensi`
    //     })
    // })
</script>
@stop