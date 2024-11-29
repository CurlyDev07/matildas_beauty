<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title') </title>
    {{-- STYLE SHEETS --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css" integrity="sha512-gMjQeDaELJ0ryCI+FtItusU9MkAifCZcGq789FrzkiM49D8lbDhoaUaIX4ASU187wofMNlgBJ4ckbrXM9sE6Pg==" crossorigin="anonymous" referrerpolicy="no-referrer" />    <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    @yield('favicon')
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <style>
        .input-control {
            width: 100%;
            padding: 12px!important;
            font-size: 14px;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            border: 1px solid #e1e5eb;
            font-weight: 400;
            will-change: border-color,box-shadow;
            border-radius: 0.25rem;
            box-shadow: none;
            transition: box-shadow 250ms cubic-bezier(.27,.01,.38,1.06),border 250ms cubic-bezier(.27,.01,.38,1.06);
        }

        .zoom-in-out-box {
            animation: zoom-in-zoom-out 1s ease infinite;
        }

        @keyframes zoom-in-zoom-out {
            0% {
                transform: scale(1, 1);
            }
            30% {
                transform: scale(1.1, 1.1);
            }
            100% {
                transform: scale(1, 1);
            }
        }

        li{
            list-style-type: disc !important;
        }

        .gredient-border{
            border: linear-gradient(180deg, rgba(255, 106, 0, 1) 0%, rgba(238, 9, 9, 1) 100%);
            background: linear-gradient(#fff, #fff), linear-gradient(to right, #f63705, #fc5b01);
            background-origin: padding-box, border-box;
            background-repeat: no-repeat;
            border: 5px solid transparent;
        }


        .theme-color{
            color: #f7442e;
        }
        
        .theme-bg{
            background: linear-gradient(-180deg, #f53d2d, #f63);
            transition: transform .2s cubic-bezier(.4,0,.2,1);
        }

        .misstisa-bg{
            background-color: #ee2a7b;
        }

        .misstisa-color{
            color: #ee2a7b;
        }

        .ginger-theme-color{
            color: #020702;
        }

        .ginger-theme-bg{
            background: linear-gradient(-180deg, #020702, #164f19);
            transition: transform .2s cubic-bezier(.4,0,.2,1);
        }

        /* SLIDE SHOW */
        .custom-slider{
            position: relative;
            width: 100%;
            margin: auto;
            overflow: hidden;
        }
        .custom-slider img{
            width: 100%;
            display: none;
        }
        img.displaySlide{
            display: block;
            animation-name: fade;
            animation-duration: 1.5s;
        }
        .custom-slider button{
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 2rem;
            padding: 10px 15px;
            background-color: hsla(0, 0%, 0%, 0.5);
            color: white;
            border: none;
            cursor: pointer;
        }
        .prev{
            left: 0;
        }
        .next{
            right: 0;
        }
        @keyframes fade {
            from {opacity: .5}
            to {opacity: 1}
        }


        /* MODAL */
        .modal .modal-content {
            padding: 15px;
        }

        .modal {
            display: none;
            position: fixed;
            left: 0;
            /* top: 0% !important; */
            right: 0;
            background-color: #fafafa;
            padding: 0;
            max-height: 100%;
            width: 100%!important%;
            margin: auto;
            /* overflow-y: auto; */
            overflow: hidden;
            border-radius: 2px;
            will-change: top, opacity;
        }

        .modal-overlay {
            position: fixed;
            z-index: 999;
            top: -25%;
            left: 0;
            bottom: 0;
            right: 0;
            height: 125%;
            width: 100%;
            background: #000;
            display: none;
            will-change: opacity;
        }

        div#order_success_modal {
            max-width: 450px;
        }

        .loader { 
            position: fixed; 
            left: 0px; 
            top: 0px; 
            width: 100%; 
            height: 100%; 
            z-index: 999!important; 
            background: rgba(245,245,245,0.89); 
            background-size: 55px 55px; 
        }

        /* FOR CONFETTI ANIMATION */
        canvas {
            overflow-y: hidden;
            overflow-x: hidden;
            width: 100%;
            margin: 0;
            height: -webkit-fill-available;
            opacity: 70%;
        }

    </style>

    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"  crossorigin="anonymous"></script>
    <script src="{{ asset('js/materialize.min.js') }}"  crossorigin="anonymous"></script>


    <!-- Meta Pixel Code -->

    @yield('pixels')

</head>
<body>
<div class="loader thidden">
    <div class="tmx-auto" style="max-width: 480px;">
        <img src="{{ asset('loader\cart.svg') }}" class="tmx-auto" style="margin-top: 45%;" alt="cart Loading">
        <h1 class="tfont-medium ttext-3xl ttext-center">Your Order is Processing</h1>
        <h1 class="tfont-medium ttext-lg ttext-center">Please Wait...</h1>
        <img src="{{ asset('loader\loading.gif') }}" class="tmx-auto" style="margin-top: -45px;" alt="loader">
    </div>
</div> 

