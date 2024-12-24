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
            <div wire:offline>
                <p class="text-danger">This device is currently offline.</p>
            </div>
            <div class="col-lg-12 mb-2">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="" height="100px" class="mr-4">
                            <div class="d-flex flex-column">
                                <h3 class="mb-0">{{ Auth::user()->first_name ?? '' }} {{ Auth::user()->middle_name ?? '' }} {{ Auth::user()->last_name ?? '' }} {{ Auth::user()->name_ext ?? '' }}</h3>
                                <p class="m-0">{{ Auth::user()->role ?? '' }} </p>
                                <p class="m-0 text-success">{{ Auth::user()->org_code ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <livewire:profileform />
            </div>
            <div class="col-lg-6">
                <div class="card text-center ">
                    <div class="card-body d-flex justify-content-center">
                        <div id="qrcode"></div>

                    </div>
                    <h3 >Scan to Check In</h3>
                    <p style="color:#5b47fb ;">Simply scan this QR code to check in to your event.<br> It’s fast, secure, and hassle-free!</p>
                    <button id="download-btn" class="btn btn-indigo btn-block">Download</button>
                </div>
            </div>
        </div>
    </div>

    <x-footer />

    @include('core.core_scripts')\

    <script>
        var qrcode = new QRCode("qrcode", {
            text: "{{ Auth::user()->id }}_"+"{{ Auth::user()->unit_no ?? 'x' }}",
            colorDark : "#5b47fb",  // Dark color (foreground) - set to red in this case
            colorLight : "#FFFFFF", // Light color (background) - white here
            correctLevel : QRCode.CorrectLevel.H // Error correction level (optional)
        });

        document.getElementById("download-btn").addEventListener("click", function() {
            var canvas = document.querySelector("#qrcode canvas"); // Get the canvas element from the QR code
            if (canvas) {
                var dataUrl = canvas.toDataURL("image/png"); // Get the data URL of the canvas as PNG
                var a = document.createElement("a"); // Create a link element
                a.href = dataUrl; // Set the download link to the PNG data URL
                a.download = "qrcode.png"; // Set the filename for download
                a.click(); // Trigger the download
            } else {
                alert("QR code not available!");
            }
        });

    </script>

</body>
@livewireScripts

</html>