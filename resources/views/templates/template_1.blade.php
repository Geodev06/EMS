<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Template 1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('core.core_css')
    <style>
        * {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .certificate {
            border: 15px solid #4b8dd9; /* Blue Border */
            border-radius: 25px;
            padding: 30px;
            margin: 20px;
            position: relative;
            background: #fff;
            background-image: url('https://www.transparenttextures.com/patterns/diagonal-stripes-light.png');
            background-repeat: repeat;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
        }

        .certificate:before {
            content: "";
            position: absolute;
            top: 10px;
            left: 10px;
            right: 10px;
            bottom: 10px;
            border: 5px solid #F5A623; /* Decorative border color */
            border-radius: 15px;
        }

        .certificate h4 {
            text-align: center;
            font-size: 24px;
            color: #4b8dd9;
            margin-bottom: 10px;
        }

        .certificate .card-body {
            text-align: center;
        }

        .certificate img {
            height: 100px;
            margin-bottom: 20px;
        }

        .certificate h1 {
            margin-top: 50px;
            font-size: 40px;
            font-family: 'Times New Roman', Times, serif;
        }

        .certificate p {
            font-size: 18px;
            font-family: 'Times New Roman', Times, serif;
        }

        .certificate .d-flex {
            justify-content: space-between;
            margin-top: 40px;
        }

        .certificate .d-flex div {
            width: 45%;
        }

        .certificate .d-flex p {
            margin: 0;
            text-align: center;
        }

        .certificate .d-flex div p:last-child {
            font-style: italic;
        }

        .certificate .card-body p strong {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="certificate">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="https://th.bing.com/th/id/R.46a2dced62a6005e136510b608fd6ef5?rik=qvnGSFVTnnadeA&riu=http%3a%2f%2fwww.ucarecdn.com%2f57342b2d-900f-4b82-b2c2-980f58a307ec%2f-%2fpreview%2f&ehk=hrF%2fbNr%2fJLiOwTs1lPyNWODdZuax1rOSXji0k0CCAWA%3d&risl=&pid=ImgRaw&r=0&sres=1&sresct=1" alt=""
                                srcset="" height="100px">
                            <p class="m-0" style="font-family:'Times New Roman', Times, serif; font-size:20px">Laguna State Polytechnic University</p>
                            <p class="m-0" style="font-family:'Times New Roman', Times, serif; font-size:14px">San Pablo City Campus</p>

                            <h1 class="mt-5 mb-5">Certificate of Participation</h1>
                            <p>This is to certify that</p>
                            <h4 class="mt-5">Juan Dela Cruz Mendoza</h4>

                            <p class="mt-5 pt-2">Has successfully participated in <i>Event Name</i></p>
                            <p>Conducted between <b>Start date</b> to <b>End date</b> from <b>start_time</b> to <b>end_time</b></p>

                            <p class="pt-2">this activity was awarded by</p>

                            <div class="d-flex justify-content-around mt-5">
                                <div>
                                    <p class="m-0">_________________</p>
                                    <p class="m-0" style="font-weight: bold;">Signatory 1</p>
                                    <p>Signatory 1 Position/Designation</p>
                                </div>

                                <div>
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
