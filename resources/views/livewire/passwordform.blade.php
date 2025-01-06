<div class="row ">
    <div class="col-lg-12">

        @if(session('message'))

        <div class="alert alert-success">

            <p> {{ session('message')}}</p>
        </div>

        @endif

        <h4>Security</h4>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label>Old Password</label>
            <input type="password" class="form-control" style="color: black; font-weight: 500" placeholder="Old password" wire:model="old_password">
            <div class="text-danger">@error('old_password') {{ $message }} @enderror</div>
        </div>
    </div>

    <div class="col-lg-12">
        <hr>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label>New Password</label>
            <input type="password" class="form-control" style="color: black; font-weight: 500" placeholder="New password" wire:model="password">
            <div class="text-danger">@error('password') {{ $message }} @enderror</div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group">
            <label>Old Password</label>
            <input type="password" class="form-control" style="color: black; font-weight: 500" placeholder="Confirm password" wire:model="password_confirmation">
            <div class="text-danger">@error('password') {{ $message }} @enderror</div>
        </div>
    </div>

    <div class="col-lg-12">
        <button class="btn btn-az-primary" type="button" wire:click="submit">Save changes</button>
    </div>

</div>