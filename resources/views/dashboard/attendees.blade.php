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
        <div class="row mt-5 mb-5">
            <div class="col-lg-12" wire:offline>
                <p class="text-danger">This device is currently offline.</p>
            </div>

            <div class="col-lg-12">
                <h4>Event Management</h4>
                <button class="btn btn-indigo btn-with-icon btn-md" onclick='window.location.replace("/events")'><i class="typcn typcn-arrow-left"></i> Back</button>
            </div>
            <div class="col-lg-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="m-0 text-secondary">Title</p>
                                <h4 class="mt-0">{{ $event->title ?? '' }} </h4>
                            </div>
                            <div>
                                <p class="m-0 text-secondary">Code</p>
                                <h4 class="mt-0">{{ $event->code ?? '' }} </h4>
                            </div>

                            <div>
                                <p class="m-0 text-secondary">Max. No. of participants</p>
                                <h4 class="mt-0">{{ $event->no_of_participants ?? '' }} </h4>
                            </div>
                            <div>
                                <p class="m-0 text-secondary">Seat Utilization</p>
                                <h4 class="mt-0">{{ $utilization }} % </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered mg-b-0">
                        <thead>
                            <tr>
                                <th>Unit No.</th>
                                <th>Name</th>
                                <th>Organization</th>
                                <th>Gender</th>
                                <th>Time in</th>
                                <th width="3%">Evaluation</th>
                                <th>Feedback Score</th>


                            </tr>
                        </thead>
                        <tbody>
                            @forelse($participants as $key => $val)
                            <tr>
                                <th scope="row">{{ $val['participant_unit_no'] ?? ''}}</th>
                                <th scope="row">{{ $val['participant_name'] ?? ''}}</th>
                                <th scope="row">{{ $val['participant_org'] ?? ''}}</th>
                                <th scope="row">{{ $val['participant_gender'] ?? ''}}</th>
                                <th scope="row">{{ \Carbon\Carbon::parse($val['created_at'])->format('Y-m-d h:i A') }}</th>
                                <th scope="row" class="text-center">
                                    @if($val['evaluation'])
                                    <i class="typcn typcn-tick text-success"></i>
                                    @else
                                    @endif
                                </th>
                                <th scope="row">@if($val['eval_result']) {{ $val['eval_result'] .'%' }} @endif</th>



                            </tr>
                            @empty
                            <tr>
                                <th scope="row" colspan="5">No Participant</th>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <x-footer />


    @include('core.core_scripts')



</body>
@livewireScripts

</html>