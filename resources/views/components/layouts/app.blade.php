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
                    <div class="header-element header-sidebar">
                        <!-- Start::header-link--> <a href="javascript:void(0);" class="header-link"
                            data-bs-toggle="offcanvas" data-bs-target="#header-sidebar"> <svg
                                xmlns="http://www.w3.org/2000/svg" class="header-link-icon" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <line x1="3" y1="12" x2="21" y2="12"></line>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <line x1="3" y1="18" x2="21" y2="18"></line>
                            </svg> </a> <!-- End::header-link-->
                    </div> <!-- End::header-element -->
                    <!-- Start::header-element -->
                    <div class="header-element headerProfile-dropdown">
                        <!-- Start::header-link|dropdown-toggle --> <a href="javascript:void(0);"
                            class="header-link dropdown-toggle" id="mainHeaderProfile" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" aria-expanded="false"> <img src="#" alt="img" width="37"
                                height="37" class="rounded-circle"> </a>
                        <!-- End::header-link|dropdown-toggle -->
                        <ul class="main-header-dropdown dropdown-menu pt-0 header-profile-dropdown dropdown-menu-end main-profile-menu"
                            aria-labelledby="mainHeaderProfile">
                            <li>
                                <div class="main-header-profile bg-primary menu-header-content text-fixed-white">
                                    <div class="my-auto">
                                        <h6 class="mb-0 lh-1 text-fixed-white">Petey Cruiser</h6><span
                                            class="fs-11 op-7 lh-1">Premium Member</span>
                                    </div>
                                </div>
                            </li>
                            <li><a class="dropdown-item d-flex" href="profile.html"><i
                                        class="bx bx-user-circle fs-18 me-2 op-7"></i>Profile</a></li>
                            <li><a class="dropdown-item d-flex" href="editprofile.html"><i
                                        class="bx bx-cog fs-18 me-2 op-7"></i>Edit Profile </a></li>
                            <li><a class="dropdown-item d-flex border-block-end" href="mail.html"><i
                                        class="bx bxs-inbox fs-18 me-2 op-7"></i>Inbox</a></li>
                            <li><a class="dropdown-item d-flex" href="chat.html"><i
                                        class="bx bx-envelope fs-18 me-2 op-7"></i>Messages</a></li>
                            <li><a class="dropdown-item d-flex border-block-end" href="editprofile.html"><i
                                        class="bx bx-slider-alt fs-18 me-2 op-7"></i>Account Settings</a></li>
                            <li><a class="dropdown-item d-flex" href="signin.html"><i
                                        class="bx bx-log-out fs-18 me-2 op-7"></i>Sign Out</a></li>
                        </ul>
                    </div> <!-- End::header-element -->

                </div> <!-- End::header-content-right -->
            </div> <!-- End::main-header-container -->
        </header> <!-- /app-header -->


        <!-- Start::app-sidebar -->
        <aside class="app-sidebar sticky" id="sidebar">
            <!-- Start::main-sidebar-header -->
            <div class="main-sidebar-header">
                <h5>Construction</h5>
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
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" 
                                                        fill="currentColor" class="bi bi-kanban" viewBox="0 0 16 16">
                                                        <path
                                                            d="M13.5 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-11a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zm-11-1a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                                                        <path
                                                            d="M6.5 3a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1zm-4 0a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1zm8 0a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1z" />
                                                    </svg>
                                                    <span class="side-menu__label">Projects</span> <i
                                                        class="fe fe-chevron-right side-menu__angle"></i> </a>
                                                <ul class="slide-menu child1"
                                                    style="position: relative; left: 0px; top: 0px; margin: 0px; transform: translate3d(119.5px, 294px, 0px);"
                                                    data-popper-placement="bottom">

                                                    <li class="slide"> <a href="{{route('project.index')}}"
                                                            class="side-menu__item {{ request()->segment(1) == 'projects' || request()->segment(1) == 'project' ? 'active' : ''}}">List</a>
                                                    </li>
                                                    <li class="slide"> <a href="{{route('role.index')}}"
                                                            class="side-menu__item {{ request()->segment(1) == 'roles' || request()->segment(1) == 'role' ? 'active' : ''}}">BOQ</a>
                                                    </li>
                                                </ul>
                                            </li> <!-- End::slide -->
                                            <!-- Start::slide__category -->
                                            <li class="slide__category"><span class="category-name">Web Apps</span></li>
                                            <!-- End::slide__category -->
                                            <!-- Start::slide -->
                                            <li class="slide has-sub"> <a href="javascript:void(0);"
                                                    class="side-menu__item"> <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="side-menu__icon" viewBox="0 0 24 24">
                                                        <path d="M0 0h24v24H0V0z" fill="none"></path>
                                                        <path
                                                            d="M4 12c0 4.08 3.06 7.44 7 7.93V4.07C7.05 4.56 4 7.92 4 12z"
                                                            opacity=".3"></path>
                                                        <path
                                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93s3.05-7.44 7-7.93v15.86zm2-15.86c1.03.13 2 .45 2.87.93H13v-.93zM13 7h5.24c.25.31.48.65.68 1H13V7zm0 3h6.74c.08.33.15.66.19 1H13v-1zm0 9.93V19h2.87c-.87.48-1.84.8-2.87.93zM18.24 17H13v-1h5.92c-.2.35-.43.69-.68 1zm1.5-3H13v-1h6.93c-.04.34-.11.67-.19 1z">
                                                        </path>
                                                    </svg> <span class="side-menu__label">Apps</span> <i
                                                        class="fe fe-chevron-right side-menu__angle"></i> </a>
                                                <ul class="slide-menu child1"
                                                    style="position: relative; left: 0px; top: 0px; margin: 0px; transform: translate3d(119.5px, 388px, 0px);"
                                                    data-popper-placement="bottom">
                                                    <li class="slide side-menu__label1"> <a
                                                            href="javascript:void(0);">Apps</a> </li>
                                                    <li class="slide"> <a href="cards.html"
                                                            class="side-menu__item">Cards</a> </li>
                                                    <li class="slide"> <a href="draggable-cards.html"
                                                            class="side-menu__item">Draggable Cards</a> </li>
                                                    <li class="slide"> <a href="full-calendar.html"
                                                            class="side-menu__item">Calendar</a> </li>
                                                    <li class="slide"> <a href="contacts.html"
                                                            class="side-menu__item">Contacts</a> </li>
                                                    <li class="slide"> <a href="notifications.html"
                                                            class="side-menu__item">Notifications</a> </li>
                                                    <li class="slide"> <a href="widgets.html"
                                                            class="side-menu__item">Widgets</a> </li>
                                                    <li class="slide"> <a href="widget-notification.html"
                                                            class="side-menu__item">Widget-notification</a> </li>
                                                    <li class="slide"> <a href="treeview.html"
                                                            class="side-menu__item">Treeview</a> </li>
                                                    <li class="slide has-sub"> <a href="javascript:void(0);"
                                                            class="side-menu__item">File Manager <i
                                                                class="fe fe-chevron-right side-menu__angle"></i></a>
                                                        <ul class="slide-menu child2">
                                                            <li class="slide"> <a href="file-manager.html"
                                                                    class="side-menu__item">File-Manager</a> </li>
                                                            <li class="slide"> <a href="file-manager-list.html"
                                                                    class="side-menu__item">File-Manager-List</a> </li>
                                                            <li class="slide"> <a href="file-manager-details.html"
                                                                    class="side-menu__item">File-Manager-details</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li> <!-- End::slide -->
                                            <!-- Start::slide -->
                                            <li class="slide has-sub"> <a href="javascript:void(0);"
                                                    class="side-menu__item"> <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="side-menu__icon" viewBox="0 0 24 24">
                                                        <path d="M0 0h24v24H0V0z" fill="none"></path>
                                                        <path d="M6.26 9L12 13.47 17.74 9 12 4.53z" opacity=".3"></path>
                                                        <path
                                                            d="M19.37 12.8l-7.38 5.74-7.37-5.73L3 14.07l9 7 9-7zM12 2L3 9l1.63 1.27L12 16l7.36-5.73L21 9l-9-7zm0 11.47L6.26 9 12 4.53 17.74 9 12 13.47z">
                                                        </path>
                                                    </svg> <span class="side-menu__label">Elements</span> <i
                                                        class="fe fe-chevron-right side-menu__angle"></i> </a>
                                                <ul class="slide-menu child1 mega-menu"
                                                    style="position: relative; left: 0px; top: 0px; margin: 0px; transform: translate3d(119.5px, 430px, 0px);"
                                                    data-popper-placement="bottom">
                                                    <li class="slide side-menu__label1"> <a
                                                            href="javascript:void(0);">Elements</a> </li>
                                                    <li class="slide"> <a href="alerts.html"
                                                            class="side-menu__item">Alerts</a> </li>
                                                    <li class="slide"> <a href="avatars.html"
                                                            class="side-menu__item">Avatar</a> </li>
                                                    <li class="slide"> <a href="breadcrumb.html"
                                                            class="side-menu__item">Breadcrumb</a> </li>
                                                    <li class="slide"> <a href="buttons.html"
                                                            class="side-menu__item">Buttons</a> </li>
                                                    <li class="slide"> <a href="buttongroup.html"
                                                            class="side-menu__item">Button Group</a> </li>
                                                    <li class="slide"> <a href="badge.html"
                                                            class="side-menu__item">Badge</a> </li>
                                                    <li class="slide"> <a href="dropdowns.html"
                                                            class="side-menu__item">Dropdown</a> </li>
                                                    <li class="slide"> <a href="listgroup.html"
                                                            class="side-menu__item">List Group</a> </li>
                                                    <li class="slide"> <a href="links_interactions.html"
                                                            class="side-menu__item">Links &amp; Interactions</a> </li>
                                                    <li class="slide"> <a href="navbar.html"
                                                            class="side-menu__item">Navbar</a> </li>
                                                    <li class="slide"> <a href="images-figures.html"
                                                            class="side-menu__item">Images &amp; Figures</a> </li>
                                                    <li class="slide"> <a href="pagination.html"
                                                            class="side-menu__item">Pagination</a> </li>
                                                    <li class="slide"> <a href="popovers.html"
                                                            class="side-menu__item">Popovers</a> </li>
                                                    <li class="slide"> <a href="progress.html"
                                                            class="side-menu__item">Progress</a> </li>
                                                    <li class="slide"> <a href="spinners.html"
                                                            class="side-menu__item">Spinners</a> </li>
                                                    <li class="slide"> <a href="typography.html"
                                                            class="side-menu__item">Typography</a> </li>
                                                    <li class="slide"> <a href="tooltips.html"
                                                            class="side-menu__item">Tooltips</a> </li>
                                                    <li class="slide"> <a href="toasts.html"
                                                            class="side-menu__item">Toasts</a> </li>
                                                    <li class="slide"> <a href="tags.html"
                                                            class="side-menu__item">Tags</a> </li>
                                                    <li class="slide"> <a href="navs-tabs.html"
                                                            class="side-menu__item">Tabs</a> </li>
                                                    <li class="slide"> <a href="scrollspy.html"
                                                            class="side-menu__item">Scrollspy</a> </li>
                                                    <li class="slide"> <a href="object-fit.html"
                                                            class="side-menu__item">Object Fit</a> </li>
                                                </ul>
                                            </li> <!-- End::slide -->
                                            <!-- Start::slide -->
                                            <li class="slide has-sub"> <a href="javascript:void(0);"
                                                    class="side-menu__item"> <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="side-menu__icon" viewBox="0 0 24 24">
                                                        <path d="M0 0h24v24H0z" fill="none"></path>
                                                        <path
                                                            d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8c.28 0 .5-.22.5-.5 0-.16-.08-.28-.14-.35-.41-.46-.63-1.05-.63-1.65 0-1.38 1.12-2.5 2.5-2.5H16c2.21 0 4-1.79 4-4 0-3.86-3.59-7-8-7zm-5.5 9c-.83 0-1.5-.67-1.5-1.5S5.67 10 6.5 10s1.5.67 1.5 1.5S7.33 13 6.5 13zm3-4C8.67 9 8 8.33 8 7.5S8.67 6 9.5 6s1.5.67 1.5 1.5S10.33 9 9.5 9zm5 0c-.83 0-1.5-.67-1.5-1.5S13.67 6 14.5 6s1.5.67 1.5 1.5S15.33 9 14.5 9zm4.5 2.5c0 .83-.67 1.5-1.5 1.5s-1.5-.67-1.5-1.5.67-1.5 1.5-1.5 1.5.67 1.5 1.5z"
                                                            opacity=".3"></path>
                                                        <path
                                                            d="M12 2C6.49 2 2 6.49 2 12s4.49 10 10 10c1.38 0 2.5-1.12 2.5-2.5 0-.61-.23-1.21-.64-1.67-.08-.09-.13-.21-.13-.33 0-.28.22-.5.5-.5H16c3.31 0 6-2.69 6-6 0-4.96-4.49-9-10-9zm4 13h-1.77c-1.38 0-2.5 1.12-2.5 2.5 0 .61.22 1.19.63 1.65.06.07.14.19.14.35 0 .28-.22.5-.5.5-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.14 8 7c0 2.21-1.79 4-4 4z">
                                                        </path>
                                                        <circle cx="6.5" cy="11.5" r="1.5"></circle>
                                                        <circle cx="9.5" cy="7.5" r="1.5"></circle>
                                                        <circle cx="14.5" cy="7.5" r="1.5"></circle>
                                                        <circle cx="17.5" cy="11.5" r="1.5"></circle>
                                                    </svg> <span class="side-menu__label">Advanced Ui</span> <i
                                                        class="fe fe-chevron-right side-menu__angle"></i> </a>
                                                <ul class="slide-menu child1"
                                                    style="position: relative; left: 0px; top: 0px; margin: 0px; transform: translate3d(119.5px, 472px, 0px);"
                                                    data-popper-placement="bottom">
                                                    <li class="slide side-menu__label1"> <a
                                                            href="javascript:void(0);">Advanced Ui</a> </li>
                                                    <li class="slide"> <a href="accordions-collpase.html"
                                                            class="side-menu__item">Accordions</a> </li>
                                                    <li class="slide"> <a href="carousel.html"
                                                            class="side-menu__item">Carousel</a> </li>
                                                    <li class="slide"> <a href="modals-closes.html"
                                                            class="side-menu__item">Modals</a> </li>
                                                    <li class="slide"> <a href="timeline.html"
                                                            class="side-menu__item">Timeline</a> </li>
                                                    <li class="slide"> <a href="sweet-alerts.html"
                                                            class="side-menu__item">Sweet Alerts</a> </li>
                                                    <li class="slide"> <a href="ratings.html"
                                                            class="side-menu__item">Ratings</a> </li>
                                                    <li class="slide"> <a href="search.html"
                                                            class="side-menu__item">Search</a> </li>
                                                    <li class="slide"> <a href="userlist.html"
                                                            class="side-menu__item">Userlist</a> </li>
                                                    <li class="slide has-sub"> <a href="javascript:void(0);"
                                                            class="side-menu__item">Blog Pages <i
                                                                class="fe fe-chevron-right side-menu__angle"></i></a>
                                                        <ul class="slide-menu child2">
                                                            <li class="slide"> <a href="blog.html"
                                                                    class="side-menu__item">Blog</a> </li>
                                                            <li class="slide"> <a href="blog-details.html"
                                                                    class="side-menu__item">Blog Details</a> </li>
                                                            <li class="slide"> <a href="blog-post.html"
                                                                    class="side-menu__item">Blog Post</a> </li>
                                                        </ul>
                                                    </li>
                                                    <li class="slide"> <a href="offcanvas.html"
                                                            class="side-menu__item">Offcanvas</a> </li>
                                                    <li class="slide"> <a href="placeholders.html"
                                                            class="side-menu__item">Placeholders</a> </li>
                                                    <li class="slide"> <a href="swiperjs.html"
                                                            class="side-menu__item">Swiper JS</a> </li>
                                                </ul>
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