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


    <livewire:nav />

    <div class="az-content az-content-dashboard">
        <div class="container">
            <div class="az-content-body">
                <div class="az-dashboard-one-title">
                    <div>
                        <h2 class="az-dashboard-title">Hi, welcome back!, {{ Auth::user()->first_name ?? '' }} {{ Auth::user()->last_name ?? '' }} </h2>
                        <p class="az-dashboard-text">Your web analytics dashboard template.</p>
                    </div>
                    <div class="az-content-header-right">
                        <div class="media">
                            <div class="media-body">
                                <label>Start Date</label>
                                <h6>Oct 10, 2018</h6>
                            </div><!-- media-body -->
                        </div><!-- media -->
                        <div class="media">
                            <div class="media-body">
                                <label>End Date</label>
                                <h6>Oct 23, 2018</h6>
                            </div><!-- media-body -->
                        </div><!-- media -->
                        <div class="media">
                            <div class="media-body">
                                <label>Event Category</label>
                                <h6>All Categories</h6>
                            </div><!-- media-body -->
                        </div><!-- media -->
                        <a href="" class="btn btn-purple">Export</a>
                    </div>
                </div><!-- az-dashboard-one-title -->

                <div class="az-dashboard-nav">
                    <nav class="nav">
                        <a class="nav-link active" data-toggle="tab" href="#">Overview</a>
                        <a class="nav-link" data-toggle="tab" href="#">Audiences</a>
                        <a class="nav-link" data-toggle="tab" href="#">Demographics</a>
                        <a class="nav-link" data-toggle="tab" href="#">More</a>
                    </nav>

                    <nav class="nav">
                        <a class="nav-link" href="#"><i class="far fa-save"></i> Save Report</a>
                        <a class="nav-link" href="#"><i class="far fa-file-pdf"></i> Export to PDF</a>
                        <a class="nav-link" href="#"><i class="far fa-envelope"></i>Send to Email</a>
                        <a class="nav-link" href="#"><i class="fas fa-ellipsis-h"></i></a>
                    </nav>
                </div>

           
            </div><!-- az-content-body -->
        </div>
    </div>

    <x-footer />

    @include('core.core_scripts')
</body>
@livewireScripts

</html>