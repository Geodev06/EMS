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

            <div class="col-lg-12">
                <livewire:eventform  id="{{ $id ?? null }}" />
            </div>
        </div>
    </div>

    <x-footer />


    @include('core.core_scripts')



</body>
@livewireScripts

</html>