<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Template 1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&display=swap" rel="stylesheet">

    @include('core.core_css')

    <style>
        .cert-cont {
            padding: 10px;
        }

        .cert-cont * {
            font-family: "Funnel Display", serif;
            font-optical-sizing: auto;
            font-weight: 500;
            font-style: normal;

        }

        .name {
            font-size: 38px;
            color: goldenrod;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="certificate p-3">
                    <div class="card cert-cont">
                        <div class="d-flex justify-content-around mt-3 align-items-center">
                            <img src="https://th.bing.com/th/id/R.46a2dced62a6005e136510b608fd6ef5?rik=qvnGSFVTnnadeA&riu=http%3a%2f%2fwww.ucarecdn.com%2f57342b2d-900f-4b82-b2c2-980f58a307ec%2f-%2fpreview%2f&ehk=hrF%2fbNr%2fJLiOwTs1lPyNWODdZuax1rOSXji0k0CCAWA%3d&risl=&pid=ImgRaw&r=0&sres=1&sresct=1" alt=""
                                srcset="" height="100px">
                            <div class="text-center">
                                <h1 class="m-0">CERTIFICATE</h1>
                                <h5 class="m-0">of Participation</h5>
                            </div>
                            <img src="https://th.bing.com/th/id/OIP.twTX--_qXS_ijQ3_whOPogHaHa?rs=1&pid=ImgDetMain" alt=""
                                srcset="" height="100px">
                        </div>
                        <div class="card-body text-center">


                            <p class="mt-5  ">this certificate is proudly presented to</p>
                            <p class="name monsieur-la-doulaise-regular">{{ $participant->first_name ?? '' }} {{ $participant->middle_name ?? '' }}, {{ $participant->last_name ?? '' }} {{ $participant->name_ext ?? '' }}</p>

                            <p>For participating in the <i>{{ $event->title ?? '' }}</i></p>
                            <p>held by Laguna State Polytechnic University San Pablo City Campus on {{ \Carbon\Carbon::parse($event->start_date)->format('F j, Y') }}</p>
                            <div class="d-flex justify-content-around mt-5">
                                <div>
                                    <img src="{{ asset($signatory->signatory_1_img ?? '') }}" alt="" srcset="" style="max-height:40px; margin-bottom: -30px;">
                                    <p class="m-0">_________________</p>
                                    <p class="m-0" style="font-weight: bold;">{{ $signatory->signatory_1 ?? '' }}</p>
                                    <p style="color: goldenrod;">{{ $signatory->signatory_1_pos ?? '' }}</p>
                                </div>

                                <div>
                                    <img src="{{ asset($signatory->signatory_2_img ?? '') }}" alt="" srcset="" style="max-height:40px; margin-bottom: -30px;">

                                    <p class="m-0">_________________</p>
                                    <p class="m-0" style="font-weight: bold;">{{ $signatory->signatory_2 ?? '' }}</p>
                                    <p style="color: goldenrod;">{{ $signatory->signatory_2_pos ?? '' }}</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-around ">
                                <div>
                                    <img src="{{ asset($signatory->signatory_3_img ?? '') }}" alt="" srcset="" style="max-height:40px; margin-bottom: -30px;">
                                    <p class="m-0">_________________</p>
                                    <p class="m-0" style="font-weight: bold;">{{ $signatory->signatory_3 ?? '' }}</p>
                                    <p style="color: goldenrod;">{{ $signatory->signatory_3_pos ?? '' }}</p>
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