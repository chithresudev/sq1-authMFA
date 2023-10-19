@extends('layouts.app')
@section('title', 'TOTP - QR-Code')

@section('content')
    <div class="d-flex justify-content-center align-items-center hv-75 mt-5">
        <div class="col-xl-4 col-lg-6 col-sm-8 col-md-8  w-450">
            <div class="card dark-card">
                <div class="card-body">
                    <div class="position-relative">
                        <a class="text-info position-absolute" style="    top: 10px; right: 10px;" type="button"
                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"> Help <i
                                class="fa-regular fa-circle-question"></i></a>
                        <h3 class="mb-4 form-heading">Scan your QR Code.</h3>
                        <div class=" text-center mb-4">
                            {!! $qrcode_img !!}
                        </div>
                        <p class="text-center font-14">
                            If you are facing issues in scanning, please enter this code
                            <code class="text-warning ">{{ $secret_code }}</code>
                        </p>
                        <div class="d-grid mb-3">
                            <a href="{{ route('authmfa.verify.mfa.index') }}" class="btn btn-before-auth border-0 shadow-none"
                                type="submit">Continue</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class=" offcanvas w-50 offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title text-dark" id="offcanvasRightLabel">Configure mobile app</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body text-dark">
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                        <button class="accordion-button shadow-none" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                            aria-controls="panelsStayOpen-collapseOne">
                            Microsoft Authenticator Configuration
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                        aria-labelledby="panelsStayOpen-headingOne">
                        <div class="accordion-body">
                            <p>Complete the following steps to configure your mobile app.</p>
                            <ol>
                                <li>Install the Microsoft authenticator app for Windows Phone, Android or iOS.</li>
                                <li>In the app, add an account and choose "Work or school account".</li>
                                <li>Scan the image below.</li>
                                <br>
                                {!! $qrcode_img !!}
                                <br>
                                <br>
                                <p>If you are unable to scan the image, enter the following information in your app.
                                </p>
                                <p>Code: {{ $secret_code }} </p>
                                <p>If the app displays a six-digit code, you are done!</p>
                                <br>
                                <br>

                                <img class="w-100" src="{{ asset('assets/images/ms-auth-image.png') }}"
                                    alt="ms-auth-image">
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button shadow-none collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseTwo">
                            Google Authenticator Configuration
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                            <p>Complete the following steps to configure your mobile app.</p>
                            <ol>
                                <li>Install the Google authenticator app for Windows Phone, Android or iOS.</li>
                                <li>In the app, tap the "Plus Button" and select "Scan a Barcode"</li>
                                <li>Scan the image below.</li>
                                <br>
                                {!! $qrcode_img !!}
                                <br>
                                <br>


                                <p>If you are unable to scan the image, enter the following information in your app.
                                </p>
                                <p>Code: {{ $secret_code }} </p>
                                <p>If the app displays a six-digit code, you are done!</p>
                                <br>
                                <br>

                                <img class="w-100" src="{{ asset('assets/images/google-auth-image.png') }}"
                                    alt="google-auth-image">

                            </ol>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                        <button class="accordion-button shadow-none collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseThree">
                            Download App
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingThree">
                        <div class="accordion-body">
                            <p>Get the link via message to download the mobile app.</p>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Get Link via SMS
                                </button>
                                {{-- <ul class="dropdown-menu">
                                    <li><a href="{{ route('mfa.application.link', ['type' => 'android']) }}" class="dropdown-item" id="android">Android</a></li>
                                    <li><a href="{{ route('mfa.application.link', ['type' => 'ios']) }}" class="dropdown-item" id="ios">iOS</a></li>
                                </ul> --}}
                            </div>


                            <div class="alert alert-success" role="alert" id="successMsg" style="display: none">
                                Thank you for getting in touch!
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection


