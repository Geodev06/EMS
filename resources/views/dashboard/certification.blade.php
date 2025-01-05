<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Event Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @livewireStyles
    @include('core.core_css')
    <style>
        @media print {
            body {
                margin: 0;
                padding: 0;
                font-size: 12px;
            }


            #content {
                width: 100%;
                margin: 0;
                padding: 0;
                /* Any additional adjustments for printing */
                page-break-before: avoid;
                page-break-after: avoid;
                page-break-inside: avoid;
            }
        }
    </style>

</head>

<body>



    <div class="container">
        <div class="row mt-5 mb-5">
            <div class="col-lg-12" wire:offline>
                <p class="text-danger">This device is currently offline.</p>
            </div>

            <div class="col-lg-12">
                <h4>Click the download button to get your certificate.</h4>
                <button class="btn btn-success btn-with-icon btn-download" disabled><i class="typcn typcn-download"></i> Download</button>
            </div>
            <div class="col-lg-12 cnt" id="content">
            </div>
        </div>
    </div>

    <x-footer />


    @include('core.core_scripts')
    <script src="{{ asset('assets/js/html2pdf.bundle.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            // Disable Right-click (context menu)
            document.addEventListener("contextmenu", function(e) {
                e.preventDefault();
            });

            // Disable specific key combinations (F12, Ctrl+Shift+I, Ctrl+U, Ctrl+Shift+J)
            document.addEventListener("keydown", function(e) {
                // F12
                if (e.keyCode === 123) {
                    e.preventDefault();
                }
                // Ctrl + Shift + I
                if (e.ctrlKey && e.shiftKey && e.keyCode === 73) {
                    e.preventDefault();
                }
                // Ctrl + U
                if (e.ctrlKey && e.keyCode === 85) {
                    e.preventDefault();
                }
                // Ctrl + Shift + J
                if (e.ctrlKey && e.shiftKey && e.keyCode === 74) {
                    e.preventDefault();
                }
            });

            $.get("/render-template", {
                    template_id: "{{ $event->certificate_id }}",
                    event_id: "{{ $event->id }}",
                    user_id: "{{ Auth::user()->id }}",
                })
                .done(function(res) {
                    $('.cnt').html(res);
                    $('.btn-download').removeAttr('disabled')
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    var errorMessage = "An error occurred. Please try again later.";

                    console.error("Error: " + textStatus, errorThrown);

                    $('.cnt').html(errorMessage);
                });

            $('.btn-download').click(function(e) {
                var element = document.getElementById('content');
                var opt = {
                    margin: 0.2,
                    filename: 'CERTIFICATE.pdf',
                    image: {
                        type: 'png',
                        quality: 0.98
                    },
                    html2canvas: {
                        scale: 2, // Increasing scale can sometimes help with clarity without creating breaks
                        logging: false, // Optional: prevents unnecessary logging in the console
                        useCORS: true // If you are including external resources like images
                    },
                    jsPDF: {
                        unit: 'in',
                        format: 'letter',
                        orientation: 'landscape',
                        autoPaging: false, // Prevent auto-paging (this can help avoid breaks)
                    }
                };

                // New Promise-based usage:
                html2pdf().set(opt).from(element).save();

            })

        })
    </script>


</body>
@livewireScripts

</html>