<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Event Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @livewireStyles
    @include('core.core_css')
</head>

<body>

    <div class="container pt-5">
        <div class="row pt-5">
            <div class="col-lg-5 col-md-7 mx-auto pt-5">

                <div class="card ">
                   

                    <form action="{{ route('update_reset_password') }} " method="post">
                        @csrf
                        <div class="card-body p-5">
                            <h3 style="font-weight: 500;">RESET PASSWORD</h3>
                            <div class="row">
                                @if(session('error'))
                                <div class="form-error p-2"> {{ session('error') }}</div>
                                @endif
                            </div>

                            <div class="row mb-2">
                                <label for="" class="text-info">{{ $email ?? '' }} </label>
                            </div>


                            <div class="row">
                                <input type="hidden" name="email" value="{{ $email ?? '' }}">
                                <div class="form-error">@error('password') {{ $message }} @enderror</div>

                                <div class="input-group {{ $errors->has('password') ? 'has-danger' : 'has-success' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user-circle"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control" placeholder="Enter new password">
                                </div>
                            </div>

                            <div class="row">

                                <div class="input-group {{ $errors->has('password') ? 'has-danger' : 'has-success' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user-circle"></i></span>
                                    </div>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
                                </div>
                            </div>


                            <div class="row mt-2">
                                <button class="btn btn-indigo btn-round" type="submit">
                                    Save changes <i class="fa fa-arrow-right"></i>
                                </button>
                            </div>

                            <div class="row d-flex justify-content-between align-items-center">
                                <p></p>
                                <div>
                                    <a href="/">Back to Login</a>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('core.core_scripts')
</body>
@livewireScripts

</html>