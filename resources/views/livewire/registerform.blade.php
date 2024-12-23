<div class="container">
    <div class="row" style="height: 100vh;">
        <div class="az-signup-wrapper">
            <div class="az-column-signup-left">
                <div>
                    <i class="typcn typcn-chart-bar-outline"></i>
                    <h1 class="az-logo text-uppercase">EMS</h1>
                    <h5>Event management system</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse corporis aperiam velit eaque! Vel neque rem facere corporis ab provident autem debitis a? Nemo cumque, nesciunt mollitia eveniet consequuntur rem!</p>
                    <p>Esse corporis aperiam velit eaque! Vel neque rem facere corporis ab provident autem debiti.</p>
                    <a href="index.html" class="btn btn-outline-indigo">Learn More</a>
                </div>
            </div><!-- az-column-signup-left -->
            <div class="az-column-signup">
                <h1 class="az-logo">lspu.edu.ph</h1>
                <div class="az-signup-header">
                    <h2>Get Started</h2>
                    <h4>It's free to signup and only takes a minute.</h4>

                    <form action="page-profile.html">
                        <div class="form-group">
                            <label>First name</label>
                            <input type="text" class="form-control" placeholder="Enter your firstname" wire:model="first_name">
                            <div class="text-danger">@error('first_name') {{ $message }} @enderror</div>
                        </div>
                        <div class="form-group">
                            <label>Last name</label>
                            <input type="text" class="form-control" placeholder="Enter your lastname" wire:model="last_name">
                            <div class="text-danger">@error('last_name') {{ $message }} @enderror</div>

                        </div>
                        <hr>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" placeholder="Enter your email" wire:model="email">
                            <div class="text-danger">@error('email') {{ $message }} @enderror</div>

                        </div><!-- form-group -->
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Enter your password" wire:model="password">
                            <div class="text-danger">@error('password') {{ $message }} @enderror</div>

                        </div><!-- form-group -->
                        <button class="btn btn-az-primary btn-block" type="button" wire:click="submit">Create Account</button>

                    </form>
                </div><!-- az-signup-header -->
                <div class="az-signup-footer">
                    <p>Already have an account? <a href="{{ route('login') }}" wire:navigate>Sign In</a></p>
                </div><!-- az-signin-footer -->
            </div><!-- az-column-signup -->
        </div><!-- az-signup-wrapper -->
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
    </script>
    @endscript
</div>