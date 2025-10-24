<!DOCTYPE html><!-- saved from url=(0014)about:internet -->
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
    data-menu-styles="light" data-toggled="close">

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Construction</title>

    <!-- Choices JS -->
    <script src="{{asset('assets/libs/choices.js/public/assets/scripts/choices.min.js')}}"></script>
    <!-- Main Theme Js -->
    <script src="{{asset('assets/js/main.js')}}"></script> <!-- Bootstrap Css -->
    <link id="style" href="{{asset('assets/libs/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Style Css -->
    <link href="{{asset('assets/css/styles.min.css')}}" rel="stylesheet"> <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet"> <!-- Node Waves Css -->
    <link href="{{asset('assets/libs/node-waves/waves.min.css')}}" rel="stylesheet"> <!-- Simplebar Css -->
    <link href="{{asset('assets/libs/simplebar/simplebar.min.css')}}" rel="stylesheet"> <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/libs/@simonwep/pickr/themes/nano.min.css')}}"> <!-- Choices Css -->
    <link rel="stylesheet" href="{{asset('assets/libs/choices.js/public/assets/styles/choices.min.css')}}">

    <!--[if gte IE 5]><frame></frame><![endif]-->
</head>

<body>

    <div class="container-fluid custom-page">
        <div class="row bg-white">
            <!-- The image half -->
            <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent-3">
                <div class="row w-100 mx-auto text-center">
                    <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto w-100"> <img
                            src="{{asset('asset/images/media/pngs/5.png')}}"
                            class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo"> </div>
                </div>
            </div> <!-- The content half -->
            <div class="col-md-6 col-lg-6 col-xl-5 bg-white py-4">
                <div class="login d-flex align-items-center py-2">
                    <!-- Demo content-->
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                <div class="card-sigin">
                                    <div class="mb-5 d-flex"> <a href="index.html" class="header-logo"><img
                                                src="../assets/images/brand-logos/desktop-logo.png"
                                                class="desktop-logo ht-40" alt="logo"> <img
                                                src="../assets/images/brand-logos/desktop-white.png"
                                                class="desktop-white ht-40" alt="logo"> </a> </div>
                                    <div class="card-sigin">
                                        {{ $slot }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End -->
                </div>
            </div><!-- End -->
        </div>
    </div>

    <script src="{{asset('assets/libs/@popperjs/core/umd/popper.min.js')}}"></script>

    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('assets/js/defaultmenu.min.js')}}"></script>

    <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

    <script src="{{asset('assets/js/sticky.js')}}"></script>

    <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>

    <script src="{{asset('assets/js/simplebar.js')}}"></script>
    <script src="{{asset('assets/libs/@simonwep/pickr/pickr.es5.min.js')}}"></script>

    <script src="{{asset('assets/js/custom-switcher.min.js')}}"></script>

    <script src="{{asset('assets/js/custom.js')}}"></script>

</body>

</html>