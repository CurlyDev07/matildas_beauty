<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">  --}}

    {{-- SEO --}}
    <title>{{ seo_title($seo['title']) }}</title>
    <meta property="og:title" content="{{ seo_title($seo['title']) }}" name="title" >
    <meta property="og:site_name " content="shopickers.com" name="site_name">
    <meta property="og:description" content="{{ seo_description($seo['description']) }}" name="description">
    <meta property="og:url" content="{{ url()->current() }}" name="url">
    <meta property="og:type" content="RAM | SSD | GPU | PC | CASE | POWER SUPPLY | MOUSE | KEYBOARD | Shopickers PH " name="type">
    <meta property="og:image" content="{{ seo_image($seo['image']) }}" name="image">
    <meta name="robots" content="{{seo_robots($seo['robots'])}}">
    <link href="{{ url()->current() }}" rel="canonical">
    <link rel="alternate" href="{{ url()->current() }}" hreflang="en-us" />

    {{-- STYLE SHEETS --}}
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="shortcut icon" href="{{ url('favicon.ico') }}" >


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-168677509-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-168677509-1');
    </script>

    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1614979632011184');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1614979632011184&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->

    <style>
        .fb_dialog{
            background: none;
            border-radius: 50%;
            bottom: 35pt!important;
            display: inline;
            height: 45pt;
            padding: 0px;
            position: fixed;
            right: 18pt;
            top: auto;
            width: 45pt;
            z-index: 2147483646;
        }
    </style>
    @yield('css')
    @yield('head_js')
</head>
<body class="trelative bg-color">

    
    

 