@extends('layout')

@section('style')
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


@section('main-content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card user-list">
                @livewire('user.user-list')
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    window.livewire.on('passwordReseted', email => {
        $('#reset-password-form').modal('hide')
        console.log(email);
        Toast.fire({
            icon: 'success',
            title: `Success reset password user with email ${email}`
        })

    })
</script>
@endsection
