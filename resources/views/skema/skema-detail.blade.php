@extends('layout')

@section('page-title')
{{$skema->nomor}} | {{$skema->name}}
@endsection


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
                    <h3 class="card-title">Skema</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">


                            <form action="{{url('/skema/'.$skema->id.'/update')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nomor</label>
                                    <input name="nomor" value="{{$skema->nomor}}" type="text" class="form-control" placeholder="Masukan nomor skema">
                                    @error('nomor') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Skema</label>
                                    <input name="name" value="{{$skema->name}}" type="text" class="form-control" placeholder="Masukan nama skema">
                                    @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <label for="exampleInputEmail1">Status</label>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline mr-3">
                                        <input type="radio" id="radioPrimary1" name="active" value="y" {{$skema->active ? 'checked' : ''}}>
                                        <label for="radioPrimary1">
                                            Active
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary2" name="active" value="n" {{!$skema->active ? 'checked' : ''}}>
                                        <label for="radioPrimary2">
                                            Nonactive
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                            </form>
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

                @livewire('skema-detail.persyaratan.index',['skemaId' => $skema->id])

            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Unit Kompetensi</div>
                </div>
                @livewire('skema-detail.unit-kompetensi.index',['skemaId' => $skema->id])
            </div>
        </div>
    </div>
</div>

@livewire('skema-detail.persyaratan.create',['skemaId' => $skema->id])
@livewire('skema-detail.persyaratan.update')
@livewire('skema-detail.persyaratan.delete')

@livewire('skema-detail.unit-kompetensi.create',['skemaId' => $skema->id])
@livewire('skema-detail.unit-kompetensi.delete')
@livewire('skema-detail.unit-kompetensi.update')

@endsection

@section('script')
<script>
    window.livewire.on('delete-set-persyaratan-success', name => {
        Swal.fire({
            icon: 'question',
            title: `Yakin ingin menghapus Persyaratan ${name}?`,
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                Livewire.emit('delete-persyaratan')
            }
        })
    })

    window.livewire.on('persyaratan-deleted', () => {
        Toast.fire({
            icon: 'success',
            title: `Berhasil menghapus persyaratan`
        })
    })

    window.livewire.on('delete-set-unit-id-success', name => {
        Swal.fire({
            icon: 'question',
            title: `Yakin ingin menghapus Unit Kompetensi ${name}?`,
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                Livewire.emit('detete-unit')
            }
        })
    })

    window.livewire.on('unit-deleted', () => {
        Toast.fire({
            icon: 'success',
            title: `Berhasil menghapus unit kompetensi`
        })
    })
</script>
@stop