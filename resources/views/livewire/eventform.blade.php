<div class="card">
    <div class="card-body">
        <form action="">
            <div class="row ">
                <div class="col-lg-12">
                    <h4>Event Form</h4>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" style="color: black; font-weight: 500" placeholder="Enter Title" wire:model="title">
                        <div class="text-danger">@error('title') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Particulars</label>
                        <input type="text" class="form-control" style="color: black; font-weight: 500" placeholder="Enter Particulars" wire:model="particulars">
                        <div class="text-danger">@error('particulars') {{ $message }} @enderror</div>
                    </div>
                </div>


                <div class="col-lg-12">
                    <hr>
                    <h4>Execution Date</h4>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="date" class="form-control" style="color: black; font-weight: 500" placeholder="Enter Particulars" wire:model="start_date">
                        <div class="text-danger">@error('start_date') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Start Time</label>
                        <input type="time" class="form-control" style="color: black; font-weight: 500" placeholder="Enter Particulars" wire:model="start_time">
                        <div class="text-danger">@error('start_time') {{ $message }} @enderror</div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <label>End Date</label>
                        <input type="date" class="form-control" style="color: black; font-weight: 500" placeholder="Enter Particulars" wire:model="end_date">
                        <div class="text-danger">@error('end_date') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label>End Time</label>
                        <input type="time" class="form-control" style="color: black; font-weight: 500" placeholder="Enter Particulars" wire:model="end_time">
                        <div class="text-danger">@error('end_time') {{ $message }} @enderror</div>
                    </div>
                </div>


                <div class="col-lg-12">
                    <hr>
                    <h4>Registration Period</h4>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="date" class="form-control" style="color: black; font-weight: 500" placeholder="Enter " wire:model="reg_start_date">
                        <div class="text-danger">@error('reg_start_date') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Start Time</label>
                        <input type="time" class="form-control" style="color: black; font-weight: 500" placeholder="Enter " wire:model="reg_start_time">
                        <div class="text-danger">@error('reg_start_time') {{ $message }} @enderror</div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <label>End Date</label>
                        <input type="date" class="form-control" style="color: black; font-weight: 500" placeholder="Enter " wire:model="reg_end_date">
                        <div class="text-danger">@error('reg_end_date') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label>End Time</label>
                        <input type="time" class="form-control" style="color: black; font-weight: 500" placeholder="Enter " wire:model="reg_end_time">
                        <div class="text-danger">@error('reg_end_time') {{ $message }} @enderror</div>
                    </div>
                </div>


                <div class="col-lg-12">
                    <hr>
                    <h4>Others</h4>
                </div>

                <div class="col-lg-4">
                    <div>
                        <p class="mg-b-10">Select Certificate Template</p>
                        <select class="form-control select2" wire:model="certificate_id">
                            <option value="" selected> Choose one</option>

                            <option value="1"> Template 1</option>
                            <option value="2"> Template 2</option>
                            <option value="3"> Template 3</option>
                            <option value="4"> Template 4</option>
                            <option value="5"> Template 5</option>
                        </select>
                    </div>
                    <div class="text-danger">@error('certificate_id') {{ $message }} @enderror</div>

                </div>

                <div class="col-lg-4">
                    <div>
                        <p class="mg-b-10">Status</p>
                        <select class="form-control select2" wire:model="status">
                            <option value="" selected> Choose one</option>

                            <option value="PENDING">Pending</option>
                            <option value="ONGOING">Ongoing</option>
                            <option value="FINISHED">Finished</option>
                        </select>
                    </div>
                    <div class="text-danger">@error('status') {{ $message }} @enderror</div>

                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label>No. of Participants</label>
                        <input type="text" class="form-control" style="color: black; font-weight: 500" placeholder="Enter No. of Participants" wire:model="no_of_participants">
                        <div class="text-danger">@error('no_of_participants') {{ $message }} @enderror</div>
                    </div>
                </div>

                <div class="col-sm-12 mt-4 d-flex">
                    <button class="mx-2 btn btn-indigo btn-with-icon " type="button" wire:click="submit">Save <i class="far fa-check-circle ml-2"></i>
                    </button>

                </div>
            </div>
        </form>
    </div>

    @assets
    <!-- Include the required JavaScript files -->
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