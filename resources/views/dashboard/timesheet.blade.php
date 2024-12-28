<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Event Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @livewireStyles
    @include('core.core_css')
    <script src="https://cdn.jsdelivr.net/npm/jsqr/dist/jsQR.js"></script>
    <style>
        #output {
            margin-top: 10px;
            font-size: 18px;
        }

        #videoElement {
            width: 100%;
            max-width: 600px;
            border: 1px solid black;
        }
    </style>
</head>

<body>


    <livewire:nav />

    <div class="container">
        <div class="row mt-5 ">
            <div class="col-lg-12" wire:offline>
                <p class="text-danger">This device is currently offline.</p>
            </div>

            <div class="col-lg-8">
                <!-- Video element to show webcam stream -->
                <video id="videoElement" autoplay></video>

                <!-- Canvas to capture frames from the video -->
                <canvas id="qrCanvas" style="display: none;"></canvas>

                <!-- Output for displaying the decoded data -->
                <p>Decoded QR Code Data: <span id="output"></span></p>
            </div>

            <div class="col-lg-4">
                <div class="card mt-5 pt-5 time-card" style="display: none;">
                    <div class="card-body">
                        <h4 class="mb-0 name"></h4>
                        <p class="m-0 role text-info"></p>
                        <p class="mb-2 org_code text-success"></p>
                        <table class="table table-resonsive table-bordered">
                            <thead>
                                <td>Date</td>
                                <td>Time</td>
                            </thead>
                            <tbody class="bg-secondary">
                                <td class="created_at">Date</td>
                                <td class="time_in">Time</td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>

    </div>

    <x-footer />


    @include('core.core_scripts')
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script>
        // Grab references to elements
        const videoElement = document.getElementById('videoElement');
        const canvas = document.getElementById('qrCanvas');
        const output = document.getElementById('output');
        const context = canvas.getContext('2d');

        // Flag to track if a request is already in progress
        let isProcessing = false;

        // Function to initialize the webcam
        async function startWebcam() {
            try {
                // Get the video stream from the webcam
                const stream = await navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: 'environment'
                    }
                });

                // Attach the video stream to the video element
                videoElement.srcObject = stream;

                // Wait for the video to be ready (metadata loaded)
                videoElement.addEventListener('loadedmetadata', () => {
                    // Start processing the video frames
                    processFrame();
                });

            } catch (error) {
                console.error('Error accessing webcam: ', error);
                showNotification("Error", error, 'error');
            }
        }

        // Function to process each frame from the video
        function processFrame() {
            // Check if video is ready
            if (videoElement.videoWidth === 0 || videoElement.videoHeight === 0) {
                // Wait for the video to be ready
                requestAnimationFrame(processFrame);
                return;
            }

            // Set the canvas size to match the video frame
            canvas.width = videoElement.videoWidth;
            canvas.height = videoElement.videoHeight;

            // Draw the current video frame onto the canvas
            context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);

            // Get the image data from the canvas
            const imageData = context.getImageData(0, 0, canvas.width, canvas.height);

            // Try to decode the QR code from the image data
            const qrCode = jsQR(imageData.data, imageData.width, imageData.height);

            if (qrCode) {
                // If a QR code is found and no request is in progress, start the request
                if (!isProcessing) {
                    output.textContent = qrCode.data;
                    isProcessing = true; // Set the flag to true to indicate request in progress

                    // Split QR code data to validate format
                    const qrData = qrCode.data.split('_');
                    if (qrData.length === 2) {
                        // Send the AJAX request
                        $.ajax({
                            url: "{{ route('time_in') }}", // Example API URL
                            type: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                participant_id: qrData[0],
                                unit_no: qrData[1],
                                event_id: "{{ $id }}"
                            },
                            dataType: 'json', // Expected response type
                            success: function(response) {
                                console.log(response);
                                // Reset the flag after the request completes
                                isProcessing = false;
                                showNotification("Success", response.msg, 'success');

                                $('.time-card').show();

                                $('.name').text(response.name)
                                $('.org_code').text(response.org_code)
                                $('.role').text(response.role)
                                $('.created_at').text(response.created_at)
                                $('.time_in').text(response.time_in)


                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                                console.log(xhr);

                                isProcessing = false;
                                showNotification("Error", error, 'error');
                            }
                        });
                    } else {
                        output.textContent = 'Invalid QR code format';
                        isProcessing = false;
                    }
                }
            } else {
                // If no QR code is detected, display a message, but do not send a request
                output.textContent = 'No QR code detected';
            }

            // Call the function again to continuously process the video frames
            requestAnimationFrame(processFrame);
        }

        // Start the webcam when the page loads
        window.onload = startWebcam;
    </script>






</body>
@livewireScripts

</html>