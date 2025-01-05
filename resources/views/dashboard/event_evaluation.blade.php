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
                <h4>Event Evaluation Form</h4>
            </div>

            <form id="form-evaluation">
                @csrf
                <input type="hidden" name="event_id" value="{{ $id }}">
                <div class="col-lg-12 mt-2">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mg-b-0">
                            <thead>
                                <tr>
                                    <th>Criteria/Questions</th>
                                    <th width="10%" class="text-center">5 <br> <b>Strongly Agree</b></th>
                                    <th width="10%" class="text-center">4 <br> <b>Agree</b></th>
                                    <th width="10%" class="text-center">3 <br> <b>Neither Agree or Disagree</b></th>
                                    <th width="10%" class="text-center">2 <br> <b>Disagree</b></th>
                                    <th width="10%" class="text-center">1 <br> <b>Strongly Disagree</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($questions as $item => $val)
                                <!-- Parent Question -->
                                <tr>
                                    <td class="" style="font-weight: 600;">{{ $val['parent']->question ?? '' }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <!-- Child Questions -->
                                @forelse($val['children'] as $child)
                                <tr>
                                    <td style="padding-left: 30px;">&mdash; {{ $child->question ?? '' }}</td>
                                    <td class="text-center">
                                        <input type="radio" name="question_{{ $child->id }}" value="5">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="question_{{ $child->id }}" value="4">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="question_{{ $child->id }}" value="3">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="question_{{ $child->id }}" value="2">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="question_{{ $child->id }}" value="1">
                                        <input type="radio" name="question_{{ $child->id }}" value="" checked style="display: none;">

                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="error-message" id="error-question_{{ $child->id }}"></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">No Data</td>
                                </tr>
                                @endforelse
                                @empty
                                <tr>
                                    <td colspan="6">No Data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-lg-12 mt-2">
                    <div class="form-group">
                        <label style="font-weight: 600;">Remarks</label>
                        <input type="text" id="remarks" class="form-control" placeholder="Enter remarks" name="remarks">
                        <div class="text-danger" id="remarks-error"></div>
                    </div>
                    <button class="btn btn-az-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <x-footer />


    @include('core.core_scripts')
    <!-- Include the required JavaScript files -->
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#form-evaluation').on('submit', function(e) {
                e.preventDefault(); // Prevent the form from submitting the usual way

                // Collect the selected radio values
                var formData = $(this).serialize();

                // Clear previous error messages
                $('.error-message').html('');
                $('#remarks-error').html('');

                // Perform the AJAX request
                $.ajax({
                    url: '/submit-evaluation', // The URL where you want to send the data
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        // Handle the success response
                        showNotification("Success", 'Evaluation form has been submitted', "success")
                    },
                    error: function(xhr) {
                        // Handle errors (e.g., validation errors)

                        if(xhr.status == 403) {
                        showNotification("Error", xhr.responseJSON.message , "error")

                        }
                        var errors = xhr.responseJSON.errors;

                        // Display validation errors
                        $.each(errors, function(key, message) {
                            if (key.startsWith('question_')) {
                                $('#error-' + key).html('<span class="text-danger">' + message + '</span>');
                            } else if (key === 'remarks') {
                                $('#remarks-error').html('<span class="text-danger">' + message + '</span>');
                            }
                        });
                    }
                });
            });
        });
    </script>


</body>
@livewireScripts

</html>