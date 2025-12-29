<?php

// Products array - easy to manage and update
$products = [
    [
        'id' => 0,
        'name' => '1Pc MissTisa Set',
        'price' => 499,
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
        'name' => '2pcs MissTisa Set',
        'price' => 799,
        'image' => 'https://matildasbeauty.com/filemanager/ab38e19e27d840abbc96eb22a85f530f.png',
        'description' => 'Advanced anti-aging and whitening serum',
    ],
    [
        'id' => 2,
        'name' => 'Set + Serum FREE VITAMIN C',
        'price' => 999,
        'image' => 'https://matildasbeauty.com/filemanager/9071030cb8ab448d95211aac0e9093bc.png',
        'description' => 'High protection sunscreen lotion',
    ],
    [
        'id' => 3,
        'name' => 'Set + Lotion+ Serum Free Victoria Secret',
        'price' => 1399,
        'image' => 'https://matildasbeauty.com/filemanager/a657f8a7c4e04717ab90214ce3221948.png',
        'description' => 'Complete beauty set with serum and lotion'
    ]
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css" integrity="sha512-gMjQeDaELJ0ryCI+FtItusU9MkAifCZcGq789FrzkiM49D8lbDhoaUaIX4ASU187wofMNlgBJ4ckbrXM9sE6Pg==" crossorigin="anonymous" referrerpolicy="no-referrer" />    <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">

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
            <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=375777585581364&ev=PageView&noscript=1"
        /></noscript>
        <!-- End Meta Pixel Code -->
    @endif

</head>
<body>
    <div style="scroll-behavior: smooth;max-width: 480px;" class="tmx-auto" id="body">
        <div class="tflex tfont-medium titems-center tjustify-center trelative tshadow-md ttext-center" style="height: 31px; background: #fa199e;">
            <div >
                {{-- <div class="">
                    <p class="t-mt-2 tfont-medium  ttext-4xl ttext-white">Good Bye Kulubot</p>
                </div> --}}
                <div class="">
                    <span class="ttext-sm ttext-white">
                        <i class="fas fa-star ttext-yellow-300"></i>
                        <i class="fas fa-star ttext-yellow-300"></i>
                        <i class="fas fa-star ttext-yellow-300"></i>
                        <i class="fas fa-star ttext-yellow-300"></i>
                        <i class="fas fa-star ttext-yellow-300"></i>
                    </span>
                    <span class="ttext-md ttext-white">
                        <span><u>9.5k</u> Ratings</span>
                        <span> | </span>
                        <span><u>23.6k</u> Sold</span>
                    </span>
                </div>
            </div>
            <button class="focus:tbg-pink-300 order_now tabsolute tbottom-0 tfixed tfont-medium tpy-2 trounded-full tshadow-lg ttext-white tw-10/12 waves-effect zoom-in-out-box" style="bottom: -447%;max-width: 240px;width: 36%;right: 4%;color: #ffffff;background-color: #ee2a7b;">ORDER NOW!
            </button>
        </div>


        <img src="https://matildasbeauty.com/filemanager/afe4fc9e1c00485d9797336377793dff.webp" width="480" height="480" class="tw-full tmb-2" alt="#1 Kulubot Remover">

        {{-- <div class="tmx-3 tflex titems-center tmy-5">
            <div class="tw-1/2 tborder-gray-200 tborder-r-2 ttext-center ">
                <span class="ttext-sm ttext-white">
                    <i class="fas fa-star" style="color: #ee4d2d;" aria-hidden="true"></i>
                    <i class="fas fa-star" style="color: #ee4d2d;" aria-hidden="true"></i>
                    <i class="fas fa-star" style="color: #ee4d2d;" aria-hidden="true"></i>
                    <i class="fas fa-star" style="color: #ee4d2d;" aria-hidden="true"></i>
                    <i class="fas fa-star" style="color: #ee4d2d;" aria-hidden="true"></i>
                </span>
                <span class="ttext-md ttext-green-900">
                    <span class="tfont-bold"> &nbsp; 4.8</span>
                    <span class="tfont-medium">Ratings</span>
                </span>
            </div>
            <div class="tw-1/2 ttext-green-900 ttext-center tfont-medium ">⭐19,586 Trusted Reviews</div>
        </div><!-- Trusted Reviews --> --}}

        <div class="tfont-semibold tmx-3 tmy-4  ttext-center">
            <i class="fas fa-check-circle tmb-2" style="color: #12bc39;"></i> LEGIT | 🚚 Fast Delivery | 💸 COD | <i class="fas fa-check-circle tmb-2" style="color: #12bc39;"></i> FDA 
        </div>


         <div class="tborder-dashed ttext-center tmx-3 tmy-2 tpx-3 tpy-1" style="border: 2px solid #ee2a7b; border-style: dashed;">
            <span class="tfont-bold  ttext-center" style="font-size: 20px;">FREE Pomelo Vitamin C – Ends Soon!</span>
            <span class="ttext-md tfont-bold tflex tjustify-center" style="color: #ff0021;">
                ⏰
                <div id="timer_top">18:38</div>
                mins
            </span>
            {{-- <span class="theme-color tfont-medium tml-2"> FREE 2 Gifts</span> --}}
        </div><!-- FREE 2 Gifts -->

        <div class="tflex tw-full tflex-wrap tjustify-center tpy-3 tpx-3 tmb-3">
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #f52d87;"></i><b> Kulubot</b> </div>
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #f52d87;"></i><b> Wrinkles</b> </div>
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2" style="color: #f52d87;"></i> Melasma Remover</div>
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2" style="color: #f52d87;"></i> Korean Glass Skin</div>
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #f52d87;"></i><b> No More Pekas</b></div>
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #f52d87;"></i> <b>Pinkish Skin</b></div>
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2" style="color: #f52d87;"></i> No More Dark Spots</div>
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2" style="color: #f52d87;"></i> Uneven Skin Tone</div>
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2" style="color: #f52d87;"></i> Deep Scars</div>
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2" style="color: #f52d87;"></i> Whiteheads</div>
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2" style="color: #f52d87;"></i> Blackheads</div>
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2" style="color: #f52d87;"></i> Skin Whitening</div>
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2" style="color: #f52d87;"></i> For Sensitive Skin</div>
            <div class="tw-1/2 tmb-3"><i class="fas fa-check-circle tmb-2" style="color: #f52d87;"></i> No Irritation </div>
          
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2" style="color: #12bc39;"></i> FDA Approved</div>
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2" style="color: #12bc39;"></i> Safe</div>
            <div class="tw-full"><i class="fas fa-check-circle tmb-2" style="color: #12bc39;"></i> Proven & tested by many users</div>
        </div>


        <img class="tmb-3" src="https://matildasbeauty.com/filemanager/523e7f186fa140a59b0b1a823da23c5d.webp" loading="lazy" width="480" height="480" alt="mudra before & After">
        <img class="tmb-3" src="https://matildasbeauty.com/filemanager/9cbf82ef5abd4084990a43b52cea2684.webp" loading="lazy" width="480" height="480" alt="mudra before & After">
        <img class="tmb-3" src="https://matildasbeauty.com/filemanager/8a66857048fd4e4f82bc93b744ebc68f.webp" loading="lazy" width="480" height="480" alt="mudra before & After">
        <img class="tmb-3" src="https://matildasbeauty.com/filemanager/82ad83ef37b343f9a85b7cee0c3f9c1a.webp" loading="lazy" width="480" height="480" alt="mudra before & After">
        <img class="tmb-3" src="https://matildasbeauty.com/filemanager/51c18c57bf684bad88bfafb3b69efe5f.webp" loading="lazy" width="480" height="480" alt="mudra before & After">
        <img class="tmb-3" src="https://matildasbeauty.com/filemanager/a6a15a12a7e04b06b0ae681342f201c6.webp" loading="lazy" width="480" height="480" alt="mudra before & After">
        <img class="tmb-3" src="https://matildasbeauty.com/filemanager/1cdb4585573a43ccbfb6a75ca6680cff.webp" loading="lazy" width="480" height="480" alt="mudra before & After">

        {{-- <img class="tmb-3" src="https://matildasbeauty.com/filemanager/943b70fea8564d969e9275e6cdec5156.webp" loading="lazy" width="480" height="480" alt="mudra before & After">
        <img class="tmb-3" src="https://matildasbeauty.com/filemanager/e835b9e4bc9f4cad803cf3c3a6ef4473.webp" loading="lazy" width="480" height="480" alt="mudra before & After">
        <img class="tmb-3" src="https://matildasbeauty.com/filemanager/36f85481a2114cc891d25704ddfa02ae.webp" loading="lazy" width="480" height="480" alt="Happy Users">
        <img class="tmb-3" src="https://matildasbeauty.com/filemanager/47e5c4f66a294471b45863de264aefa4.webp" loading="lazy" width="480" height="350" alt="28_days_challenge">
        <img class="tmb-3" src="https://matildasbeauty.com/filemanager/caeeb8c393854078ab638ce543f2daea.webp" loading="lazy" width="480" height="480" alt="MissTisa Lotion - New Image">

        <h4 class="tfont-medium tpy-3 tmt-8 ttext-xl ttext-center">HAPPY & SATISFIED CUSTOMERS</h4> --}}
       
        {{-- REVIEWS --}}

        {{-- <img src="https://matildasbeauty.com/filemanager/3de536b529bf4cfb9a3d81c5b6c537f6.webp" loading="lazy" width="480" height="1000" alt="satisfied_customer1">
        <img src="https://matildasbeauty.com/filemanager/9685bc8e635a480b84b7852dfd74b41f.webp" loading="lazy" width="480" height="1000"alt="satisfied_customer2">
        <img src="https://matildasbeauty.com/filemanager/a04e4b8538014d62a80d3dd2d3446643.webp" loading="lazy" width="480" height="1000" alt="New Before and After"> --}}


        {{-- <div class="tmx-auto trelative tp-5">
            <h3 class="tfont-medium tmb-5 ttext-2xl ttext-center">PRODUCT DETAILS</h3>

            <p style="font-size: 20px;" class="ttext-center tmb-4">
                <b><b>"</b>Revitalize Your Skin with Our Melasma Rejuvenating Set<b>"</b></b>
            </p><br>

            <h4 class="tfont-medium tmb-4 ttext-xl">BENEFITS:</h4>
            
            <img class="tmb-5" src="https://matildasbeauty.com/filemanager/092361f04f9f4b3195f3959100ac26a9.webp" loading="lazy" width="480" height="1000" alt="benefits">
     
            <img class="tmb-5" src="https://matildasbeauty.com/filemanager/b6dabd41a66a4871a61ecee70fc1b59a.webp" loading="lazy" width="480" height="1000" alt="What to expect">
            <!--WHAT TO EXPECT: -->
            
            <img class="" src="https://matildasbeauty.com/filemanager/bf4b1d217b1b4654aaae8d13809d47fd.webp" loading="lazy" width="480" height="790" alt="how_to_use in the morning">
            <img class="" src="https://matildasbeauty.com/filemanager/70dae3d024234c7b9ec182fb30aa027e.webp" loading="lazy" width="480" height="1000" alt="how_to_use in the evening">
            <img class="" src="https://matildasbeauty.com/filemanager/e8c15e1cb22e4fb6b966cae11086700a.webp" loading="lazy" width="480" height="480" alt="Serum Image">

            <img class="" src="https://matildasbeauty.com/filemanager/ae7c490cd31240b8bc0bf6a66aec5193.webp" loading="lazy" width="480" height="480" alt="how_to_use in the evening">
            <img class="" src="https://matildasbeauty.com/filemanager/07823d1b14684d76833e387789938baf.webp" loading="lazy" width="480" height="480" alt="how_to_use in the evening">
            <img class="" src="https://matildasbeauty.com/filemanager/db487fdc65274f6e91d92f590c93ec5a.webp" loading="lazy" width="480" height="480" alt="Buy 2 Take 2 Flash Sale">

        </div><!-- PRODUCT DETAILS--> --}}

        {{-- <div class="tmb-5 tborder-t" >
            <div class="tborder tpx-4 tpy-5">
                <h1 class="tmb-3 ttext-2xl">Product Ratings</h1>
                <div class="tflex titems-center tjustify-between tmb-3">
                    <p>
                        <span class="ttext-2xl tfont-semibold" style="color: #f51773">5.0</span>
                        <span class="ttext-xl tfont-medium" style="color: #f51773"> out of 5</span>
                    </p>
                    <div class="">
                        <i class="fas fa-star" style="color: #f51773;"></i>
                        <i class="fas fa-star" style="color: #f51773;"></i>
                        <i class="fas fa-star" style="color: #f51773;"></i>
                        <i class="fas fa-star" style="color: #f51773;"></i>
                        <i class="fas fa-star" style="color: #f51773;"></i>
                    </div>
                </div>    
                <div class="tflex titems-center tjustify-between">

                    <div class="trounded ttext-sm tmr-1 ttext-center trelative" style="padding: 5px 5px; border: #f51773 1px solid; color: #f51773; background: #f51773; color: white;">
                        <p>5 <i class="fas fa-star" style="color: white;"></i> (9.5k)</p>
                    </div>
                    <div class="trounded ttext-sm tmr-1 ttext-center" style="padding: 5px 5px; border: #f51773 1px solid; color: #f51773;">
                        4<i class="fas fa-star" style="color: #f51773;"></i> (0)
                    </div>
                    <div class="trounded ttext-sm tmr-1 ttext-center" style="padding: 5px 5px; border: #f51773 1px solid; color: #f51773;">
                        3<i class="fas fa-star" style="color: #f51773;"></i> (0)
                    </div>
                    <div class="trounded ttext-sm tmr-1 ttext-center" style="padding: 5px 5px; border: #f51773 1px solid; color: #f51773;">
                        2<i class="fas fa-star" style="color: #f51773;"></i> (0)
                    </div>
                    <div class="trounded ttext-sm tmr-1 ttext-center" style="padding: 5px 5px; border: #f51773 1px solid; color: #f51773;">
                        1<i class="fas fa-star" style="color: #f51773;"></i> (0)
                    </div>
                </div>
                
                <div class="tmt-5 tpb-5">
                    <div class="tflex titems-center">
                        <img src="{{ asset('images/kasoy_oil/reviews/review1/profile.png') }}" class="trounded-full" style="width: 40px;" alt="Emerlita manao" loading="lazy" width="100" height="100">
                        <div class="tml-2">
                            <p>Emerlita Manao</p>
                            <div class="">
                                <i class="fas fa-star" style="color: #f51773;"></i>
                                <i class="fas fa-star" style="color: #f51773;"></i>
                                <i class="fas fa-star" style="color: #f51773;"></i>
                                <i class="fas fa-star" style="color: #f51773;"></i>
                                <i class="fas fa-star" style="color: #f51773;"></i>
                            </div>
                            <span style="margin-top: 0.25rem;margin-bottom: 0.9375rem;font-size: .75rem;color: rgba(0,0,0,.54);">April 14, 2023 09:07AM</span>
                        </div>
                    </div>
                    <div class="tpy-2" >
                        Hala grabi. <b>Effective pala talaga ang MissTisa</b> totoo pala ung napnoud ko na video.
                        Kitang kita naman sa picture ko nag <b>fade talga ung melasma ko in 3 Weeks.</b> 
                    </div>
                    <div class="tflex" style="">
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review1/1.png') }}" loading="lazy" width="100" height="100" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review1/2.png') }}" loading="lazy" width="100" height="100" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review1/3.png') }}" loading="lazy" width="100" height="100" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review1/4.png') }}" loading="lazy" width="100" height="100" class="tmr-1 trounded">
                        </div>
                    </div>
                </div><!-- REVIEW 1 -->

                <div class="tmt-5 tpb-5">
                    <div class="tflex titems-center">
                        <img src="{{ asset('images/kasoy_oil/reviews/review2/profile.png') }}" class="trounded-full" style="width: 40px;" alt="batang" loading="lazy" width="100" height="100">
                        <div class="tml-2">
                            <p>Maricel Batang</p>
                            <div class="">
                                <i class="fas fa-star" style="color: #f51773;"></i>
                                <i class="fas fa-star" style="color: #f51773;"></i>
                                <i class="fas fa-star" style="color: #f51773;"></i>
                                <i class="fas fa-star" style="color: #f51773;"></i>
                                <i class="fas fa-star" style="color: #f51773;"></i>
                            </div>
                            <span style="margin-top: 0.25rem;margin-bottom: 0.9375rem;font-size: .75rem;color: rgba(0,0,0,.54);">June 14, 2023 12:48PM</span>
                        </div>
                    </div>
                    <div class="tpy-2" >
                       <b> Sobrang problemado talaga ako sa Melasma ko.</b> Maputi naman ung face ko
                       Kaya lalong naging Visible ung Melasma ko. Nakuha ko to sa panga-nganak
                       sa Pangalawa ko. Ang dami ko na din nasubukan ok naman <b> kaso mas na satisfy
                       lang talga ako dito sa MissTisa </b>lang ung may pinaka magandang Effect.
                    </div>
                    <div class="tflex" style="">
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review2/1.png') }}" loading="lazy" width="100" height="100" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review2/2.png') }}" loading="lazy" width="100" height="100" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review2/3.png') }}" loading="lazy" width="100" height="100" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review2/4.png') }}" loading="lazy" width="100" height="100" class="tmr-1 trounded">
                        </div>
                    </div>
                </div><!-- REVIEW 2 -->

                <div class="tmt-5 tpb-5">
                    <div class="tflex titems-center">
                        <img src="{{ asset('images/kasoy_oil/reviews/review3/profile.png') }}" class="trounded-full" style="width: 40px;" alt="analiza" loading="lazy" width="100" height="100">
                        <div class="tml-2">
                            <p>Analiza Pareo</p>
                            <div class="">
                                <i class="fas fa-star" style="color: #f51773;"></i>
                                <i class="fas fa-star" style="color: #f51773;"></i>
                                <i class="fas fa-star" style="color: #f51773;"></i>
                                <i class="fas fa-star" style="color: #f51773;"></i>
                                <i class="fas fa-star" style="color: #f51773;"></i>
                            </div>
                            <span style="margin-top: 0.25rem;margin-bottom: 0.9375rem;font-size: .75rem;color: rgba(0,0,0,.54);">July 01, 2023 08:03PM</span>
                        </div>
                    </div>
                    <div class="tpy-2" >
                        Hi!. <b>I was so frustrated with my melasma.</b>  i'm a korean living here in philippines.
                        My Filipino husband bought me this product. <b>I tried many korean products</b>  but this is only 
                        The Rejuvenating set worked for me. this is my result after using for month </b>
                    </div>
                    <div class="tflex" style="">
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review3/1.png') }}" loading="lazy" width="100" height="100" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review3/2.png') }}" loading="lazy" width="100" height="100" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review3/3.png') }}" loading="lazy" width="100" height="100" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review3/4.png') }}" loading="lazy" width="100" height="100" class="tmr-1 trounded">
                        </div>
                    </div>
                </div><!-- REVIEW 3 -->
                
                <div class="tmt-5 tpb-5">
                    <div class="tflex titems-center">
                        <img src="{{ asset('images/kasoy_oil/reviews/review4/profile.png') }}" class="trounded-full" style="width: 40px;" alt="sharon" loading="lazy" width="100" height="100">
                        <div class="tml-2">
                            <p>Sharon Temon</p>
                            <div class="">
                                <i class="fas fa-star" style="color: #f51773;"></i>
                                <i class="fas fa-star" style="color: #f51773;"></i>
                                <i class="fas fa-star" style="color: #f51773;"></i>
                                <i class="fas fa-star" style="color: #f51773;"></i>
                                <i class="fas fa-star" style="color: #f51773;"></i>
                            </div>
                            <span style="margin-top: 0.25rem;margin-bottom: 0.9375rem;font-size: .75rem;color: rgba(0,0,0,.54);">June 25, 2023 04:22PM</span>
                        </div>
                    </div>
                    <div class="tpy-2" >
                        The before and after of my face is proof that MissTisa Product is very Effective.
                        The Glass Skin Effect is superb, And my melasma is totally Gone.
                        I would definitely recommend this to my co mother who suffer also from melasma.
                    </div>
                    <div class="tflex" style="">
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review4/1.png') }}" loading="lazy" width="100" height="100" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review4/2.png') }}" loading="lazy" width="100" height="100" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review4/3.png') }}" loading="lazy" width="100" height="100" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review4/4.png') }}" loading="lazy" width="100" height="100" class="tmr-1 trounded">
                        </div>
                    </div>
                </div><!-- REVIEW 4 -->

                <div class="tmt-5 tpb-5">
                    <div class="tflex titems-center">
                        <img src="{{ asset('images/kasoy_oil/reviews/review5/profile.png') }}" class="trounded-full" style="width: 40px;" alt="liza manalo" loading="lazy" width="100" height="100">
                        <div class="tml-2">
                            <p>Liza Manalo</p>
                            <div class="">
                                <i class="fas fa-star" style="color: #f51773;"></i>
                                <i class="fas fa-star" style="color: #f51773;"></i>
                                <i class="fas fa-star" style="color: #f51773;"></i>
                                <i class="fas fa-star" style="color: #f51773;"></i>
                                <i class="fas fa-star" style="color: #f51773;"></i>
                            </div>
                            <span style="margin-top: 0.25rem;margin-bottom: 0.9375rem;font-size: .75rem;color: rgba(0,0,0,.54);">July 02, 2023 07:27AM</span>
                        </div>
                    </div>
                    <div class="tpy-2" >
                        <b>Wag kayo bibili nito! Kung ayaw nyo Mawala agad ang melasma nyo ng 1 week.</b> 
                        Mga sis Legit at Effective Talga sya lalo na kapag wala ka palya sa pag lagay.
                        1 Week kitang kita na result tulad ng pic ko dito oh.
                    </div>
                    <div class="tflex" style="">
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review5/1.png') }}" loading="lazy" width="100" height="100" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review5/2.png') }}" loading="lazy" width="100" height="100" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review5/3.png') }}" loading="lazy" width="100" height="100" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review5/4.png') }}" loading="lazy" width="100" height="100" class="tmr-1 trounded">
                        </div>
                    </div>
                </div><!-- REVIEW 5 -->

                <div class="tmt-5 tpb-5">
                    <div class="tflex titems-center">
                        <img src="{{ asset('images/kasoy_oil/reviews/review6/profile.png') }}" class="trounded-full" loading="lazy" style="width: 40px;" alt="" width="100" height="100">
                        <div class="tml-2">
                            <p>Rebecca Morales</p>
                            <div class="">
                                <i class="fas fa-star" style="color: #f51773;"></i>
                                <i class="fas fa-star" style="color: #f51773;"></i>
                                <i class="fas fa-star" style="color: #f51773;"></i>
                                <i class="fas fa-star" style="color: #f51773;"></i>
                                <i class="fas fa-star" style="color: #f51773;"></i>
                            </div>
                            <span style="margin-top: 0.25rem;margin-bottom: 0.9375rem;font-size: .75rem;color: rgba(0,0,0,.54);">June 16, 2023 01:29PM</span>
                        </div>
                    </div>
                    <div class="tpy-2" >
                        <b> Dati Palagi nalang ako naka Mask.</b> Kasi Ang Dami kong Melasma. 
                        kaya Thankful ako kasi nakita ko itong MISSTISA isang Set palang
                        at <b>1 week Kitang kita na agad ang effect nya.</b>  at nag Glass SKin pa face ko.
                    </div>
                    <div class="tflex" style="">
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review6/1.png') }}" loading="lazy" width="100" height="100" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review6/2.png') }}" loading="lazy" width="100" height="100" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review6/3.png') }}" loading="lazy" width="100" height="100" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review6/4.png') }}" loading="lazy" width="100" height="100" class="tmr-1 trounded">
                        </div>
                    </div>
                </div><!-- REVIEW 6 -->

            </div>  <!-- RATINGS DIV -->
        </div> <!-- RATINGS --> --}}

        {{-- <h3 class="tfont-medium tmb-5 ttext-2xl ttext-center">FDA CERTIFICATES</h3> --}}

        {{-- <img src="https://matildasbeauty.com/filemanager/b864e63d955f47289504464f0471a6a3.webp" loading="lazy" width="480" height="480" alt="fda_certificate MissTisa Set" class="tmb-5">
        <img src="https://matildasbeauty.com/filemanager/b83e1f3a40f24410aa5d25c089b7d62f.webp" loading="lazy" width="480" height="480" alt="fda_certificate Serum" class="tmb-5"> 
        <img class="tmb-3" src="https://matildasbeauty.com/filemanager/caeeb8c393854078ab638ce543f2daea.webp" loading="lazy" width="480" height="480" alt="MissTisa Lotion - New Image"> --}}

        <h1 class="tfont-bold tpy-5 ttext-3xl ttext-center ttext-red ttext-white tmt-10" style="
            background: #ff5f29;
            background: linear-gradient(90deg, rgba(255, 95, 41, 1) 0%, rgba(253, 29, 29, 1) 40%, rgba(252, 145, 69, 1) 100%);
        ">NEW PRODUCT!</h1>

        <img class="tmb-3" src="https://matildasbeauty.com/filemanager/55c2868e86fc435aae2b55a4c96fe6f8.webp" loading="lazy" width="480" height="480" alt="pmelo serum">
        <img class="" src="https://matildasbeauty.com/filemanager/7463ba9ebfd44727a67b35d1777826a4.webp" loading="lazy" width="480" height="480" alt="pmelo serum">



        <div class="tmx-auto trelative tborder tpb-5">
            <div class="tflex tjustify-center tflex-wrap tfont-medium titems-center ttext-center">
                <img src="{{ asset('images\icons\free-shipping.png') }}" class="tmy-3" alt="free shipping" width="200" height="123">
                <span class="tmb-1">Nationwide Luzon, Visayas & Mindanao </span>
            </div>

            <section class="tflex titems-baseline tmt-5 tmb-3">
                <div class="ttext-center">
                    <i class="fas fa-truck ttext-4xl" style="color: #ee2aa9; line-height: 1.2;"></i>
                    <span class="tinline-block tmt-1">Fast delivery nationwide</span>
                </div>
                <div class="ttext-center">
                    <i class="fas fa-dollar-sign ttext-4xl" style="color: #ee2aa9; line-height: 1.2;" ></i>
                    <span class="tinline-block tmt-1">Moneyback Guarantee</span>
                </div>
                <div class="ttext-center">
                    <i class="fas fa-hand-holding-usd ttext-4xl" style="color: #ee2aa9; line-height: 1.2;" ></i>
                    <span class="tinline-block tmt-1">Cash on Delivery</span>
                </div>
                <div class="ttext-center">
                    <i class="fas fa-headset ttext-4xl" style="color: #ee2aa9; line-height: 1.2;"></i>
                    <span class="tinline-block tmt-1">Unlimited SkincareTips</span>
                </div>
            </section>

            {{-- <img src="https://matildasbeauty.com/filemanager/30ab80a0c85a4df69f8917950955e48f.webp" width="480" height="480" alt="buy 2 take 2"> --}}

           {{-- <div class="tbg-yellow-300 tborder-2 tborder-red-500 tfont-medium tmb-2 tmt-5 tmx-4 trounded ttext-center ttext-red-700">
                <span class="ttext-lg">Enjoy our Free Soap & Sunscreen</span>
                <br> <span class="tfont-extrabold ttext-md ttext-red-900">Sold out twice, Don't Miss it <br> 
                <span class="ttext-md">We'll never offer this again.</span>
                </span> 
            </div> --}}

            {{-- <form action="{{ route('miss_tisa_submit') }}" id="form" class="relative" method="post" enctype="multipart/form-data">
                <input type="hidden" id="purchase_value" value="{{ request()->amount }}"> --}}
                {{-- <h3 class="tfont-medium tmb-4 tpt-5 ttext-center">ORDER FORM</h3> --}}

                {{-- @csrf --}}

                {{-- <div class="tw-full tflex tmb-3">
                    <div class="tw-1/2 tmr-1">
                        <label for="full_name" class="tfont-medium ttext-sm tmb-2 ttext-black-100">Full Name</label>
                        <input required type="text" name="full_name" id="full_name" value="{{ old('full_name') }}" class="browser-default input-control">
                    </div>
                    <div class="tw-1/2 tml-1 trelative">
                        @error('phone_number')
                            <span class="tabsolute tfont-bold ttext-red-600 ttext-xs" style="bottom: -29%;left: 1%;">{{ $message }}</span>
                        @enderror
                        <label for="phone_number" class="tfont-medium ttext-sm tmb-2 ttext-black-100">Phone Number</label>
                        <input required type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" class="browser-default input-control">
                    </div>
                </div><!--full_name & Phone Number -->
                <div class="tw-full tflex tmb-3">
                    <div class="tw-auto tmr-1">
                        <label for="address" class=" ttext-sm tmb-2 ttext-black-100">
                            <span class="tfont-medium">Complete Address</span>
                            <small class="ttext-gray-600">(St./House No. | blk & lot/ Subdv / Barangay / City / Province)</small>
                        </label>
                        <input required type="text" name="address" id="address" value="{{ old('address') }}" class="browser-default input-control">
                    </div>
                </div><!--Address --> --}}

                {{-- ============================================================================================= --}}


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
                                        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="tw-full th-full tobject-cover trounded-md" />
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
                                        <img src="{{ $fbads_product->image1 }}" alt="{{ $fbads_product->sku }}" class="tw-full th-full tobject-cover">
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

                {{-- ============================================================================================= --}}

                {{-- <div class="tmt-3 ttext-right tw-full">
                    <span class="ttext-gray-900" style="font-size: 16px;">
                        <span class="tfont-medium">TOTAL:</span>
                        <span class="tfont-medium">₱</span>
                        <span id="total" class="tfont-medium t-ml-1">1399</span>
                    </span>
                </div> --}}


                {{-- <div class="tw-full ">
                    <button style="background-color: #ee2a7b" class="focus:tbg-pink-500 trelative tshadow tfont-medium tmt-4 tpy-3 trounded-full ttext-2xl ttext-white tw-full waves-effect z-depth-5" id="submit_btn">
                        <span>Checkout Order</span>
                    </button>
                    <span style="background-color: #ee2a7b" class="thidden focus:tbg-pink-500 trelative ttext-center tshadow tfont-medium tmt-4 tpy-3 trounded-full ttext-2xl ttext-white tw-full waves-effect z-depth-5" id="loader">
                        <img src="{{ asset('/loader/four_dots_loader.svg') }}" style="display: initial; position: absolute; top: -29%; right: 35px;">
                        <span class="tmr-5">Loading please wait</span>
                    </span>
                </div><!-- Submit Order -->
            </form><!-- ORDER PROMO --> --}}


            {{-- <div id="modal1" class="modal">
                <div class="modal-content" style="padding-bottom: 0px;">
                    <h4 class="tfont-medium ttext-3xl">Thank you</h4>
                    <h5 class="tfont-medium tmb-3 tmt-4 ttext-xl">Your order was completed successfully.</h5>
                
                    <p>We want to assure you that we are working diligently to process and ship your order as quickly as possible.</p><br>
                    <p><span class="tfont-medium">Metro Manila:</span>  1-3 working days.</p>
                    <p><span class="tfont-medium">Visayas & Mindanao:</span> 4-7 days.</p>
                    <br>
                    <p>
                        We truly appreciate your business and look forward to serving you again in the future.
                    </p><br>
                    <p class="tfont-medium">We appreciate your business!</p>

                </div>
                <div class="modal-footer">
                    <a href="" class="modal-close waves-effect waves-green btn-flat">Close</a>
                </div>
            </div> <!-- Modal  --> --}}

            <button class="order_now tabsolute  tbottom-0 tfixed tfont-medium tmb-5 tmt-4 tpy-3 trounded-full ttext-lg ttext-white tw-10/12 waves-effect zoom-in-out-box" 
                style="position: fixed; max-width: 480px; z-index: 999; opacity: 1; margin-left: auto; margin-right: auto; left: 0; right: 0;background-color: #ee2a7b;">
                ORDER NOW!
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




        let firstClickMade = false;

        function selectProduct(element, price, productIndex) {
            // On first click, auto-deselect the default (index 0) if clicking a different product
            if (!firstClickMade && productIndex !== 0 && selectedProducts.includes(0)) {
                const defaultCard = document.querySelector('.product-card.product-selected');
                if (defaultCard) {
                    defaultCard.classList.remove('product-selected');
                    defaultCard.classList.add('product-unselected');
                    defaultCard.classList.remove('tborder-pink-500', 'tbg-pink-50');
                    defaultCard.classList.add('tborder-gray-300', 'tbg-white');
                    
                    // Hide quantity container for default
                    const defaultQuantityContainer = document.getElementById('quantity-container-0');
                    if (defaultQuantityContainer) {
                        defaultQuantityContainer.classList.add('thidden');
                    }
                    
                    // Reset quantity and remove from selected products
                    quantities[0] = 0;
                    const defaultQuantitySpan = document.getElementById('quantity-0');
                    if (defaultQuantitySpan) {
                        defaultQuantitySpan.textContent = 1;
                    }
                    selectedProducts = selectedProducts.filter(index => index !== 0);
                }
                firstClickMade = true;
            }
            
            // Check if this is the only selected product and prevent deselection
            if (element.classList.contains('product-selected') && selectedProducts.length === 1) {
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
                const quantityContainer = document.getElementById(`quantity-container-${productIndex}`);
                if (quantityContainer) {
                    quantityContainer.classList.add('thidden');
                }
                
                // Reset quantity and remove from selected products
                quantities[productIndex] = 0;
                const quantitySpan = document.getElementById(`quantity-${productIndex}`);
                if (quantitySpan) {
                    quantitySpan.textContent = 1;
                }
                selectedProducts = selectedProducts.filter(index => index !== productIndex);
            } else {
                // Select product
                element.classList.remove('product-unselected');
                element.classList.add('product-selected');
                element.classList.remove('tborder-gray-300', 'tbg-white');
                element.classList.add('tborder-pink-500', 'tbg-pink-50');
                
                // Show quantity container
                const quantityContainer = document.getElementById(`quantity-container-${productIndex}`);
                if (quantityContainer) {
                    quantityContainer.classList.remove('thidden');
                }
                
                // Set initial quantity and add to selected products
                quantities[productIndex] = 1;
                const quantitySpan = document.getElementById(`quantity-${productIndex}`);
                if (quantitySpan) {
                    quantitySpan.textContent = 1;
                }
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

        // var $window = $(window),x
            //     $document = $(document),
            //     button = $('.order_now');
                
            // $window.on('scroll', function () {
            //     let scrollH = $(window).height() + $(window).scrollTop();
            //     let H = ($document.height() - 550);

            //     if (scrollH > H) {
            //         $('.order_now').css('display', 'none');
            //         button.stop(true).css('z-index', 0).animate({
            //             opacity: 0,
            //         }, 50);

            //     } else {
            //         $('.order_now').css('display', 'block');

            //         button.stop(true).css('z-index', 999).animate({
            //             opacity: 1
            //         }, 50);
            //     }
            // });// hide show ORDER BUTTON on Scroll

            // $('.order_now').click(function (e) {
            //     $('html, body').animate({
            //         scrollTop: $('#submit_btn').offset().top - 20 //#DIV_ID is an example. Use the id of your destination on the page
            //     }, 'slow');

            //     $.post("/event-listener",{
            //         order_form: 1, 
            //         website: '{{ $website }}',
            //         session_id: '{{ $session_id }}',
            //     });// EVENT LISTENER Track ORDER FORM
        // });

        $(document).ready(function() {
            const $window = $(window);
            const $document = $(document);
            const $button = $('.order_now');
            
            let isHidden = false;
            let scrollTimeout;
            let isScrolling = false;
            
            // Cache the calculation that doesn't change frequently
            let hideThreshold = $document.height() - 550;
            
            // Function to recalculate page dimensions
            function recalculateThreshold() {
                hideThreshold = $document.height() - 550;
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
            }, 2000); // Improve this in the future.
            // The Problem here is this function runs every 3 seconds. which can cost performance bottleneck.

            
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
                    const scrollPosition = $window.height() + $window.scrollTop();
                    toggleButton(scrollPosition <= hideThreshold);
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

    <script>
        let timeLeft = 27 * 43;

        function updateTimerTop() {
            const m = Math.floor(timeLeft / 60).toString().padStart(2, '0');
            const s = (timeLeft % 60).toString().padStart(2, '0');
            $('#timer_top').text(`${m}:${s}`);

            if (timeLeft > 0) {
            timeLeft--;
            } else {
            clearInterval(timer);
                alert("Time's up!");
            }
        }

        function updateTimerBottom() {
            const m = Math.floor(timeLeft / 60).toString().padStart(2, '0');
            const s = (timeLeft % 60).toString().padStart(2, '0');
            $('#timer_bottom').text(`${m}:${s}`);

            if (timeLeft > 0) {
            timeLeft--;
            } else {
            clearInterval(timer);
                alert("Time's up!");
            }
        }

        const timer_top = setInterval(updateTimerTop, 1000);
        const timer_bottom = setInterval(updateTimerBottom, 1000);
        updateTimerTop();
        updateTimerBottom();
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

    </footer>



</body>
</html>