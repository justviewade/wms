<!DOCTYPE html>
<html lang="en\us">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Warehouse Management System - {{Session::get('nama')}} </title>
    <link rel="icon" type="image/x-icon" href="{{asset ('assets/img/favicon.png')}}"/>
    <link href="{{asset ('assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset ('assets/js/loader.js')}}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset ('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset ('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset ('assets/css/elements/miscellaneous.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset ('assets/css/elements/breadcrumb.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/components/custom-carousel.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    @yield('scripttop')
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    
</head>
<body class="alt-menu sidebar-noneoverflow">
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <div class="header-container fixed-top">
        <header class="header navbar navbar-expand-sm expand-header">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

            <ul class="navbar-item flex-row ml-auto">
                <!--
                 <li class="nav-item align-self-center" style="padding:15px">
                 <svg class="bi bi-clock" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm8-7A8 8 0 1 1 0 8a8 8 0 0 1 16 0z"/>
                    <path fill-rule="evenodd" d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                </svg>
                    <span>
                    {{date("d/m/yy h:i:sa")}}
                    </span>             
                </li>
                --> 
                <li class="nav-item align-self-center search-animated">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search toggle-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <form class="form-inline search-full form-inline search" role="search">
                        <div class="search-bar">
                            <input type="text" class="form-control search-form-control  ml-lg-auto" placeholder="Cari ...">
                        </div>
                    </form>
                </li>

                <li class="nav-item dropdown language-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="language-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{asset ('assets/img/ina.png')}}" class="flag-width" alt="flag">
                    </a>
                    <div class="dropdown-menu position-absolute" aria-labelledby="language-dropdown">
                        <a class="dropdown-item d-flex" href="javascript:void(0);"><img src="{{asset ('assets/img/ina.png')}}" class="flag-width" alt="flag"> <span class="align-self-center">&nbsp;Bahasa</span></a>
                    </div>
                </li>
                
                <li class="nav-item dropdown message-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="messageDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg><span class="badge badge-primary">1</span>
                    </a>
                    <div class="dropdown-menu position-absolute e-animated e-fadeInUp" aria-labelledby="messageDropdown">
                        <div class="">
                            <a class="dropdown-item">
                                <div class="">
                                    <div class="media notification-new">
                                        <div class="notification-icon">
                                            <div class="icon-svg mr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                                <p class="meta-title mr-3">Pesan Dari WMS</p>
                                                <p class="message-text">Selamat Datang {{Session::get('nama')}}</p>
                                                <p class="meta-time align-self-center mb-0">Today</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <!--
                            <a class="dropdown-item">
                                <div class="">
                                    <div class="media notification-new">
                                        <div class="usr-profile-img mr-3">
                                            <div class="user-profile">
                                                <div class="">KY</div>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                                <p class="meta-user-name mr-3">Kara Young</p>
                                                <p class="message-text">Some quick example text to build the notification ..</p>
                                                <p class="meta-time align-self-center mb-0">2 hours ago</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item">
                                <div class="">
                                    <div class="media notification-new">
                                        <div class="notification-icon">
                                            <div class="icon-svg mr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                                <p class="meta-title mr-3">1 new email</p>
                                                <p class="message-text">Anderson.Daisy@mail.com</p>
                                                <p class="meta-time align-self-center mb-0">Yesterday</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        -->
                    </div>
                </li>

                <li class="nav-item dropdown notification-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg><span class="badge badge-success"></span>
                    </a>
                    <div class="dropdown-menu position-absolute e-animated e-fadeInUp" aria-labelledby="notificationDropdown">
                        <div class="notification-scroll">

                            <div class="dropdown-item">
                                <div class="media">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                                    <div class="media-body">
                                        <div class="notification-para"><span class="user-name">Admin SPS</span> Menyetuji transaksi PBM</div>
                                        <div class="notification-meta-time">2 days ago</div>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="dropdown-item">
                                <div class="media">                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-thumbs-up"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
                                    <div class="media-body">
                                        <div class="notification-para"><span class="user-name">Kelly Young</span> likes your photo</div>
                                        <div class="notification-meta-time">8 mins ago</div>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown-item">
                                <div class="media">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                                    <div class="media-body">
                                        <div class="notification-para">Invitation successfully sent to <span class="user-name">Amy Diaz</span></div>
                                        <div class="notification-meta-time">10 mins ago</div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
                    </a>
                    <div class="dropdown-menu position-absolute e-animated e-fadeInUp" aria-labelledby="userProfileDropdown">
                        <div class="user-profile-section">                            
                            <div class="media mx-auto">
                                @if(Session::get('peran_id') === 1)
                                <img src="{{ asset('assets/img/90x90_admin.png')}}" class="navbar-logo" alt="logo"> 
                                @elseif(Session::get('peran_id') === 2 || Session::get('peran_id') === 3 || Session::get('peran_id') === 4)
                                <img src="{{ asset('assets/img/90x90_sps.png')}}" class="navbar-logo" alt="logo">
                                @elseif(Session::get('peran_id') === 5 || Session::get('peran_id') === 6)
                                <img src="{{ asset('assets/img/90x90_bni.png')}}" class="navbar-logo" alt="logo">
                                @endif  
                                <div class="media-body">
                                    <h5>{{ Session::get('username')}}</h5>
                                    <p>{{ Session::get('nama')}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-item">
                            <a href="user_profile.html">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> <span>My Profile</span>
                            </a>
                        </div>
                        <div class="dropdown-item">
                            <a href="apps_mailbox.html">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-inbox"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline><path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path></svg> <span>My Inbox</span>
                            </a>
                        </div>
                        <div class="dropdown-item">
                            <a href="{{url('gantipassword')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg> <span>Ganti Password</span>
                            </a>
                        </div>
                        <div class="dropdown-item">
                            <a href="{{ url('logout')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> <span>Log Out</span>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container sidebar-closed sbar-open" id="container">

        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">
            <nav id="sidebar">
                <ul class="navbar-nav theme-brand flex-row  text-center">
                    <li class="nav-item theme-logo">
                        <a href="{{ url('dashboard')}}">
                        @if(Session::get('peran_id') === 1)
                        <img src="{{ asset('assets/img/90x90_admin.png')}}" class="navbar-logo" alt="logo"> 
                        @elseif(Session::get('peran_id') === 2 || Session::get('peran_id') === 3 || Session::get('peran_id') === 4)
                        <img src="{{ asset('assets/img/90x90_sps.png')}}" class="navbar-logo" alt="logo">
                        @elseif(Session::get('peran_id') === 5 || Session::get('peran_id') === 6)
                        <img src="{{ asset('assets/img/90x90_bni.png')}}" class="navbar-logo" alt="logo">
                        @endif  
                        </a>
                    </li>
                    <li class="nav-item theme-text">
                        <a href="{{ url('dashboard')}}" class="nav-link">WMS</a>
                    </li>
                </ul>

                <ul class="list-unstyled menu-categories" id="accordionExample">
                    <li class="menu active">
                        <a href="#" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span> Dashboard </span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu recent-submenu mini-recent-submenu list-unstyled show" id="dashboard" data-parent="#accordionExample">
                            <li class="active">
                                <a href="{{ url('dashboard')}}"> Home </a>
                            </li>
                        </ul>
                    </li>
                    @if(Session::get('peran_id') === 1 || Session::get('peran_id') === 5 || Session::get('peran_id') === 6)
                    <li class="menu menu-heading">
                        <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg><span>{{Session::get('nama_peran')}}</span></div>
                    </li>
                    <li class="menu">
                        <a href="#forms" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg>
                                <span>Formulir</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="forms" data-parent="#accordionExample">
                            <li>
                                <a href="{{ url('formbarang')}}"> Data Barang </a>
                            </li>
                        </ul>
                        <ul class="collapse submenu list-unstyled" id="forms" data-parent="#accordionExample">
                            <li>
                                <a href="{{ url('formsupplier')}}"> Data Supplier </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu">
                        <a href="#datatables" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                                <span> Data Master </span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="datatables" data-parent="#accordionExample">
                            <li>
                                <a href="{{ url('listbarang')}}"> Data Master Barang </a>
                            </li>
                        </ul>
                        <ul class="collapse submenu list-unstyled" id="datatables" data-parent="#accordionExample">
                            <li>
                                <a href="{{ url('listsupplier')}}"> Data Master Supplier </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu">
                        <a href="#forms" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                <span> Permohonan </span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="forms" data-parent="#accordionExample">
                            <li>
                                <a href="{{ url('formpbm')}}"> Barang Masuk </a>
                            </li>
                        </ul>
                        <ul class="collapse submenu list-unstyled" id="forms" data-parent="#accordionExample">
                            <li>
                                <a href="{{url('formpbk')}}"> Barang Keluar </a>
                            </li>
                        </ul>
                        <ul class="collapse submenu list-unstyled" id="forms" data-parent="#accordionExample">
                            <li>
                                <a href="{{ url('listpbm')}}"> Data PBM </a>
                            </li>
                        </ul>
                        <ul class="collapse submenu list-unstyled" id="forms" data-parent="#accordionExample">
                            <li>
                                <a href="{{ url('listpbk')}}"> Data PBK </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu">
                        <a href="#forms" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                                <span> Monitoring </span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="forms" data-parent="#accordionExample">
                            <li>
                                <a href="{{ url('listinventory')}}"> Invetori Gudang </a>
                            </li>
                        </ul>
                        <!-- <ul class="collapse submenu list-unstyled" id="forms" data-parent="#accordionExample">
                            <li>
                                <a href=""> Barang Keluar </a>
                            </li>
                        </ul> -->
                    </li>
                    @endif  
                    @if(Session::get('peran_id') === 1 || Session::get('peran_id') === 2 || Session::get('peran_id') === 3 || Session::get('peran_id') === 4)
                    <li class="menu menu-heading">
                        <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg><span>{{Session::get('nama_peran')}}</span></div>
                    </li>
                    <li class="menu">
                        <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                                <span> Experiment Menu Testing</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="submenu2" data-parent="#accordionExample">
                            <li>
                                <a href="javascript:void(0);"> Submenu 1 </a>
                            </li>
                            <li>
                                <a href="#sm2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Submenu 2 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                                <ul class="collapse list-unstyled sub-submenu" id="sm2" data-parent="#submenu2"> 
                                    <li>
                                        <a href="javascript:void(0);"> Sub-Submenu 1 </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);"> Sub-Submenu 2 </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);"> Sub-Submenu 3 </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="collapse submenu list-unstyled" id="submenu2" data-parent="#accordionExample">
                            <li>
                                <a href="javascript:void(0);"> Submenu 1 </a>
                            </li>
                            <li>
                                <a href="#sm2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Submenu 2 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                                <ul class="collapse list-unstyled sub-submenu" id="sm2" data-parent="#submenu2"> 
                                    <li>
                                        <a href="javascript:void(0);"> Sub-Submenu 1 </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);"> Sub-Submenu 2 </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);"> Sub-Submenu 3 </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="menu">
                        <a href="#forms" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg>
                                <span> Formulir </span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="datatables" data-parent="#accordionExample">
                            <li>
                                <a href="{{ url('formbarang')}}"> Data Barang </a>
                            </li>
                        </ul>
                        <ul class="collapse submenu list-unstyled" id="forms" data-parent="#accordionExample">
                            <li>
                                <a href="{{ url('formgudang')}}"> Data Gudang </a>
                            </li>
                        </ul>
                        <ul class="collapse submenu list-unstyled" id="forms" data-parent="#accordionExample">
                            <li>
                                <a href="{{ url('formkategoribarang')}}">  Data Kategori Barang</a>
                            </li>
                        </ul>
                        <ul class="collapse submenu list-unstyled" id="forms" data-parent="#accordionExample">
                            <li>
                                <a href="{{ url('formpelanggan')}}">  Data Pelanggan</a>
                            </li>
                        </ul>
                        <ul class="collapse submenu list-unstyled" id="forms" data-parent="#accordionExample">
                            <li>
                                <a href="{{ url('formsupplier')}}"> Data Supplier </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu">
                        <a href="#datatables" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                                <span> Data Master </span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="datatables" data-parent="#accordionExample">
                            <li>
                                <a href="{{ url('listbarang')}}"> Data Master Barang </a>
                            </li>
                        </ul>
                        <ul class="collapse submenu list-unstyled" id="datatables" data-parent="#accordionExample">
                            <li>
                                <a href="{{ url('listgudang')}}"> Data Master Gudang </a>
                            </li>
                        </ul>
                        <ul class="collapse submenu list-unstyled" id="datatables" data-parent="#accordionExample">
                            <li>
                                <a href="{{ url('listkategoribarang')}}"> Data Master Kategori Barang </a>
                            </li>
                        </ul>
                        <ul class="collapse submenu list-unstyled" id="datatables" data-parent="#accordionExample">
                            <li>
                                <a href="{{ url('listpelanggan')}}"> Data Master Pelanggan </a>                                                                                </a>
                            </li>
                        </ul>
                        <ul class="collapse submenu list-unstyled" id="datatables" data-parent="#accordionExample">
                            <li>
                                <a href="{{ url('listsupplier')}}"> Data Master Supplier </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu">
                        <a href="#forms" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                <span> Proses PBM</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="forms" data-parent="#accordionExample">
                            <li>
                                <a href="{{url('listpbmspsacc')}}"> PBM Masuk {{(\App\Trx_PBM::all()->where('level','=',1)->count() > 0 ) ? '('.\App\Trx_PBM::all()->where('level','=',1)->count().')' : ''}}</a>
                            </li>
                        </ul>
                        <ul class="collapse submenu list-unstyled" id="forms" data-parent="#accordionExample">
                            <li>
                                <a href="{{url('listpbmspsterima')}}"> [O] Penerimaan Barang {{(\App\Trx_PBM::all()->where('level','=',2)->count() > 0 ) ? '('.\App\Trx_PBM::all()->where('level','=',2)->count().')' : ''}} </a>
                            </li>
                        </ul>
                        <ul class="collapse submenu list-unstyled" id="forms" data-parent="#accordionExample">
                            <li>
                                <a href="{{url('listpbmspskekurangan')}}"> [O] Penerimaan Kekurangan {{(\App\Trx_PBM::all()->where('level','=',3)->count() > 0 ) ? '('.\App\Trx_PBM::all()->where('level','=',3)->count().')' : ''}} </a>
                            </li>
                        </ul>
                        <ul class="collapse submenu list-unstyled" id="forms" data-parent="#accordionExample">
                            <li>
                                <a href="{{url('listpbmspsalokasi')}}"> [G] Alokasi Barang {{(\App\Trx_PBM::where('level','=',3)->orWhere('level',4)->count() > 0 ) ? '('.\App\Trx_PBM::where('level','=',3)->orWhere('level',4)->count().')' : ''}}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu">
                        <a href="#forms" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                                <span> Proses PBK</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="forms" data-parent="#accordionExample">
                            <li>
                                <a href="{{url('listpbkspsacc')}}"> PBK Masuk {{(\App\Trx_PBK::all()->where('level','=',1)->count() > 0 ) ? '('.\App\Trx_PBM::all()->where('level','=',1)->count().')' : ''}}</a>
                            </li>
                        </ul>
                        <ul class="collapse submenu list-unstyled" id="forms" data-parent="#accordionExample">
                            <li>
                                <a href="{{url('listpbkstock')}}"> [G] Pehitungan Stok  </a>
                            </li>
                        </ul>
                        <ul class="collapse submenu list-unstyled" id="forms" data-parent="#accordionExample">
                            <li>
                                <a href="{{url('listpbksps3')}}"> [O] Packing & Kirim Barang </a>
                            </li>
                        </ul>
                        <ul class="collapse submenu list-unstyled" id="forms" data-parent="#accordionExample">
                            <li>
                                <a href="{{url('listpbksps4')}}"> Penerimaan</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu">
                        <a href="#forms" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                                <span> Monitoring </span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="forms" data-parent="#accordionExample">
                            <li>
                                <a href="{{ url('formpbm')}}"> Barang Masuk </a>
                            </li>
                        </ul>
                        <ul class="collapse submenu list-unstyled" id="forms" data-parent="#accordionExample">
                            <li>
                                <a href="{{ url('formpbk')}}"> Barang Keluar </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu">
                        <a href="#forms" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                                <span> Laporan </span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="forms" data-parent="#accordionExample">
                            <li>
                                <a href="{{url('inventorimaster')}}"> Inventori </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu">
                        <a href="#forms" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <span> Akun </span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="forms" data-parent="#accordionExample">
                            <li>
                                <a href="{{url('formakun')}}"> Daftar Akun </a>
                            </li>
                            <li>
                                <a href="{{url('listakun')}}"> Manajemen Akun </a>
                            </li>
                        </ul>
                    </li>
                    @endif 
                </ul>
            </nav>
        </div>
        <!--  END SIDEBAR  -->
        
        <!--  BEGIN CONTENT AREA  -->
        @yield('content')
        <!--  END CONTENT AREA  -->
        <div class="col-lg-12">
            <div style="text-align:center;" class="terms-conditions">Copyright © {{ date ('Y') }}. <a href="index.html">PT. Sukma Putra Sarana (SPS) Domestic & Internasional Cargo</a> All Rights Reserved</div>
            <br>
        </div>
  
    <!-- END MAIN CONTAINER -->
    

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset ('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset ('bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset ('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset ('plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset ('assets/js/app.js')}}"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="{{asset ('assets/js/custom.js')}}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    @yield('scriptbuttom')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

</body> 
</html>