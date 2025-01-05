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

                            <h1 class="mt-5 mb-4">Certificate of Participation</h1>
                            <p>This is to certify that</p>
                            <h4 class="mt-5" style="color: dodgerblue;">{{ $participant->first_name ?? '' }} {{ $participant->middle_name ?? '' }}, {{ $participant->last_name ?? '' }} {{ $participant->name_ext ?? '' }}</h4>

                            <p class="mt-4">Has successfully participated in <i><b>{{ $event->title ?? '' }}</b> </i></p>
                            <p>Conducted between <b>{{ \Carbon\Carbon::parse($event->start_date)->format('F j, Y') }}</b> to <b>{{ \Carbon\Carbon::parse($event->end_date)->format('F j, Y') }}</b> from <b>{{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }}</b> to <b>{{ \Carbon\Carbon::parse($event->end_time)->format('h:i A') }}</b></p>

                            <p class="pt-2">this activity was awarded by</p>

                            <div class="d-flex justify-content-around mt-2">
                                <div>
                                    <img src="{{ asset($signatory->signatory_1_img) }}" alt="" srcset="" style="max-height:40px; margin-bottom: -30px;">
                                    <p class="m-0">_________________</p>
                                    <p class="m-0" style="font-weight: bold;">{{ $signatory->signatory_1 ?? '' }}</p>
                                    <p>{{ $signatory->signatory_1_pos ?? '' }}</p>
                                </div>

                                <div>
                                    <img src="{{ asset($signatory->signatory_2_img) }}" alt="" srcset="" style="max-height:40px; margin-bottom: -30px;">

                                    <p class="m-0">_________________</p>
                                    <p class="m-0" style="font-weight: bold;">{{ $signatory->signatory_2 ?? '' }}</p>
                                    <p>{{ $signatory->signatory_2_pos ?? '' }}</p>
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