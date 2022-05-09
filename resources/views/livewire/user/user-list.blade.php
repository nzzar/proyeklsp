<div class="table-responsive p-2 p-md-5">
    <div class="row mb-2">
        <div class="col-12 col-md-3">
            <div class="d-flex align-items-center small">
                <i class="fa fa-search fa-fw text-muted position-absolute pl-3"></i>
                <input wire:model.debounce.300ms="search" type="text" class="form-control py-2" placeholder="Search..." style="padding-left: 38px;" />
            </div>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Email</th>
                <th>Role</th>
                <th style="width: 300px">Active</th>
                <th style="width: 300px">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0 ?>
            @foreach($data as $user)
            <?php $no++ ?>
            <tr>
                <td>{{$no}}.</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role}}</td>
                <td>{{$user->active ? 'True' : 'False'}}</td>
                <td>
                    <button wire:click.prevent="resetForm('{{$user->id}}')" class="btn btn-xs btn-warning mr-2 btn-reset" data-toggle="modal" data-target="#reset-password-form">Reset password</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @include('livewire.user.reset-password-form')

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
</div>