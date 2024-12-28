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

    <div class="container">
        <div class="row mt-5 ">
            <div class="col-lg-12" wire:offline>
                <p class="text-danger">This device is currently offline.</p>
            </div>



            <div class="col-lg-12">
                <h4>Join Events</h4>
                <p>Enter the code to join an event</p>
                <form action="{{ route('join') }}" method="POST">
                    @csrf
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="form-group w-100">
                            <label>Code</label>
                            <input type="text" class="form-control" name="event_code" placeholder="Enter your code">
                        </div>
                        <button type="submit" class="btn btn-sm btn-indigo" style="margin-top: 12.5px;">Submit</button>
                    </div>
                    <div class="text-danger">@error('event_code') {{ $message }} @enderror</div>
                    <div class="text-danger">@if(session('invalid_code')) {{ session('invalid_code') }} @endif</div>
                    <div class="text-danger">@if(session('err')) {{ session('err') }} @endif</div>
                    <div class="text-danger">@if(session('no_available_seats')) {{ session('no_available_seats') }} @endif</div>
                    <div class="text-success">@if(session('success')) {{ session('success') }} @endif</div>
                </form>
            </div>

        </div>
        <div class="row mb-5">
            @forelse($events as $dt)
            <div class="col-lg-4 mb-2">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title text-truncate" style="max-width: 100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $dt->title ?? '' }} </h5>
                            <button class="btn btn-info btn-icon mr-1" >
                                <i class="typcn typcn-info"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="m-0">Event Code:</p>
                        <h4 class="m-0 text-dark">{{ $dt->code ?? '' }}</h4>
                        <hr>
                        <p class="text-truncate mt-4" style="max-width: 100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">About: {{ $dt->particulars ?? '' }} </p>
                        <div class="d-flex">
                            <div class="media mx-1">
                                <div class="media-body">
                                    <label class="text-secondary">Target date(start)</label>
                                    <h6>{{ \Carbon\Carbon::parse($dt->reg_start_date)->format('F j, Y') }}</h6>
                                </div>
                            </div>

                            <div class="media mx-1">
                                <div class="media-body">
                                    <label class="text-secondary">Time</label>
                                    <h6>{{ \Carbon\Carbon::parse($dt->reg_start_time)->format('h:i A') }} to {{ \Carbon\Carbon::parse($dt->reg_end_time)->format('h:i A') }} </h6>
                                </div>
                            </div>
                        </div>
                        @if($dt->status == 'PENDING')
                        <span class="badge badge-info">PENDING</span>
                        @elseif($dt->status == 'ONGOING')
                        <span class="badge badge-success">ONGOING</span>
                        @else
                        <span class="badge badge-danger">FINISHED</span>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-lg-12 text-center">
                <h4 class="mt-5">No Events</h4>
            </div>
            @endforelse
        </div>
    </div>

    <x-footer />


    @include('core.core_scripts')



</body>
@livewireScripts

</html>