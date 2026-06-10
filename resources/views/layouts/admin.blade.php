<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ config('app.name', 'MantaCil') }} - @yield('title')</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="_token" content="{{ csrf_token() }}">

        <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="/favicons/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/favicons/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="/favicons/manifest.json">
        <link rel="mask-icon" href="/favicons/safari-pinned-tab.svg" color="#bc6e3c">
        <link rel="shortcut icon" href="/favicons/favicon.ico">
        <meta name="msapplication-config" content="/favicons/browserconfig.xml">
        <meta name="theme-color" content="#0e4688">

        @include('layouts.scripts')

        @section('scripts')
            {!! Theme::css('vendor/select2/select2.min.css?t={cache-version}') !!}
            {!! Theme::css('vendor/bootstrap/bootstrap.min.css?t={cache-version}') !!}
            {!! Theme::css('vendor/adminlte/admin.min.css?t={cache-version}') !!}
            {!! Theme::css('vendor/adminlte/colors/skin-blue.min.css?t={cache-version}') !!}
            {!! Theme::css('vendor/sweetalert/sweetalert.min.css?t={cache-version}') !!}
            {!! Theme::css('vendor/animate/animate.min.css?t={cache-version}') !!}
            {!! Theme::css('css/mantacil.css?t={cache-version}') !!}
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

            <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
            <style>
                /* Global Animated Gradient */
                body, .wrapper, .content-wrapper, .right-side, .main-footer {
                    background: transparent !important;
                }
                body {
                    background: linear-gradient(-45deg, #0d1a17, #1A312C, #132420, #0a1411) !important;
                    background-size: 400% 400% !important;
                    animation: gradientBG 15s ease infinite !important;
                    color: #d7e6e2 !important;
                }
                @keyframes gradientBG {
                    0% { background-position: 0% 50%; }
                    50% { background-position: 100% 50%; }
                    100% { background-position: 0% 50%; }
                }

                /* Header & Navbar - Glass */
                .skin-blue .main-header .logo { background: rgba(19, 36, 32, 0.7) !important; backdrop-filter: blur(10px); color: #F6C15B !important; border-bottom: 1px solid rgba(255,255,255,0.05); }
                .skin-blue .main-header .logo:hover { background: rgba(13, 26, 23, 0.8) !important; }
                .skin-blue .main-header .navbar { background: rgba(26, 49, 44, 0.5) !important; backdrop-filter: blur(10px); border-bottom: 1px solid rgba(255,255,255,0.05); }
                .skin-blue .main-header .navbar .sidebar-toggle:hover { background: rgba(19, 36, 32, 0.6) !important; }
                
                /* Sidebar - Glass */
                .skin-blue .main-sidebar, .skin-blue .left-side { background: rgba(13, 26, 23, 0.6) !important; backdrop-filter: blur(15px); border-right: 1px solid rgba(255,255,255,0.05); }
                .skin-blue .sidebar-menu > li.header { background: transparent !important; color: #F6C15B !important; font-weight: bold; }
                .skin-blue .sidebar-menu > li > a { color: #b8c7ce !important; transition: all 0.3s ease; }
                .skin-blue .sidebar-menu > li > a:hover, .skin-blue .sidebar-menu > li.active > a, .skin-blue .sidebar-menu > li.menu-open > a { color: #ffffff !important; background: rgba(246, 193, 91, 0.1) !important; border-left-color: #F6C15B !important; border-radius: 0 20px 20px 0; margin-right: 10px; }
                
                /* Content Wrapper & Footer */
                .main-footer { border-top: 1px solid rgba(255,255,255,0.05) !important; color: #84b1a8 !important; }
                .content-header > h1 { color: #ffffff !important; text-shadow: 0 2px 4px rgba(0,0,0,0.5); }
                .content-header > .breadcrumb > li > a { color: #F6C15B !important; }
                
                /* Boxes (Glass Cards) */
                .box { 
                    background: rgba(26, 49, 44, 0.45) !important; 
                    backdrop-filter: blur(12px) !important; 
                    color: #d7e6e2 !important; 
                    border-top: 3px solid #F6C15B !important;
                    border-radius: 15px !important;
                    box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37) !important;
                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                }
                .box:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 12px 40px 0 rgba(0, 0, 0, 0.5) !important;
                }
                .box-header { color: #ffffff !important; }
                .box-header.with-border { border-bottom: 1px solid rgba(255,255,255,0.05) !important; }
                .box-body { color: #d7e6e2 !important; }
                .box-footer { background: rgba(19, 36, 32, 0.4) !important; border-top: 1px solid rgba(255,255,255,0.05) !important; border-radius: 0 0 15px 15px !important; }
                
                /* Tables & Inputs */
                .table-striped > tbody > tr:nth-of-type(odd) { background: rgba(19, 36, 32, 0.4) !important; }
                .table-striped > tbody > tr:nth-of-type(even) { background: transparent !important; }
                .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td { border-top: 1px solid rgba(255,255,255,0.05) !important; }
                .form-control { background: rgba(13, 26, 23, 0.6) !important; color: #ffffff !important; border: 1px solid rgba(255,255,255,0.1) !important; border-radius: 8px; transition: border-color 0.3s ease; }
                .form-control:focus { border-color: #F6C15B !important; box-shadow: 0 0 8px rgba(246, 193, 91, 0.5) !important; }
                .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control { background: rgba(13, 26, 23, 0.3) !important; opacity: 0.7; }
                .input-group-addon { background: rgba(13, 26, 23, 0.8) !important; color: #ffffff !important; border: 1px solid rgba(255,255,255,0.1) !important; }
                select.form-control { background: rgba(13, 26, 23, 0.6) !important; }
                
                /* Buttons & Texts */
                .btn-primary { background: linear-gradient(135deg, #F6C15B, #e59020) !important; border: none !important; color: #1A312C !important; font-weight: bold; border-radius: 8px; box-shadow: 0 4px 15px rgba(246, 193, 91, 0.3); transition: all 0.3s ease; }
                .btn-primary:hover, .btn-primary:active, .btn-primary.focus { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(246, 193, 91, 0.5); color: #132420 !important; }
                .btn-default { background: rgba(19, 36, 32, 0.6) !important; color: #ffffff !important; border: 1px solid rgba(255,255,255,0.1) !important; border-radius: 8px; transition: all 0.3s ease; }
                .btn-default:hover { background: rgba(13, 26, 23, 0.8) !important; color: #F6C15B !important; transform: translateY(-2px); }
                .text-primary { color: #F6C15B !important; }
                .text-muted { color: #84b1a8 !important; }
                .help-block { color: #84b1a8 !important; }
                h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 { color: #ffffff !important; }
                a { color: #F6C15B; transition: color 0.3s ease; }
                a:hover { color: #e59020; text-shadow: 0 0 8px rgba(246, 193, 91, 0.5); }
                
                /* Small adjustments for labels */
                label { color: #d7e6e2 !important; }
            </style>
        @show
    </head>
    <body class="hold-transition skin-blue fixed sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <a href="{{ route('index') }}" class="logo">
                    <img src="/assets/MantaCil.png" alt="MantaCil" style="height: 35px; margin-top: 7px;" />
                </a>
                <nav class="navbar navbar-static-top">
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="user-menu">
                                <a href="{{ route('account') }}">
                                    <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(Auth::user()->email)) }}?s=160" class="user-image" alt="User Image">
                                    <span class="hidden-xs">{{ Auth::user()->name_first }} {{ Auth::user()->name_last }}</span>
                                </a>
                            </li>
                            <li>
                                <li><a href="{{ route('index') }}" data-toggle="tooltip" data-placement="bottom" title="Exit Admin Control"><i class="fa fa-server"></i></a></li>
                            </li>
                            <li>
                                <li><a href="{{ route('auth.logout') }}" id="logoutButton" data-toggle="tooltip" data-placement="bottom" title="Logout"><i class="fa fa-sign-out"></i></a></li>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <aside class="main-sidebar">
                <section class="sidebar">
                    <ul class="sidebar-menu">
                        <li class="header">ADMINISTRASI DASAR</li>
                        <li class="{{ Route::currentRouteName() !== 'admin.index' ?: 'active' }}">
                            <a href="{{ route('admin.index') }}">
                                <i class="fa fa-home"></i> <span>Ikhtisar</span>
                            </a>
                        </li>
                        <li class="{{ ! starts_with(Route::currentRouteName(), 'admin.settings') ?: 'active' }}">
                            <a href="{{ route('admin.settings')}}">
                                <i class="fa fa-wrench"></i> <span>Pengaturan</span>
                            </a>
                        </li>
                        <li class="{{ ! starts_with(Route::currentRouteName(), 'admin.api') ?: 'active' }}">
                            <a href="{{ route('admin.api.index')}}">
                                <i class="fa fa-gamepad"></i> <span>API Aplikasi</span>
                            </a>
                        </li>
                        <li class="header">MANAJEMEN</li>
                        <li class="{{ ! starts_with(Route::currentRouteName(), 'admin.databases') ?: 'active' }}">
                            <a href="{{ route('admin.databases') }}">
                                <i class="fa fa-database"></i> <span>Basis Data</span>
                            </a>
                        </li>
                        <li class="{{ ! starts_with(Route::currentRouteName(), 'admin.locations') ?: 'active' }}">
                            <a href="{{ route('admin.locations') }}">
                                <i class="fa fa-globe"></i> <span>Lokasi</span>
                            </a>
                        </li>
                        <li class="{{ ! starts_with(Route::currentRouteName(), 'admin.nodes') ?: 'active' }}">
                            <a href="{{ route('admin.nodes') }}">
                                <i class="fa fa-sitemap"></i> <span>Node</span>
                            </a>
                        </li>
                        <li class="{{ ! starts_with(Route::currentRouteName(), 'admin.servers') ?: 'active' }}">
                            <a href="{{ route('admin.servers') }}">
                                <i class="fa fa-server"></i> <span>Server</span>
                            </a>
                        </li>
                        <li class="{{ ! starts_with(Route::currentRouteName(), 'admin.users') ?: 'active' }}">
                            <a href="{{ route('admin.users') }}">
                                <i class="fa fa-users"></i> <span>Pengguna</span>
                            </a>
                        </li>
                        <li class="header">MANAJEMEN LAYANAN</li>
                        <li class="{{ ! starts_with(Route::currentRouteName(), 'admin.mounts') ?: 'active' }}">
                            <a href="{{ route('admin.mounts') }}">
                                <i class="fa fa-magic"></i> <span>Mount (Penyimpanan)</span>
                            </a>
                        </li>
                        <li class="{{ ! starts_with(Route::currentRouteName(), 'admin.nests') ?: 'active' }}">
                            <a href="{{ route('admin.nests') }}">
                                <i class="fa fa-th-large"></i> <span>Sarang (Nests)</span>
                            </a>
                        </li>
                    </ul>
                </section>
            </aside>
            <div class="content-wrapper">
                <section class="content-header">
                    @yield('content-header')
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    There was an error validating the data provided.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @foreach (Alert::getMessages() as $type => $messages)
                                @foreach ($messages as $message)
                                    <div class="alert alert-{{ $type }} alert-dismissable" role="alert">
                                        {{ $message }}
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                    @yield('content')
                </section>
            </div>
            <footer class="main-footer">
                <div class="pull-right small text-gray" style="margin-right:10px;margin-top:-7px;">
                    <strong><i class="fa fa-fw {{ $appIsGit ? 'fa-git-square' : 'fa-code-fork' }}"></i></strong> {{ $appVersion }}<br />
                    <strong><i class="fa fa-fw fa-clock-o"></i></strong> {{ round(microtime(true) - LARAVEL_START, 3) }}s
                </div>
                Copyright &copy; 2015 - {{ date('Y') }} <a href="#">MantaCil Software</a>.
            </footer>
        </div>
        @section('footer-scripts')
            <script src="/js/keyboard.polyfill.js" type="application/javascript"></script>
            <script>keyboardeventKeyPolyfill.polyfill();</script>

            {!! Theme::js('vendor/jquery/jquery.min.js?t={cache-version}') !!}
            {!! Theme::js('vendor/sweetalert/sweetalert.min.js?t={cache-version}') !!}
            {!! Theme::js('vendor/bootstrap/bootstrap.min.js?t={cache-version}') !!}
            {!! Theme::js('vendor/slimscroll/jquery.slimscroll.min.js?t={cache-version}') !!}
            {!! Theme::js('vendor/adminlte/app.min.js?t={cache-version}') !!}
            {!! Theme::js('vendor/bootstrap-notify/bootstrap-notify.min.js?t={cache-version}') !!}
            {!! Theme::js('vendor/select2/select2.full.min.js?t={cache-version}') !!}
            {!! Theme::js('js/admin/functions.js?t={cache-version}') !!}
            <script src="/js/autocomplete.js" type="application/javascript"></script>

            @if(Auth::user()->root_admin)
                <script>
                    $('#logoutButton').on('click', function (event) {
                        event.preventDefault();

                        var that = this;
                        swal({
                            title: 'Do you want to log out?',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d9534f',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Log out'
                        }, function () {
                             $.ajax({
                                type: 'POST',
                                url: '{{ route('auth.logout') }}',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                },complete: function () {
                                    window.location.href = '{{route('auth.login')}}';
                                }
                        });
                    });
                });
                </script>
            @endif

            <script>
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip();
                })
            </script>
        @show
    </body>
</html>
