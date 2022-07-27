@section('title')
Admin | Profile
@stop

@section('style')

<link rel="stylesheet" href="{{asset('/assets/plugins/signature/css/jquery.signature.css')}}">
<link rel="stylesheet" href="{{asset('/assets/plugins/jquery-ui/jquery-ui.min.js')}}">

@stop


<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Profile</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nomor Registrasi</label>
                                <input type="text" class="form-control  @error('reg') is-invalid @enderror" placeholder="Masukan nomor registrasi" wire:model="reg">
                                @error('reg') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Lengkap</label>
                                <input name="nik" type="text" class="form-control  @error('name') is-invalid @enderror" placeholder="Masukan nama lengkap" wire:model="name">
                                @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <label for="exampleInputEmail1">Tanda Tangan</label>
                            <div class="mb-3 d-flex">
                                <div style="width: 200px; height: 150px;">
                                    @if($signature)
                                        @if(is_string($signature))
                                            <img src="{{Storage::url($signature)}}" alt="" class="rounded h-75 mb-2">
                                        @else
                                            <img src="{{$signature->temporaryUrl()}}" alt="" class="rounded h-75 mb-2">
                                        @endif
                                    @else
                                        <div wire:ignore class="w-100 h-100" id="signature-pad"></div>
                                    @endif
                                </div>
                                @if(!$signature)
                                <div class="mx-3">
                                    <button class="btn btn-sm btn-primary btn-block mb-3" id="save-signature">Save Signature</button>
                                    <button class="btn btn-sm btn-danger btn-block mb-3" id="clear-signature" wire:click="test()">Clear Signature</button>
                                </div>
                                @endif
                            </div>
                            @if($errorMessage)
                                <div class="text-danger">{{$errorMessage}}</div> 
                            @endif
                            <button class="btn btn-primary btn-block" wire:click="save()" @if($errorMessage)  disabled @endif>Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
<script src="{{asset('/assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('/assets/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>
<script src="{{asset('/assets/plugins/signature/js/jquery.signature.min.js')}}"></script>

<script>
    window.addEventListener('swal', function(e) {
        Swal.fire(e.detail);
    });
    
    $(document).ready(function() {
        $('#signature-pad').signature()

        $('#clear-signature').click(function() {
            $('#signature-pad').signature('clear')
        })

    })

    $('#test').click(function() {
        console.log('test');
    })

    $('#save-signature').click(async function() {
        let invalidSignate = $('#signature-pad').signature('isEmpty')

        if (invalidSignate) {
            Swal.fire({
                title: 'Gagal!',
                text: 'Tanda tangan tidak boleh kosong',
                icon: 'warning',
                timer: 2000,
                showConfirmButton: false,
            })

            return
        }

        let base64 = $('#signature-pad').signature('toDataURL', 'image/png');
        let resImg = await fetch(base64)
        let blobImg = await resImg.blob()
        @this.upload('signature', blobImg)
    })
</script>
@stop