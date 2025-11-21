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

    <div class="page">
        <!-- app-header -->
        <header class="app-header">
            <!-- Start::main-header-container -->
            <div class="main-header-container container-fluid">
                <!-- Start::header-content-left -->
                <div class="header-content-left">
                    <!-- Start::header-element -->
                    <div class="header-element">
                        <div class="horizontal-logo">
                            <h5>Construction</h5>
                        </div>
                    </div> <!-- End::header-element -->
                    <!-- Start::header-element -->
                    <div class="header-element">
                        <!-- Start::header-link --> <a aria-label="Hide Sidebar"
                            class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle"
                            data-bs-toggle="sidebar" href="javascript:void(0);"> <i
                                class="header-icon fe fe-align-left"></i> </a>
                        <div class="main-header-center d-none d-lg-block"> <input class="form-control"
                                placeholder="Search for anything..." type="search"> <button class="btn"><i
                                    class="fa fa-search d-none d-md-block"></i></button> </div>
                        <!-- End::header-link -->
                    </div> <!-- End::header-element -->
                </div> <!-- End::header-content-left -->
                <!-- Start::header-content-right -->
                <div class="header-content-right">
                    <div class="header-element Search-element d-block d-lg-none">
                        <!-- Start::header-link|dropdown-toggle --> <a href="javascript:void(0);"
                            class="header-link dropdown-toggle" data-bs-auto-close="outside" data-bs-toggle="dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="header-link-icon">
                                <path
                                    d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z">
                                </path>
                            </svg> </a> <!-- End::header-link|dropdown-toggle -->
                        <ul class="main-header-dropdown dropdown-menu dropdown-menu-end Search-element-dropdown"
                            data-popper-placement="none">
                            <li>
                                <div class="input-group w-100 p-2"> <input type="text" class="form-control"
                                        placeholder="Search....">
                                    <div class="btn btn-primary"> <i class="fa fa-search" aria-hidden="true"></i> </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Start::header-element -->
                    <div class="header-element messages-dropdown">
                        <!-- Start::header-link|dropdown-toggle --> <a href="javascript:void(0);"
                            class="header-link dropdown-toggle" data-bs-auto-close="outside" data-bs-toggle="dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" class="header-link-icon" height="24px"
                                viewBox="0 0 24 24" width="24px" fill="currentColor">
                                <path d="M0 0h24v24H0V0z" fill="none"></path>
                                <path
                                    d="M22 6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6zm-2 0l-8 5-8-5h16zm0 12H4V8l8 5 8-5v10z">
                                </path>
                            </svg> <span class="pulse-danger"></span> </a> <!-- End::header-link|dropdown-toggle -->
                        <!-- Start::main-header-dropdown -->
                        <div class="main-header-dropdown dropdown-menu dropdown-menu-end main-header-message"
                            data-popper-placement="none">
                            <div class="menu-header-content bg-primary text-fixed-white">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0 fs-15 fw-semibold text-fixed-white">Messages</h6> <span
                                        class="badge rounded-pill bg-warning pt-1 text-fixed-black">Mark All Read</span>
                                </div>
                                <p class="dropdown-title-text subtext mb-0 text-fixed-white op-6 pb-0 fs-12 ">You have 4
                                    unread messages</p>
                            </div>
                            <div>
                                <hr class="dropdown-divider">
                            </div>
                            <ul class="list-unstyled mb-0" id="header-cart-items-scroll" data-simplebar="init">
                                <div class="simplebar-wrapper" style="margin: 0px;">
                                    <div class="simplebar-height-auto-observer-wrapper">
                                        <div class="simplebar-height-auto-observer"></div>
                                    </div>
                                    <div class="simplebar-mask">
                                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                            <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                                aria-label="scrollable content" style="height: auto; overflow: hidden;">
                                                <div class="simplebar-content" style="padding: 0px;">
                                                    <li class="dropdown-item">
                                                        <div class="d-flex messages"> <span
                                                                class="avatar avatar-md me-2 online avatar-rounded flex-shrink-0">
                                                                <img src="#" alt="img">
                                                            </span>
                                                            <div>
                                                                <div class="d-flex"> <a href="chat.html">
                                                                        <h6 class="mb-1 name">Petey Cruiser</h6>
                                                                    </a> </div>
                                                                <p class="mb-0 fs-12 desc">I'm sorry but i'm not sure
                                                                    how to help you with that......</p>
                                                                <p class="time mb-0 text-start float-start ms-2 mt-2">
                                                                    Mar 15 3:55 PM</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <div class="d-flex messages"> <span
                                                                class="avatar avatar-md me-2 online avatar-rounded flex-shrink-0">
                                                                <img src="#" alt="img">
                                                            </span>
                                                            <div>
                                                                <div class="d-flex"> <a href="chat.html">
                                                                        <h6 class="mb-1 name">Jimmy Changa</h6>
                                                                    </a> </div>
                                                                <p class="mb-0 fs-12 desc">All set ! Now, time to get to
                                                                    you now......</p>
                                                                <p class="time mb-0 text-start float-start ms-2 mt-2">
                                                                    Mar 06 01:12 AM</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <div class="d-flex messages"> <span
                                                                class="avatar avatar-md me-2 online avatar-rounded flex-shrink-0">
                                                                <img src=".#" alt="img">
                                                            </span>
                                                            <div>
                                                                <div class="d-flex"> <a href="chat.html">
                                                                        <h6 class="mb-1 name">Graham Cracker</h6>
                                                                    </a> </div>
                                                                <p class="mb-0 fs-12 desc">Are you ready to pickup your
                                                                    Delivery...</p>
                                                                <p class="time mb-0 text-start float-start ms-2 mt-2">
                                                                    Feb 25 10:35 AM</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <div class="d-flex messages"> <span
                                                                class="avatar avatar-md me-2 online avatar-rounded flex-shrink-0">
                                                                <img src="#" alt="img">
                                                            </span>
                                                            <div>
                                                                <div class="d-flex"> <a href="chat.html">
                                                                        <h6 class="mb-1 name">Donatella Nobatti</h6>
                                                                    </a> </div>
                                                                <p class="mb-0 fs-12 desc">Here are some products ...
                                                                </p>
                                                                <p class="time mb-0 text-start float-start ms-2 mt-2">
                                                                    Feb 12 05:12 PM</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <div class="d-flex messages"> <span
                                                                class="avatar avatar-md me-2 online avatar-rounded flex-shrink-0">
                                                                <img src="#" alt="img">
                                                            </span>
                                                            <div>
                                                                <div class="d-flex"> <a href="chat.html">
                                                                        <h6 class="mb-1 name">Anne Fibbiyon</h6>
                                                                    </a> </div>
                                                                <p class="mb-0 fs-12 desc">I'm sorry but i'm not sure
                                                                    how...</p>
                                                                <p class="time mb-0 text-start float-start ms-2 mt-2">
                                                                    Jan 29 03:16 PM</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
                                </div>
                                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                </div>
                                <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
                                </div>
                            </ul>
                            <div class="text-center dropdown-footer"> <a href="chat.html"
                                    class="text-primary fs-13">VIEW ALL</a> </div>
                        </div> <!-- End::main-header-dropdown -->
                    </div> <!-- End::header-element -->
                    <!-- Start::header-element -->
                    <div class="header-element notifications-dropdown main-header-notification">
                        <!-- Start::header-link|dropdown-toggle --> <a href="javascript:void(0);"
                            class="header-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                            id="messageDropdown" aria-expanded="false"> <svg xmlns="http://www.w3.org/2000/svg"
                                class="header-link-icon" height="24px" viewBox="0 0 24 24" width="24px"
                                fill="currentColor">
                                <path d="M0 0h24v24H0V0z" fill="none"></path>
                                <path
                                    d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2zm-2 1H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6z">
                                </path>
                            </svg> <span class="pulse-success"></span> </a> <!-- End::header-link|dropdown-toggle -->
                        <!-- Start::main-header-dropdown -->
                        <div class="main-header-dropdown dropdown-menu dropdown-menu-end main-header-message"
                            data-popper-placement="none">
                            <div class="menu-header-content bg-primary text-fixed-white">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0 fs-15 fw-semibold text-fixed-white">Notifications</h6> <span
                                        class="badge rounded-pill bg-warning pt-1 text-fixed-black">Mark All Read</span>
                                </div>
                                <p class="dropdown-title-text subtext mb-0 text-fixed-white op-6 pb-0 fs-12 ">You have 4
                                    unread Notifications</p>
                            </div>
                            <div>
                                <hr class="dropdown-divider">
                            </div>
                            <ul class="list-unstyled mb-0" id="header-notification-scroll" data-simplebar="init">
                                <div class="simplebar-wrapper" style="margin: 0px;">
                                    <div class="simplebar-height-auto-observer-wrapper">
                                        <div class="simplebar-height-auto-observer"></div>
                                    </div>
                                    <div class="simplebar-mask">
                                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                            <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                                aria-label="scrollable content" style="height: auto; overflow: hidden;">
                                                <div class="simplebar-content" style="padding: 0px;">
                                                    <li class="dropdown-item px-3">
                                                        <div class="d-flex"> <span
                                                                class="avatar avatar-md me-2 avatar-rounded flex-shrink-0 bg-pink">
                                                                <i class="la la-file-alt fs-20"></i> </span>
                                                            <div class="ms-3"> <a href="mail.html">
                                                                    <h5 class="notification-label text-dark mb-1">New
                                                                        files available</h5>
                                                                </a>
                                                                <div class="notification-subtext">10 hour ago</div>
                                                            </div>
                                                            <div class="ms-auto"> <a href="mail.html"><i
                                                                        class="las la-angle-right text-end text-muted icon"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item px-3">
                                                        <div class="d-flex"> <span
                                                                class="avatar avatar-md me-2 avatar-rounded flex-shrink-0 bg-purple">
                                                                <i class="la la-gem fs-20"></i> </span>
                                                            <div class="ms-3"> <a href="mail.html">
                                                                    <h5 class="notification-label text-dark mb-1">
                                                                        Updates Available</h5>
                                                                </a>
                                                                <div class="notification-subtext">2 days ago</div>
                                                            </div>
                                                            <div class="ms-auto"> <a href="mail.html"><i
                                                                        class="las la-angle-right text-end text-muted icon"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item px-3">
                                                        <div class="d-flex"> <span
                                                                class="avatar avatar-md me-2 avatar-rounded flex-shrink-0 bg-success">
                                                                <i class="la la-shopping-basket fs-20"></i> </span>
                                                            <div class="ms-3"> <a href="mail.html">
                                                                    <h5 class="notification-label text-dark mb-1">New
                                                                        Order Received</h5>
                                                                </a>
                                                                <div class="notification-subtext">1 hour ago</div>
                                                            </div>
                                                            <div class="ms-auto"> <a href="mail.html"><i
                                                                        class="las la-angle-right text-end text-muted icon"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item px-3">
                                                        <div class="d-flex"> <span
                                                                class="avatar avatar-md me-2 avatar-rounded flex-shrink-0 bg-warning">
                                                                <i
                                                                    class="la la-envelope-open fs-20 text-fixed-white"></i>
                                                            </span>
                                                            <div class="ms-3"> <a href="mail.html">
                                                                    <h5 class="notification-label text-dark mb-1">New
                                                                        review received</h5>
                                                                </a>
                                                                <div class="notification-subtext">1 day ago</div>
                                                            </div>
                                                            <div class="ms-auto"> <a href="mail.html"><i
                                                                        class="las la-angle-right text-end text-muted icon"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item px-3">
                                                        <div class="d-flex"> <span
                                                                class="avatar avatar-md me-2 avatar-rounded flex-shrink-0 bg-danger">
                                                                <i class="la la-user-check fs-20"></i> </span>
                                                            <div class="ms-3"> <a href="mail.html">
                                                                    <h5 class="notification-label text-dark mb-1">22
                                                                        verified registrations</h5>
                                                                </a>
                                                                <div class="notification-subtext">2 hour ago</div>
                                                            </div>
                                                            <div class="ms-auto"> <a href="mail.html"><i
                                                                        class="las la-angle-right text-end text-muted icon"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item px-3">
                                                        <div class="d-flex"> <span
                                                                class="avatar avatar-md me-2 avatar-rounded flex-shrink-0 bg-primary">
                                                                <i class="la la-check-circle fs-20"></i> </span>
                                                            <div class="ms-3"> <a href="mail.html">
                                                                    <h5 class="notification-label text-dark mb-1">
                                                                        Project has been approved</h5>
                                                                </a>
                                                                <div class="notification-subtext">4 hour ago</div>
                                                            </div>
                                                            <div class="ms-auto"> <a href="mail.html"><i
                                                                        class="las la-angle-right text-end text-muted icon"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
                                </div>
                                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                </div>
                                <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
                                </div>
                            </ul>
                            <div class="text-center dropdown-footer"> <a href="mail.html"
                                    class="text-primary fs-13">VIEW ALL</a> </div>
                        </div> <!-- End::main-header-dropdown -->
                    </div> <!-- End::header-element -->


                    <!-- Start::header-element -->
                    <div class="header-element headerProfile-dropdown">
                        <!-- Start::header-link|dropdown-toggle --> <a href="javascript:void(0);"
                            class="header-link dropdown-toggle" id="mainHeaderProfile" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" aria-expanded="false"> <img
                                src="{{asset('assets/images/profile.png')}}" alt="img" width="37" height="37"
                                class="rounded-circle"> </a>
                        <!-- End::header-link|dropdown-toggle -->
                        <ul class="main-header-dropdown dropdown-menu pt-0 header-profile-dropdown dropdown-menu-end main-profile-menu"
                            aria-labelledby="mainHeaderProfile">
                            <li>
                                <div class="main-header-profile bg-primary menu-header-content text-fixed-white">
                                    <div class="my-auto">
                                        <h6 class="mb-0 lh-1 text-fixed-white">{{auth()->user() ? auth()->user()->name :
                                            ''}}</h6><span class="fs-11 op-7 lh-1">
                                            @if(auth()->user() && auth()->user()->roles->first())
                                            {{ auth()->user()->roles->first()->name}}
                                            @elseif(auth()->user()->type == 'Company') Company
                                            @else User @endif
                                        </span>
                                    </div>
                                </div>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center" href="profile.html"><i
                                        class="bi bi-person fs-18 me-2 op-7"></i>Profile</a></li>

                            <li><a class="dropdown-item d-flex align-items-center border-block-end" href="mail.html"><i
                                        class="bi bi-chat-left fs-18 me-2 op-7"></i>Logs</a></li>
                            <livewire:auth.signout />
                        </ul>
                    </div> <!-- End::header-element -->

                </div> <!-- End::header-content-right -->
            </div> <!-- End::main-header-container -->
        </header> <!-- /app-header -->


        <!-- Start::app-sidebar -->
        <aside class="app-sidebar sticky" id="sidebar">
            <!-- Start::main-sidebar-header -->
            <div class="main-sidebar-header d-flex align-items-center justify-content-between">
                <h5>Construction</h5>
                <livewire:specific-project-switcher />
            </div>
            <!-- End::main-sidebar-header -->
            <!-- Start::main-sidebar -->
            <div class="main-sidebar" id="sidebar-scroll" data-simplebar="init">
                <div class="simplebar-wrapper" style="margin: -8px 0px -80px;">
                    <div class="simplebar-height-auto-observer-wrapper">
                        <div class="simplebar-height-auto-observer"></div>
                    </div>
                    <div class="simplebar-mask">
                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                            <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                                <div class="simplebar-content" style="padding: 8px 0px 80px;">
                                    <!-- Start::nav -->
                                    <nav class="main-menu-container nav nav-pills flex-column sub-open active">
                                        <div class="slide-left active d-none" id="slide-left"> <svg
                                                xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z">
                                                </path>
                                            </svg> </div>
                                        <ul class="main-menu active" style="margin-left: 0px; margin-right: 0px;">
                                            <!-- Start::slide__category -->
                                            <li class="slide__category"><span class="category-name">Main</span></li>

                                            <li class="slide"> <a href="index.html" class="side-menu__item"> <svg
                                                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"
                                                        viewBox="0 0 24 24">
                                                        <path d="M0 0h24v24H0V0z" fill="none"></path>
                                                        <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z"
                                                            opacity=".3"></path>
                                                        <path
                                                            d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z">
                                                        </path>
                                                    </svg> <span class="side-menu__label">Index</span> <span
                                                        class="badge bg-success ms-auto menu-badge">1</span> </a> </li>
                                            @can('super_admin')
                                            <li class="slide"> <a href="{{route('company.index')}}"
                                                    class="side-menu__item {{request()->segment(1) == 'company' ? 'active' : ''}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="bi bi-building side-menu__icon" viewBox="0 0 16 16">
                                                        <path
                                                            d="M4 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z" />
                                                        <path
                                                            d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1zm11 0H3v14h3v-2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V15h3z" />
                                                    </svg> <span class="side-menu__label">Company</span> </a> </li>
                                            @endcan
                                            <!-- End::slide -->
                                            <!-- Start::slide__user -->
                                            <li class="slide__category"><span class="category-name">User
                                                    Management</span></li>

                                            <li class="slide has-sub"> <a href="javascript:void(0);"
                                                    class="side-menu__item {{request()->segment(1) == 'roles' || request()->segment(1) == 'role' || request()->segment(1) == 'modules' || request()->segment(1) == 'module' || request()->segment(1) == 'accounts' || request()->segment(1) == 'account' ? 'active' : ''}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"
                                                        viewBox="0 0 24 24">
                                                        <title>User</title>
                                                        <path
                                                            d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z" />
                                                    </svg>
                                                    <span class="side-menu__label">Users</span> <i
                                                        class="fe fe-chevron-right side-menu__angle"></i> </a>
                                                <ul class="slide-menu child1"
                                                    style="position: relative; left: 0px; top: 0px; margin: 0px; transform: translate3d(119.5px, 294px, 0px);"
                                                    data-popper-placement="bottom">

                                                    <li class="slide"> <a href="{{route('module.index')}}"
                                                            class="side-menu__item {{ request()->segment(1) == 'modules' || request()->segment(1) == 'module' ? 'active' : ''}}">Module</a>
                                                    </li>
                                                    <li class="slide"> <a href="{{route('role.index')}}"
                                                            class="side-menu__item {{ request()->segment(1) == 'roles' || request()->segment(1) == 'role' ? 'active' : ''}}">Roles</a>
                                                    </li>

                                                    <li class="slide"> <a href="{{route('account.index')}}"
                                                            class="side-menu__item {{ request()->segment(1) == 'accounts' || request()->segment(1) == 'account' ? 'active' : ''}}">Accounts</a>
                                                    </li>
                                                </ul>
                                            </li> <!-- End::slide -->
                                            <!-- Start::slide__project -->
                                            <li class="slide__category"><span class="category-name">Project
                                                    Management</span></li>

                                            <li class="slide has-sub"> <a href="javascript:void(0);"
                                                    class="side-menu__item {{request()->segment(1) == 'projects' || request()->segment(1) == 'project' || request()->segment(1) == 'boqs' || request()->segment(1) == 'boq' ? 'active' : ''}}">

                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        class="bi bi-folder-plus side-menu__icon" viewBox="0 0 16 16">
                                                        <path
                                                            d="M.5 3a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v10a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V3zm1 0v10h12V3H1z" />
                                                        <path
                                                            d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V10.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                                        <path fill-rule="evenodd"
                                                            d="M2.5 1A1.5 1.5 0 0 0 1 2.5v1A1.5 1.5 0 0 0 2.5 5h2.757l.5-1H2.5a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 0 .354.146h4a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1.793l-.5 1h2.293a1.5 1.5 0 0 0 1.5-1.5v-1A1.5 1.5 0 0 0 13.5 1h-11z" />
                                                    </svg>
                                                    <span class="side-menu__label">Projects</span> <i
                                                        class="fe fe-chevron-right side-menu__angle"></i> </a>
                                                <ul class="slide-menu child1"
                                                    style="position: relative; left: 0px; top: 0px; margin: 0px; transform: translate3d(119.5px, 294px, 0px);"
                                                    data-popper-placement="bottom">

                                                    <li class="slide"> <a href="{{route('project.index')}}"
                                                            class="side-menu__item {{ request()->segment(1) == 'projects' || request()->segment(1) == 'project' ? 'active' : ''}}">List</a>
                                                    </li>
                                                    <li class="slide"> <a href="{{route('boq.index')}}"
                                                            class="side-menu__item {{ request()->segment(1) == 'boq' || request()->segment(1) == 'boqs' ? 'active' : ''}}">BOQ</a>
                                                    </li>
                                                </ul>
                                            </li> <!-- End::slide -->
                                            <li class="slide"> <a href="{{route('tax.index')}}"
                                                    class="side-menu__item {{request()->segment(1) == 'taxes' || request()->segment(1) == 'tax' ? 'active' : ''}}">

                                                    <svg viewBox="0 0 1024 1024" class="icon side-menu__icon"
                                                        version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <path
                                                                d="M438.87 301.71h-82.29v-82.28h-54.86v82.28h-82.28v54.86h82.28v82.29h54.86v-82.29h82.29zM585.15 301.71h219.43v54.86H585.15zM270.95 791.82l58.19-58.18 58.19 58.18 38.79-38.78-58.19-58.18 58.19-58.18-38.79-38.79-58.19 58.18-58.19-58.18-38.78 38.79 58.18 58.18-58.18 58.18z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M109.72 109.71v804.57h475.43v-73.14h-36.57V548.57h292.57v36.57h73.14V109.71H109.72z m73.15 73.15h292.57v292.57H182.87V182.86z m292.57 658.28H182.87V548.57h292.57v292.57z m365.71-365.71H548.58V182.86h292.57v292.57z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M624.85 664.52v165.41l143.25 82.71 143.25-82.71V664.52L768.1 581.81l-143.25 82.71z m204.21 15.83l-60.97 35.19-60.96-35.19 60.97-35.2 60.96 35.2z m-149.35 47.51l60.96 35.19v70.4l-60.96-35.19v-70.4z m115.82 105.6v-70.41l60.97-35.19v70.4l-60.97 35.2z"
                                                                fill="currentColor"></path>
                                                        </g>
                                                    </svg>
                                                    <span class="side-menu__label">Tax</span> </a>

                                            </li>
                                            <!-- Start::slide__category -->
                                            <li class="slide__category"><span class="category-name">Stock
                                                    Management</span></li>
                                            <!-- Start::slide -->
                                            <li class="slide"> <a href="{{route('vendor.index')}}"
                                                    class="side-menu__item {{request()->segment(1) == 'vendors' || request()->segment(1) == 'vendor' ? 'active' : ''}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-truck side-menu__icon"
                                                        fill="currentColor" viewBox="0 0 16 16">
                                                        <path
                                                            d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2" />
                                                    </svg>
                                                    <span class="side-menu__label">Vendor</span> </a>

                                            </li> <!-- End::slide -->
                                            
                                            <!-- Start::slide -->
                                            <li class="slide has-sub"> <a href="javascript:void(0);" class="side-menu__item {{request()->segment(1) == 'items' || request()->segment(1) == 'item' || request()->segment(1) == 'categories' || request()->segment(1) == 'category' || request()->segment(1) == 'purchases' || request()->segment(1) == 'purchase' || request()->segment(1) == 'stocks' || request()->segment(1) == 'stock'
                                                     ? 'active' : ''}}">
                                                    <svg viewBox="0 0 24 24" class="side-menu__icon" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M3.13861 8.5856C3.10395 8.79352 3.07799 8.98444 3.05852 9.15412C2.89911 9.20305 2.72733 9.2683 2.55279 9.35557C2.18416 9.53989 1.78511 9.83206 1.48045 10.2891C1.17162 10.7523 1 11.325 1 12C1 12.675 1.17162 13.2477 1.48045 13.7109C1.78511 14.1679 2.18416 14.4601 2.55279 14.6444C2.72733 14.7317 2.89911 14.7969 3.05852 14.8459C3.07798 15.0156 3.10395 15.2065 3.13861 15.4144C3.27452 16.2299 3.54822 17.3325 4.10557 18.4472C4.66489 19.5658 5.51956 20.7149 6.8203 21.5821C8.1273 22.4534 9.82502 23 12 23C14.175 23 15.8727 22.4534 17.1797 21.5821C18.4804 20.7149 19.3351 19.5658 19.8944 18.4472C20.4518 17.3325 20.7255 16.2299 20.8614 15.4144C20.896 15.2065 20.922 15.0156 20.9415 14.8459C21.1009 14.7969 21.2727 14.7317 21.4472 14.6444C21.8158 14.4601 22.2149 14.1679 22.5196 13.7109C22.8284 13.2477 23 12.675 23 12C23 11.325 22.8284 10.7523 22.5196 10.2891C22.2149 9.83206 21.8158 9.53989 21.4472 9.35557C21.2727 9.2683 21.1009 9.20305 20.9415 9.15412C20.922 8.98444 20.896 8.79352 20.8614 8.5856C20.7255 7.77011 20.4518 6.6675 19.8944 5.55278C19.3351 4.43416 18.4804 3.28511 17.1797 2.41795C15.8727 1.54662 14.175 1 12 1C9.82502 1 8.1273 1.54662 6.8203 2.41795C5.51957 3.28511 4.66489 4.43416 4.10558 5.55279C3.54822 6.6675 3.27452 7.77011 3.13861 8.5856ZM18.9025 15H5.09753C5.20639 15.692 5.43305 16.63 5.89443 17.5528C6.33511 18.4342 6.98044 19.2851 7.9297 19.9179C8.8727 20.5466 10.175 21 12 21C13.825 21 15.1273 20.5466 16.0703 19.9179C17.0196 19.2851 17.6649 18.4342 18.1056 17.5528C18.5669 16.63 18.7936 15.692 18.9025 15ZM18.9025 9H18C17.4477 9 17 9.44771 17 10C17 10.5523 17.4477 11 18 11H20C20.3084 11.012 20.6759 11.1291 20.8554 11.3984C20.9216 11.4977 21 11.675 21 12C21 12.325 20.9216 12.5023 20.8554 12.6016C20.6759 12.8709 20.3084 12.988 20 13H4C3.69155 12.988 3.32414 12.8709 3.14455 12.6016C3.07838 12.5023 3 12.325 3 12C3 11.675 3.07838 11.4977 3.14455 11.3984C3.32414 11.1291 3.69155 11.012 4 11H6C6.55228 11 7 10.5523 7 10C7 9.44771 6.55228 9 6 9H5.09753C5.20639 8.30804 5.43306 7.36996 5.89443 6.44721C6.33512 5.56584 6.98044 4.71489 7.92971 4.08205C8.24443 3.87224 8.59917 3.68195 9 3.52152V6C9 6.55228 9.44771 7 10 7C10.5523 7 11 6.55228 11 6V3.04872C11.3146 3.01691 11.6476 3 12 3C12.3524 3 12.6854 3.01691 13 3.04872V6C13 6.55228 13.4477 7 14 7C14.5523 7 15 6.55228 15 6V3.52152C15.4008 3.68195 15.7556 3.87224 16.0703 4.08205C17.0196 4.71489 17.6649 5.56584 18.1056 6.44721C18.5669 7.36996 18.7936 8.30804 18.9025 9Z"
                                                                fill="currentColor"></path>
                                                        </g>
                                                    </svg>
                                                    <span class="side-menu__label">Items</span> <i
                                                        class="fe fe-chevron-right side-menu__angle"></i> </a>
                                                <ul class="slide-menu child1"
                                                    style="position: relative; left: 0px; top: 0px; margin: 0px; transform: translate3d(119.5px, 472px, 0px);"
                                                    data-popper-placement="bottom">

                                                    <li class="slide"> <a href="{{route('category.index')}}"
                                                            class="side-menu__item {{request()->segment(1) == 'categories' || request()->segment(1) == 'category' ? 'active' : ''}}">Category</a>
                                                    </li>
                                                    <li class="slide"> <a href="{{route('item.index')}}"
                                                            class="side-menu__item {{request()->segment(1) == 'items' || request()->segment(1) == 'item' ? 'active' : ''}}">Items</a>
                                                    </li>
                                                    <li class="slide"> <a href="{{route('purchase.index')}}"
                                                            class="side-menu__item {{request()->segment(1) == 'purchases' || request()->segment(1) == 'purchase' ? 'active' : ''}}">Purchase</a>
                                                    </li>
                                                    <li class="slide"> <a href="{{route('stock.index')}}"
                                                            class="side-menu__item {{request()->segment(1) == 'stocks' || request()->segment(1) == 'stock' ? 'active' : ''}}">Stock</a>
                                                    </li>

                                                </ul>
                                            </li> <!-- End::slide -->

                                            <li class="slide"> <a href="{{route('requisition.index')}}"
                                                    class="side-menu__item {{request()->segment(1) == 'requisitions' || request()->segment(1) == 'requisition' ? 'active' : ''}}">
                                                   
                                                    <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"
                                                        fill="none">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                                                                <path
                                                                    d="M5 6.905A3.001 3.001 0 004.25 1a3 3 0 00-.75 5.905V14A.75.75 0 005 14V6.905zM2.75 4a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM12.5 5.25v3.595a3.001 3.001 0 01-.75 5.905A3 3 0 0111 8.845V5.25a.75.75 0 00-.75-.75H9A.75.75 0 019 3h1.25a2.25 2.25 0 012.25 2.25zm-2.25 6.5a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                    <span class="side-menu__label">Requisition</span> </a>

                                            </li> <!-- End::slide -->
                                            
                                            <li class="slide"> <a href="{{route('bill.index')}}"
                                                    class="side-menu__item {{request()->segment(1) == 'bills' || request()->segment(1) == 'bill' ? 'active' : ''}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"
                                                        fill="currentColor" class="bi bi-receipt" viewBox="0 0 16 16">
                                                        <path
                                                            d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27m.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0z" />
                                                        <path
                                                            d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5" />
                                                    </svg>

                                                    <span class="side-menu__label">Bills</span> </a>

                                            </li> <!-- End::slide -->
                                            <li class="slide"> <a href="{{route('payment.index')}}"
                                                    class="side-menu__item {{request()->segment(1) == 'payments' || request()->segment(1) == 'payment' ? 'active' : ''}}">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"
                                                        fill="currentColor" class="bi bi-wallet-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M1.5 2A1.5 1.5 0 0 0 0 3.5v2h6a.5.5 0 0 1 .5.5c0 .253.08.644.306.958.207.288.557.542 1.194.542s.987-.254 1.194-.542C9.42 6.644 9.5 6.253 9.5 6a.5.5 0 0 1 .5-.5h6v-2A1.5 1.5 0 0 0 14.5 2z" />
                                                        <path
                                                            d="M16 6.5h-5.551a2.7 2.7 0 0 1-.443 1.042C9.613 8.088 8.963 8.5 8 8.5s-1.613-.412-2.006-.958A2.7 2.7 0 0 1 5.551 6.5H0v6A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5z" />
                                                    </svg>

                                                    <span class="side-menu__label">Payments</span> </a>

                                            </li> <!-- End::slide -->


                                            <!-- Start::slide__category -->
                                            <li class="slide__category"><span class="category-name">Multi Levels</span>
                                            </li> <!-- End::slide__category -->
                                            <!-- Start::slide -->
                                            <li class="slide has-sub"> <a href="javascript:void(0);"
                                                    class="side-menu__item"> <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="side-menu__icon" viewBox="0 0 24 24">
                                                        <path d="M0 0h24v24H0V0z" fill="none"></path>
                                                        <path
                                                            d="M5 9h14V5H5v4zm2-3.5c.83 0 1.5.67 1.5 1.5S7.83 8.5 7 8.5 5.5 7.83 5.5 7 6.17 5.5 7 5.5zM5 19h14v-4H5v4zm2-3.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5.67-1.5 1.5-1.5z"
                                                            opacity=".3"></path>
                                                        <path
                                                            d="M20 13H4c-.55 0-1 .45-1 1v6c0 .55.45 1 1 1h16c.55 0 1-.45 1-1v-6c0-.55-.45-1-1-1zm-1 6H5v-4h14v4zm-12-.5c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5-1.5.67-1.5 1.5.67 1.5 1.5 1.5zM20 3H4c-.55 0-1 .45-1 1v6c0 .55.45 1 1 1h16c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1zm-1 6H5V5h14v4zM7 8.5c.83 0 1.5-.67 1.5-1.5S7.83 5.5 7 5.5 5.5 6.17 5.5 7 6.17 8.5 7 8.5z">
                                                        </path>
                                                    </svg> <span class="side-menu__label">Menu Levels</span> <i
                                                        class="fe fe-chevron-right side-menu__angle"></i> </a>
                                                <ul class="slide-menu child1"
                                                    style="position: relative; left: 0px; top: 0px; margin: 0px; transform: translate3d(119.5px, 566px, 0px);"
                                                    data-popper-placement="bottom">
                                                    <li class="slide side-menu__label1"> <a
                                                            href="javascript:void(0);">Menu Levels</a> </li>
                                                    <li class="slide"> <a href="javascript:void(0);"
                                                            class="side-menu__item">Level-1</a> </li>
                                                    <li class="slide has-sub"> <a href="javascript:void(0);"
                                                            class="side-menu__item">Level-2 <i
                                                                class="fe fe-chevron-right side-menu__angle"></i></a>
                                                        <ul class="slide-menu child2">
                                                            <li class="slide"> <a href="javascript:void(0);"
                                                                    class="side-menu__item">Level-2-1</a> </li>
                                                            <li class="slide has-sub"> <a href="javascript:void(0);"
                                                                    class="side-menu__item">Level-2-2 <i
                                                                        class="fe fe-chevron-right side-menu__angle"></i></a>
                                                                <ul class="slide-menu child3">
                                                                    <li class="slide"> <a href="javascript:void(0);"
                                                                            class="side-menu__item">Level-2-2-1</a>
                                                                    </li>
                                                                    <li class="slide"> <a href="javascript:void(0);"
                                                                            class="side-menu__item">Level-2-2-2</a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li> <!-- End::slide -->
                                            <!-- Start::slide__category -->
                                            <li class="slide__category"><span class="category-name">Components</span>
                                            </li> <!-- End::slide__category -->
                                            <!-- Start::slide -->
                                            <li class="slide has-sub"> <a href="javascript:void(0);"
                                                    class="side-menu__item"> <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="side-menu__icon" viewBox="0 0 24 24">
                                                        <path d="M0 0h24v24H0V0z" fill="none"></path>
                                                        <path d="M13 4H6v16h12V9h-5V4zm3 14H8v-2h8v2zm0-6v2H8v-2h8z"
                                                            opacity=".3"></path>
                                                        <path
                                                            d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z">
                                                        </path>
                                                    </svg> <span class="side-menu__label">Forms</span> <i
                                                        class="fe fe-chevron-right side-menu__angle"></i> </a>
                                                <ul class="slide-menu child1"
                                                    style="position: relative; left: 0px; top: 0px; margin: 0px; transform: translate3d(119.5px, 660px, 0px);"
                                                    data-popper-placement="bottom">
                                                    <li class="slide side-menu__label1"> <a
                                                            href="javascript:void(0);">Forms</a> </li>
                                                    <li class="slide has-sub"> <a href="javascript:void(0);"
                                                            class="side-menu__item">Form Elements <i
                                                                class="fe fe-chevron-right side-menu__angle"></i></a>
                                                        <ul class="slide-menu child2">
                                                            <li class="slide"> <a href="form-inputs.html"
                                                                    class="side-menu__item">Inputs</a> </li>
                                                            <li class="slide"> <a href="form-check-radios.html"
                                                                    class="side-menu__item">Checks &amp; Radios</a>
                                                            </li>
                                                            <li class="slide"> <a href="form-input-group.html"
                                                                    class="side-menu__item">Input Group</a> </li>
                                                            <li class="slide"> <a href="form-select.html"
                                                                    class="side-menu__item">Form Select</a> </li>
                                                            <li class="slide"> <a href="form-range.html"
                                                                    class="side-menu__item">Range Slider</a> </li>
                                                            <li class="slide"> <a href="form-input-masks.html"
                                                                    class="side-menu__item">Input Masks</a> </li>
                                                            <li class="slide"> <a href="form-file-uploads.html"
                                                                    class="side-menu__item">File Uploads</a> </li>
                                                            <li class="slide"> <a href="form-dateTime-pickers.html"
                                                                    class="side-menu__item">Date,Time Picker</a> </li>
                                                            <li class="slide"> <a href="form-color-pickers.html"
                                                                    class="side-menu__item">Color Pickers</a> </li>
                                                        </ul>
                                                    </li>
                                                    <li class="slide"> <a href="floating-labels.html"
                                                            class="side-menu__item">Floating Labels</a> </li>
                                                    <li class="slide"> <a href="form-layout.html"
                                                            class="side-menu__item">Form Layouts</a> </li>
                                                    <li class="slide has-sub"> <a href="javascript:void(0);"
                                                            class="side-menu__item">Form Editors <i
                                                                class="fe fe-chevron-right side-menu__angle"></i></a>
                                                        <ul class="slide-menu child2">
                                                            <li class="slide"> <a href="quill_editor.html"
                                                                    class="side-menu__item">Quill Editor</a> </li>
                                                        </ul>
                                                    </li>
                                                    <li class="slide"> <a href="form-validation.html"
                                                            class="side-menu__item">Validation</a> </li>
                                                    <li class="slide"> <a href="form-select2.html"
                                                            class="side-menu__item">Select2</a> </li>
                                                </ul>
                                            </li> <!-- End::slide -->
                                            <!-- Start::slide -->
                                            <li class="slide has-sub"> <a href="javascript:void(0);"
                                                    class="side-menu__item"> <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="side-menu__icon" viewBox="0 0 24 24">
                                                        <path d="M0 0h24v24H0V0z" fill="none"></path>
                                                        <path d="M5 5h15v3H5zm12 5h3v9h-3zm-7 0h5v9h-5zm-5 0h3v9H5z"
                                                            opacity=".3"></path>
                                                        <path
                                                            d="M20 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h15c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM8 19H5v-9h3v9zm7 0h-5v-9h5v9zm5 0h-3v-9h3v9zm0-11H5V5h15v3z">
                                                        </path>
                                                    </svg> <span class="side-menu__label">Tables</span> <i
                                                        class="fe fe-chevron-right side-menu__angle"></i> </a>
                                                <ul class="slide-menu child1"
                                                    style="position: relative; left: 0px; top: 0px; margin: 0px; transform: translate3d(119.5px, 702px, 0px);"
                                                    data-popper-placement="bottom">
                                                    <li class="slide side-menu__label1"> <a
                                                            href="javascript:void(0);">Tables</a> </li>
                                                    <li class="slide"> <a href="tables.html"
                                                            class="side-menu__item">Tables</a> </li>
                                                    <li class="slide"> <a href="grid-tables.html"
                                                            class="side-menu__item">Grid JS Tables</a> </li>
                                                    <li class="slide"> <a href="data-tables.html"
                                                            class="side-menu__item">Data Tables</a> </li>
                                                </ul>
                                            </li> <!-- End::slide -->
                                            <!-- Start::slide -->
                                            <li class="slide"> <a href="landing-page.html" class="side-menu__item"> <svg
                                                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"
                                                        viewBox="0 0 24 24">
                                                        <path d="M0 0h24v24H0z" fill="none"></path>
                                                        <path
                                                            d="M12 4.02C7.6 4.02 4.02 7.6 4.02 12S7.6 19.98 12 19.98s7.98-3.58 7.98-7.98S16.4 4.02 12 4.02zM11.39 19v-5.5H8.25l4.5-8.5v5.5h3L11.39 19z"
                                                            opacity=".3"></path>
                                                        <path
                                                            d="M12 2.02c-5.51 0-9.98 4.47-9.98 9.98s4.47 9.98 9.98 9.98 9.98-4.47 9.98-9.98S17.51 2.02 12 2.02zm0 17.96c-4.4 0-7.98-3.58-7.98-7.98S7.6 4.02 12 4.02 19.98 7.6 19.98 12 16.4 19.98 12 19.98zM12.75 5l-4.5 8.5h3.14V19l4.36-8.5h-3V5z">
                                                        </path>
                                                    </svg> <span class="side-menu__label">Landing Page</span> </a> </li>
                                            <!-- End::slide -->
                                            <!-- Start::slide -->
                                            <li class="slide has-sub"> <a href="javascript:void(0);"
                                                    class="side-menu__item"> <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="side-menu__icon" viewBox="0 0 24 24">
                                                        <path d="M0 0h24v24H0V0z" fill="none"></path>
                                                        <path
                                                            d="M12 4C9.24 4 7 6.24 7 9c0 2.85 2.92 7.21 5 9.88 2.11-2.69 5-7 5-9.88 0-2.76-2.24-5-5-5zm0 7.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"
                                                            opacity=".3"></path>
                                                        <path
                                                            d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zM7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 2.88-2.88 7.19-5 9.88C9.92 16.21 7 11.85 7 9z">
                                                        </path>
                                                        <circle cx="12" cy="9" r="2.5"></circle>
                                                    </svg> <span class="side-menu__label">Maps</span> <i
                                                        class="fe fe-chevron-right side-menu__angle"></i> </a>
                                                <ul class="slide-menu child1"
                                                    style="position: relative; left: 0px; top: 0px; margin: 0px; transform: translate3d(119.5px, 786px, 0px);"
                                                    data-popper-placement="bottom">
                                                    <li class="slide side-menu__label1"> <a
                                                            href="javascript:void(0);">Maps</a> </li>
                                                    <li class="slide"> <a href="google-maps.html"
                                                            class="side-menu__item">Google Maps</a> </li>
                                                    <li class="slide"> <a href="leaflet-maps.html"
                                                            class="side-menu__item">Leaflet Maps</a> </li>
                                                    <li class="slide"> <a href="vector-maps.html"
                                                            class="side-menu__item">Vector Maps</a> </li>
                                                </ul>
                                            </li> <!-- End::slide -->
                                            <!-- Start::slide__category -->
                                            <li class="slide__category"><span class="category-name">Pages</span></li>
                                            <!-- End::slide__category -->
                                            <!-- Start::slide -->
                                            <li class="slide has-sub"> <a href="javascript:void(0);"
                                                    class="side-menu__item"> <svg xmlns="http://www.w3.org/2000/svg"
                                                        enable-background="new 0 0 24 24" class="side-menu__icon"
                                                        viewBox="0 0 24 24">
                                                        <g></g>
                                                        <g>
                                                            <g></g>
                                                            <g>
                                                                <path
                                                                    d="M21,5c-1.11-0.35-2.33-0.5-3.5-0.5c-1.95,0-4.05,0.4-5.5,1.5c-1.45-1.1-3.55-1.5-5.5-1.5S2.45,4.9,1,6v14.65 c0,0.25,0.25,0.5,0.5,0.5c0.1,0,0.15-0.05,0.25-0.05C3.1,20.45,5.05,20,6.5,20c1.95,0,4.05,0.4,5.5,1.5c1.35-0.85,3.8-1.5,5.5-1.5 c1.65,0,3.35,0.3,4.75,1.05c0.1,0.05,0.15,0.05,0.25,0.05c0.25,0,0.5-0.25,0.5-0.5V6C22.4,5.55,21.75,5.25,21,5z M3,18.5V7 c1.1-0.35,2.3-0.5,3.5-0.5c1.34,0,3.13,0.41,4.5,0.99v11.5C9.63,18.41,7.84,18,6.5,18C5.3,18,4.1,18.15,3,18.5z M21,18.5 c-1.1-0.35-2.3-0.5-3.5-0.5c-1.34,0-3.13,0.41-4.5,0.99V7.49c1.37-0.59,3.16-0.99,4.5-0.99c1.2,0,2.4,0.15,3.5,0.5V18.5z">
                                                                </path>
                                                                <path
                                                                    d="M11,7.49C9.63,6.91,7.84,6.5,6.5,6.5C5.3,6.5,4.1,6.65,3,7v11.5C4.1,18.15,5.3,18,6.5,18 c1.34,0,3.13,0.41,4.5,0.99V7.49z"
                                                                    opacity=".3"></path>
                                                            </g>
                                                            <g>
                                                                <path
                                                                    d="M17.5,10.5c0.88,0,1.73,0.09,2.5,0.26V9.24C19.21,9.09,18.36,9,17.5,9c-1.28,0-2.46,0.16-3.5,0.47v1.57 C14.99,10.69,16.18,10.5,17.5,10.5z">
                                                                </path>
                                                                <path
                                                                    d="M17.5,13.16c0.88,0,1.73,0.09,2.5,0.26V11.9c-0.79-0.15-1.64-0.24-2.5-0.24c-1.28,0-2.46,0.16-3.5,0.47v1.57 C14.99,13.36,16.18,13.16,17.5,13.16z">
                                                                </path>
                                                                <path
                                                                    d="M17.5,15.83c0.88,0,1.73,0.09,2.5,0.26v-1.52c-0.79-0.15-1.64-0.24-2.5-0.24c-1.28,0-2.46,0.16-3.5,0.47v1.57 C14.99,16.02,16.18,15.83,17.5,15.83z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </svg> <span class="side-menu__label">Pages</span> <i
                                                        class="fe fe-chevron-right side-menu__angle"></i> </a>
                                                <ul class="slide-menu child1"
                                                    style="position: relative; left: 0px; top: 0px; margin: 0px; transform: translate3d(119.5px, 838px, 0px);"
                                                    data-popper-placement="top">
                                                    <li class="slide side-menu__label1"> <a
                                                            href="javascript:void(0);">Pages</a> </li>
                                                    <li class="slide"> <a href="profile.html"
                                                            class="side-menu__item">Profile</a> </li>
                                                    <li class="slide"> <a href="editprofile.html"
                                                            class="side-menu__item">Edit-Profile</a> </li>
                                                    <li class="slide"> <a href="about.html"
                                                            class="side-menu__item">About-Us</a> </li>
                                                    <li class="slide"> <a href="settings.html"
                                                            class="side-menu__item">Settings</a> </li>
                                                    <li class="slide"> <a href="invoice.html"
                                                            class="side-menu__item">Invoice</a> </li>
                                                    <li class="slide"> <a href="pricing.html"
                                                            class="side-menu__item">Pricing</a> </li>
                                                    <li class="slide"> <a href="gallery.html"
                                                            class="side-menu__item">Gallery</a> </li>
                                                    <li class="slide"> <a href="todotask.html"
                                                            class="side-menu__item">Todotask</a> </li>
                                                    <li class="slide"> <a href="faq.html"
                                                            class="side-menu__item">Faqs</a> </li>
                                                    <li class="slide"> <a href="empty.html"
                                                            class="side-menu__item">Empty</a> </li>
                                                    <li class="slide has-sub"> <a href="javascript:void(0);"
                                                            class="side-menu__item">Mail <i
                                                                class="fe fe-chevron-right side-menu__angle"></i></a>
                                                        <ul class="slide-menu child2">
                                                            <li class="slide"> <a href="mail.html"
                                                                    class="side-menu__item">Mail</a> </li>
                                                            <li class="slide"> <a href="mail-compose.html"
                                                                    class="side-menu__item">Mail Compose</a> </li>
                                                            <li class="slide"> <a href="mail-read.html"
                                                                    class="side-menu__item">Mail Read</a> </li>
                                                            <li class="slide"> <a href="mail-settings.html"
                                                                    class="side-menu__item">Mail Settings</a> </li>
                                                            <li class="slide"> <a href="chat.html"
                                                                    class="side-menu__item">Chat</a> </li>
                                                        </ul>
                                                    </li>
                                                    <li class="slide has-sub"> <a href="javascript:void(0);"
                                                            class="side-menu__item">Ecommerce <i
                                                                class="fe fe-chevron-right side-menu__angle"></i></a>
                                                        <ul class="slide-menu child2">
                                                            <li class="slide"> <a href="products.html"
                                                                    class="side-menu__item">Products</a> </li>
                                                            <li class="slide"> <a href="product-details.html"
                                                                    class="side-menu__item">Product Details</a> </li>
                                                            <li class="slide"> <a href="product-cart.html"
                                                                    class="side-menu__item">Cart</a> </li>
                                                            <li class="slide"> <a href="check-out.html"
                                                                    class="side-menu__item">Check-out</a> </li>
                                                            <li class="slide"> <a href="wish-list.html"
                                                                    class="side-menu__item">Wish List</a> </li>
                                                        </ul>
                                                    </li>
                                                    <li class="slide has-sub"> <a href="javascript:void(0);"
                                                            class="side-menu__item">Custom Pages <i
                                                                class="fe fe-chevron-right side-menu__angle"></i></a>
                                                        <ul class="slide-menu child2">
                                                            <li class="slide"> <a href="signin.html"
                                                                    class="side-menu__item">Sign In</a> </li>
                                                            <li class="slide"> <a href="signup.html"
                                                                    class="side-menu__item">Sign Up</a> </li>
                                                            <li class="slide"> <a href="forgot.html"
                                                                    class="side-menu__item">Forgot Password</a> </li>
                                                            <li class="slide"> <a href="reset.html"
                                                                    class="side-menu__item">Reset Password</a> </li>
                                                            <li class="slide"> <a href="lockscreen.html"
                                                                    class="side-menu__item">Lockscreen</a> </li>
                                                            <li class="slide"> <a href="underconstruction.html"
                                                                    class="side-menu__item">UnderConstruction</a> </li>
                                                            <li class="slide"> <a href="404.html"
                                                                    class="side-menu__item">404 Error</a> </li>
                                                            <li class="slide"> <a href="500.html"
                                                                    class="side-menu__item">500 Error</a> </li>
                                                            <li class="slide"> <a href="501.html"
                                                                    class="side-menu__item">501 Error</a> </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li> <!-- End::slide -->
                                            <!-- Start::slide -->
                                            <li class="slide has-sub"> <a href="javascript:void(0);"
                                                    class="side-menu__item"> <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="side-menu__icon" viewBox="0 0 24 24">
                                                        <path d="M0 0h24v24H0V0z" fill="none"></path>
                                                        <path
                                                            d="M10.9 19.91c.36.05.72.09 1.1.09 2.18 0 4.16-.88 5.61-2.3L14.89 13l-3.99 6.91zm-1.04-.21l2.71-4.7H4.59c.93 2.28 2.87 4.03 5.27 4.7zM8.54 12L5.7 7.09C4.64 8.45 4 10.15 4 12c0 .69.1 1.36.26 2h5.43l-1.15-2zm9.76 4.91C19.36 15.55 20 13.85 20 12c0-.69-.1-1.36-.26-2h-5.43l3.99 6.91zM13.73 9h5.68c-.93-2.28-2.88-4.04-5.28-4.7L11.42 9h2.31zm-3.46 0l2.83-4.92C12.74 4.03 12.37 4 12 4c-2.18 0-4.16.88-5.6 2.3L9.12 11l1.15-2z"
                                                            opacity=".3"></path>
                                                        <path
                                                            d="M12 22c5.52 0 10-4.48 10-10 0-4.75-3.31-8.72-7.75-9.74l-.08-.04-.01.02C13.46 2.09 12.74 2 12 2 6.48 2 2 6.48 2 12s4.48 10 10 10zm0-2c-.38 0-.74-.04-1.1-.09L14.89 13l2.72 4.7C16.16 19.12 14.18 20 12 20zm8-8c0 1.85-.64 3.55-1.7 4.91l-4-6.91h5.43c.17.64.27 1.31.27 2zm-.59-3h-7.99l2.71-4.7c2.4.66 4.35 2.42 5.28 4.7zM12 4c.37 0 .74.03 1.1.08L10.27 9l-1.15 2L6.4 6.3C7.84 4.88 9.82 4 12 4zm-8 8c0-1.85.64-3.55 1.7-4.91L8.54 12l1.15 2H4.26C4.1 13.36 4 12.69 4 12zm6.27 3h2.3l-2.71 4.7c-2.4-.67-4.35-2.42-5.28-4.7h5.69z">
                                                        </path>
                                                    </svg> <span class="side-menu__label">Utilities</span> <i
                                                        class="fe fe-chevron-right side-menu__angle"></i> </a>
                                                <ul class="slide-menu child1"
                                                    style="position: relative; left: 0px; top: 0px; margin: 0px; transform: translate3d(119.5px, 880px, 0px);"
                                                    data-popper-reference-hidden="" data-popper-escaped=""
                                                    data-popper-placement="top">
                                                    <li class="slide side-menu__label1"> <a
                                                            href="javascript:void(0);">Utilities</a> </li>
                                                    <li class="slide"> <a href="borders.html"
                                                            class="side-menu__item">Borders</a> </li>
                                                    <li class="slide"> <a href="breakpoints.html"
                                                            class="side-menu__item">Breakpoints</a> </li>
                                                    <li class="slide"> <a href="colors.html"
                                                            class="side-menu__item">Colors</a> </li>
                                                    <li class="slide"> <a href="columns.html"
                                                            class="side-menu__item">Columns</a> </li>
                                                    <li class="slide"> <a href="flex.html"
                                                            class="side-menu__item">Flex</a> </li>
                                                    <li class="slide"> <a href="gutters.html"
                                                            class="side-menu__item">Gutters</a> </li>
                                                    <li class="slide"> <a href="helpers.html"
                                                            class="side-menu__item">Helpers</a> </li>
                                                    <li class="slide"> <a href="position.html"
                                                            class="side-menu__item">Position</a> </li>
                                                    <li class="slide"> <a href="more.html"
                                                            class="side-menu__item">Additional Content</a> </li>
                                                </ul>
                                            </li> <!-- End::slide -->
                                        </ul>
                                        <div class="slide-right d-none" id="slide-right"><svg
                                                xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
                                                </path>
                                            </svg></div>
                                    </nav> <!-- End::nav -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="simplebar-placeholder" style="width: auto; height: 954px;"></div>
                </div>
                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                    <div class="simplebar-scrollbar"
                        style="width: 0px; transform: translate3d(0px, 0px, 0px); display: none;"></div>
                </div>
                <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                    <div class="simplebar-scrollbar"
                        style="height: 771px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                </div>
            </div> <!-- End::main-sidebar -->
        </aside> <!-- End::app-sidebar -->
        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid">
                <!-- Page Header -->
                <x-breadcrumb />
                <!-- Page Header Close -->
                <!-- Start::row-1 -->
                <div class="row">
                    {{$slot}}
                </div>
                <!--End::row-1 -->
            </div>
        </div> <!-- End::app-content -->

    </div>

    @stack('dropdowns')
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