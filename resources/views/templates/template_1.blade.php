<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Template 1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('core.core_css')
    <style>
        .certificate * {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .certificate {
            border: 5px solid dodgerblue;
            border-radius: 10px;
        }

        .cert-cont {
            border: 2px solid orange;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="certificate p-3">
                    <div class="card cert-cont">
                        <div class="card-body text-center">
                            <img src="https://th.bing.com/th/id/R.46a2dced62a6005e136510b608fd6ef5?rik=qvnGSFVTnnadeA&riu=http%3a%2f%2fwww.ucarecdn.com%2f57342b2d-900f-4b82-b2c2-980f58a307ec%2f-%2fpreview%2f&ehk=hrF%2fbNr%2fJLiOwTs1lPyNWODdZuax1rOSXji0k0CCAWA%3d&risl=&pid=ImgRaw&r=0&sres=1&sresct=1" alt=""
                                srcset="" height="100px">
                            <p class="m-0" style="font-family:'Times New Roman', Times, serif; font-size:20px">Laguna State Polytechnic University</p>
                            <p class="m-0" style="font-family:'Times New Roman', Times, serif; font-size:14px">San Pablo City Campus</p>

                            <h1 class="mt-5 mb-5">Certificate of Participation</h1>
                            <p>This is to certify that</p>
                            <h4 class="mt-5" style="color: dodgerblue;">Juan Dela Cruz Mendoza</h4>

                            <p class="mt-5 pt-2">Has successfully participated in <i>Event Name</i></p>
                            <p>Conducted between <b>Start date</b> to <b>End date</b> from <b>start_time</b> to <b>end_time</b></p>

                            <p class="pt-2">this activity was awarded by</p>

                            <div class="d-flex justify-content-around mt-5">
                                <div>
                                    <img src="{{ asset('assets/img/signature.png') }}" alt="" srcset="" style="max-height:40px; margin-bottom: -30px;">
                                    <p class="m-0">_________________</p>
                                    <p class="m-0" style="font-weight: bold;">Signatory 1</p>
                                    <p>Signatory 1 Position/Designation</p>
                                </div>

                                <div>
                                    <img src="{{ asset('assets/img/signature.png') }}" alt="" srcset="" style="max-height:40px; margin-bottom: -30px;">

                                    <p class="m-0">_________________</p>
                                    <p class="m-0" style="font-weight: bold;">Signatory 2</p>
                                    <p>Signatory 2 Position/Designation</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('core.core_scripts')
</body>

</html>