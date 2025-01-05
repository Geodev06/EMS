<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Event Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @livewireStyles
    @include('core.core_css')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>


    <livewire:nav />

    @include('core.core_scripts')


    @if(Auth::user()->role == 'ADMIN' || Auth::user()->role == 'ORGANIZER')
    <div class="az-content az-content-dashboard">
        <div class="container">
            <div class="az-content-body">
                <div class="az-dashboard-one-title">
                    <div>
                        <h2 class="az-dashboard-title">Hi, welcome back!, {{ Auth::user()->first_name ?? '' }} {{ Auth::user()->last_name ?? '' }} </h2>
                        <p class="az-dashboard-text">Your web analytics dashboard template.</p>
                    </div>

                </div>

                <div class="az-dashboard-nav">
                    <nav class="nav nav-tabs" id="dashboardTab" role="tablist">
                        <!-- Tab Links -->
                        <a class="nav-item nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                        <a class="nav-item nav-link" id="audiences-tab" data-toggle="tab" href="#audiences" role="tab" aria-controls="audiences" aria-selected="false">Audiences</a>
                    </nav>

                </div>
                <div class="tab-content" id="dashboardTabContent">
                    <!-- Tab Panels -->
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">

                        <div class="row">
                            <div class="col-lg-4 mb-2">
                                <div class="card bg-indigo text-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h3>No. of Users</h3>
                                            <h3>{{ $no_of_users }}</h3>
                                        </div>

                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <canvas id="gender"></canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 mb-2 h-100 ">
                                <div class="card bg-indigo text-white ">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h3>My Events</h3>
                                            <h3>{{ $my_event_counts }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <canvas id="events"></canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 mb-2 h-100 ">
                                <div class="card bg-indigo text-white ">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h3>Organizer Accounts</h3>
                                            <h3>{{ $no_of_organizers }}</h3>
                                        </div>
                                    </div>
                                </div>

                            </div>



                        </div>
                    </div>
                    <div class="tab-pane fade" id="audiences" role="tabpanel" aria-labelledby="audiences-tab">
                        <!-- Content for Audiences Tab -->
                        <p>This is the audiences section.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        $.get("/get-analytics", {}, function(response) {

            var ctx = document.getElementById('gender').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'pie', // You can change the type to 'line', 'pie', etc.
                data: {
                    labels: ['Male', 'Female', 'Unspecified'], // X-axis labels
                    datasets: [{
                        label: 'Gender',
                        data: [response.genders[0], response.genders[1], response.genders[2]], // Values for the chart
                        backgroundColor: [
                            '#6f42c1',
                            '#f10075',
                            'gainsboro',

                        ], // Background colors for each bar
                        borderColor: [
                            '#6f42c1',
                            '#f10075',
                            'gainsboro',

                        ], // Border colors for each bar
                        borderWidth: 0
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            var ctx1 = document.getElementById('events').getContext('2d');
            var myChart1 = new Chart(ctx1, {
                type: 'bar', // You can change the type to 'line', 'pie', etc.
                data: {
                    labels: ['Pending', 'Ongoing', 'Finished'], // X-axis labels
                    datasets: [{
                        label: 'Events',
                        data: [response.events[0] ?? 0, response.events[1] ?? 0, response.events[2] ?? 0], // Values for the chart
                        backgroundColor: [
                            '#6f42c1',
                            '#f10075',
                            'seagreen',

                        ], // Background colors for each bar
                        borderColor: [
                            '#6f42c1',
                            '#f10075',
                            'seagreen',

                        ], // Border colors for each bar
                        borderWidth: 0
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });



        })
    </script>
    @endif

    @if(Auth::user()->role == 'PARTICIPANT')
    <div class="az-content az-content-dashboard">
        <div class="container">
            <div class="az-content-body">
                <div class="az-dashboard-one-title">
                    <div>
                        <h2 class="az-dashboard-title">Hi, welcome back!, {{ Auth::user()->first_name ?? '' }} {{ Auth::user()->last_name ?? '' }} </h2>
                        <p class="az-dashboard-text">Your web analytics dashboard template.</p>
                    </div>

                </div>

                <div class="az-dashboard-nav">
                    <nav class="nav nav-tabs" id="dashboardTab" role="tablist">
                        <!-- Tab Links -->
                        <a class="nav-item nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                        <a class="nav-item nav-link" id="audiences-tab" data-toggle="tab" href="#audiences" role="tab" aria-controls="audiences" aria-selected="false">Audiences</a>
                    </nav>

                </div>
                <div class="tab-content" id="dashboardTabContent">
                    <!-- Tab Panels -->
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">

                        <div class="row">


                            <div class="col-lg-4 mb-2 h-100 ">
                                <div class="card bg-indigo text-white ">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h3>Joined Events</h3>
                                            <h3>{{ $no_of_joined }}</h3>
                                        </div>
                                    </div>
                                </div>

                            </div>



                        </div>
                    </div>
                    <div class="tab-pane fade" id="audiences" role="tabpanel" aria-labelledby="audiences-tab">
                        <!-- Content for Audiences Tab -->
                        <p>This is the audiences section.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endif

    <x-footer />

</body>
@livewireScripts

</html>