<!DOCTYPE html>
<html>
    <head>
        <title>{{ config('app.name', 'MantaCil') }}</title>

        @section('meta')
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <meta name="robots" content="noindex">
            <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png">
            <link rel="icon" type="image/png" href="/favicons/favicon-32x32.png" sizes="32x32">
            <link rel="icon" type="image/png" href="/favicons/favicon-16x16.png" sizes="16x16">
            <link rel="manifest" href="/favicons/manifest.json">
            <link rel="mask-icon" href="/favicons/safari-pinned-tab.svg" color="#bc6e3c">
            <link rel="shortcut icon" href="/favicons/favicon.ico">
            <meta name="msapplication-config" content="/favicons/browserconfig.xml">
            <meta name="theme-color" content="#0e4688">
        @show

        @section('user-data')
            @if(!is_null(Auth::user()))
                <script>
                    window.MantaCilUser = {!! json_encode(Auth::user()->toVueObject()) !!};
                </script>
            @endif
            @if(!empty($siteConfiguration))
                <script>
                    window.SiteConfiguration = {!! json_encode($siteConfiguration) !!};
                </script>
            @endif
        @show

        @yield('assets')

        @include('layouts.scripts')
        <style>
            body, .mantacil-bg {
                background: linear-gradient(-45deg, #0d1a17, #1A312C, #132420, #0a1411) !important;
                background-size: 400% 400% !important;
                animation: gradientBG 15s ease infinite !important;
                color: #e2e8f0;
            }
            @keyframes gradientBG {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }
            /* Global Glassmorphism base utility */
            .glass-panel {
                background: rgba(26, 49, 44, 0.45) !important;
                backdrop-filter: blur(12px) !important;
                -webkit-backdrop-filter: blur(12px) !important;
                border: 1px solid rgba(246, 193, 91, 0.15) !important;
                box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37) !important;
            }
            .glass-pill {
                background: rgba(19, 36, 32, 0.6) !important;
                backdrop-filter: blur(16px) !important;
                border: 1px solid rgba(255, 255, 255, 0.05) !important;
                border-radius: 50px !important;
            }
        </style>
    </head>
    <body class="{{ $css['body'] ?? 'bg-neutral-50' }}">
        @section('content')
            @yield('above-container')
            @yield('container')
            @yield('below-container')
        @show
        @section('scripts')
            {!! $asset->js('main.js') !!}
        @show
    </body>
</html>
