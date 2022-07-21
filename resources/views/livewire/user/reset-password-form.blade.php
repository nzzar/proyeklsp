<div wire:ignore.self class="modal" tabindex="-1" role="dialog" id="reset-password-form">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reset password @if($userSelected) with email {{$userSelected->email}} @endif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" id="password-form">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input wire:model="password" type="password" class="form-control" placeholder="Enter email">
                        @error('password') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Confirm Password</label>
                        <input wire:model="cpassword" type="password" class="form-control" placeholder="Enter email">
                        @error('cpassword') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" wire:click.prevent="resetPassword()">Save changes</button>
            </div>
        </div>
    </div>
</div>

