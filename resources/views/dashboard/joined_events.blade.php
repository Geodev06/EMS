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
                            <div class="d-flex">
                                <button class="btn btn-indigo btn-icon mr-1 btn-view-event" 
                                data-event_id="{{ $dt->id }}"
                                data-title="{{ $dt->title }}"
                                data-particulars="{{ $dt->particulars }}"

                                data-reg_start_date="{{ \Carbon\Carbon::parse($dt->reg_start_date . ' ' . $dt->reg_start_time)->format('Y-m-d h:i A') }}"
                                data-reg_end_date="{{ \Carbon\Carbon::parse($dt->reg_end_date . ' ' . $dt->reg_end_time)->format('Y-m-d h:i A') }}"

                                data-start_date="{{ \Carbon\Carbon::parse($dt->start_date . ' ' . $dt->start_time)->format('Y-m-d h:i A') }}"
                                data-end_date="{{ \Carbon\Carbon::parse($dt->end_date . ' ' . $dt->end_time)->format('Y-m-d h:i A') }}"

                                >
                                    <i class="typcn typcn-document"></i>
                                </button>
                                @if($dt->status == 'FINISHED' && $dt->has_evaluation == FALSE)
                                <button class="btn btn-success btn-icon mr-1 btn-feedback" data-url="{{ route('event_evaluation', encrypt($dt->id)) }}">
                                    <i class="typcn typcn-document"></i>
                                </button>
                                @endif

                                @if($dt->status == 'FINISHED' && $dt->has_evaluation == TRUE)
                                <button class="btn btn-danger btn-icon mr-1 btn-certificate" data-url="{{ route('certification', encrypt($dt->id)) }}">
                                    <i class="typcn typcn-business-card"></i>
                                </button>
                                @endif
                            </div>
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

    <div class="modal fade" id="modal_preview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>View Event</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 mb-2">
                            <p class="m-0 text-secondary" style="font-size: 12px;">Title</p>
                            <h5 class="m-0 title"></h5>
                        </div>
                        <div class="col-lg-12 mb-2">
                            <p class="m-0 text-secondary" style="font-size: 12px;">Particulars</p>
                            <p class="m-0 particulars"></p>
                        </div>

                        <div class="col-lg-12">
                        <hr>
                            Registration Period
                        </div>
                        <div class="col-lg-6 mb-2">
                            <p class="m-0 text-secondary" style="font-size: 12px;">Start Date</p>
                            <h5 class="m-0 reg_start_date"></h5>
                        </div>

                        <div class="col-lg-6 mb-2">
                            <p class="m-0 text-secondary" style="font-size: 12px;">End Date</p>
                            <h5 class="m-0 reg_end_date"></h5>
                        </div>

                        <div class="col-lg-12">
                        <hr>

                            Execution Date
                        </div>
                        <div class="col-lg-6 mb-2">
                            <p class="m-0 text-secondary" style="font-size: 12px;">Start Date</p>
                            <h5 class="m-0 start_date"></h5>
                        </div>

                        <div class="col-lg-6 mb-2">
                            <p class="m-0 text-secondary" style="font-size: 12px;">End Date</p>
                            <h5 class="m-0 end_date"></h5>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-x" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    @include('core.core_scripts')
    <script>
        $(document).ready(function(e) {
            $('.btn-feedback').click(function(e) {
                var url = $(this).attr('data-url')
                window.location.replace(url)
            })

            $('.btn-certificate').click(function(e) {
                var url = $(this).attr('data-url')
                window.location.replace(url)
            })

            $('.btn-view-event').click(function(e) {
                var id = $(this).attr('data-event_id')

                $('.title').text($(this).attr('data-title'))
                $('.particulars').text($(this).attr('data-particulars'))

                $('.reg_start_date').text($(this).attr('data-reg_start_date'))
                $('.reg_end_date').text($(this).attr('data-reg_end_date'))

                $('.start_date').text($(this).attr('data-start_date'))
                $('.end_date').text($(this).attr('data-end_date'))


                $('#modal_preview').modal('show')
            })
        })
    </script>



</body>
@livewireScripts

</html>