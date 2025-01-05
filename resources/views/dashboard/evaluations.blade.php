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
            </div>

            <div class="col-lg-12 mt-2">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered mg-b-0">
                        <thead>
                            <tr>
                                <th>Criteria/Questions</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($questions as $item => $val)
                            <!-- Parent Question -->
                            <tr>
                                <td class="" style="font-weight: 600;">{{ $val['parent']->question ?? '' }}</td>
                                <td></td>
                            </tr>

                            <!-- Child Questions -->
                            @forelse($val['children'] as $child)
                            <tr>
                                <td style="padding-left: 30px;">&mdash; {{ $child->question ?? '' }}</td>
                                <td class="text-center">
                                    @if($child->active_flag == 'Y')
                                    <span class="badge badge-success p-2">Active</span>
                                    @else
                                    <span class="badge badge-danegr p-2">Inactive</span>

                                    @endif
                                </td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="2">No Data</td>
                            </tr>
                            @endforelse

                            @empty
                            <tr>
                                <td colspan="2">No Data</td>
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