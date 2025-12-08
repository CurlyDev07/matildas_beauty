<?php

// Products array - easy to manage and update
$products = [
    [
        'id' => 0,
        'name' => '1Pc MissTisa Set',
        'price' => 649,
        'image' => 'https://matildasbeauty.com/filemanager/6680dcdecd7042588a0a02b32f4bf3c3.png',
        'description' => 'Advanced anti-aging and whitening serum',
        'promo' => [
            [
                'qty' => 2,
                'bundle_price' => 849
            ]
        ]   
    ],
    [
        'id' => 1, 
        'name' => 'Buy 1 Take 1 Get Free Vitamin C',
        'price' => 849,
        'image' => 'https://matildasbeauty.com/filemanager/61d432d1a5144aee8cbd8be22a357f08.png',
        'description' => 'Advanced anti-aging and whitening serum',
    ],
   
];

// Convert products to JavaScript format for frontend
$products_json = json_encode($products);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MissTisa | Matilda's Beauty</title>
    {{-- STYLE SHEETS --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css" integrity="sha512-gMjQeDaELJ0ryCI+FtItusU9MkAifCZcGq789FrzkiM49D8lbDhoaUaIX4ASU187wofMNlgBJ4ckbrXM9sE6Pg==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
    
    <!-- <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}"> -->

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            prefix: 't',
            theme: {
                extend: {
                    colors: {
                        'custom-pink': '#e91e63',
                        'custom-purple': '#9c27b0'
                    }
                }
            }
        }
    </script>

    <link rel="shortcut icon" href="{{ asset('images/icons/favicon.ico') }}" >
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- TESTIMONIAL CSS -->
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <style>
        .ttext-brand-pink{
            color: #ec407a;
        }
        .tbg-brand-pink {
            --tw-bg-opacity: 1;
            background-color: rgb(236 64 122 / var(--tw-bg-opacity, 1));
        }
    </style>
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

    </style>


    <style>/* Success Modal Overlay */
        
        .success-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: linear-gradient(64deg, #e91e63 0%, #e91e63 45%, #9c27b0 100%);
            z-index: 9999;
            animation: success-modal-fadeIn 0.3s ease-in-out;
            padding: 20px;
            overflow-y: auto;
        }

        .success-modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Close Button */
        .success-modal-close-btn {
            position: absolute;
            top: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: linear-gradient(64deg, #e91e63 0%, #e91e63 45%, #9c27b0 100%);
            border: 1px solid white;
            border-radius: 50%;
            color: white;
            font-size: 24px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            z-index: 10001;
        }

        .success-modal-close-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        /* Success Content */
        .success-modal-content {
            background: white;
            border-radius: 20px;
            padding: 40px 30px;
            margin: 20px;
            max-width: 500px;
            width: 100%;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            animation: success-modal-slideUp 0.4s ease-out;
            position: relative;
            max-height: calc(100vh - 40px);
            overflow-y: auto;
        }

        /* Success Icon */
        .success-modal-icon {
            width: 65px;
            height: 65px;
            background: linear-gradient(135deg, #e91e63 0%, #e91e63 70%, #9c27b0 100%);
            border-radius: 50%;
            margin: 0 auto 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: success-modal-bounce 0.6s ease-out;
        }

        .success-modal-icon::before {
            content: '✓';
            color: white;
            font-size: 40px;
            font-weight: bold;
        }

            /* Typography */
        .success-modal-title {
            color: #333;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .success-modal-message {
            color: #666;
            font-size: 14px;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        /* Order Details */
        .success-modal-order-details {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 12px 20px;
            padding-bottom: 0px;
            margin: 2px 0;
            text-align: left;
        }

        .success-modal-detail-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 7px;
            padding-bottom: 7px;
            border-bottom: 1px dashed #dbdbdb;
        }

        .success-modal-detail-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .success-modal-detail-label {
            font-weight: 600;
            color: #333;
            font-size: 15px;
            min-width: 80px;
        }

        .success-modal-detail-value {
            color: #666;
            font-size: 14px;
            flex: 1;
            text-align: right;
        }

        .success-modal-customer-name {
            color: #e91e63;
            font-weight: 600;
        }

        .success-modal-promo-text {
            line-height: 1.6;
            max-width: 280px;
        }

        .success-modal-total-amount {
            color: #e91e63;
            font-size: 22px;
            font-weight: bold;
        }

        /* Action Buttons */
        .success-modal-action-buttons {
            margin-top: 30px;
            display: flex;
            gap: 12px;
            justify-content: center;
        }

        .success-modal-btn {
            padding: 12px 25px;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }


        .success-modal-btn-primary {
            background: linear-gradient(135deg, #e91e63 0%, #e91e63 70%, #9c27b0 100%);
            color: white;
        }

        .success-modal-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(233, 30, 99, 0.3);
        }
        /* Animations */
        @keyframes success-modal-fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes success-modal-slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes success-modal-bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-8px);
            }
            60% {
                transform: translateY(-4px);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .success-modal {
                padding: 15px;
            }
            
            .success-modal-content {
                margin: 0px;
                padding: 25px 20px;
                max-height: calc(100vh - 30px);
            }

            .success-modal-title {
                font-size: 22px;
            }

            .success-modal-close-btn {
                top: 20px;
                right: 20px;
                width: 40px;
                height: 40px;
                font-size: 18px;
            }

            .success-modal-action-buttons {
                flex-direction: column;
            }

            .success-modal-detail-row {
                flex-direction: column;
                gap: 5px;
            }

            .success-modal-detail-value {
                text-align: left;
            }

            .success-modal-promo-text {
                max-width: 100%;
            }
        }
    </style>


    <style> /* Loading Modal Overlay */

        /* Loading Overlay */
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: linear-gradient(135deg, #e91e63 0%, #e91e63 70%, #9c27b0 100%);
            z-index: 10000;
            animation: loading-fadeIn 0.3s ease-in-out;
        }

        .loading-overlay.show {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        /* Loading Content */
        .loading-content {
            text-align: center;
            color: white;
        }

        /* Animated Skincare Icons */
        .loading-animation {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto 40px;
        }

        /* Main Bottle Animation */
        .skincare-bottle {
            width: 60px;
            height: 80px;
            background: white;
            border-radius: 8px 8px 15px 15px;
            position: absolute;
            top: 20px;
            left: 30px;
            animation: loading-bounce 2s ease-in-out infinite;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .skincare-bottle::before {
            content: '';
            position: absolute;
            top: -8px;
            left: 15px;
            width: 30px;
            height: 12px;
            background: #f8f9fa;
            border-radius: 6px 6px 0 0;
        }

        .skincare-bottle::after {
            content: '';
            position: absolute;
            top: 10px;
            left: 10px;
            width: 40px;
            height: 50px;
            background: linear-gradient(135deg, #e91e63, #f8bbd9);
            border-radius: 4px;
            opacity: 0.8;
        }

        /* Floating Bubbles */
        .bubble {
            position: absolute;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            animation: loading-float 3s ease-in-out infinite;
        }

        .bubble:nth-child(1) {
            width: 12px;
            height: 12px;
            top: 15px;
            left: 10px;
            animation-delay: 0s;
        }

        .bubble:nth-child(2) {
            width: 8px;
            height: 8px;
            top: 30px;
            right: 15px;
            animation-delay: 1s;
        }

        .bubble:nth-child(3) {
            width: 15px;
            height: 15px;
            bottom: 20px;
            left: 20px;
            animation-delay: 2s;
        }

        .bubble:nth-child(4) {
            width: 10px;
            height: 10px;
            bottom: 35px;
            right: 10px;
            animation-delay: 0.5s;
        }

        /* Loading Text */
        .loading-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 15px;
            animation: loading-pulse 2s ease-in-out infinite;
        }

        .loading-message {
            font-size: 16px;
            opacity: 0.9;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        /* Progress Dots */
        .loading-dots {
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        .loading-dot {
            width: 12px;
            height: 12px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            animation: loading-dot-pulse 1.5s ease-in-out infinite;
        }

        .loading-dot:nth-child(1) { animation-delay: 0s; }
        .loading-dot:nth-child(2) { animation-delay: 0.3s; }
        .loading-dot:nth-child(3) { animation-delay: 0.6s; }

        /* Animations */
        @keyframes loading-fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes loading-bounce {
            0%, 100% { 
                transform: translateY(0px) rotate(0deg); 
            }
            50% { 
                transform: translateY(-15px) rotate(5deg); 
            }
        }

        @keyframes loading-float {
            0%, 100% { 
                transform: translateY(0px) scale(1);
                opacity: 0.8;
            }
            50% { 
                transform: translateY(-20px) scale(1.2);
                opacity: 1;
            }
        }

        @keyframes loading-pulse {
            0%, 100% { 
                opacity: 1;
                transform: scale(1);
            }
            50% { 
                opacity: 0.8;
                transform: scale(1.05);
            }
        }

        @keyframes loading-dot-pulse {
            0%, 100% { 
                transform: scale(1);
                opacity: 0.6;
            }
            50% { 
                transform: scale(1.5);
                opacity: 1;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .loading-animation {
                width: 100px;
                height: 100px;
            }

            .skincare-bottle {
                width: 50px;
                height: 70px;
                left: 25px;
            }

            .loading-title {
                font-size: 24px;
            }

            .loading-message {
                font-size: 14px;
                padding: 0 20px;
            }
        }

        /* Demo page styling */
        .demo-page {
            padding: 50px;
            text-align: center;
        }

        .demo-btn {
            padding: 15px 30px;
            background: #e91e63;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            margin: 10px;
        }

        .demo-btn:hover {
            background: #c2185b;
        }
    </style>

    <style>/* Disable text selection and long press */
        * {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-touch-callout: none;
            -webkit-tap-highlight-color: transparent;
        }
        
        /* Allow text selection only for input fields */
        input, textarea {
            -webkit-user-select: text;
            -moz-user-select: text;
            -ms-user-select: text;
            user-select: text;
            -webkit-touch-callout: default;
        }
        
        /* Custom gradient background */
        .bg-gradient-purple-pink {
            background: linear-gradient(135deg, #9c27b0 0%, #e91e63 100%);
        }
        
        /* Default state for all checkmarks */
        .check-circle {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-weight: bold !important;
            background-color: transparent !important;
            border: 2px solid #d1d5db !important;
            color: transparent !important;
        }
        
        /* Selected state styles */
        .product-selected {
            border-color: #e91e63 !important;
            background-color: #fdf2f8 !important;
        }
        
        .product-selected .check-circle {
            background-color: #e91e63 !important;
            color: white !important;
            border: 2px solid #e91e63 !important;
        }
        
        /* Unselected state styles */
        .product-unselected .check-circle {
            background-color: transparent !important;
            border: 2px solid #d1d5db !important;
            color: transparent !important;
        }
        
        /* Beautiful popup modal styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .modal-overlay.show {
            opacity: 1;
            visibility: visible;
        }
        
        .modal-content {
            background: white;
            border-radius: 16px;
            padding: 40px 30px;
            max-width: 450px;
            width: 90%;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            transform: scale(0.9) translateY(20px);
            transition: all 0.3s ease;
            position: relative;
        }
        
        .modal-overlay.show .modal-content {
            transform: scale(1) translateY(0);
        }
        
        .modal-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: 0 auto 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            color: white;
            background: linear-gradient(135deg, #e91e63, #ad1457);
        }
        
        .modal-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #2d3748;
            line-height: 1.2;
        }
        
        .modal-message {
            font-size: 20px;
            color: #4a5568;
            margin-bottom: 30px;
            line-height: 1.4;
        }
        
        .modal-button {
            background: linear-gradient(135deg, #e91e63, #ad1457);
            color: white;
            border: none;
            padding: 16px 40px;
            border-radius: 25px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 140px;
        }
        
        .modal-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(233, 30, 99, 0.4);
        }
        
        .missing-fields {
            background: #fef2f2;
            border: 2px solid #fca5a5;
            border-radius: 12px;
            padding: 20px;
            margin: 20px 0;
            text-align: left;
        }
        
        .missing-fields h4 {
            margin: 0 0 15px 0;
            color: #dc2626;
            font-weight: bold;
            font-size: 18px;
        }
        
        .missing-fields ul {
            margin: 0;
            padding-left: 25px;
            color: #dc2626;
        }
        
        .missing-fields li {
            margin-bottom: 8px;
            font-size: 16px;
            line-height: 1.3;
        }
    </style>

    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"  crossorigin="anonymous"></script>
    {{-- <script src="{{ asset('js/materialize.min.js') }}"  crossorigin="anonymous"></script> --}}

    @if (!request()->test)
        <!-- Meta Pixel Code -->
        <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '375777585581364');
            fbq('track', 'PageView');
            </script>
            <noscript><img loading="lazy" height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=375777585581364&ev=PageView&noscript=1"
        /></noscript>
        <!-- End Meta Pixel Code -->
    @endif

</head>
<body>

    <div style="scroll-behavior: smooth;max-width: 480px;" class="tmx-auto" id="body">

        <img  src="https://matildasbeauty.com/filemanager/2c921a7a56d84181b33af588873c435f.webp" width="480" height="480" class="tw-full tmb-1" alt="#1 Kulubot Remover">

        <div class="trelative tmax-w-[480px] tw-full taspect-square tbg-white tshadow-2xl toverflow-hidden tmb-10">

            <div id="slider-track" class="tflex th-full ttransition-transform tduration-500 tease-in-out tww-full">
                <div class="tflex-shrink-0 tw-full th-full trelative">
                    <img src="https://matildasbeauty.com/filemanager/0a951067295d4c7d81d85610b5c49547.webp" width="412" height="412" class="tobject-fill th-full tw-full" alt="Testimonial 1">
                    
                    <span class="tabsolute ttop-4 tleft-4 tbg-black/60 ttext-white ttext-xs tuppercase tfont-bold tpx-3 tpy-1 trounded z-10">Before</span>
                    <span class="tabsolute tbg-brand-pink tfont-medium tpx-3 tpy-1 trounded-full tshadow-sm ttext-[10px] ttext-white ttop-4 z-10" style="left: 28%;">3 Days</span>

                    <span class="tabsolute ttop-4 tright-4 tbg-black/60 ttext-white ttext-xs tuppercase tfont-bold tpx-3 tpy-1 trounded z-10">After</span>
                    <span class="tabsolute tbg-green-500 tfont-medium tpx-3 tpy-1 trounded-full tshadow-sm ttext-[10px] ttext-white z-10" style="top: 5%; left: 52%;">5 Weeks</span>

                    <div class="tabsolute tbottom-0 tleft-0 tright-0 tbg-gradient-to-t tfrom-black/90 tvia-black/60 tto-transparent tpt-20 tpb-6 tpx-6 ttext-white">
                        <p class="tfont-bold ttext-sm tmb-1">Maria F. (42 yrs old)</p>
                        <p class="ttext-sm tleading-relaxed titalic ttext-gray-100">
                            “Sis, akala ko wala nang pag-asa yung melasma ko.
                            Pero after 7 weeks, ibang-iba — mas clear at mas fresh na talaga.”
                        </p>
                    </div>
                </div><!-- before and after 7-->

                <div class="tflex-shrink-0 tw-full th-full trelative">
                    <img loading="lazy" src="https://matildasbeauty.com/filemanager/52a23f367576404da69ed185a24a5996.webp" width="412" height="412"  class="tobject-fill th-full tw-full" alt="Testimonial 1">
                    
                    <span class="tabsolute ttop-4 tleft-4 tbg-black/60 ttext-white ttext-xs tuppercase tfont-bold tpx-3 tpy-1 trounded z-10">Before</span>
                    <span class="tabsolute tbg-brand-pink tfont-medium tpx-3 tpy-1 trounded-full tshadow-sm ttext-[10px] ttext-white ttop-4 z-10" style="left: 28%;">2 Weeks</span>

                    <span class="tabsolute ttop-4 tright-4 tbg-black/60 ttext-white ttext-xs tuppercase tfont-bold tpx-3 tpy-1 trounded z-10">After</span>
                    <span class="tabsolute tbg-green-500 tfont-medium tpx-3 tpy-1 trounded-full tshadow-sm ttext-[10px] ttext-white z-10" style="top: 5%; left: 52%;">7 Weeks</span>

                    <div class="tabsolute tbottom-0 tleft-0 tright-0 tbg-gradient-to-t tfrom-black/90 tvia-black/60 tto-transparent tpt-20 tpb-6 tpx-6 ttext-white">
                        <p class="tfont-bold ttext-sm tmb-1">Marites L. (45 yrs old)</p>
                        <p class="ttext-sm tleading-relaxed titalic ttext-gray-100">
                            "Nag-lighten talaga yung melasma ko after a few weeks.
                            Mas angat yung glow ko ngayon."
                        </p>
                    </div>
                </div><!-- before and after 2-->

                <div class="tflex-shrink-0 tw-full th-full trelative">
                    <img loading="lazy" src="https://matildasbeauty.com/filemanager/9f5c0a04a28a4a379806936e30a63ec9.webp" width="412" height="412"   class="tobject-fill th-full tw-full" alt="Testimonial 2">
                    
                    <span class="tabsolute ttop-4 tleft-4 tbg-black/60 ttext-white ttext-xs tuppercase tfont-bold tpx-3 tpy-1 trounded z-10">Before</span>
                    <span class="tabsolute tbg-brand-pink tfont-medium tpx-3 tpy-1 trounded-full tshadow-sm ttext-[10px] ttext-white ttop-4 z-10" style="left: 28%;">Day 1</span>

                    <span class="tabsolute ttop-4 tright-4 tbg-black/60 ttext-white ttext-xs tuppercase tfont-bold tpx-3 tpy-1 trounded z-10">After</span>
                    <span class="tabsolute tbg-green-500 tfont-medium tpx-3 tpy-1 trounded-full tshadow-sm ttext-[10px] ttext-white z-10" style="top: 5%; left: 52%;">3 Weeks</span>

                    <div class="tabsolute tbottom-0 tleft-0 tright-0 tbg-gradient-to-t tfrom-black/90 tvia-black/60 tto-transparent tpt-20 tpb-6 tpx-6 ttext-white">
                        <p class="tfont-bold ttext-sm tmb-1">Mika T. (36 yrs old)</p>
                        <p class="ttext-sm tleading-relaxed titalic ttext-gray-100">
                            "3 weeks pa lang, sis… lumalambot na yung melasma ko.
                            Nakikita ko na yung glow ko unti-unti bumabalik."
                        </p>
                    </div>
                </div><!-- before and after 8-->

                <div class="tflex-shrink-0 tw-full th-full trelative">
                    <img loading="lazy" src="https://matildasbeauty.com/filemanager/a7da15f4fc6f4d82aab6d498202e29d5.webp" width="412" height="412"  class="tobject-fill th-full tw-full" alt="Testimonial 1">
                    
                    <span class="tabsolute ttop-4 tleft-4 tbg-black/60 ttext-white ttext-xs tuppercase tfont-bold tpx-3 tpy-1 trounded z-10">Before</span>
                    <span class="tabsolute tbg-brand-pink tfont-medium tpx-3 tpy-1 trounded-full tshadow-sm ttext-[10px] ttext-white ttop-4 z-10" style="left: 28%;">0 Day</span>

                    <span class="tabsolute ttop-4 tright-4 tbg-black/60 ttext-white ttext-xs tuppercase tfont-bold tpx-3 tpy-1 trounded z-10">After</span>
                    <span class="tabsolute tbg-green-500 tfont-medium tpx-3 tpy-1 trounded-full tshadow-sm ttext-[10px] ttext-white z-10" style="top: 5%; left: 52%;">5 Weeks</span>

                    <div class="tabsolute tbottom-0 tleft-0 tright-0 tbg-gradient-to-t tfrom-black/90 tvia-black/60 tto-transparent tpt-20 tpb-6 tpx-6 ttext-white">
                        <p class="tfont-bold ttext-sm tmb-1">Tessa J. (41 yrs old)</p>
                        <p class="ttext-sm tleading-relaxed titalic ttext-gray-100">
                            “Ang bilis nag-soften ng melasma ko.
                            After 7 weeks, mas malinaw at mas fresh na talaga yung skin ko.”
                        </p>
                    </div>
                </div><!-- before and after 9-->

                <div class="tflex-shrink-0 tw-full th-full trelative">
                    <img loading="lazy" src="https://matildasbeauty.com/filemanager/a0999349fc354961832984ac6c2e2a04.webp" width="412" height="412"  class="tobject-fill th-full tw-full" alt="Testimonial 2">
                    
                    <span class="tabsolute ttop-4 tleft-4 tbg-black/60 ttext-white ttext-xs tuppercase tfont-bold tpx-3 tpy-1 trounded z-10">Before</span>
                    <span class="tabsolute tbg-brand-pink tfont-medium tpx-3 tpy-1 trounded-full tshadow-sm ttext-[10px] ttext-white ttop-4 z-10" style="left: 28%;">Day 1</span>

                    <span class="tabsolute ttop-4 tright-4 tbg-black/60 ttext-white ttext-xs tuppercase tfont-bold tpx-3 tpy-1 trounded z-10">After</span>
                    <span class="tabsolute tbg-green-500 tfont-medium tpx-3 tpy-1 trounded-full tshadow-sm ttext-[10px] ttext-white z-10" style="top: 5%; left: 52%;">4 Weeks</span>

                    <div class="tabsolute tbottom-0 tleft-0 tright-0 tbg-gradient-to-t tfrom-black/90 tvia-black/60 tto-transparent tpt-20 tpb-6 tpx-6 ttext-white">
                        <p class="tfont-bold ttext-sm tmb-1">Minda T. (52 yrs old)</p>
                        <p class="ttext-sm tleading-relaxed titalic ttext-gray-100">
                            "4 weeks pa lang, sis… ang laking ginhawa sa melasma ko.
                            Mas malinaw yung skin ko at mas confident na ulit ako."
                        </p>
                    </div>
                </div><!-- before and after 10-->

                <div class="tflex-shrink-0 tw-full th-full trelative">
                    <img loading="lazy" src="https://matildasbeauty.com/filemanager/b31c1b82909c434da6577530880207fb.webp" width="412" height="412" class="tobject-fill th-full tw-full" alt="Testimonial 1">
                    
                    <span class="tabsolute ttop-4 tleft-4 tbg-black/60 ttext-white ttext-xs tuppercase tfont-bold tpx-3 tpy-1 trounded z-10">Before</span>
                    <span class="tabsolute tbg-brand-pink tfont-medium tpx-3 tpy-1 trounded-full tshadow-sm ttext-[10px] ttext-white ttop-4 z-10" style="left: 28%;">2 Weeks</span>

                    <span class="tabsolute ttop-4 tright-4 tbg-black/60 ttext-white ttext-xs tuppercase tfont-bold tpx-3 tpy-1 trounded z-10">After</span>
                    <span class="tabsolute tbg-green-500 tfont-medium tpx-3 tpy-1 trounded-full tshadow-sm ttext-[10px] ttext-white z-10" style="top: 5%; left: 52%;">7 Weeks</span>

                    <div class="tabsolute tbottom-0 tleft-0 tright-0 tbg-gradient-to-t tfrom-black/90 tvia-black/60 tto-transparent tpt-20 tpb-6 tpx-6 ttext-white">
                        <p class="tfont-bold ttext-sm tmb-1">Chinie J. (41 yrs old)</p>
                        <p class="ttext-sm tleading-relaxed titalic ttext-gray-100">
                            "ang bilis nag-soften ng melasma ko.
                            After 7 weeks, mas malinaw at mas fresh na talaga yung skin ko."
                        </p>
                    </div>
                </div><!-- before and after 11-->

                <div class="tflex-shrink-0 tw-full th-full trelative">
                    <img loading="lazy" src="https://matildasbeauty.com/filemanager/9eec8f529fa744f2b85fa9cc44839409.webp" width="412" height="412" class="tobject-fill th-full tw-full" alt="Testimonial 2">
                    
                    <span class="tabsolute ttop-4 tleft-4 tbg-black/60 ttext-white ttext-xs tuppercase tfont-bold tpx-3 tpy-1 trounded z-10">Before</span>
                    <span class="tabsolute tbg-brand-pink tfont-medium tpx-3 tpy-1 trounded-full tshadow-sm ttext-[10px] ttext-white ttop-4 z-10" style="left: 28%;">Day 1</span>

                    <span class="tabsolute ttop-4 tright-4 tbg-black/60 ttext-white ttext-xs tuppercase tfont-bold tpx-3 tpy-1 trounded z-10">After</span>
                    <span class="tabsolute tbg-green-500 tfont-medium tpx-3 tpy-1 trounded-full tshadow-sm ttext-[10px] ttext-white z-10" style="top: 5%; left: 52%;">4 Weeks</span>

                    <div class="tabsolute tbottom-0 tleft-0 tright-0 tbg-gradient-to-t tfrom-black/90 tvia-black/60 tto-transparent tpt-20 tpb-6 tpx-6 ttext-white">
                        <p class="tfont-bold ttext-sm tmb-1">Minda T. (52 yrs old)</p>
                        <p class="ttext-sm tleading-relaxed titalic ttext-gray-100">
                            “Hindi ko in-expect na ganito kabilis.
                            4 weeks and sis, mas fresh na talaga yung face ko.”
                        </p>
                    </div>
                </div><!-- before and after 12-->

            </div>

            <button id="prev-btn" class="tabsolute ttop-1/2 tleft-2 -ttranslate-y-1/2 tbg-black/40 thover:tbg-black/60 ttext-white trounded-full tp-3 ttransition-colors tfocus:toutline-none z-20">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="tw-5 th-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </button>
            <button id="next-btn" class="tabsolute ttop-1/2 tright-2 -ttranslate-y-1/2 tbg-black/40 thover:tbg-black/60 ttext-white trounded-full tp-3 ttransition-colors tfocus:toutline-none z-20">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="tw-5 th-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>
        </div><!-- SLIDER BEFORE AND AFTER -->
          
        <div class="tfont-semibold tmx-3 tmb-10 tmy-5 ttext-center">
            <h1 class="ttext-4xl" style="color: #3a1b31;">Bakit dumadami ang pekas after manganak?</h1>
        </div>

        <div class="tflex titems-center tmb-8">
            <div class="tw-1/2">
                <img loading="lazy" src="https://matildasbeauty.com/filemanager/073957c9a57d43d2a9f6a1750ca03569.png" width="206" height="128.75" class="tw-full trounded-2xl" alt="">
            </div>
            <div class="tw-1/2">
                <p class="tpx-5 ttext-lg"><b>Hormones.</b> <b>Puyat.</b> <b>Stress.</b> Sis, normal ‘yan… pero hindi ibig sabihin wala kang choice.</p>
            </div>
        </div><!-- SLIDE 1 -->

        <div class="tflex titems-center tmb-8">
            <div class="tw-1/2">
                <p class="tpx-5 ttext-lg"><b>Kahit anong skincare…</b>  ayaw<b> mawala.</b>  Parang dumikit na talaga.</p>
            </div>
             <div class="tw-1/2">
                <img loading="lazy" src="https://matildasbeauty.com/filemanager/6c2530ddd02c40f9bfb379220096a110.png" width="206" height="128.75" class="tw-full trounded-2xl" alt="">
            </div>
        </div><!-- SLIDE 2 -->

        <div class="tflex titems-center tmb-8">
            <div class="tw-1/2">
                <img loading="lazy" src="https://matildasbeauty.com/filemanager/2e885e9ce7fd4ddcb9028c078b72ecd1.png" width="206" height="128.75" class="tw-full trounded-2xl" alt="">
            </div>
            <div class="tw-1/2">
                <p class="tpx-5 ttext-lg"><b>Ayaw</b>  mo na mag- <b>selfie …
                Filters, foundation…</b>  paulit-ulit na lang.</p>
            </div>
        </div><!-- SLIDE  3-->

        <div class="tflex titems-center tmb-8">
            <div class="tw-1/2">
                <p class="tpx-5 ttext-lg">
                    Parang ang <b>tanda</b>  mo <b>tingnan…</b> 
                    Kahit nasa <b>mid 30's</b>  ka pa lang.
                </p>
            </div>
             <div class="tw-1/2">
                <img loading="lazy" src="https://matildasbeauty.com/filemanager/0ad80d6c336c4e73aa157e969a0cbfcb.png" width="206" height="128.75" class="tw-full trounded-2xl" alt="">
            </div>
        </div><!-- SLIDE  4-->

         <div class="tflex titems-center tmb-8">
            <div class="tw-1/2">
                <img loading="lazy" src="https://matildasbeauty.com/filemanager/caea7e9a027a41e7ae3d869000f3a673.png" width="206" height="128.75" class="tw-full trounded-2xl" alt="">
            </div>
            <div class="tw-1/2">
                <p class="tpx-5 ttext-lg">
                    Pero sis… <b>Normal</b>  ang <b>Melasma</b> 
                    at May paraan para mawala...
                    <br>
                    Ang <b>hindi normal</b>  ung pa <b>bayaan</b>   mo lang

                </p>
            </div>
            
        </div><!-- SLIDE 5 -->

        <hr class="my-5">

        <div class="tfont-semibold trelative tmx-3 tmb-10 tmy-5 ttext-center" style="margin-top: 50px;">
            <h1 class="" style="color: #3a1b31; font-size: 25px;">
                <i class="fas fa-exclamation-circle" style="color: #ff4300"></i>

                Maling paniniwala na <br> nag  papalala ng melasma</h1>
        </div>

        <div class="tflex titems-center tmb-8 tpx-2">
            <div class="tw-1/2">
                <img loading="lazy" src="https://matildasbeauty.com/filemanager/8fcc3adf254e467a967adea27c19909c.png" width="206" height="128.75" class="tw-full trounded-2xl" alt="">
            </div>
            <div class="tw-1/2 ">
                <p class="tpx-5 ttext-md">
                    <b>Pag gamit ng sobrang tapang na peeling…
                    todo bakbak, todo hapdi.</b>
                    
                    Pero hindi nila alam—
                    lalo lang umiitim ang melasma pag na-iiritate ang skin.
                </p>
            </div>
        </div><!-- Missconceptino #1 -->

        <div class="tflex titems-center tmb-8 tpx-2">
            <div class="tw-1/2">
                <img loading="lazy" src="https://matildasbeauty.com/filemanager/b0eb2271a79b4cfca2ec9a0831f3199e.png" width="206" height="128.75" class="tw-full trounded-2xl" alt="">
            </div>
            <div class="tw-1/2">
                <p class="tpx-5 ttext-md">
                    <b>Harsh products </b>  <b class="ttext-red-600">= irritation</b> . <br>
                    Irritated skin =  <b class="ttext-red-800">= darker melasma.</b> <br>
                    Glow ang hanap mo… <b>hapdi</b>  ang nakuha mo, sis.
                </p>
            </div>
        </div><!-- Missconceptino #2 -->

        <div class="tflex titems-center tmb-8 tpx-2">
            <div class="tw-1/2">
                <img loading="lazy" src="https://matildasbeauty.com/filemanager/36ba16536b094cdca925fa6081233775.png" width="206" height="128.75" class="tw-full trounded-2xl" alt="">
            </div>
            <div class="tw-1/2">
                <p class="tpx-5 ttext-md">
                    <b>"PINAKA MALING pa NINI-WALA"</b>
                    na nag papa tanda sayo lalo!
                    is... <b>FOREVER na ang MELASMA <small class="ttext-red-600">(wrong!!!)</small> </b>
                </p>
            </div>
        </div><!-- Missconceptino #3 -->

        <br>

        <h5  class="tfont-bold  ttext-center tmb-2 tpx-2 tmt-10" style="font-size: 25px;">
            ✨ Top 3 Ingredients na Dapat Nasa Melasma Products Mo
        </h5>
        <p class="ttext-center tpx-2">Kung isa mawala jan hindi effective skincare mo!</p>
        <p class="ttext-center tpx-2">ito ung hindi alam ng mga skincare CEO sa Pinas</p>
        <p class="ttext-center tpx-2 tfont-medium">Kailangan pag sama-samahin ang mga sumusunod na ingredients</p>

        <div class="tmb-10 tmt-10 tpt-5 tpx-5 tpy-5 trelative trounded-lg tshadow-lg ttext-md tw-full">
            <i class="fas fa-star tmb-2 ttext-lg" style="color:#f52d87;"></i>
            <img loading="lazy" class="tabsolute trounded-full" src="https://matildasbeauty.com/filemanager/0f015d7f1aaa4daba6188184592f793a.webp" loading="lazy" width="75" height="75" alt="mudra before &amp; After" style="
                top: -26px;
                right: 27px;
            ">
            <b class="tmt-10" style="font-size: 16px;">Tranexamic Acid</b>
            <div class="tml-5 tmb-3 ">
                <h6>
                    <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                    <span style="color: #f62d87"><b> Strongest gentle melasma brightener</b></span>
                </h6>
                <h6>
                    <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                    Helps reduce dark melasma patches
                </h6>

                <h6>
                    <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                    Makes skin even after removing melasma
                </h6>
            </div>  

            <h6 class="tmb-2"><b> Why it ranks #1:</b> </h6>
            <h6>It gives the strongest brightening Melasma Remover without irritation.</h6>
        </div> <!-- Tranexamic Acid-->

        <div class="tmb-10 tmt-10 tpt-5 tpx-5 tpy-5 trelative trounded-lg tshadow-lg ttext-md tw-full">
            <i class="fas fa-star tmb-2 ttext-lg" style="color:#f52d87;"></i>
            <img loading="lazy" class="tabsolute trounded-full" src="https://matildasbeauty.com/filemanager/2cbcf5e1da2f43d7b46ba62b46ebc3b1.webp" loading="lazy" width="75" height="75" alt="mudra before &amp; After" style="
                top: -9px;
                right: 27px;
            ">
            <b class="tmt-10" style="font-size: 16px;">Alpha-arbutin</b>
            <div class="tml-5 tmb-3 ">
                <h6>
                    <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                    <span style="color: #f62d87"><b>Targets stubborn melasma</b></span>
                </h6>
                <h6>
                    <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                    Helps fade dark spots
                </h6>

                <h6>
                    <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                    Helps brighten dull areas
                </h6>
            </div>  

            <h6 class="tmb-2"><b> Why it ranks #2:</b> </h6>
            <h6>Target melasma from within — but stays gentle and safe for sensitive skin.</h6>
        </div><!-- Alpha arbutin-->

        <div class="tmy-10 tpt-5 tpx-5 tpy-5 trelative trounded-lg tshadow-lg ttext-md tw-full">
            <i class="fas fa-star tmb-2 ttext-lg" style="color:#f52d87;"></i>
            <img loading="lazy" class="tabsolute trounded-full" src="https://matildasbeauty.com/filemanager/9eeb7b26df784e2b8bb4f9ef6e03f8ed.webp" loading="lazy" width="75" height="75" alt="mudra before &amp; After" style="
                top: -9px;
                right: 27px;
            ">
            <b class="tmt-10" style="font-size: 16px;">Niacinamide</b>
            <div class="tml-5 tmb-3 ">
                <h6>
                    <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                    <span style="color: #f62d87"><b>Calms melasma-prone skin</b></span>
                </h6>
                <h6>
                    <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                    Helps lighten dark patches
                </h6>

                <h6>
                    <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                    Helps prevent melasma from darkening
                </h6>
            </div>  

            <h6 class="tmb-2"><b> Why it ranks #3:</b> </h6>
            <h6>Lightens melasma gradually — without the redness, without the hapdi.</h6>
        </div><!-- Niacinamide -->


        <br>

        <!-- MISSTISA INTRODUCTION -->
        <h5 id="show_cta" class="tfont-bold  ttext-center tmb-8 tpx-2 tmt-5" style="font-size: 25px;">
            “Saan ko makikita lahat ‘yan in one?”
            Sis, good news.
        </h5>

        <!-- MISSTISA INTRODUCTION -->
        <h5  class="tfont-bold ttext-center tpx-2 tmt-8" style="font-size: 18px;">
          <span style="color: #f52d87;">MissTisa</span>   combines all 3 Melasma Killer Ingredients 
        </h5>
        <p class="tpx-2 ttext-center tmb-5">the gentle way. Safe, simple, and made for melasma-prone, sensitive skin.</p>
        
        <div class="titems-center ">
            <img loading="lazy" src="https://matildasbeauty.com/filemanager/02cac66ae5ff4ea3875a6aadb6dc0d86.png" width="300" height="160" class="tmx-auto" loading="lazy" alt="" srcset="">
        </div>    

        <div  class="tflex tw-full tflex-wrap tjustify-center tpy-3 tpx-3 tmb-3">
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #f52d87;"></i>
                <b> Melasma Killer </b> 
            </div>
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #f52d87;"></i>
                <b> Tranexamic Acid </b> 
            </div>
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #f52d87;"></i>
                <b> Darkspots </b> 
            </div>
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #f52d87;"></i>
                <b> Niacinamide </b> 
            </div>
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #f52d87;"></i>
                <b> Pekas </b> 
            </div>
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #f52d87;"></i>
                <b>Alpha Arbutin </b> 
            </div>

            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #12bc39;"></i>
                Safe for moms
            </div>
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #12bc39;"></i>
                FDA Approved
            </div>
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #12bc39;"></i>
                Gentle yet Effective
            </div>
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #12bc39;"></i>
                Safe
            </div>

            <hr>

            <div class="tw-1/2"><i class="fas fa-times-circle tmb-2 ttext-lg" style="color: #ff4300;"></i>
                No Hapdi
            </div>
            <div class="tw-1/2"><i class="fas fa-times-circle tmb-2 ttext-lg" style="color: #ff4300;"></i>
                No Irritation
            </div>
            <div class="tw-1/2"><i class="fas fa-times-circle tmb-2 ttext-lg" style="color: #ff4300;"></i>
                No Redness
            </div>
            <div class="tw-1/2"><i class="fas fa-times-circle tmb-2 ttext-lg" style="color: #ff4300;"></i>
                No Bak-bak
            </div>


        </div>

        <!-- TIMELINE -->
        <h5  class="tfont-bold  ttext-center tpx-2 tmt-10" style="font-size: 25px;">
            What Happens to Your Skin When You Use MissTisa?
        </h5>

        <div class="tmax-w-[480px] tmx-auto tbg-white tpy-12 tpx-2 trelative  tmy-4 trounded-xl tuppercase-0">
            
            <div class="tabsolute tleft-1/2 ttransform -ttranslate-x-1/2 th-full tw-[2px] tbg-gray-200 ttop-0"></div>

            <div class="tflex titems-center tjustify-between tmb-5 trelative">
                
                <div class="tw-[45%] tpr-3">
                    <img loading="lazy" src="https://matildasbeauty.com/filemanager/a384f81eb94d4bb1b19c00c0ccbf7844.png" width="166.2" height="166.2" alt="Calming Phase" class="tw-full th-auto tobject-cover trounded-tl-[40px] trounded-br-[40px] trounded-tr-[15px] trounded-bl-[15px] tshadow-sm">
                </div>

                <div class="tabsolute tleft-1/2 ttop-0 ttransform -ttranslate-x-1/2 -ttranslate-y-1/4 tw-4 th-4 tbg-brand-pink trounded-full tborder-[3px] tborder-white tshadow-sm tz-10"></div>

                <div class="tw-[45%] tpl-3 ttext-left">
                    <div class="tbg-brand-pink ttext-white tpx-3 tpy-1.5 trounded-full ttext-xs tfont-bold tinline-flex titems-center tgap-1 tshadow-md tmb-3 tw-fit twhitespace-nowrap">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="tw-3 th-3 ttext-yellow-300">
                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.007z" clip-rule="evenodd" />
                        </svg>
                        Day 1–7
                    </div>
                    
                    <h2 class="ttext-brand-pink tfont-bold ttext-base tlext-lg tleading-tight tmb-3">Melasma Calming</h2>
                    
                    <ul class="tflex tflex-col tgap-2">
                        <li class="tflex titems-start tgap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="tw-5 th-5 ttext-green-500 tflex-shrink-0 tmt-0.5">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                            </svg>
                            <span class="ttext-gray-700 tfont-medium ttext-sm tleading-tight">Melasma looks calmer</span>
                        </li>
                        <li class="tflex titems-start tgap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="tw-5 th-5 ttext-green-500 tflex-shrink-0 tmt-0.5">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                            </svg>
                            <span class="ttext-gray-700 tfont-medium ttext-sm tleading-tight">Glow slowly returns</span>
                        </li>
                        <li class="tflex titems-start tgap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="tw-5 th-5 ttext-green-500 tflex-shrink-0 tmt-0.5">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                            </svg>
                            <span class="ttext-gray-700 tfont-medium ttext-sm tleading-tight">You feel hopeful again</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="tflex titems-center tjustify-between tmb-5 trelative">
                
                <div class="tw-[45%] tpr-3 ttext-right tflex tflex-col titems-end">
                    <div class="tbg-brand-pink ttext-white tpx-3 tpy-1.5 trounded-full ttext-xs tfont-bold tinline-flex titems-center tgap-1 tshadow-md tmb-3 tw-fit twhitespace-nowrap">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="tw-3 th-3 ttext-yellow-300">
                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.007z" clip-rule="evenodd" />
                        </svg>
                        Week 2–4
                    </div>
                    
                    <h2 class="ttext-brand-pink tfont-bold ttext-base tleading-tight tmb-3">Melasma Softening</h2>
                    
                    <ul class="tflex tflex-col tgap-2 titems-end">
                        <li class="tflex tflex-row-reverse titems-start tgap-2 ttext-right">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="tw-5 th-5 ttext-green-500 tflex-shrink-0 tmt-0.5">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                            </svg>
                            <span class="ttext-gray-700 tfont-medium ttext-sm tleading-tight">Melasma starts to fade gently</span>
                        </li>
                        <li class="tflex tflex-row-reverse titems-start tgap-2 ttext-right">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="tw-5 th-5 ttext-green-500 tflex-shrink-0 tmt-0.5">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                            </svg>
                            <span class="ttext-gray-700 tfont-medium ttext-sm tleading-tight">Your natural glow becomes visible</span>
                        </li>
                        <li class="tflex tflex-row-reverse titems-start tgap-2 ttext-right">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="tw-5 th-5 ttext-green-500 tflex-shrink-0 tmt-0.5">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                            </svg>
                            <span class="ttext-gray-700 tfont-medium ttext-sm tleading-tight">Comfortable facing mirror</span>
                        </li>
                    </ul>
                </div>

                <div class="tabsolute tleft-1/2 ttop-0 ttransform -ttranslate-x-1/2 -ttranslate-y-1/4 tw-4 th-4 tbg-brand-pink trounded-full tborder-[3px] tborder-white tshadow-sm tz-10"></div>

                <div class="tw-[45%] tpl-3">
                    <img loading="lazy" src="https://matildasbeauty.com/filemanager/0842b5e490de4e5f94f11a173a344533.png" width="166.2" height="166.2" alt="Softening Phase" class="tw-full th-auto tobject-cover trounded-[30px] tshadow-sm">
                </div>
            </div>

            <div class="tflex titems-center tjustify-between trelative">
                
                <div class="tw-[45%] tpr-3">
                    <img loading="lazy" src="https://matildasbeauty.com/filemanager/7e5a82da4eef4633abbd84d67197d55d.png" width="166.2" height="166.2" alt="Glow Phase" class="tw-full th-auto tobject-cover trounded-tl-[40px] trounded-br-[40px] trounded-tr-[15px] trounded-bl-[15px] tshadow-sm">
                </div>

                <div class="tabsolute tleft-1/2 ttop-0 ttransform -ttranslate-x-1/2 -ttranslate-y-1/4 tw-4 th-4 tbg-brand-pink trounded-full tborder-[3px] tborder-white tshadow-sm tz-10"></div>

                <div class="tw-[45%] tpl-3 ttext-left">
                    <div class="tbg-brand-pink ttext-white tpx-3 tpy-1.5 trounded-full ttext-xs tfont-bold tinline-flex titems-center tgap-1 tshadow-md tmb-3 tw-fit twhitespace-nowrap">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="tw-3 th-3 ttext-yellow-300">
                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.007z" clip-rule="evenodd" />
                        </svg>
                        Week 4-8
                    </div>
                    
                    <h2 class="ttext-brand-pink tfont-bold ttext-base tleading-tight tmb-3">Melasma Lightening</h2>
                    
                    <ul class="tflex tflex-col tgap-2">
                        <li class="tflex titems-start tgap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="tw-5 th-5 ttext-green-500 tflex-shrink-0 tmt-0.5">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                            </svg>
                            <span class="ttext-gray-700 tfont-medium ttext-sm tleading-tight">Melasma looks visibly lighter</span>
                        </li>
                        <li class="tflex titems-start tgap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="tw-5 th-5 ttext-green-500 tflex-shrink-0 tmt-0.5">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                            </svg>
                            <span class="ttext-gray-700 tfont-medium ttext-sm tleading-tight">Skin looks brighter glass skin</span>
                        </li>
                        <li class="tflex titems-start tgap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="tw-5 th-5 ttext-green-500 tflex-shrink-0 tmt-0.5">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                            </svg>
                            <span class="ttext-gray-700 tfont-medium ttext-sm tleading-tight">Confidence slowly comes back</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

        <!-- BEFORE AND AFTER -->
        <h5 class="tfont-bold  ttext-center tpx-2 tmt-10" style="font-size: 25px;">
            "Melasma Stories"
        </h5>
        <p class="ttext-2xl ttext-center">From melasma struggles to gentle glow results.</p>

        <br>


        <div class="tflex-shrink-0 tw-full th-full trelative">
            <img loading="lazy" src="https://matildasbeauty.com/filemanager/66292ccc42dd45e9b0ea4e83ea595f1b.webp"  class="tobject-fill th-full tw-full" alt="Testimonial 1">
            
            <span class="tabsolute ttop-4 tleft-4 tbg-black/60 ttext-white ttext-xs tuppercase tfont-bold tpx-3 tpy-1 trounded z-10">Before</span>
            <span class="tabsolute tbg-brand-pink tfont-medium tpx-3 tpy-1 trounded-full tshadow-sm ttext-[10px] ttext-white ttop-4 z-10" style="left: 28%;">1 Weeks</span>

            <span class="tabsolute ttop-4 tright-4 tbg-black/60 ttext-white ttext-xs tuppercase tfont-bold tpx-3 tpy-1 trounded z-10">After</span>
            <span class="tabsolute tbg-green-500 tfont-medium tpx-3 tpy-1 trounded-full tshadow-sm ttext-[10px] ttext-white z-10" style="top: 5%; left: 52%;">8 Weeks</span>

            <div class="tabsolute tbottom-0 tleft-0 tright-0 tbg-gradient-to-t tfrom-black/90 tvia-black/60 tto-transparent tpt-20 tpb-6 tpx-6 ttext-white">
                <p class="tfont-bold ttext-sm tmb-1">Evelyn R. (58 yrs old)</p>
                <p class="ttext-sm tleading-relaxed titalic ttext-gray-100">
                    "ang bilis nag-lighten ng melasma ko.
                    Kaya mas fresh at mas saya na ang aura ko ngayon."
                </p>
            </div>
        </div>

        <div class="tflex-shrink-0 tw-full th-full trelative">
            <img loading="lazy" src="https://matildasbeauty.com/filemanager/3cb3ce4b0f92438db4b953ae657a1ecb.webp"  class="tobject-fill th-full tw-full" alt="Testimonial 1">
            
            <span class="tabsolute ttop-4 tleft-4 tbg-black/60 ttext-white ttext-xs tuppercase tfont-bold tpx-3 tpy-1 trounded z-10">Before</span>
            <span class="tabsolute tbg-brand-pink tfont-medium tpx-3 tpy-1 trounded-full tshadow-sm ttext-[10px] ttext-white ttop-4 z-10" style="left: 28%;">1 Weeks</span>

            <span class="tabsolute ttop-4 tright-4 tbg-black/60 ttext-white ttext-xs tuppercase tfont-bold tpx-3 tpy-1 trounded z-10">After</span>
            <span class="tabsolute tbg-green-500 tfont-medium tpx-3 tpy-1 trounded-full tshadow-sm ttext-[10px] ttext-white z-10" style="top: 5%; left: 52%;">8 Weeks</span>

            <div class="tabsolute tbottom-0 tleft-0 tright-0 tbg-gradient-to-t tfrom-black/90 tvia-black/60 tto-transparent tpt-20 tpb-6 tpx-6 ttext-white">
                <p class="tfont-bold ttext-sm tmb-1">Jocelyn S. (53yrs old).</p>
                <p class="ttext-sm tleading-relaxed titalic ttext-gray-100">
                    "Walang hapdi at walang pamumula —
                    pero ang bilis nag-soften ng melasma ko. ngayon halos wala na"
                </p>
            </div>
        </div>

        <div class="tflex-shrink-0 tw-full th-full trelative">
            <img loading="lazy" src="https://matildasbeauty.com/filemanager/181ef5ad6f8f47f2895c4b5bfe054975.webp"  class="tobject-fill th-full tw-full" alt="Testimonial 1">
            
            <span class="tabsolute ttop-4 tleft-4 tbg-black/60 ttext-white ttext-xs tuppercase tfont-bold tpx-3 tpy-1 trounded z-10">Before</span>
            <span class="tabsolute tbg-brand-pink tfont-medium tpx-3 tpy-1 trounded-full tshadow-sm ttext-[10px] ttext-white ttop-4 z-10" style="left: 28%;">2 Weeks</span>

            <span class="tabsolute ttop-4 tright-4 tbg-black/60 ttext-white ttext-xs tuppercase tfont-bold tpx-3 tpy-1 trounded z-10">After</span>
            <span class="tabsolute tbg-green-500 tfont-medium tpx-3 tpy-1 trounded-full tshadow-sm ttext-[10px] ttext-white z-10" style="top: 5%; left: 52%;">7 Weeks</span>

            <div class="tabsolute tbottom-0 tleft-0 tright-0 tbg-gradient-to-t tfrom-black/90 tvia-black/60 tto-transparent tpt-20 tpb-6 tpx-6 ttext-white">
                <p class="tfont-bold ttext-sm tmb-1">Sarah J. (55 yrs old)</p>
                <p class="ttext-sm tleading-relaxed titalic ttext-gray-100">"After 7 weeks, iba na talaga… mas soft, mas even, at mas confident na ulit ako lumabas."</p>
            </div>
        </div>

        <div class="tflex-shrink-0 tw-full th-full trelative">
            <img loading="lazy" src="https://matildasbeauty.com/filemanager/0d250eaee2284e10bb648cf206226552.webp"  class="tobject-fill th-full tw-full" alt="Testimonial 1">
            
            <span class="tabsolute ttop-4 tleft-4 tbg-black/60 ttext-white ttext-xs tuppercase tfont-bold tpx-3 tpy-1 trounded z-10">Before</span>
            <span class="tabsolute tbg-brand-pink tfont-medium tpx-3 tpy-1 trounded-full tshadow-sm ttext-[10px] ttext-white ttop-4 z-10" style="left: 28%;">0 Days</span>

            <span class="tabsolute ttop-4 tright-4 tbg-black/60 ttext-white ttext-xs tuppercase tfont-bold tpx-3 tpy-1 trounded z-10">After</span>
            <span class="tabsolute tbg-green-500 tfont-medium tpx-3 tpy-1 trounded-full tshadow-sm ttext-[10px] ttext-white z-10" style="top: 5%; left: 52%;">8 Weeks</span>

            <div class="tabsolute tbottom-0 tleft-0 tright-0 tbg-gradient-to-t tfrom-black/90 tvia-black/60 tto-transparent tpt-20 tpb-6 tpx-6 ttext-white">
                <p class="tfont-bold ttext-sm tmb-1">Elidina G. (65yrs old)</p>
                <p class="ttext-sm tleading-relaxed titalic ttext-gray-100">
                    “Ang dami ko nang sinubukan. lahat walang effect.
                    MissTisa lang talaga nagpa-lighten ng melasma ko.”
                </p>
            </div>
        </div>

        <div class="tflex-shrink-0 tw-full th-full trelative">
            <img loading="lazy" src="https://matildasbeauty.com/filemanager/e8fcad609ec74b61af4d68f663b35a14.webp"  class="tobject-fill th-full tw-full" alt="Testimonial 1">
            
            <span class="tabsolute ttop-4 tleft-4 tbg-black/60 ttext-white ttext-xs tuppercase tfont-bold tpx-3 tpy-1 trounded z-10">Before</span>
            <span class="tabsolute tbg-brand-pink tfont-medium tpx-3 tpy-1 trounded-full tshadow-sm ttext-[10px] ttext-white ttop-4 z-10" style="left: 28%;">2 Weeks</span>

            <span class="tabsolute ttop-4 tright-4 tbg-black/60 ttext-white ttext-xs tuppercase tfont-bold tpx-3 tpy-1 trounded z-10">After</span>
            <span class="tabsolute tbg-green-500 tfont-medium tpx-3 tpy-1 trounded-full tshadow-sm ttext-[10px] ttext-white z-10" style="top: 5%; left: 52%;">6 Weeks</span>

            <div class="tabsolute tbottom-0 tleft-0 tright-0 tbg-gradient-to-t tfrom-black/90 tvia-black/60 tto-transparent tpt-20 tpb-6 tpx-6 ttext-white">
                <p class="tfont-bold ttext-sm tmb-1">Luz M. (62 yrs old)</p>
                <p class="ttext-sm tleading-relaxed titalic ttext-gray-100">
                    "ang laki ng ginhawa…
                    mas gumaan at nag-lighten talaga yung melasma ko."
                </p>
            </div>
        </div>



        <br><br>
        <h5 class="tfont-bold  ttext-center tpx-2 tmt-10" style="font-size: 25px;">
            "Why MissTisa"
        </h5>
        <p class="ttext-2xl ttext-center">
            Engineered for Melasma-Prone, Sensitive Skin, Made Gentle for Moms.
        </p>

        <div class="tflex tpx-2 tmt-10">
            <div class="tw-1/2 tflex tflex-wrap">
                <div class="tmt-16">
                    <img loading="lazy" width="75" height="75" src="https://matildasbeauty.com/filemanager/452fadb8d77a455da516e4c63a5fdab9.png" alt="">
                </div>
                <div class="">
                    <img loading="lazy" width="75" height="75" src="https://matildasbeauty.com/filemanager/fab6642ee2454e7ab9a06a8b5338d1e0.png" alt="">
                </div>
                <div class="">
                    <img loading="lazy" width="75" height="75" src="https://matildasbeauty.com/filemanager/db4c31681864423992ab7c1e894e6b85.png" alt="" class="tmt-16">
                </div>
                <div class="">
                    <img loading="lazy" width="75" height="75" src="https://matildasbeauty.com/filemanager/ba5ba27b7ce34c37ac45fb0280fb9d73.png" alt="" class="tmb-16">
                </div>
                <div class="">
                    <img loading="lazy" width="75" height="75" src="https://matildasbeauty.com/filemanager/d7c85db2562a4f2cb26dde475b07affd.png" alt="" class="tmt-16">
                </div>
                <div class="">
                    <img loading="lazy" width="75" height="75" src="https://matildasbeauty.com/filemanager/912eef78ef1a4ca9a0bfc36710556ea1.png" alt="" class="tmb-16">
                </div>
            </div>
            <div class="tw-1/2 tflex tflex-wrap">
                <span class="tmb-5" style="line-height: 0.1;">
                    <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #12bc39;"></i>
                    Contains 3 Melasma <br> <span class="tml-6"><b>Killer Ingredients</b></span> 
                </span>
                <span class="tmb-5" style="line-height: 0.1;">
                    <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #12bc39;"></i>
                    <b>Gentle on melasma</b> <br> <span class="tml-6">no irritation</span>  
                </span>
                <span class="tmb-5" style="line-height: 0.1;">
                    <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #12bc39;"></i>
                    <b>Safe for moms</b> (including breastfeeding)
                </span>
                <span class="tmb-5" style="line-height: 0.1;">
                    <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #12bc39;"></i>
                    <b>No redness</b> <br> <span class="tml-6">no peeling </span> 
                </span>
                <span class="tmb-5" style="line-height: 0.1;">
                    <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #12bc39;"></i>
                    <b>Visible lightening</b> <br> <span class="tml-6">in 4–8 weeks </span> 
                </span>
                <span class="tmb-5" style="line-height: 0.1;">
                    <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #12bc39;"></i>
                    <b>Works</b> even on <b>deep</b>,  <span class="tml-6"><b>stubborn patches</b> </span> 
                </span>
                <span class="tmb-5" style="line-height: 0.1;">
                    <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #12bc39;"></i>
                    Restores natural <br>  <span class="tml-6"> <b>glow safely</b></span> 
                </span>
                <span class="tmb-5" style="line-height: 0.1;">
                    <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #12bc39;"></i>
                    Perfect for  <b> ages  <br>  <span class="tml-6"> 30–70+ </span> </b>
                </span>
            </div>
            
        </div>
                



        <br>
        <h5 class="tfont-bold  ttext-center tpx-2 tmy-10" style="font-size: 25px;">
            "How to use"
        </h5>

        <div class="tgrid tgrid-cols-2 md:tgrid-cols-2">

            <div class="tp-2 tflex tflex-col titems-center  md:tborder-b-0 md:tborder-r ">
                
                <h2 class="tfont-medium ttext-pink-600 tuppercase ttracking-wide tmb-10 ttext-center">
                    <i class="fas fa-sun ttext-4xl tmb-3"  style="color: #ffa900;"></i>
                    <br>
                    Morning
                </h2>

                <div class="tw-28 th-24 trounded-lg tflex titems-center tjustify-center tshadow-2xl tmb-6">
                    <img loading="lazy" src="https://matildasbeauty.com/filemanager/93d5e47eb5f147b4bd11c8782a8de2cb.png" alt="">
                    <!-- <span class="ttext-white tfont-medium ttext-sm">MissTisa Soap</span> -->
                </div>

                <h3 class="ttext-xl tfont-bold ttext-gray-900 ttext-center">
                    Soap
                </h3>
                <p class="ttext-gray-600 ttext-center tmt-2 ttext-sm">
                    Lather gently, wash face, and rinse well.
                </p>

                <div class="tmy-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="tw-8 th-8 ttext-pink-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" />
                    </svg>
                </div>

                <div class="tw-28 th-24 trounded-lg tflex titems-center tjustify-center tshadow-2xl tmb-6">
                    <img loading="lazy" src="https://matildasbeauty.com/filemanager/b4b8252984834489a5ceac3387b21bad.png" alt="">
                </div>

                <h3 class="ttext-xl tfont-bold ttext-gray-900 ttext-center tmax-w-xs">
                    Sunscreen
                </h3>
                <p class="ttext-gray-600 ttext-center tmt-2 ttext-sm">
                    Spread evenly on face and neck. 
                </p>

            </div><!-- HOW TO USE Morning -->

            <div class="tborder-l tflex tflex-col titems-center tp-2">
                
                <h2 class="tfont-medium ttext-pink-600 tuppercase ttracking-wide tmb-10 ttext-center">
                    <i class="fas fa-moon ttext-4xl tmb-3" style="color: #090973bf;"></i> <br>
                    Night
                </h2>

                <div class="tw-28 th-24 trounded-lg tflex titems-center tjustify-center tshadow-2xl tmb-4">
                    <img loading="lazy" src="https://matildasbeauty.com/filemanager/93d5e47eb5f147b4bd11c8782a8de2cb.png" alt="">
                </div>

                <h3 class="ttext-lg tfont-bold ttext-gray-900 ttext-center">
                     Soap
                </h3>
                <p class="ttext-gray-500 ttext-center tmt-1 ttext-sm tmb-4">
                    Reapply every 2–3 hours when exposed to sun.
                </p>

                <div class="tmb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="tw-6 th-6 ttext-pink-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" />
                    </svg>
                </div>

                <div class="tw-24 th-36 trounded-lg tflex titems-center tjustify-center tshadow-2xl tmb-4">
                    <img loading="lazy" src="https://matildasbeauty.com/filemanager/b79b18fec1764116979c8ef199b1a4cc.png" alt="">
                </div>

                <h3 class="ttext-lg tfont-bold ttext-gray-900 ttext-center">
                    Toner
                </h3>
                <p class="ttext-gray-500 ttext-center tmt-1 ttext-sm tmb-4">
                    Use a cotton pad, swipe gently across the face.
                </p>

                <div class="tmb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="tw-6 th-6 ttext-pink-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" />
                    </svg>
                </div>

                <div class="tw-28 th-24 trounded-lg tflex titems-center tjustify-center tshadow-2xl tmb-4">
                    <img loading="lazy" src="https://matildasbeauty.com/filemanager/ad92bc9237154872978fd33495ac44af.png" alt="">
                </div>

                <h3 class="ttext-lg tfont-bold ttext-gray-900 ttext-center tmax-w-xs">
                    Night Cream
                </h3>
                <p class="ttext-gray-500 ttext-center tmt-1 ttext-sm tpb-1">
                    Massage gently until absorbed. Leave on overnight.
                </p>

            </div> <!-- HOW TO USE NIGHT -->

        </div>


        <div class="tmx-auto trelative tborder tpb-5">
            <div class="tflex tjustify-center tflex-wrap tfont-medium titems-center ttext-center">
                <img loading="lazy" src="{{ asset('images\icons\free-shipping.png') }}" class="tmy-3" alt="free shipping" width="200" height="123">
                <span class="tmb-1">Nationwide Luzon, Visayas & Mindanao </span>
            </div>

            <section class="tflex titems-baseline tmt-5 tmb-3">
                <div class="ttext-center">
                    <i class="fas fa-truck ttext-4xl" style="color: #ff1075; line-height: 1.2;"></i>
                    <span class="tinline-block tmt-1">Fast delivery nationwide</span>
                </div>
                <div class="ttext-center">
                    <i class="fas fa-dollar-sign ttext-4xl" style="color: #ff1075; line-height: 1.2;" ></i>
                    <span class="tinline-block tmt-1">Moneyback Guarantee</span>
                </div>
                <div class="ttext-center">
                    <i class="fas fa-hand-holding-usd ttext-4xl" style="color: #ff1075; line-height: 1.2;" ></i>
                    <span class="tinline-block tmt-1">Cash on Delivery</span>
                </div>
                <div class="ttext-center">
                    <i class="fas fa-headset ttext-4xl" style="color: #ff1075; line-height: 1.2;"></i>
                    <span class="tinline-block tmt-1">Unlimited SkincareTips</span>
                </div>
            </section>


                <!-- ORDER PROMO -->
                <div class="th-full tflex tflex-col tmax-w-2xl tmx-auto tbg-white tp-3">
                    <!-- Header -->
                    
                    <h1 class="ttext-center ttext-xl tfont-black ttext-gray-900 tmb-3 ttracking-wide">ORDER FORM</h1>
                    
                    <!-- Customer Information Form -->
                    <div class="tmb-3">
                        <div class="tgrid tgrid-cols-2 tgap-2 tmb-2">
                            <div>
                                <label class="tblock ttext-xs tfont-medium ttext-gray-700 tmb-1">Full Name</label>
                                <input 
                                    type="text" 
                                    id="full_name"
                                    class="browser-default tw-full tp-2 tborder-2 tborder-red-400 trounded-lg tfocus:outline-none tfocus:tborder-purple-400 ttransition-colors ttext-md"
                                    placeholder="Enter your full name"
                                    name="full_name"
                                >
                            </div>
                            <div>
                                <label class="tblock ttext-xs tfont-medium ttext-gray-700 tmb-1">Contact Number</label>
                                <input 
                                    type="tel" 
                                    id="phone_number"
                                    class="browser-default tw-full tp-2 tborder-2 tborder-red-400 trounded-lg tfocus:outline-none tfocus:tborder-purple-400 ttransition-colors ttext-md"
                                    placeholder="Enter your contact number"
                                    name="phone_number" 
                                >
                            </div>
                        </div>
                        <div>
                            <label class="tblock ttext-xs tfont-medium ttext-gray-700 tmb-1">Complete Address <span class="ttext-md ttext-gray-500">(St./House No. | blk & lot/ Subdv / Barangay / City / Province)</span> </label>
                            <input 
                                type="text" 
                                id="address"
                                class="browser-default tw-full tp-2 tborder-2 tborder-red-400 trounded-lg tfocus:outline-none tfocus:tborder-purple-400 ttransition-colors ttext-md"
                                placeholder="Enter your complete address"
                                name="address"
                            >
                        </div>
                    </div>

                    <!-- Product Selection -->
                    <div class="tflex tflex-col">
                        <h2 class="ttext-center ttext-base tfont-bold ttext-gray-800 tmb-2">
                            <span class="ttext-lg">🌟</span> MissTisa Beauty Collection
                        </h2>
                        
                        <div class="tgrid tgrid-cols-2 tgap-2">
                            <?php foreach ($products as $index => $product): ?>
                            <div class="product-card <?= $index === 0 ? 'product-selected' : '' ?> tmb-3 tbg-white tborder-2 tborder-gray-300 tcursor-pointer tduration-200 tp-2 tpb-1 trelative trounded-lg ttransition-all" style="height: 150px;" onclick="selectProduct(this, <?= $product['price'] ?>, <?= $product['id'] ?>)">
                                <div class="tflex titems-center tgap-2 tmb-1">
                                    <div class="tflex titems-center tjustify-center trounded-md" style="height: 65px; width: 65px;">
                                        <img loading="lazy" src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="tw-full th-full tobject-cover trounded-md" />
                                    </div>
                                    <div class="tmx-auto">
                                        <span class="tfont-bold ttext-2xl ttext-pink-600">₱<?= number_format($product['price']) ?></span>
                                    </div>
                                </div>
                                <div class="check-circle tabsolute tw-6 th-6 trounded-full tflex titems-center tjustify-center ttext-xs tfont-bold" style="top: 4px;right: 4px;">✓</div>
                                <h3 class="tfont-bold ttext-center ttext-gray-800 ttext-xs" style="font-size: 17px; line-height: 1.1rem;"><?= htmlspecialchars($product['name']) ?></h3>
                                <div id="quantity-container-<?= $product['id'] ?>" class="tflex titems-center tjustify-center tmb-1 tmt-2 <?= $index !== 0 ? 'thidden' : '' ?>">
                                    <div class="tflex titems-center tbg-white tborder-2 tborder-pink-200 trounded-md tpx-1 tpy-1 tshadow-sm">
                                        <button onclick="changeQuantity(<?= $product['id'] ?>, -1); event.stopPropagation();" class="tw-6 th-6 tbg-gradient-to-r tfrom-pink-400 tto-pink-500 trounded-md tflex titems-center tjustify-center hover:tfrom-pink-500 hover:tto-pink-600 ttext-white tfont-bold tshadow-sm ttransition-all tduration-200 active:tscale-95">-</button>
                                        <span id="quantity-<?= $product['id'] ?>" class="tmx-3 tfont-bold ttext-lg ttext-gray-800 tmin-w-[24px] ttext-center">1</span>
                                        <button onclick="changeQuantity(<?= $product['id'] ?>, 1); event.stopPropagation();" class="tw-6 th-6 tbg-gradient-to-r tfrom-pink-400 tto-pink-500 trounded-md tflex titems-center tjustify-center hover:tfrom-pink-500 hover:tto-pink-600 ttext-white tfont-bold tshadow-sm ttransition-all tduration-200 active:tscale-95">+</button>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Total and Buy Button -->
                    <button 
                        id="submit_btn"
                        onclick="submitOrder()"
                        class="bg-gradient-purple-pink trounded-xl tp-4 ttext-white tmt-3 tw-full tflex tjustify-between titems-center hover:opacity-90 ttransition-all tduration-300 tcursor-pointer tshadow-lg hover:tshadow-xl hover:transform hover:tscale-105 active:tscale-95"
                        style="box-shadow: 0 8px 25px rgba(185, 36, 147, 0.3); transition: all 0.3s ease;"
                    >
                        <div>
                            <div class="ttext-sm tfont-medium">Total Amount:</div>
                            <div class="ttext-2xl tfont-bold" id="total">₱ <span><?= number_format($products[0]['price']) ?></span> </div>
                        </div>
                        <div class="tbg-white tpx-6 tpy-3 trounded-lg ttext-xl tfont-black ttracking-wide tshadow-md" style="color: rgb(185, 36, 147);">
                            BUY NOW
                        </div>
                    </button>
                </div> <!-- ORDER FOROM AND PROMO -->

                <div id="validationModal" class="modal-overlay">
                    <div class="modal-content">
                        <div id="modalIcon" class="modal-icon">
                            ⚠️
                        </div>
                        <h3 id="modalTitle" class="modal-title">Complete Your Information</h3>
                        <p id="modalMessage" class="modal-message">Please fill in all required fields to continue with your order.</p>
                        <div id="missingFields" class="missing-fields" style="display: none;">
                            <h4>Missing Information:</h4>
                            <ul id="fieldsList">
                            </ul>
                        </div>
                        <button class="modal-button" onclick="closeModal()">Got It!</button>
                    </div>
                </div><!-- MODAL - VALIDATION -->

                <!-- MODAL SUCCESS NEW (Pink New Original Modal working)-->
                <div class="success-modal" id="successModal">
                    <button class="success-modal-close-btn" onclick="closeSuccessModal()">✕</button>
                    
                    <div class="success-modal-content">
                        <div class="success-modal-icon tmb-3"></div>
                        
                        <h1 class="success-modal-title tmb-1">Order Sucess!</h1>
                        <p class="ttext-gray-500 ttext-sm tmt-1">Thank you for your purchase.</p>

                        
                        <div class="success-modal-order-details tbg-white tborder-b tborder-l tfont-medium">
                            <div class="success-modal-detail-row">
                                <span class="success-modal-detail-label">Customer:</span>
                                <span class="success-modal-detail-value success-modal-customer-name" id="successModalCustomerName">-</span>
                            </div>
                            
                            <div class="success-modal-detail-row">
                                <span class="success-modal-detail-label">Products:</span>
                                <span class="success-modal-detail-value success-modal-promo-text" id="successModalPromoText">-</span>
                            </div>
                            
                            <div class="tflex tjustify-between">
                                <div class="">Total:</div>
                                <div class="success-modal-total-amount" id="successModalTotalAmount">₱0</div>
                            </div>
                        </div>

                        <div class="tbg-gradient-to-b  tto-white tpy-3">
                            <div class="ttext-center tmb-4 tmt-2">
                                <h3 class="ttext-lg tfont-bold ttext-gray-900">Add this now for a Glow Upgrade</h3>
                                <p class="ttext-xs ttext-pink-600 tfont-medium">Add this now and enjoy extra savings</p>
                            </div>

                            <!-- Horizontal Scrollable Container -->
                            <div class="tflex toverflow-x-auto tspace-x-4 tp-2 no-scrollbar tsnap-x tsnap-mandatory">
                                

                                <?php foreach($fbads_products as $fbads_product) { ?>

                                <!-- Upsell Product 1 -->
                                <div class="tsnap-center tshrink-0 tw-64 tbg-white trounded-2xl tshadow-md tborder tborder-gray-100 toverflow-hidden">
                                    <div class="th-32 tbg-gray-100 trelative">
                                        <img loading="lazy" src="{{ $fbads_product->image1 }}" alt="{{ $fbads_product->sku }}" class="tw-full th-full tobject-cover">
                                        <span class="tabsolute ttop-2 tright-2 tbg-red-500 ttext-white ttext-[10px] tfont-bold tpx-2 tpy-1 trounded-full">{{ $fbads_product->discount_tag }}</span>
                                    </div>
                                    <div class="tp-3">
                                        <h4 class="tfont-bold ttext-gray-800 ttext-sm ttruncate">{{ $fbads_product->promo_line1 }}</h4>
                                        <span class="upsell_product thidden">{{ $fbads_product->sku }}</span>
                                        <input type="hidden" class="product_id" value="{{ $fbads_product->id }}">
                                        <div class="tjustify-center tflex titems-baseline tspace-x-2 tmt-1">
                                            <span class="ttext-xl tfont-black ttext-pink-600">₱{{ $fbads_product->price }}</span>
                                            <span class="ttext-sm ttext-gray-400 tline-through">₱{{ $fbads_product->slashed_price }}</span>
                                        </div>
                                        <button class=" tw-full tbg-gray-900 ttext-white ttext-xs tfont-bold tpy-2 trounded-lg hover:tbg-gray-800 ttransition tflex titems-center tjustify-center tgap-2">
                                            Add to Order
                                        </button>
                                    </div>
                                </div>

                                <?php  } ?>
                               
                            </div>
                        </div>

                         <div class="success-modal-action-buttons">
                            <a href="https://www.facebook.com/groups/422982666836465" class="success-modal-btn success-modal-btn-primary zoom-in-out-box">Join Our MissTisa <br> VIP Facebook Group</a>
                        </div>
                    </div>
                </div>

                <!-- Loading Overlay -->
                <div class="loading-overlay" id="loadingOverlay">
                    <div class="loading-content">
                        <div class="loading-animation">
                            <div class="skincare-bottle"></div>
                            <div class="bubble"></div>
                            <div class="bubble"></div>
                            <div class="bubble"></div>
                            <div class="bubble"></div>
                        </div>
                        
                        <h2 class="loading-title">Processing Your Order</h2>
                        <p class="loading-message">
                            Please wait while we prepare your<br>
                            skincare products with love ✨
                        </p>
                        
                        <div class="loading-dots">
                            <div class="loading-dot"></div>
                            <div class="loading-dot"></div>
                            <div class="loading-dot"></div>
                        </div>
                    </div>
                </div> <!-- Loading Overlay -->

 

            <button class="order_now tabsolute  tbottom-0 tfixed tfont-medium tmb-5 tmt-4 tpy-3 trounded-full ttext-lg ttext-white tw-10/12 waves-effect zoom-in-out-box" 
                style="position: fixed; max-width: 480px; z-index: 999; opacity: 1; margin-left: auto; margin-right: auto; left: 0; right: 0;background-color: #ee2a7b;">
                Start My Melasma Journey
            </button>
        </div>
    </div>

        <!-- Promo Toast Container -->
    <div id="promoToast" class="tfixed ttop-0 tleft-0 tright-0 tz-50 ttransform t-translate-y-full ttransition-transform tduration-300 tease-in-out">
        <div class="tbg-gradient-to-r tfrom-pink-500 tto-red-500 ttext-white tpx-4 tpy-3 tshadow-lg">
           <div class="tmax-w-6xl tmx-auto">
                <div class="tflex titems-start tspace-x-3 tmb-2">
                    <div class="tbg-white tbg-opacity-20 trounded-full tp-2 tmt-1">
                        <svg class="tw-5 th-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="tflex-1">
                        <div class="tfont-bold ttext-sm tmb-2">🔥 PROMO ACTIVE!</div>
                        <div id="promoToastContent" class="ttext-sm topacity-90"></div>
                    </div>
                </div>
                <div class="ttext-center ttext-xs topacity-75 tfont-medium">SAVE MORE!</div>
            </div>
        </div>
    </div>

    <footer>

        {{-- /// ORDER PROCESSING SCRIPT --}}
    <script>
        // Get products data from PHP
        const products = <?= $products_json ?>;
        
        let currentTotal = products[0].price;
        let selectedProducts = [0];
        let quantities = <?= json_encode(array_fill(0, count($products), 0)) ?>;
        quantities[0] = 1; // Set first product quantity to 1
        
        // Create prices array from products
        const prices = products.map(product => product.price);

        function showValidationModal(missingFields) {
            const modal = document.getElementById('validationModal');
            const fieldsList = document.getElementById('fieldsList');
            const missingFieldsDiv = document.getElementById('missingFields');
            
            // Clear previous fields
            fieldsList.innerHTML = '';
            
            // Add missing fields to list
            missingFields.forEach(field => {
                const li = document.createElement('li');
                li.textContent = field;
                fieldsList.appendChild(li);
            });
            
            // Show missing fields section
            missingFieldsDiv.style.display = 'block';
            
            // Show modal with animation
            modal.classList.add('show');
        }
        
        function closeModal() {
            const modal = document.getElementById('validationModal');
            modal.classList.remove('show');
        }

        function selectProduct(element, price, productIndex) {
            // Check if this is the only selected product and prevent deselection
            if (element.classList.contains('product-selected') && selectedProducts.length === 1) {
                // Don't allow deselecting the last selected product
                return;
            }
            
            // Toggle selection
            if (element.classList.contains('product-selected')) {
                // Deselect product
                element.classList.remove('product-selected');
                element.classList.add('product-unselected');
                element.classList.remove('tborder-pink-500', 'tbg-pink-50');
                element.classList.add('tborder-gray-300', 'tbg-white');
                
                // Hide quantity container
                document.getElementById(`quantity-container-${productIndex}`).classList.add('thidden');
                
                // Reset quantity and remove from selected products
                quantities[productIndex] = 0;
                document.getElementById(`quantity-${productIndex}`).textContent = 1;
                selectedProducts = selectedProducts.filter(index => index !== productIndex);
            } else {
                // Select product
                element.classList.remove('product-unselected');
                element.classList.add('product-selected');
                element.classList.remove('tborder-gray-300', 'tbg-white');
                element.classList.add('tborder-pink-500', 'tbg-pink-50');
                
                // Show quantity container
                document.getElementById(`quantity-container-${productIndex}`).classList.remove('thidden');
                
                // Set initial quantity and add to selected products
                quantities[productIndex] = 1;
                document.getElementById(`quantity-${productIndex}`).textContent = 1;
                if (!selectedProducts.includes(productIndex)) {
                    selectedProducts.push(productIndex);
                }
            }
            
            updateTotal();
        }

        function changeQuantity(productIndex, change) {
            const newQuantity = Math.max(1, quantities[productIndex] + change);
            quantities[productIndex] = newQuantity;
            document.getElementById(`quantity-${productIndex}`).textContent = newQuantity;
            updateTotal();
        }

        function updateTotal() {
            currentTotal = 0;
            let activePromos = [];
            
            selectedProducts.forEach(productIndex => {
                const quantity = quantities[productIndex];
                const product = products[productIndex];
                let productTotal = 0;
                
                // Check if product has promo and if current quantity matches any promo qty
                if (product.promo) {
                    const matchingPromo = product.promo.find(promo => promo.qty === quantity);
                    if (matchingPromo) {
                        productTotal = matchingPromo.bundle_price;
                        // Add to active promos for toast
                        activePromos.push({
                            name: product.name,
                            qty: quantity,
                            price: matchingPromo.bundle_price
                        });
                    } else {
                        productTotal = prices[productIndex] * quantity;
                    }
                } else {
                    productTotal = prices[productIndex] * quantity;
                }
                
                currentTotal += productTotal;
            });
            
            document.getElementById('total').textContent = `₱${currentTotal.toLocaleString()}`;
            
            // Update promo toast
            updatePromoToast(activePromos);
        }

        function updatePromoToast(activePromos) {
            const toast = document.getElementById('promoToast');
            const content = document.getElementById('promoToastContent');
            
            if (activePromos.length > 0) {
                // Build promo content with better formatting - border on all items
                let promoHTML = activePromos.map((promo, index) => {
                    return `
                        <div class="tflex tjustify-between titems-center tborder-b tborder-white tborder-opacity-30 tpb-2 tmb-2 tlast:tborder-b-0 tlast:tmb-0 tlast:tpb-0">
                            <span class="tfont-medium">${promo.name}</span>
                            <span class="ttext-right">Qty: ${promo.qty}pcs = ₱${promo.price.toLocaleString()}</span>
                        </div>
                    `;
                }).join('');
                
                content.innerHTML = promoHTML;
                
                // Show toast
                toast.classList.remove('-ttranslate-y-full');
                toast.classList.add('ttranslate-y-0');
            } else {
                // Hide toast
                toast.classList.remove('ttranslate-y-0');
                toast.classList.add('-ttranslate-y-full');
            }
        }

        // SUBMIT ORDER
        function submitOrder() {
            // Show loading before fetch
            showLoading();


            $.post("/event-listener",{
                submit_order: 1,
                website: '{{ $website }}',
                session_id: '{{ $session_id }}',
            });//  EVENT LISTENER Track SUBMIT ORDER
            console.log('submit Order From submitOrder()')

            const full_name = document.getElementById('full_name').value.trim();
            const phone_number = document.getElementById('phone_number').value.trim();
            const address = document.getElementById('address').value.trim();

            // Check for missing fields
            const missingFields = [];
            if (!full_name) missingFields.push('Full Name');
            if (!phone_number) missingFields.push('Contact Number');
            if (!address) missingFields.push('Complete Address');

            if (missingFields.length > 0) {
                hideLoading();// Hide loading

                showValidationModal(missingFields);
                return;
            }

            if (selectedProducts.length === 0) {
                hideLoading();// Hide loading

                showValidationModal(['At least one product selection']);
                return;
            }

            // Create products array from selected products
            // Create products array from selected products with promo pricing
            const productsArray = selectedProducts.map(productIndex => {
                const quantity = quantities[productIndex];
                const product = products[productIndex];
                let subtotal = 0;
                let unitPrice = product.price;
                
                // Check if product has promo and if current quantity matches any promo qty
                if (product.promo) {
                    const matchingPromo = product.promo.find(promo => promo.qty === quantity);
                    if (matchingPromo) {
                        subtotal = matchingPromo.bundle_price;
                        unitPrice = matchingPromo.bundle_price; // Use bundle price as unit price for display
                    } else {
                        subtotal = product.price * quantity;
                    }
                } else {
                    subtotal = product.price * quantity;
                }
                
                return {
                    id: product.id,
                    name: product.name,
                    qty: quantity,
                    price: unitPrice,
                    subtotal: subtotal
                };
            });

            // Create order object
            const orderData = {
                customer: {
                    full_name: full_name,
                    phone_number: phone_number,
                    address: address
                },
                products: productsArray,
                total: currentTotal
            };

            // =================== InitiateCheckout=======================
            

            if (currentTotal < 3000) {
                console.log('send Initiate Checkout value to Pixel: '+ currentTotal);

                fbq('track', 'InitiateCheckout', {
                    currency: "PHP",
                    value: currentTotal
                });
            } // Fire FB Purchase Pixel if order value only lessthan 3k


            // START =================== SUBMIT ORDER =======================

            // ==== Get CSRF token from meta tag ====
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Make POST request using fetch
            fetch('{{ route("miss_tisa_submit") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(orderData)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {// Handle successful response
                hideLoading();// Hide loading


                if (data.total < 3000) {// original working

                    fbq('track', 'Purchase', { currency: "PHP",  value: data.total }, {
                        eventID: data.purchase_event_id
                    });  // WORKING 

                    // Save phone for upsell use global variable
                    window.missTisaCustomerPhone = window.missTisaCustomerPhone || {};
                    window.missTisaCustomerPhone = data.contact_number; // or data.phone_number – depende sa response mo

                    // GLOBAL VARIABLE ORDER ID
                    window.global_order_id = window.global_order_id || {};
                    window.global_order_id = data.order_id;

                } // If Order Value > 3000 = DONT Send data to FACEBOOK


                
                if (data.success) {
                    showSuccessModal(data);
                    console.log(data.total)
                    

                    $.post("/event-listener",{
                        order_success: 1,
                        name: data.customer,
                        contact_number: data.contact_number,
                        website: '{{ $website }}',
                        session_id: '{{ $session_id }}',
                    });//  EVENT LISTENER Track SUBMIT ORDER


                }// Show the beautiful success modal

                console.log('Success:', data);
            })
            .catch(error => {
                hideLoading();// Hide loading

                // Handle errors
                console.error('Error:', error);
            });
            // END ==================== SUBMIT ORDER =======================


            // Console log the complete order
            console.log('=== ORDER SUBMITTED ===');
            console.log('Order Data:', orderData);
            console.log('=======================');
        } // Submit Order

        // Initialize with first product selected
        document.addEventListener('DOMContentLoaded', function() {
            updateTotal();
        });
    </script>


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



        // $(document).ready(function() {
        //     const $window = $(window);
        //     const $document = $(document);
        //     const $button = $('.order_now');
            
        //     let isHidden = false;
        //     let scrollTimeout;
        //     let isScrolling = false;
            
        //     // Cache the calculation that doesn't change frequently
        //     let hideThreshold = $document.height() - 550;
            
        //     // Function to recalculate page dimensions
        //     function recalculateThreshold() {
        //         hideThreshold = $document.height() - 550;
        //     }
            
        //     // Recalculate on various events that might change page height
        //     $window.on('resize', recalculateThreshold);
            
        //     // Listen for image load events to recalculate when lazy images load
        //     $(document).on('load', 'img', recalculateThreshold);
            
        //     // Force recalculation when images finish loading
        //     $('img').on('load', recalculateThreshold);
            
        //     // Fallback: periodically recalculate for any missed lazy loads
        //     setInterval(recalculateThreshold, 1000);
            
        //     // Reset scrolling flag periodically in case it gets stuck
        //     setInterval(function() {
        //         if (isScrolling) {
        //             isScrolling = false;
        //         }
        //         console.log('aaa');
        //     }, 2000); // Improve this in the future.
        //     // The Problem here is this function runs every 3 seconds. which can cost performance bottleneck.

            
        //     function toggleButton(show) {
        //         if (show && isHidden) {
        //             isHidden = false;
        //             $button.stop(true, true)
        //                 .css({ 'display': 'block', 'z-index': 999 })
        //                 .animate({ opacity: 1 }, 50);
        //         } else if (!show && !isHidden) {
        //             isHidden = true;
        //             $button.stop(true, true)
        //                 .css('z-index', 0)
        //                 .animate({ opacity: 0 }, 50, function() {
        //                     $(this).css('display', 'none');
        //                 });
        //         }
        //     }
            
        //     // Throttled scroll handler
        //     $window.on('scroll', function() {
        //         clearTimeout(scrollTimeout);
        //         scrollTimeout = setTimeout(function() {
        //             const scrollPosition = $window.height() + $window.scrollTop();
        //             toggleButton(scrollPosition <= hideThreshold);
        //         }, 16);
        //     });
            
        //     // Improved scroll to bottom function with lazy load support
        //     function scrollToBottom() {
        //         isScrolling = true;
                
        //         // Force lazy images to load by triggering scroll events
        //         const currentScroll = $window.scrollTop();
        //         $window.trigger('scroll');
                
        //         // Small delay to allow lazy loading to trigger
        //         setTimeout(function() {
        //             const $target = $('#submit_btn');
        //             let targetOffset;
                    
        //             // Recalculate page height in case images loaded
        //             recalculateThreshold();
                    
        //             if ($target.length) {
        //                 targetOffset = $target.offset().top - 20;
        //             } else {
        //                 // Fallback: scroll to actual bottom of page
        //                 targetOffset = $document.height() - $window.height();
        //             }
                    
        //             $('html, body').animate({
        //                 scrollTop: targetOffset
        //             }, {
        //                 duration: 'slow',
        //                 complete: function() {
        //                     // Double-check position after animation with multiple retries
        //                     let retryCount = 0;
        //                     const maxRetries = 3;
                            
        //                     function checkPosition() {
        //                         const currentScroll = $window.scrollTop();
        //                         const maxScroll = $document.height() - $window.height();
                                
        //                         // Recalculate in case more images loaded during scroll
        //                         recalculateThreshold();
                                
        //                         let finalTarget;
        //                         if ($target.length) {
        //                             finalTarget = $target.offset().top - 20;
        //                         } else {
        //                             finalTarget = $document.height() - $window.height();
        //                         }
                                
        //                         // If we're not at the intended position and haven't exceeded retries
        //                         if (Math.abs(currentScroll - finalTarget) > 10 && retryCount < maxRetries) {
        //                             retryCount++;
        //                             $('html, body').animate({
        //                                 scrollTop: finalTarget
        //                             }, 200, checkPosition);
        //                         } else {
        //                             isScrolling = false;
        //                         }
        //                     }
                            
        //                     setTimeout(checkPosition, 100);
        //                 }
        //             });
        //         }, 100);
        //     }
            
        //     // Order button click handler
        //     $button.on('click', function(e) {
        //         e.preventDefault();
        //         scrollToBottom();
                
        //         // Event tracking
        //         $.post('/event-listener', {
        //             order_form: 1,
        //             website: '{{ $website }}',
        //             session_id: '{{ $session_id }}'
        //         }).fail(function() {
        //             console.warn('Failed to track order form event');
        //         });
        //     });
        // });

        $(document).ready(function() {
    const $window = $(window);
    const $document = $(document);
    const $button = $('.order_now');
    
    let isHidden = false; // Note: You might want to start this as true if you want it hidden on load
    let scrollTimeout;
    let isScrolling = false;
    
    // Cache the calculation that doesn't change frequently
    let hideThreshold = $document.height() - 550;
    
    // --- NEW: Variable to store where the CTA section is ---
    let showCtaThreshold = 0;
    
    // Function to recalculate page dimensions
    function recalculateThreshold() {
        hideThreshold = $document.height() - 550;
        
        // --- NEW: Calculate the position of the #show_cta element ---
        const $ctaElement = $('#show_cta');
        if ($ctaElement.length) {
            // We use offset().top so we know how far down the page it is
            showCtaThreshold = $ctaElement.offset().top;
        }
    }
    
    // Recalculate on various events that might change page height
    $window.on('resize', recalculateThreshold);
    
    // Listen for image load events to recalculate when lazy images load
    $(document).on('load', 'img', recalculateThreshold);
    
    // Force recalculation when images finish loading
    $('img').on('load', recalculateThreshold);
    
    // Fallback: periodically recalculate for any missed lazy loads
    setInterval(recalculateThreshold, 1000);
    
    // Reset scrolling flag periodically in case it gets stuck
    setInterval(function() {
        if (isScrolling) {
            isScrolling = false;
        }
        console.log('aaa');
    }, 2000); 

    
    function toggleButton(show) {
        if (show && isHidden) {
            isHidden = false;
            $button.stop(true, true)
                .css({ 'display': 'block', 'z-index': 999 })
                .animate({ opacity: 1 }, 50);
        } else if (!show && !isHidden) {
            isHidden = true;
            $button.stop(true, true)
                .css('z-index', 0)
                .animate({ opacity: 0 }, 50, function() {
                    $(this).css('display', 'none');
                });
        }
    }
    
    // Throttled scroll handler
    $window.on('scroll', function() {
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(function() {
            // We need the current top position to compare with #show_cta
            const currentScrollTop = $window.scrollTop();
            
            // We need the bottom position to compare with footer (existing logic)
            const scrollBottomPosition = $window.height() + currentScrollTop;
            
            // --- NEW CONDITION ---
            // 1. Have we passed the #show_cta element? (currentScrollTop >= showCtaThreshold)
            // 2. Are we still above the bottom/footer? (scrollBottomPosition <= hideThreshold)
            const shouldShow = (currentScrollTop >= showCtaThreshold) && (scrollBottomPosition <= hideThreshold);
            
            toggleButton(shouldShow);
        }, 16);
    });
    
    // Improved scroll to bottom function with lazy load support
    function scrollToBottom() {
        isScrolling = true;
        
        // Force lazy images to load by triggering scroll events
        const currentScroll = $window.scrollTop();
        $window.trigger('scroll');
        
        // Small delay to allow lazy loading to trigger
        setTimeout(function() {
            const $target = $('#submit_btn');
            let targetOffset;
            
            // Recalculate page height in case images loaded
            recalculateThreshold();
            
            if ($target.length) {
                targetOffset = $target.offset().top - 20;
            } else {
                // Fallback: scroll to actual bottom of page
                targetOffset = $document.height() - $window.height();
            }
            
            $('html, body').animate({
                scrollTop: targetOffset
            }, {
                duration: 'slow',
                complete: function() {
                    // Double-check position after animation with multiple retries
                    let retryCount = 0;
                    const maxRetries = 3;
                    
                    function checkPosition() {
                        const currentScroll = $window.scrollTop();
                        const maxScroll = $document.height() - $window.height();
                        
                        // Recalculate in case more images loaded during scroll
                        recalculateThreshold();
                        
                        let finalTarget;
                        if ($target.length) {
                            finalTarget = $target.offset().top - 20;
                        } else {
                            finalTarget = $document.height() - $window.height();
                        }
                        
                        // If we're not at the intended position and haven't exceeded retries
                        if (Math.abs(currentScroll - finalTarget) > 10 && retryCount < maxRetries) {
                            retryCount++;
                            $('html, body').animate({
                                scrollTop: finalTarget
                            }, 200, checkPosition);
                        } else {
                            isScrolling = false;
                        }
                    }
                    
                    setTimeout(checkPosition, 100);
                }
            });
        }, 100);
    }
    
    // Order button click handler
    $button.on('click', function(e) {
        e.preventDefault();
        scrollToBottom();
        
        // Event tracking
        $.post('/event-listener', {
            order_form: 1,
            website: '{{ $website }}',
            session_id: '{{ $session_id }}'
        }).fail(function() {
            console.warn('Failed to track order form event');
        });
    });
    
    // --- NEW: Trigger initial calculation immediately ---
    recalculateThreshold();
});


        $('#full_name').change(function (e) {
            $.post("/event-listener",{
                full_name: $(this).val(),
                website: '{{ $website }}',
                session_id: '{{ $session_id }}',
            });// EVENT LISTENER Track ENTER FULL NAME
        });
        
        $('#phone_number').change(function (e) {
            $.post("/event-listener",{
                phone_number: $(this).val(),
                website: '{{ $website }}',
                session_id: '{{ $session_id }}',
            });// EVENT LISTENER Track ENTER CONTACT NUMBER
        });

        $('#address').change(function (e) {
            $.post("/event-listener",{
                address: $(this).val(),
                website: '{{ $website }}',
                session_id: '{{ $session_id }}',
            });// EVENT LISTENER Track ENTER CONTACT NUMBER
        });

        $('.promo').click(function (e) {
            $.post("/event-listener",{
                promo: 1,
                website: '{{ $website }}',
                session_id: '{{ $session_id }}',
            });// EVENT LISTENER Track ENTER CONTACT NUMBER
        });

        $('#submit_btn').click(function () {
            // $.post("/event-listener",{
            //     submit_order: 1,
            //     website: '{{ $website }}',
            //     session_id: '{{ $session_id }}',
            // });//  EVENT LISTENER Track SUBMIT ORDER
            // console.log('submit Order From #submit_btn')
        })

        $("#form").submit(function(event) {
            $('#submit_btn').addClass('thidden');
            $('#loader').removeClass('thidden');
        });

        $.post("/event-listener",{
            visitors: 1,
            website: '{{ $website }}',
            session_id: '{{ $session_id }}',
        });//  EVENT LISTENER Track VIEW

    </script>
        
    <script> // LOADING SCRIPT
        function showLoading() { // Function to show loading overlay
            const overlay = document.getElementById('loadingOverlay');
            overlay.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function hideLoading() { // Function to hide loading overlay
            const overlay = document.getElementById('loadingOverlay');
            overlay.classList.remove('show');
            document.body.style.overflow = 'auto';
        }
    </script>
    
    <script>  // ORDER SUCCESS MODAL SCRIPT

        // Function to show success modal with data */
        function showSuccessModal(data = null) {
            const modal = document.getElementById('successModal');
            
            // If data is provided, populate the modal
            if (data && data.success) {
                document.getElementById('successModalCustomerName').textContent = data.customer;
                
                // Format promo text with line breaks
                const promoElement = document.getElementById('successModalPromoText');
                const formattedPromo = data.promo.split(' + ').join('\n');
                promoElement.style.whiteSpace = 'pre-line'; // This makes \n work
                promoElement.textContent = formattedPromo;
                
                document.getElementById('successModalTotalAmount').textContent = '₱' + data.total.toLocaleString();
            }
            
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        // Function to close success modal
        function closeSuccessModal() {
            $('#full_name').val('');
            $('#phone_number').val('');
            $('#address').val('');

            const modal = document.getElementById('successModal');
            modal.classList.remove('show');
            document.body.style.overflow = 'auto';
            location.reload();
        }

        // Test function with sample data
        function testSuccessModal() {
            const sampleData = {
                "success": true,
                "message": "Order submitted successfully!",
                "customer": "Reggie Frias",
                "promo": "1 - MissTisa Skincare Set + 1 - Lotion Sunscreen SPF50 PA++++ + 1 - Serum Luminous Glow Pro + 1 - Skincare Trio Set+Lotion+Serum",
                "total": 3296
            };
            showSuccessModal(sampleData);
        }

        document.getElementById('successModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeSuccessModal();
            }
        }); // Close modal when clicking outside content

                
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && document.getElementById('successModal').classList.contains('show')) {
                closeSuccessModal();
            }
        }); // Close modal with Escape key


    </script> 


    <script> // UPSELL
        $(document).ready(function() {
            // Keep track of added upsell products
            let upsellProducts = [];
            let initialProducts = ''; // Store the original products
            let initialTotal = 0;     // Store the original total
            let isInitialized = false;

            // Handle Add to Order button clicks
            $('.success-modal').on('click', '.tbg-gray-900', function(e) {
                e.preventDefault();
                
                // Initialize on first click
                if (!isInitialized) {
                    initialProducts = $('#successModalPromoText').text().trim();
                    initialTotal = parseInt(
                        $('#successModalTotalAmount').text()
                            .replace('₱', '')
                            .replace(/,/g, '')
                    );
                    isInitialized = true;
                    
                    // Add white-space style to the products element
                    $('#successModalPromoText').css('white-space', 'pre-line');
                }
                
                // Get the product card
                const productCard = $(this).closest('.tsnap-center');
                
                // Extract product details
                const productName = productCard.find('.upsell_product').text().trim();
                const productId = parseInt(productCard.find('.product_id').val());

                const productPrice = parseInt(
                    productCard.find('.tfont-black.ttext-pink-600').text()
                        .replace('₱', '')
                        .replace(/,/g, '')
                );
                
                // Check if product already added
                const existingProduct = upsellProducts.find(p => p.name === productName);
                if (existingProduct) {
                    alert('This product has already been added to your order.');
                    return;
                }
                
                // Add to upsell products array
                upsellProducts.push({
                    name: productName,
                    price: productPrice,
                    productId: productId
                });
                
                // Update the products display (UI only)
                updateOrderDetails();
                
                // Change button state
                $(this)
                    .text('Added ✓')
                    .removeClass('tbg-gray-900 hover:tbg-gray-800')
                    .addClass('tbg-green-600')
                    .prop('disabled', true);

                // 🔥 NEW: fire upsell to backend + Pixel
                triggerUpsellPurchase(productName, productPrice, productId);
            });

            function updateOrderDetails() {
                // Start with initial products
                let productsText = initialProducts;
                let addedTotal = 0;
                
                // Add each upsell product on a new line
                upsellProducts.forEach((product) => {
                    productsText += '\n+ ' + product.name;
                    addedTotal += product.price;
                });
                
                // Calculate new total
                const newTotal = initialTotal + addedTotal;
                
                // Update the DOM
                $('#successModalPromoText').text(productsText);
                $('#successModalTotalAmount').text('₱' + newTotal.toLocaleString());
            }

            // 🔥 NEW: send upsell purchase to backend + fire Pixel Purchase
            function triggerUpsellPurchase(productName, productPrice, productId) {
                const customerPhone = window.missTisaCustomerPhone || null;
                const global_order_id = window.global_order_id || null;

                const csrfToken = $('meta[name="csrf-token"]').attr('content');

                if (!customerPhone) {
                    console.warn('No customer phone available for upsell tracking.');
                    return;
                }

                const payload = {
                    phone_number: customerPhone,
                    order_id: global_order_id,
                    product_name: productName,
                    upsell_total: productPrice,
                    product_id: productId
                };

                console.log(payload);

                fetch("{{ route('miss_tisa.upsell') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify(payload),
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Upsell request failed with status ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    if (!data.success) {
                        console.warn('Upsell response not successful:', data);
                        return;
                    }

                    console.log('Upsell CAPI sent. Amount:', data.upsell_total);
                    console.log('Upsell eventID:', data.upsell_purchase_event_id);

                    // Pixel Purchase for the upsell
                    if (typeof fbq !== 'undefined') {
                        fbq('track', 'Purchase', {
                            value: data.upsell_total,
                            currency: 'PHP',
                        }, {
                            eventID: data.upsell_purchase_event_id
                        }); //WORKING
                    }
                })
                .catch(error => {
                    console.error('Error sending upsell purchase:', error);
                });
            }
        });
    </script>

    <script> // TESTIMONIAL SCRIPT
        document.addEventListener('DOMContentLoaded', () => {
            const track = document.getElementById('slider-track');
            const slides = Array.from(track.children);
            const nextBtn = document.getElementById('next-btn');
            const prevBtn = document.getElementById('prev-btn');
            
            let currentIndex = 0;
            const totalSlides = slides.length;

            function updateSliderPosition() {
                // width is dynamic now, so we calculate based on the container's current width
                const slideWidth = track.parentElement.getBoundingClientRect().width;
                track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
            }

            nextBtn.addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % totalSlides;
                updateSliderPosition();
            });

            prevBtn.addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
                updateSliderPosition();
            });

            // Update position on window resize to keep alignment correct
            window.addEventListener('resize', updateSliderPosition);
        });
    </script>   

    </footer>



</body>
</html>