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
                <h4>Templates</h4>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5>List</h5>
                        <div class="table-responsive">
                            <table class="table table-striped mg-b-0">
                                <thead>
                                    <tr>
                                        <th>Template Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($templates as $i)
                                    <tr>
                                        <th scope="row">{{ $i['name'] }}</th>
                                        <td>
                                            <button class="btn btn-info btn-icon mr-1 btn-modal" data-id="{{ $i['key'] }}">
                                                <i class="typcn typcn-document"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <x-footer />

    <div class="modal fade" id="modal_preview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body cnt">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-x" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    @include('core.core_scripts')

    <script>
        $(document).ready(function() {
            $('.table-responsive').on('click', 'td .btn-modal', function(e) {
                var template_id = $(this).attr('data-id'); // Get the value of data-id
                $('#modal_preview').modal('show')

                $('.cnt').html('');

                $.get("/preview-template", {
                        template: template_id
                    })
                    .done(function(res) {
                        $('.cnt').html(res);
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        var errorMessage = "An error occurred. Please try again later.";

                        console.error("Error: " + textStatus, errorThrown);

                        $('.cnt').html(errorMessage);
                    });
            })

        })
    </script>


</body>
@livewireScripts

</html>