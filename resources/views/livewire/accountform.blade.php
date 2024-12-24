<div class="card">


    <div class="card-body">
        <form action="">
            <div class="row ">
                <div class="col-lg-12">
                    <h4>Account Form</h4>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>First name</label>
                        <input type="text" class="form-control" style="color: black; font-weight: 500" placeholder="First name" wire:model="first_name">
                        <div class="text-danger">@error('first_name') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Middle name</label>
                        <input type="text" class="form-control" style="color: black; font-weight: 500" placeholder="Middle name" wire:model="middle_name">
                        <div class="text-danger">@error('middle_name') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Last name</label>
                        <input type="text" class="form-control" style="color: black; font-weight: 500" placeholder="Last name" wire:model="last_name">
                        <div class="text-danger">@error('last_name') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Ext. name</label>
                        <input type="text" class="form-control" style="color: black; font-weight: 500" placeholder="Ext. name" wire:model="name_ext">
                        <div class="text-danger">@error('name_ext') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="d-flex">
                        <label class="rdiobox mr-3">
                            <input name="rdio" type="radio" wire:model="gender" value="MALE">
                            <span>Male</span>
                        </label>

                        <label class="rdiobox">
                            <input name="rdio" type="radio" wire:model="gender" value="FEMALE">
                            <span>Female</span>
                        </label>
                    </div>
                    <div class="text-danger">@error('gender') {{ $message }} @enderror</div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Age</label>
                        <input type="text" class="form-control" style="color: black; font-weight: 500" placeholder="Age" wire:model="age">
                        <div class="text-danger">@error('age') {{ $message }} @enderror</div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="form-group">
                        <label>Unit no.</label>
                        <input type="text" class="form-control" style="color: black; font-weight: 500" placeholder="Unit no." wire:model="unit_no">
                        <div class="text-danger">@error('unit_no') {{ $message }} @enderror</div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="text" class="form-control" style="color: black; font-weight: 500" placeholder="Email" wire:model="email">
                        <div class="text-danger">@error('email') {{ $message }} @enderror</div>
                    </div>
                </div>

                <div class="col-lg-12 card-footer mb-2">
                    <div class="d-flex">
                        <label class="rdiobox mr-3">
                            <input name="ac" type="radio" wire:model="active_flag" value="Y" checked>
                            <span>Active</span>
                        </label>

                        <label class="rdiobox">
                            <input name="ac" type="radio" wire:model="active_flag" value="N">
                            <span>Inactive</span>
                        </label>
                    </div>
                    <div class="text-danger">@error('active_flag') {{ $message }} @enderror</div>
                </div>

                <div class="col-sm-6 col-md-3 d-flex">
                    <button class="mx-2 btn btn-indigo btn-with-icon btn-block" type="button" wire:click="submit">Save <i class="far fa-check-circle ml-2"></i>
                    </button>
                    <button class="btn btn-secondary btn-with-icon" type="button" wire:click="reset_fields"> <i class="typcn typcn-arrow-back-outline"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    @assets
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    @endassets

    @script
    <script>
        $wire.on('response', (res) => {
            showNotification("Success", res, 'success')
        });

        $wire.on('response_err', (err) => {
            showNotification("Error", err, 'error')
        });
    </script>
    @endscript

</div>