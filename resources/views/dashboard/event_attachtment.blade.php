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
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered mg-b-0">
                        <thead>
                            <tr>
                                <th>Signatory No.</th>
                                <th>Signatory Name</th>
                                <th>Signatory Position</th>
                                <th>Digital Signature</th>
                                <th>Upload</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>{{ $signatory->signatory_1 ?? 'None' }}</td>
                                <td>{{ $signatory->signatory_1_pos?? 'None' }}</td>
                                <td><img src="{{ asset($signatory->signatory_1_img ?? '') }}" alt="" srcset="" style="max-height: 40px;"></td>
                                <td> <input type="file" name="file" onchange="uploadFile(this)" data-id="1"></td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>{{ $signatory->signatory_2 ?? 'None' }}</td>
                                <td>{{ $signatory->signatory_2_pos?? 'None' }}</td>
                                <td><img src="{{ asset($signatory->signatory_2_img ?? '') }}" alt="" srcset="" style="max-height: 40px;"></td>
                                <td> <input type="file" name="file" onchange="uploadFile(this)" data-id="2"></td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td>{{ $signatory->signatory_3 ?? 'None' }}</td>
                                <td>{{ $signatory->signatory_3_pos?? 'None' }}</td>
                                <td><img src="{{ asset($signatory->signatory_3_img ?? '') }}" alt="" srcset="" style="max-height: 40px;"></td>
                                <td> <input type="file" name="file" onchange="uploadFile(this)" data-id="3"></td>
                            </tr>

                            <tr>
                                <td>4</td>
                                <td>{{ $signatory->signatory_4 ?? 'None' }}</td>
                                <td>{{ $signatory->signatory_4_pos?? 'None' }}</td>
                                <td><img src="{{ asset($signatory->signatory_4_img ?? '') }}" alt="" srcset="" style="max-height: 40px;"></td>
                                <td> <input type="file" name="file" onchange="uploadFile(this)" data-id="4"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <x-footer />
    <!-- Include the required JavaScript files -->
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script>
        function uploadFile(input) {
            // Create a FormData object to prepare file data for the request


            var formData = new FormData();
            var dataId = $(input).data('id');

            formData.append("file", input.files[0]);
            formData.append("_token", "{{ csrf_token() }}")
            formData.append("event_id", "{{ $event->id }}")
            formData.append("signatory", dataId)




            $.ajax({
                url: '/upload-signature', // Replace with your URL where you handle the file upload
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Handle the response (e.g., update UI, show success message)
                    showNotification("Success", 'File uploaded successfully!', 'success')
                    window.location.reload()
                },
                error: function(xhr, status, error) {
                    showNotification("Error", 'File upload Failed', 'error')
                    window.location.reload()


                }
            });
        }
    </script>
    @include('core.core_scripts')





</body>
@livewireScripts

</html>