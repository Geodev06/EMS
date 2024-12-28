<div class="container">
    <div class="row" style="height: 100vh;">
        <div class="az-signin-wrapper">
            <div class="az-card-signin">
                <h6 class="" style="color: #5b47fb;">lspu.edu.ph</h6>
                <div class="az-signin-header">
                    <h2>Welcome back!</h2>
                    <h4>Please sign in to continue</h4>

                    <form action="/">
                        <div class="text-danger">@if(session('invalid_cred')) {{ session('invalid_cred') }} @endif</div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" placeholder="Enter your email" wire:model="email">
                            <div class="text-danger">@error('email') {{ $message }} @enderror</div>

                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Enter your password" wire:model="password">
                            <div class="text-danger">@error('password') {{ $message }} @enderror</div>

                        </div><!-- form-group -->
                        <button class="btn btn-az-primary btn-block" type="button" wire:click="submit">Sign In</button>
                    </form>
                </div><!-- az-signin-header -->
                <div class="az-signin-footer">
                    <p><a href="">Forgot password?</a></p>
                    <p>Don't have an account? <a href="{{ route('register') }}" wire:navigate>Create an Account</a></p>
                </div><!-- az-signin-footer -->
            </div><!-- az-card-signin -->
        </div><!-- az-signin-wrapper -->
    </div>
    @assets
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    @endassets

    @script
    <script>
        $wire.on('response', (res) => {
            showNotification("Error", res, 'error')
        });
    </script>
    @endscript

</div>