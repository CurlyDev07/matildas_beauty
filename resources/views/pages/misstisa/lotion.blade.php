<?php

// Products array - easy to manage and update
$products = [
    [
        'id' => 0,
        'name' => '1Pc MissTisa Lotion',
        'price' => 649,
        'image' => 'https://matildasbeauty.com/filemanager/c71a493b00594e8390bc43bb44342923.png',
        'description' => 'Advanced anti-aging and whitening serum',
        // 'promo' => [
        //     [
        //         'qty' => 2,
        //         'bundle_price' => 849
        //     ]
        // ]   
    ],
    [
        'id' => 1, 
        'name' => 'Buy 1 Get 1 HALF PRICE',
        'price' => 973,
        'image' => 'https://matildasbeauty.com/filemanager/bddbaac773644f63bf8a6aefc4e3cac6.png',
        'description' => 'Advanced anti-aging and whitening serum',
    ],
    [
        'id' => 2,
        'name' => 'Buy 2 Get 1 for Free',
        'price' => 1298,
        'image' => 'https://matildasbeauty.com/filemanager/cd45d7b5bce74dd1a0fc3449e7a03393.png',
        'description' => 'High protection sunscreen lotion',
    ],
    // [
    //     'id' => 3,
    //     'name' => 'Skincare Trio Set + Lotion+ Serum',
    //     'price' => 1399,
    //     'image' => 'https://matildasbeauty.com/filemanager/e94f2d3153de4058ac5264dd31c0af0f.png',
    //     'description' => 'Complete beauty set with serum and lotion'
    // ]
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
            width: 80px;
            height: 80px;
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
            margin: 25px 0;
            text-align: left;
        }

        .success-modal-detail-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 18px;
            padding-bottom: 18px;
            border-bottom: 1px solid #eee;
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
                margin: 10px;
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
                    <span class="tfont-bold ttext-white" style="font-size: 20px;">3x Bigger 100g for face &amp; Body</span>
                </div>
            </div>
        </div>

        <!-- <img src="https://matildasbeauty.com/filemanager/ebac5e3ae0014c9ebf182d37d8a7dea0.webp" width="480" height="480" class="tw-full tmb-2" alt="#1 Kulubot Remover"> -->
        <img src="https://matildasbeauty.com/filemanager/8dc4ab92ce0344ddbded6e4951314708.png" width="480" height="480" class="tw-full" alt="#1 Kulubot Remover">

        <!-- <div class="tmx-3 tflex titems-center tmy-5">
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
        </div>Trusted Reviews -->

        <div class="tflex tfont-medium titems-center tjustify-center trelative tshadow-md ttext-center" style="height: 31px;background: #ed1c59;">
            <div>
                
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

        </div>

        <div class="tfont-semibold tmx-3  ttext-center">
            <i class="fas fa-check-circle tmt-5 tmb-2" style="color: #12bc39;"></i> LEGIT | 🚚 Fast Delivery | 💸 COD | <i class="fas fa-check-circle tmb-2" style="color: #12bc39;"></i> FDA 
        </div>

        <!-- <div class="tborder-dashed ttext-center tmx-3 tmy-2 tpx-3 tpy-1" style="border: 2px solid #ee2a7b; border-style: dashed;">
            <span class="tfont-bold  ttext-center" style="font-size: 20px;">All-in-1 Skincare Sale – Ends Soon!</span>
            <span class="ttext-md tfont-bold tflex tjustify-center" style="color: #ff0021;">
                ⏰
                <div id="timer_top">18:38</div>
                mins
            </span>
            {{-- <span class="theme-color tfont-medium tml-2"> FREE 2 Gifts</span> --}}
        </div>FREE 2 Gifts -->


        <!-- SOLUTION -->
        <div class="tflex tw-full tflex-wrap tjustify-center tpt-3 tpx-3 ">
            <span class="tfont-bold  ttext-center" style="font-size: 25px;">
                MissTisa Dewy Glow Lotion
            </span>
            <!-- <span class="tfont-medium  ttext-center tmb-5" style="font-size: 14px;">
                MissTisa gives you the fresh, dewy glow you’ve always wanted —
                without the oiliness, lagkit, or irritation. -->
            </span>


            <div class="tpt-3 ttext-md tw-full tmb-3">
                <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #f52d87;"></i>
                <b>Dewy glow without the oiliness</b>
                <div style="line-height: 0.5;" class="tml-5 ttext-gray-600">Fresh, soft, glowing — never greasy.</div>
            </div>

            <div class="tpt-3 ttext-md tw-full tmb-3">
                <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #f52d87;"></i>
                <b>Zero lagkit kahit mainit, humid, pawisin</b>
                <br>
                <div style="line-height: 0.5;" class="tml-5 ttext-gray-600">Perfect for real Filipina weather.</div>
            </div>

            <div class="tpt-3 ttext-md tw-full tmb-3">
                <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #f52d87;"></i>
                <b>No white cast on morena to misstisa skin</b>
                <br>
                <div style="line-height: 0.5;" class="tml-5 ttext-gray-600">Blends like skincare, not chalk.</div>
            </div>

            <div class="tpt-3 ttext-md tw-full tmb-3 tmb-1">
                <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #f52d87;"></i>
                <b>Glow skincare + sun defense in one</b>
                <br>
                <div style="line-height: 0.5;" class="tml-5 ttext-gray-600">Brightening Glow + High-Level Sun Defense.</div>
            </div>

            <div class="tpt-3 ttext-md tw-full tmb-3 tmb-1">
                <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #f52d87;"></i>
                <b>100g big size for daily face & body glow</b>
                <br>
                <div style="line-height: 0.5;" class="tml-5 ttext-gray-600">Hindi mabilis maubos — lasts up to 3 months.</div>
            </div>

            <span class="tfont-bold tmt-5 tp-4 tshadow-lg trounded-full tmb-5 ttext-center" style="font-size: 18px; background-color: #faebebab;">
                <i class="fas fa-times tmb-2  red-text tmr-1" style="transform:scale(1.2);"></i>
                Goodbye lagkit & dullness.
            </span>

            <span class="tfont-bold tpx-10 tpy-5 tshadow-lg trounded-full  ttext-center tmb-5" style="font-size: 18px;">
                <i class="fas fa-check-circle tmb-2" style="color: #12bc39;"></i>
                Hello soft, dewy glow.
            </span>

        </div>

        <hr class="tmy-10">


        <!-- PROBLEM -->
                
        <div class="tflex tw-full tflex-wrap tjustify-center tpt-3 tpx-3">
            <span class="tfont-bold  ttext-center" style="font-size: 25px;">Sunscreen Issues We’re All Tired Of…</span>
        </div>

        <div class="tflex tw-full tflex-wrap tjustify-center tpy-3 tpx-3">

        
            <div class="tw-1/2 ttext-md tmb-3">
                <i class="fas fa-times tmb-2  red-text tmr-1" style="transform:scale(1.2);"></i>
                <b> Malagkit</b> 
            </div>

            <div class="tw-1/2 ttext-md tmb-3">
                <i class="fas fa-times tmb-2  red-text tmr-1" style="transform:scale(1.2);"></i>
                <b> Oily & Greasy</b> 
            </div>

            <div class="tw-1/2 ttext-md tmb-3">
                <i class="fas fa-times tmb-2  red-text tmr-1" style="transform:scale(1.2);"></i>
                <b> May White Cast</b> 
            </div>

            <div class="tw-1/2 ttext-md tmb-3">
                <i class="fas fa-times tmb-2  red-text tmr-1" style="transform:scale(1.2);"></i>
                <b> Mainit sa Balat</b> 
            </div>

            <div class="tw-1/2 ttext-md tmb-3">
                <span>
                    <i class="fas fa-times tmb-2  red-text tmr-1" style="transform:scale(1.2);"></i>
                    <b> Mabilis Maubos</b> 
                </span>
            </div>

            <div class="tw-1/2 ttext-md tmb-3">
                <i class="fas fa-times tmb-2  red-text tmr-1" style="transform:scale(1.2);"></i>
                <b> Flat, Dry Finish</b> 
            </div>

            <div class="tw-1/2 ttext-md tmb-3">
                <i class="fas fa-times tmb-2  red-text tmr-1" style="transform:scale(1.2);"></i>
                <b> Harsh & Irritating</b> 
            </div>

            <div class="tw-1/2 ttext-md tmb-3">
                <i class="fas fa-times tmb-2  red-text tmr-1" style="transform:scale(1.2);"></i>
                <b> Walang Glow</b> 
            </div>

            <div class="tw-1/2 ttext-md tmb-3">
                <i class="fas fa-times tmb-2  red-text tmr-1" style="transform:scale(1.2);"></i>
                <b> tunaw sa pawis</b> 
            </div>

            <div class="tw-1/2 ttext-md tmb-3">
                <i class="fas fa-times tmb-2  red-text tmr-1" style="transform:scale(1.2);"></i>
                <b>Nag buo-buo</b> 
            </div>
        
        </div>

        <hr class="tmy-5">


        <!-- BENEFITS -->
        <div class="tflex tw-full tflex-wrap tjustify-center tpt-3 tpx-3">
            <span class="tfont-bold  ttext-center" style="font-size: 25px;">
                ✨ The Glow Benefits You’ll Feel Every Day
            </span>
            <span class="tfont-medium  ttext-center tmb-5" style="font-size: 14px;">
                MissTisa isn’t just sunscreen —
                it’s your daily glow companion.
                Soft, dewy, fresh-looking skin with every use…
                without the oily, sticky, heavy feeling.
            </span>

            <div class="tmb-5 tpt-3 tpx-5 trounded-2xl tshadow-lg ttext-md tw-full tmb-1">
                <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #f52d87;"></i>
                <b>Soft, dewy glow all day</b>
                <br>
                <div class="tml-5 tmb-3">Fresh, radiant, and blooming — never oily, never greasy.</div>
            </div>

            <div class="tmb-5 tpt-3 tpx-5 trounded-2xl tshadow-lg ttext-md tw-full tmb-1">
                <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #f52d87;"></i>
                <b>Zero lagkit kahit mainit</b>
                <br>
                <div class="tml-5 tmb-3">Stays light and comfortable even in humid, pawisin weather.</div>
            </div>

            <div class="tmb-5 tpt-3 tpx-5 trounded-2xl tshadow-lg ttext-md tw-full tmb-1">
                <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #f52d87;"></i>
                <b>No white cast on morena to MissTisa skin</b>
                <br>
                <div class="tml-5 tmb-3">Natural, seamless finish that blends like skincare.</div>
            </div>

            <div class="tmb-5 tpt-3 tpx-5 trounded-2xl tshadow-lg ttext-md tw-full tmb-1">
                <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #f52d87;"></i>
                <b>Brightening care with every application</b>
                <br>
                <div class="tml-5 tmb-3">Powered by the Brightening Glow Trio for a fresh, glowing look.</div>
            </div>

            <div class="tmb-5 tpt-3 tpx-5 trounded-2xl tshadow-lg ttext-md tw-full tmb-1">
                <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #f52d87;"></i>
                <b>Smooth, fresh, younger-looking skin</b>
                <br>
                <div class="tml-5 tmb-3">Helps your complexion look alive — not flat, not dull.</div>
            </div>

            <div class="tmb-5 tpt-3 tpx-5 trounded-2xl tshadow-lg ttext-md tw-full tmb-1">
                <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #f52d87;"></i>
                <b>Lightweight feel for daily face & body use</b>
                <br>
                <div class="tml-5 tmb-3">Perfect for women 30–70 who want glow without irritation.</div>
            </div>
            
            <span class="tfont-bold  ttext-center" style="font-size: 18px;">
                🌸 Glow that feels light. Glow that feels fresh. Glow that feels like YOU.
            </span>
                
        </div>

        <hr class="tmy-10">

        <!-- BEFORE AND AFTER -->
        <div class="tflex tw-full tflex-wrap tjustify-center tpt-3 tpx-3">
            <span class="tfont-bold  ttext-center" style="font-size: 25px;">
                ✨ See the Glow Transformation
            </span>
            <span class="tfont-medium  ttext-center tmb-5" style="font-size: 14px;">
                MissTisa isn’t just sunscreen —
                it’s your daily glow companion.
                Soft, dewy, fresh-looking skin with every use…
                without the oily, sticky, heavy feeling.
            </span>
        </div>

        <img class="" src="https://matildasbeauty.com/filemanager/cda5652c3ae34b188beccaecbdb1a89b.webp" loading="lazy" width="480" height="480" alt="mudra before & After">
        <img class="" src="https://matildasbeauty.com/filemanager/cfbea4d2efcd4025af2b9f6318334d5c.webp" loading="lazy" width="480" height="480" alt="mudra before & After">
        <img class="" src="https://matildasbeauty.com/filemanager/dfe4e018165a44e3adac9fb71fb49133.webp" loading="lazy" width="480" height="480" alt="mudra before & After">
        <img class="" src="https://matildasbeauty.com/filemanager/42bc003dea394bffa766a53b19662438.webp" loading="lazy" width="480" height="480" alt="mudra before & After">
        <img class="" src="https://matildasbeauty.com/filemanager/bfd457e499e44a4d8b8948a5050b48fe.webp" loading="lazy" width="480" height="480" alt="mudra before & After">

        <div class="tflex tw-full tflex-wrap tjustify-center tmt-10 tpt-3 tpx-3">
            <span class="tfont-bold  ttext-center" style="font-size: 18px;">
                🌸 Real Filipina glow, soft and natural — the MissTisa way.
            </span>
        </div>

        <hr class="tmy-10">


        <!-- BEFORE AND AFTER -->
        <div class="tflex tw-full tflex-wrap tjustify-center tpt-3 tpx-3">
            <span class="tfont-bold  ttext-center tmb-2" style="font-size: 25px;">
                ✨ The Top 3 Gentle Brightening Actives - Ranked
            </span>
            <!-- <span class="tfont-medium  ttext-center tmb-5 tpx-3" style="font-size: 14px;">
                Not all whitening ingredients are safe for daily use. But these three?
                They’re known as the most trusted, gentle-but-effective glow actives loved worldwide.
            </span> -->


            <div class="tmb-10 tmt-10 tpt-5 tpx-5 tpy-5 trelative trounded-lg tshadow-lg ttext-md tw-full">
                <i class="fas fa-star tmb-2 ttext-lg" style="color:#f52d87;"></i>
                <img class="tabsolute trounded-full" src="https://matildasbeauty.com/filemanager/c328011b5037496da95e79317c1f38f1.png" loading="lazy" width="100" height="100" alt="mudra before &amp; After" style="
                    top: -50px;
                    right: 27px;
                ">
                <b class="tmt-10" style="font-size: 16px;">Tranexamic</b>
                <div class="tml-5 tmb-3 ">
                    <h6>
                        <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                        <span style="color: #f62d87"><b> Strongest Gentle Brightener </b></span>
                    </h6>
                    <h6>
                        <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                        Helps the skin look clearer
                    </h6>

                    <h6>
                        <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                        Helps reduce visible uneven tone
                    </h6>

                    <h6>
                        <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                        Works gradually but effectively
                    </h6>

                    <h6>
                        <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                        Perfect for melasma-prone or mature skin
                    </h6>

                    <h6>
                        <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                        Gentle — no peeling, no redness
                    </h6>
                </div>

                <h6 class="tmb-2"><b> Why it ranks #1:</b> </h6>
                <h6>It gives the strongest brightening clarity without irritation.</h6>
            </div>

            <div class="tmb-10 tmt-10 tpt-5 tpx-5 tpy-5 trelative trounded-lg tshadow-lg ttext-md tw-full">
                <i class="fas fa-star tmb-2 ttext-lg" style="color:#f52d87;"></i>
                <img class="tabsolute trounded-full" src="https://matildasbeauty.com/filemanager/2dbb913c862a46e78ae37b249d71dde5.png" loading="lazy" width="100" height="100" alt="mudra before &amp; After" style="
                    top: -50px;
                    right: 27px;
                ">
                <b class="tmt-10" style="font-size: 16px;">Alpha Arbutin</b>
                <div class="tml-5 tmb-3 ">
                    <h6>
                        <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                        <span style="color: #f62d87"><b> Ultra Brightening Expert </b></span>
                    </h6>
                    <h6>
                        <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                        Golden standard for daily whitening
                    </h6>
                    <h6>
                        <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                        Helps brighten dark-looking areas
                    </h6>

                    <h6>
                        <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                        Helps the complexion more even
                    </h6>

                    <h6>
                        <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                        Works beautifully with Niacinamide
                    </h6>

                    <h6>
                        <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                        Safe for long-term use
                    </h6>
                </div>

                <h6 class="tmb-2"><b> Why it ranks #2:</b> </h6>
                <h6>Very effective — but stays gentle and safe for sensitive skin.</h6>
            </div><!-- arbutin  -->

            <div class="tmb-10 tmt-10 tpt-5 tpx-5 tpy-5 trelative trounded-lg tshadow-lg ttext-md tw-full">
                <i class="fas fa-star tmb-2 ttext-lg" style="color:#f52d87;"></i>
                <img class="tabsolute trounded-full" src="https://matildasbeauty.com/filemanager/e1af5d5b9be14e619b7f7e287ee3dc7c.png" loading="lazy" width="100" height="100" alt="mudra before &amp; After" style="
                    top: -50px;
                    right: 27px;
                ">
                <b class="tmt-10" style="font-size: 16px;">Niacinamide</b>
                <div class="tml-5 tmb-3 ">
                    <h6>
                        <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                        <span style="color: #f62d87"><b> (Glow & Texture Perfector) </b></span>
                    </h6>
                    <h6>
                        <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                        Helps soften dullness
                    </h6>
                    <h6>
                        <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                        Helps smooth & refine skin look
                    </h6>

                    <h6>
                        <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                        Supports a healthier glow
                    </h6>

                    <h6>
                        <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                        Gives that “clean radiance” feel
                    </h6>
                </div>

                <h6 class="tmb-2"><b> Why it ranks #3:</b> </h6>
                <h6>It brightens and improves texture — the perfect support active.</h6>
            </div><!-- Niacinamide  -->

        </div>

        <!-- INGREDIENTS -->
        <div class="tflex tw-full tflex-wrap tjustify-center tpt-3 tpx-3">

             <span class="tfont-bold  ttext-center tmy-5" style="font-size: 19px;">
                🌸 SKIN-LOVING SUPPORT ACTIVES
            </span>
            

            <div class="tw-full ttext-md tmb-3">
                <i class="fas fa-star tmb-2 ttext-lg" style="color:#ec4899d6;"></i>
                <b style="font-size: 16px;">Aloe Extract</b>
                <br>
                <div class="tml-5 tmb-3">
                    Calms and hydrates the skin for a fresh, non-dry feel.              
                </div>
            </div>

            <div class="tw-full ttext-md tmb-3">
                <i class="fas fa-star tmb-2 ttext-lg" style="color:#ec4899d6;"></i>
                <b style="font-size: 16px;">Tomato Extract</b>
                <br>
                <div class="tml-5 tmb-3">
                    Rich in natural brightening energy that helps give skin a fresh, pinkish glow.
                </div>
            </div>

            <div class="tw-full ttext-md tmb-3">
                <i class="fas fa-star tmb-2 ttext-lg" style="color:#ec4899d6;"></i>
                <b style="font-size: 16px;">Lightweight Hydrating Base</b>
                <br>
                <div class="tml-5 tmb-3">
                    Gives a soft, dewy look without the oily or sticky feeling.
                </div>
            </div>

            <div class="tw-full ttext-md tmb-3">
                <i class="fas fa-star tmb-2 ttext-lg" style="color:#ec4899d6;"></i>
                <b style="font-size: 16px;">Vitamin E</b>
                <br>
                <div class="tml-5 tmb-3">
                    Helps keep the skin soft and smooth while giving a healthy, radiant glow.
                </div>
            </div>

            <span class="tfont-medium  ttext-center tpx-3 tmt-3" style="font-size: 16px;">
                🌸 Top 3 Whitening and Brightening Ingredients — working together to give you a soft, dewy, MissTisa glow.
            </span>
            
        </div>

        <!-- PROOF METRICS -->
        <section class="tpy-4 tpx-4 tmt-10" style="background: #ED1C59; background: radial-gradient(circle, rgba(237, 28, 89, 1) 8%, rgba(237, 28, 89, 0.93) 100%);">
            <div class="tmax-w-5xl tmx-auto tgrid tgrid-cols-1 tsm:grid-cols-3 tgap-4 ttext-center ttext-white">
                
                <!-- Stat 1 -->
                <div class="tspace-y-1 tpx-10" style=" border-bottom: 1px dashed #fffeff85; padding-bottom: 10px; ">
                    <div class="ttext-2xl tsm:text-3xl tfont-bold">
                        100g
                    </div>
                    <div class="ttext-lg toppacity-90">
                        Big Glow Tube
                    </div>
                </div>

                <!-- Stat 2 -->
                <div class="tspace-y-1 tpx-10" style=" border-bottom: 1px dashed #fffeff85; padding-bottom: 10px; ">
                    <div class="ttext-2xl tsm:text-3xl tfont-bold">
                        3×
                    </div>
                    <div class="ttext-lg toppacity-90">
                        Bigger Than Regular Sunscreens
                    </div>
                </div>

                <!-- Stat 3 -->
                <div class="tspace-y-1">
                    <div class="ttext-2xl tsm:text-3xl tfont-bold">
                        9,500+
                    </div>
                    <div class="ttext-lg toppacity-90">
                        Happy Filipina Users
                    </div>
                </div>
            </div>
        </section>

        <img class="" src="https://matildasbeauty.com/filemanager/aa3ebc01a4504ca895cd61279646cbf6.webp" loading="lazy" width="480" height="480" alt="mudra before & After">


        <div class="ttext-center tmy-8">
            <span class="tfont-bold  ttext-center tmb-5 tmt-3" style="font-size: 25px;">
                🌸 100g 3x Bigger Size, <br> More Days of Glow.
            </span>
        </div>

        <img class="" src="https://matildasbeauty.com/filemanager/06e8bbd2f8a44638ab8a7bde6ce67b30.png" loading="lazy" width="480" height="480" alt="mudra before & After">


        <div class="tflex tw-full tflex-wrap tjustify-center tpt-3 tpx-3">


            <div class="tw-full ttext-md tmb-3">
                <div class="tml-5 tmb-3 tmt-3">
                        
                    <h6 class="tmb-3">
                        <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                        <b>3x bigger than regular sunscreens</b>  <br>
                        <p class="tpl-5 tpr-3">Most sunscreens are just 10–30ml — mabilis maubos.</p>
                    </h6>

                    <h6 class="tmb-3">
                        <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                        <b>Good for up to 3 months</b>  <br>
                        <p class="tpl-5 tpr-3">Isang tube lang, long-lasting glow + protection.</p>
                    </h6>

                    <h6 class="tmb-3">
                        <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                        <b>For face & body</b>  <br>
                        <p class="tpl-5 tpr-3">Hindi mo na kailangan ng hiwalay na face sunscreen at body lotion.</p>
                    </h6>

                    <h6 class="tmb-3">
                        <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                        <b>Not mabilis maubos</b>  <br>
                        <p class="tpl-5 tpr-3">Perfect for everyday Filipina use — commute, errands, work, araw-araw.</p>
                    </h6>
                    
                    <h6 class="tmb-3">
                        <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                        <b>Glow + protection = super value</b>  <br>
                        <p class="tpl-5 tpr-3">You get sunscreen + brightening skincare in one big tube.</p>
                    </h6>

                </div>
            </div>

            <span class="tfont-medium  ttext-center tpx-3" style="font-size: 16px;">
                🌸 Bigger size, bigger savings — and a glow that lasts.
            </span>
        </div>

        <img class="tmy-10" src="https://matildasbeauty.com/filemanager/2aa5f69f08704866a0d0b080b240e3f7.webp" loading="lazy" width="480" height="480" alt="mudra before & After">



        <div class="tpx-5 ttext-center">
             <span class="tfont-bold  ttext-center tmb-5 tmt-3" style="font-size: 25px;">
                🌸 Soft, Dewy Glow <br> Never Oily, Never Lagkit.
            </span>
            <!-- <span class="tfont-medium  ttext-center tmb-8 tpx-3" style="font-size: 14px;">
                MissTisa gives you that <b>fresh</b> , <b>dewy finish</b>  you love…
                pero <b>hindi oily</b> ,<b> hindi sticky</b> , at <b>hindi mainit sa balat</b>  —
                perfect for daily Filipina weather.
            </span> -->
        </div>
        <div class="tflex tw-full tflex-wrap tjustify-center tpt-3 tpx-3">

           

            <div class="tw-full ttext-md tmb-3">
                <i class="fas fa-star tmb-2 ttext-lg" style="color:#ec4899d6;"></i>
                <b style="font-size: 16px;">Dewy glow, not oily shine</b>
                <br>
                <div class="tml-5 tmb-3">
                    Glowy look na fresh — hindi greasy, hindi heavy.
                </div>
            </div>

            <div class="tw-full ttext-md tmb-3">
                <i class="fas fa-star tmb-2 ttext-lg" style="color:#ec4899d6;"></i>
                <b style="font-size: 16px;">Zero lagkit kahit mainit</b>
                <br>
                <div class="tml-5 tmb-3">
                    Comfortable all day, even sa commute, errands, at pawisin na weather.                
                </div>
            </div>

            <div class="tw-full ttext-md tmb-3">
                <i class="fas fa-star tmb-2 ttext-lg" style="color:#ec4899d6;"></i>
                <b style="font-size: 16px;">No white cast</b>
                <br>
                <div class="tml-5 tmb-3">
                    Blends naturally on morena to MissTisa skin tones.
                </div>
            </div>

            <div class="tw-full ttext-md tmb-3">
                <i class="fas fa-star tmb-2 ttext-lg" style="color:#ec4899d6;"></i>
                <b style="font-size: 16px;">Lightweight & breathable</b>
                <br>
                <div class="tml-5 tmb-3">
                    Feels like skincare — hindi mabigat, hindi “mask-like.”
                </div>
            </div>

            <div class="tw-full ttext-md tmb-3">
                <i class="fas fa-star tmb-2 ttext-lg" style="color:#ec4899d6;"></i>
                <b style="font-size: 16px;">Smooth, easy-to-blend texture</b>
                <br>
                <div class="tml-5 tmb-3">
                    No streaks, no chalkiness, no hassle.
                </div>
            </div>

            <div class="tw-full ttext-md tmb-3">
                <i class="fas fa-star tmb-2 ttext-lg" style="color:#ec4899d6;"></i>
                <b style="font-size: 16px;">Perfect under makeup</b>
                <br>
                <div class="tml-5 tmb-3">
                    Doesn’t pill, doesn’t clump —
                    gives a soft, glowing base.
                </div>
            </div>

            <span class="tfont-medium  ttext-center tpx-3 tmt-3" style="font-size: 16px;">
                🌸 “Dewy, glowing, fresh — a finish your skin will fall in love with.”
            </span>
            
        </div>

        <hr class="tmy-10">

        <!-- TEXTURE -->
        <div class="tflex tw-full tflex-wrap tjustify-center tpt-3 tpx-3 ">

            <span class="tfont-bold  ttext-center tmb-5 tmt-3" style="font-size: 25px;">
                🌸 Stay Fresh, Stay Glowing Even in PH Heat.
            </span>
            <span class="tfont-medium  ttext-center tmb-8 tpx-3" style="font-size: 14px;">
                PH heat makes <b>other sunscreens oily.</b>
                MissTisa stays <b>fresh and glowing all day</b> .
            </span>

            <div class="tw-full ttext-md tmb-3">
                <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>
                <b style="font-size: 16px;">Hindi natutunaw sa pawis</b>
                <br>
                <div class="tml-5 tmb-3">
                   Stays intact — no melting, no greasy shine.
                </div>
            </div>

            <div class="tw-full ttext-md tmb-3">
                <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>
                <b style="font-size: 16px;">Fresh look kahit 30–35° heat</b>
                <br>
                <div class="tml-5 tmb-3">
                    Perfect for errands, commute, outdoor work, or long days out.
                </div>
            </div>

            <div class="tw-full ttext-md tmb-3">
                <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>
                <b style="font-size: 16px;">Humidity-proof finish</b>
                <br>
                <div class="tml-5 tmb-3">
                    Designed para hindi mag-breakdown kahit sticky ang weather.
                </div>
            </div>

            <div class="tw-full ttext-md tmb-3">
                <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>
                <b style="font-size: 16px;">Soft glow—not oily shine</b>
                <br>
                <div class="tml-5 tmb-3">
                    Dewy where you want… fresh everywhere else.
                </div>
            </div>

            <div class="tw-full ttext-md tmb-3">
                <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>
                <b style="font-size: 16px;">Comfortable for pawisin & oily skin</b>
                <br>
                <div class="tml-5 tmb-3">
                    Light, breathable, and never heavy.
                </div>
            </div>

            <div class="tw-full ttext-md tmb-3">
                <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>
                <b style="font-size: 16px;">Perfect under makeup</b>
                <br>
                <div class="tml-5 tmb-3">
                    Doesn’t pill, doesn’t clump —
                    gives a soft, glowing base.
                </div>
            </div>

            <span class="tfont-medium  ttext-center tpx-3 tmt-3" style="font-size: 16px;">
                🌸 “Glow that stays—kahit gaano kainit ang Pilipinas.”
            </span>
            
        </div>

        <img class="tmy-10" src="https://matildasbeauty.com/filemanager/efbe898f0d5842539e82f1747a65fdc3.webp" loading="lazy" width="480" height="480" alt="mudra before & After">

        <!-- MissTisa VS Other Brand -->
        <div class="tflex tw-full tflex-wrap tjustify-center tpt-3 tpx-3 tmb-10">

            <span class="tfont-bold  ttext-center tmb-5 tmt-3" style="font-size: 25px;">
                🌸 Why MissTisa Stands Out vs Other Brands
            </span>

            <div class="tw-full ttext-md tmb-3">
                <i class="fas fa-star tmb-2 ttext-lg" style="color:#f52d87;"></i>
                <b style="font-size: 16px;">Why Filipinas Choose MissTisa</b>

                <div class="tml-5 tmb-3">
                    <h6>
                        <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                        Dewy glow, never oily
                    </h6>

                    <h6>
                        <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                        Zero lagkit kahit humid
                    </h6>

                    <h6>
                        <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                        No white cast
                    </h6>

                    <h6>
                        <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                        Glow skincare + SPF
                    </h6>

                    <h6>
                        <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                        100g big tube (3x bigger)
                    </h6>

                    <h6>
                        <i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #03af1a;"></i>    
                        Gentle for daily face & body
                    </h6>
                </div>
            </div>

            <div class="tw-full ttext-md tmb-3">
                <b style="font-size: 16px;">❌ Why Other Sunscreens Don’t Work</b>

                <div class="tml-5 tmb-3 tmt-3">
                    <h6 class="tmb-2 ttext-lg">
                        ❌ Oily & greasy
                    </h6>

                    <h6 class="tmb-2 ttext-lg"> ❌ Sticky sa init
                    </h6>

                    <h6 class="tmb-2 ttext-lg"> ❌ No white cast
                    </h6>

                    <h6 class="tmb-2 ttext-lg"> ❌ May white cast
                    </h6>

                    <h6 class="tmb-2 ttext-lg"> ❌ SPF only, no glow
                    </h6>

                    <h6 class="tmb-2 ttext-lg"> ❌ 10–30ml lang
                    </h6>
                    <h6> ❌ Mabilis maubos
                    </h6>
                </div>
            </div>



            <span class="tfont-medium  ttext-center tpx-3 tmt-3" style="font-size: 16px;">
                🌸 “Glow that stays—kahit gaano kainit ang Pilipinas.”
            </span>
            
        </div>





        <!-- TESTIMONIAL -->
        <section class="tpy-16 tpx-4 tbg-[#fff6fb]">
        <div class="tmax-w-5xl tmx-auto">

            <!-- Heading -->
            <div class="ttext-center tmb-12">
            <h2 class="ttext-3xl tfont-bold ttext-[#d81b60]">
                Real Filipina Glow Stories ✨
            </h2>
            <p class="tmt-4 ttext-lg ttext-gray-600">
                See the fresh, dewy glow from real MissTisa users.
            </p>
            </div>

            <!-- Testimonials Grid -->
            <div class="tgrid tgap-8 tgrid-cols-1 tmd:grid-cols-2">

            <!-- CARD 1 -->
            <article class="tbg-white trounded-3xl tshadow-md tborder tborder-pink-100 toverflow-hidden">
                
                <!-- Big Image Placeholder -->
                <div class="tbg-pink-100 th-60 tw-full toverflow-hidden">
                <!-- Replace with <img> -->
                <img 
                    src="https://matildasbeauty.com/filemanager/6559f4a5eac943e79c95b69a8614ea62.webp" 
                    alt="Customer Photo"
                    class="tw-full th-full tobject-cover tobject-center"
                />
                </div>

                <!-- Text -->
                <div class="tp-6 tsm:tp-8 tspace-y-4 trelative">

                <!-- Big quote icon -->
                <div class="tabsolute ttop-4 tright-6 ttext-pink-300 ttext-5xl tfont-serif">
                    &ldquo;
                </div>

                <p class="ttext-lg tleading-relaxed ttext-gray-700">
                    “Finally! Sunscreen na hindi sticky. Parang skincare lang—fresh at glowing all day.”
                </p>

                <p class="ttext-sm tfont-semibold ttext-[#d81b60]">
                    Sunshine, 37 • Working mom
                </p>
                </div>
            </article>

            <!-- CARD 2 -->
            <article class="tbg-white trounded-3xl tshadow-md tborder tborder-pink-100 toverflow-hidden">

                <div class="tbg-pink-100 th-60 tw-full">
                <img 
                    src="https://matildasbeauty.com/filemanager/c6ffc18d4a64436c9e51268a1a04c12a.webp" 
                    alt="Customer Photo"
                    class="tw-full th-full tobject-cover tobject-center"
                />
                </div>

                <div class="tp-6 tsm:tp-8 tspace-y-4 trelative">
                <div class="tabsolute ttop-4 tright-6 ttext-pink-300 ttext-5xl tfont-serif">
                    &ldquo;
                </div>

                <p class="ttext-lg tleading-relaxed ttext-gray-700">
                    “Ang daming sunscreen nagre-react sa’kin… pero ito, never nangate. Soft glow lang.”
                </p>

                <p class="ttext-sm tfont-semibold ttext-[#d81b60]">
                    Patricia, 28 • Sensitive skin
                </p>
                </div>
            </article>

                <!-- CARD 5 -->
            <article class="tbg-white trounded-3xl tshadow-md tborder tborder-pink-100 toverflow-hidden tmd:col-span-2">

                <div class="tbg-pink-100 th-60 tw-full">
                <img 
                    src="https://matildasbeauty.com/filemanager/fa9d5cd7538b46e09717e56eb439a06a.webp" 
                    alt="Customer Photo"
                    class="tw-full th-full tobject-cover tobject-center"
                />
                </div>

                <div class="tp-6 tsm:tp-8 tspace-y-4 trelative">
                <div class="tabsolute ttop-4 tright-6 ttext-pink-300 ttext-5xl tfont-serif">
                    &ldquo;
                </div>

                <p class="ttext-lg tleading-relaxed ttext-gray-700">
                    “Ang sarap sa skin. Dewy pero hindi oily. Mas fresh tingnan yung face ko buong araw.”
                </p>

                <p class="ttext-sm tfont-semibold ttext-[#d81b60]">
                    Shaina, 19 • Student
                </p>
                </div>

            </article>

            <!-- CARD 3 -->
            <article class="tbg-white trounded-3xl tshadow-md tborder tborder-pink-100 toverflow-hidden">

                <div class="tbg-pink-100 th-60 tw-full">
                <img 
                    src="https://matildasbeauty.com/filemanager/1d87f9e0009a4fad9b800058dbd20554.webp" 
                    alt="Customer Photo"
                    class="tw-full th-full tobject-cover tobject-center"
                />
                </div>

                <div class="tp-6 tsm:tp-8 tspace-y-4 trelative">
                <div class="tabsolute ttop-4 tright-6 ttext-pink-300 ttext-5xl tfont-serif">
                    &ldquo;
                </div>

                <p class="ttext-lg tleading-relaxed ttext-gray-700">
                    “Kahit pawis at init, hindi ako nag-oily. First time ko ma-experience ‘to sa sunscreen.”
                </p>

                <p class="ttext-sm tfont-semibold ttext-[#d81b60]">
                    Dhey, 35 • Athlete
                </p>
                </div>
            </article>

            <!-- CARD 4 -->
            <article class="tbg-white trounded-3xl tshadow-md tborder tborder-pink-100 toverflow-hidden tmd:col-span-2">

                <div class="tbg-pink-100 th-60 tw-full">
                <img 
                    src="https://matildasbeauty.com/filemanager/178585fe8c5e467b9f0d2495fe9f8b37.webp" 
                    alt="Customer Photo"
                    class="tw-full th-full tobject-cover tobject-center"
                />
                </div>

                <div class="tp-6 tsm:tp-8 tspace-y-4 trelative">
                <div class="tabsolute ttop-4 tright-6 ttext-pink-300 ttext-5xl tfont-serif">
                    &ldquo;
                </div>

                <p class="ttext-lg tleading-relaxed ttext-gray-700">
                    “Ang sarap sa skin. Dewy pero hindi oily. Mas fresh tingnan yung face ko buong araw.”
                </p>

                <p class="ttext-sm tfont-semibold ttext-[#d81b60]">
                    madel, 48 • Mature skin
                </p>
                </div>

            </article>



            </div>
        </div>
        </section>

        <!-- HOW TO USE -->

        <section class="tpy-16 tpx-4">
            <div class="tmax-w-5xl tmx-auto">
                <!-- Heading -->
                <div class="ttext-center tmb-10">
                <h2 class="ttext-3xl tsm:text-4xl tfont-bold ttext-[#d81b60]">
                    How to Use <br> MissTisa for Daily Glow
                </h2>
                <p class="tmt-4 ttext-md ttext-lg ttext-gray-600">
                    Simple, gentle, and perfect for araw-araw na routine — face and body.
                </p>
                </div>

                <!-- Timeline / Infographic -->
                <div class="trelative tmax-w-3xl tmx-auto">
                <!-- Vertical line (desktop) -->
                <div class="th-full tborder-l tborder-pink-100 tabsolute tleft-[1.75rem] ttop-4 thidden tmd:block"></div>

                <div class="tspace-y-8">
                    <!-- STEP 1 -->
                    <div class="tflex tgap-4 tmd:gap-6 titems-start titems-center ">
                    <!-- Step icon / number -->
                    <div class="trelative z-[1]">
                        <div class="tw-12 th-12 trounded-full tbg-[#ffd3e6] tflex titems-center tjustify-center tshadow-sm">
                        <span class="ttext-[#d81b60] tfont-bold ttext-lg">1</span>
                        </div>
                    </div>
                    <!-- Text -->
                    <div class="tbg-white trounded-2xl tp-4 tsm:tp-5 tpr-5 tshadow-lg tborder tborder-pink-50 tflex-1">
                        <h3 class="tfont-semibold ttext-lg tsm:text-lg ttext-gray-900">
                        Cleanse your face & body
                        </h3>
                        <p class="tmt-2 ttext-lg ttext-gray-600">
                        Gamit ang mild soap or your usual cleanser para fresh ang canvas before application.
                        </p>
                    </div>
                    </div>

                    <!-- STEP 2 -->
                    <div class="tflex tgap-4 tmd:gap-6 titems-start titems-center">
                    <div class="trelative z-[1]">
                        <div class="tw-12 th-12 trounded-full tbg-[#ffd3e6] tflex titems-center tjustify-center tshadow-lg">
                        <span class="ttext-[#d81b60] tfont-bold ttext-lg">2</span>
                        </div>
                    </div>
                    <div class="tbg-white trounded-2xl tp-4 tsm:tp-5 tpr-5 tshadow-lg tborder tborder-pink-50 tflex-1">
                        <h3 class="tfont-semibold ttext-lg tsm:text-lg ttext-gray-900">
                        Apply MissTisa on face & body
                        </h3>
                        <p class="tmt-2 ttext-lg tsm:text-base ttext-gray-600">
                        Apply generously on face and all exposed areas of the body. 
                        Siguraduhin na pantay at fully covered ang skin for glow + protection.
                        </p>
                    </div>
                    </div>

                    <!-- STEP 3 -->
                    <div class="tflex tgap-4 tmd:gap-6 titems-start titems-center">
                    <div class="trelative z-[1]">
                        <div class="tw-12 th-12 trounded-full tbg-[#ffd3e6] tflex titems-center tjustify-center tshadow-lg">
                        <span class="ttext-[#d81b60] tfont-bold ttext-lg">3</span>
                        </div>
                    </div>
                    <div class="tbg-white trounded-2xl tp-4 tsm:tp-5 tpr-5 tshadow-lg tborder tborder-pink-50 tflex-1">
                        <h3 class="tfont-semibold ttext-lg tsm:text-lg ttext-gray-900">
                        Use every morning
                        </h3>
                        <p class="tmt-2 ttext-lg tsm:text-base ttext-gray-600">
                        Apply 15–20 minutes before going out. 
                        Gawing part ng daily routine mo for consistent, dewy glow.
                        </p>
                    </div>
                    </div>

                    <!-- STEP 4 -->
                    <div class="tflex tgap-4 tmd:gap-6 titems-start titems-center">
                    <div class="trelative z-[1]">
                        <div class="tw-12 th-12 trounded-full tbg-[#ffd3e6] tflex titems-center tjustify-center tshadow-lg">
                        <span class="ttext-[#d81b60] tfont-bold ttext-lg">4</span>
                        </div>
                    </div>
                    <div class="tbg-white trounded-2xl tp-4 tsm:tp-5 tpr-5 tshadow-lg tborder tborder-pink-50 tflex-1">
                        <h3 class="tfont-semibold ttext-base tsm:text-lg ttext-gray-900">
                        Reapply as needed
                        </h3>
                        <p class="tmt-2 ttext-lg tsm:text-base ttext-gray-600">
                        Reapply lalo na kung nasa outdoors ka, nagpapawis, o matagal sa araw. 
                        More glow, more protection, still zero lagkit.
                        </p>
                    </div>
                    </div>
                </div>
                </div>

                <!-- Safe for daily use note -->
                <div class="tmt-10 ttext-center">
                <p class="tinline-flex titems-center tgap-2 tpx-4 tpy-2 trounded-full tbg-pink-50 ttext-2xl tsm:text-sm ttext-[#d81b60] tfont-medium">
                    <span>✨</span>
                    <span>Safe for daily use — gentle for sensitive & mature skin.</span>
                </p>
                </div>

            </div>
        </section>

        <!-- FAQ -->
        <section class="tpy-10 tpx-4">
            <div class="tmax-w-4xl tmx-auto">
                <!-- Heading -->
                <div class="ttext-center tmb-10">
                <h2 class="ttext-3xl tsm:text-4xl tfont-bold ttext-[#d81b60]">
                    MissTisa FAQ 💗
                </h2>
                <p class="tmt-4 ttext-lg tsm:text-base ttext-gray-600">
                    Sagot sa mga pinaka-common na tanong about MissTisa Glow Sunscreen.
                </p>
                </div>

                <!-- Accordion Wrapper -->
                <div class="tspace-y-3">
                <!-- FAQ 1 -->
                <details class="tbg-white trounded-2xl tborder tborder-pink-100 tp-4 tsm:tp-5 tshadow-sm">
                    <summary class="tflex titems-center tgap-3 tcursor-pointer tlist-none">
                    <span class="ttext-lg tsm:text-base tfont-semibold ttext-gray-900">
                        Safe ba ang MissTisa for sensitive skin?
                    </span>
                    <span class="tml-auto tw-7 th-7 trounded-full tbg-pink-50 tflex titems-center tjustify-center ttext-pink-500 ttext-lg">
                        +
                    </span>
                    </summary>
                    <div class="tmt-3 ttext-lg tsm:text-sm ttext-gray-700 tleading-relaxed">
                    MissTisa is made to be gentle and comfy for daily use, including for many women with sensitive and mature skin. 
                    Kung may existing skin condition ka or gumagamit ng medicated products, mag-patch test muna sa maliit na area.
                    </div>
                </details>

                <!-- FAQ 2 -->
                <details class="tbg-white trounded-2xl tborder tborder-pink-100 tp-4 tsm:tp-5 tshadow-sm">
                    <summary class="tflex titems-center tgap-3 tcursor-pointer tlist-none">
                    <span class="ttext-lg tsm:text-base tfont-semibold ttext-gray-900">
                        Pwede ba siya sa face at body?
                    </span>
                    <span class="tml-auto tw-7 th-7 trounded-full tbg-pink-50 tflex titems-center tjustify-center ttext-pink-500 ttext-lg">
                        +
                    </span>
                    </summary>
                    <div class="tmt-3 ttext-lg tsm:text-sm ttext-gray-700 tleading-relaxed">
                    Yes 💗 One lotion for face and body. 
                    MissTisa is designed as a 100g glow sunscreen lotion na puwedeng gamitin sa mukha, leeg, arms, at ibang exposed areas.
                    </div>
                </details>

                <!-- FAQ 3 -->
                <details class="tbg-white trounded-2xl tborder tborder-pink-100 tp-4 tsm:tp-5 tshadow-sm">
                    <summary class="tflex titems-center tgap-3 tcursor-pointer tlist-none">
                    <span class="ttext-lg tsm:text-base tfont-semibold ttext-gray-900">
                        May white cast ba? Puwede ba sa morena?
                    </span>
                    <span class="tml-auto tw-7 th-7 trounded-full tbg-pink-50 tflex titems-center tjustify-center ttext-pink-500 ttext-lg">
                        +
                    </span>
                    </summary>
                    <div class="tmt-3 ttext-lg tsm:text-sm ttext-gray-700 tleading-relaxed">
                    Formulated to blend on morena to MissTisa skin tones 💕 
                    Dewy glow ang finish, hindi chalky, hindi puting-puti, at hindi grayish sa morena.
                    </div>
                </details>

                <!-- FAQ 4 -->
                <details class="tbg-white trounded-2xl tborder tborder-pink-100 tp-4 tsm:tp-5 tshadow-sm">
                    <summary class="tflex titems-center tgap-3 tcursor-pointer tlist-none">
                    <span class="ttext-lg tsm:text-base tfont-semibold ttext-gray-900">
                        Malagkit o oily ba siya pag mainit at pawisin?
                    </span>
                    <span class="tml-auto tw-7 th-7 trounded-full tbg-pink-50 tflex titems-center tjustify-center ttext-pink-500 ttext-lg">
                        +
                    </span>
                    </summary>
                    <div class="tmt-3 ttext-lg tsm:text-sm ttext-gray-700 tleading-relaxed">
                    Hindi 💗 MissTisa is made for PH heat and humidity. 
                    Dewy glow ang finish—hindi oily, hindi greasy, at zero lagkit kahit mainit o pawisin.
                    </div>
                </details>

                <!-- FAQ 5 -->
                <details class="tbg-white trounded-2xl tborder tborder-pink-100 tp-4 tsm:tp-5 tshadow-sm">
                    <summary class="tflex titems-center tgap-3 tcursor-pointer tlist-none">
                    <span class="ttext-lg tsm:text-base tfont-semibold ttext-gray-900">
                        Gaano katagal maubos ang 100g tube?
                    </span>
                    <span class="tml-auto tw-7 th-7 trounded-full tbg-pink-50 tflex titems-center tjustify-center ttext-pink-500 ttext-lg">
                        +
                    </span>
                    </summary>
                    <div class="tmt-3 ttext-lg tsm:text-sm ttext-gray-700 tleading-relaxed">
                    Depende sa gamit, pero maraming users ang umaabot ng mga <span class="tfont-semibold">2–3 months</span> with daily use 
                    sa face and exposed body areas. 100g is around 3x bigger than typical 30ml sunscreens.
                    </div>
                </details>

                <!-- FAQ 6 -->
                <details class="tbg-white trounded-2xl tborder tborder-pink-100 tp-4 tsm:tp-5 tshadow-sm">
                    <summary class="tflex titems-center tgap-3 tcursor-pointer tlist-none">
                    <span class="ttext-lg tsm:text-base tfont-semibold ttext-gray-900">
                        Anong age puwedeng gumamit ng MissTisa?
                    </span>
                    <span class="tml-auto tw-7 th-7 trounded-full tbg-pink-50 tflex titems-center tjustify-center ttext-pink-500 ttext-lg">
                        +
                    </span>
                    </summary>
                    <div class="tmt-3 ttext-lg tsm:text-sm ttext-gray-700 tleading-relaxed">
                    Perfect for women <span class="tfont-semibold">30–70+ years old</span> na gusto ng glow, brightening, at gentle protection. 
                    Lalo na sa may dullness, dryness, or early signs of aging.
                    </div>
                </details>

                <!-- FAQ 7 -->
                <details class="tbg-white trounded-2xl tborder tborder-pink-100 tp-4 tsm:tp-5 tshadow-sm">
                    <summary class="tflex titems-center tgap-3 tcursor-pointer tlist-none">
                    <span class="ttext-lg tsm:text-base tfont-semibold ttext-gray-900">
                        Puwede ba sa melasma-prone or may dark spots?
                    </span>
                    <span class="tml-auto tw-7 th-7 trounded-full tbg-pink-50 tflex titems-center tjustify-center ttext-pink-500 ttext-lg">
                        +
                    </span>
                    </summary>
                    <div class="tmt-3 ttext-lg tsm:text-sm ttext-gray-700 tleading-relaxed">
                    MissTisa has a Brightening Glow Trio (Niacinamide, Alpha Arbutin, Tranexamic) na kilala for helping the skin look 
                    brighter and more even with daily use. Hindi ito gamot, pero great support siya if gusto mo ng softer, glowing look 
                    sa melasma-prone or dark-spot-prone skin.
                    </div>
                </details>

                <!-- FAQ 8 -->
                <details class="tbg-white trounded-2xl tborder tborder-pink-100 tp-4 tsm:tp-5 tshadow-sm">
                    <summary class="tflex titems-center tgap-3 tcursor-pointer tlist-none">
                    <span class="ttext-lg tsm:text-base tfont-semibold ttext-gray-900">
                        Morning use lang ba? Puwede ba sa ilalim ng makeup?
                    </span>
                    <span class="tml-auto tw-7 th-7 trounded-full tbg-pink-50 tflex titems-center tjustify-center ttext-pink-500 ttext-lg">
                        +
                    </span>
                    </summary>
                    <div class="tmt-3 ttext-lg tsm:text-sm ttext-gray-700 tleading-relaxed">
                    Best used in the morning as your glow sunscreen step. 
                    Puwede siya under makeup—maghintay lang ng ilang minuto para ma-absorb, then apply foundation or BB/CC cream. 
                    Dewy base, zero lagkit.
                    </div>
                </details>
                </div>
            </div>
        </section>



        <!-- <h4 class="tfont-medium tpy-3 tmt-8 ttext-xl ttext-center">HAPPY & SATISFIED CUSTOMERS</h4> -->
       
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


        <div class="tmx-auto trelative tpx-5 tpb-5">
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
                                <h3 class="tfont-bold ttext-center ttext-gray-800 ttext-xs" style="font-size: 17px; line-height: 1.2;"><?= htmlspecialchars($product['name']) ?></h3>
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

                <!-- MODAL SUCCESS NEW-->
                <div class="success-modal" id="successModal">
                    <button class="success-modal-close-btn" onclick="closeSuccessModal()">✕</button>
                    
                    <div class="success-modal-content">
                        <div class="success-modal-icon"></div>
                        
                        <h1 class="success-modal-title">Order Sucess!</h1>
                        
                        <div class="success-modal-order-details tbg-white tfont-medium tshadow-lg">
                            <div class="success-modal-detail-row">
                                <span class="success-modal-detail-label">Customer:</span>
                                <span class="success-modal-detail-value success-modal-customer-name" id="successModalCustomerName">-</span>
                            </div>
                            
                            <div class="success-modal-detail-row">
                                <span class="success-modal-detail-label">Products:</span>
                                <span class="success-modal-detail-value success-modal-promo-text" id="successModalPromoText">-</span>
                            </div>
                            
                            <div class="success-modal-detail-row">
                                <span class="success-modal-detail-label ttext-center tmx-auto">Total:</span>
                                <span class="success-modal-detail-value ttext-center tmx-auto success-modal-total-amount" id="successModalTotalAmount">₱0</span>
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

            <!-- Your ORIGINAL button (unchanged) -->
            <button class="order_now zoom-in-out-box tabsolute tbottom-0 tfixed tfont-medium tmb-5 tmt-4 tpy-3 trounded-xl ttext-lg ttext-white tw-10/12 waves-effect"
                style="position: fixed; max-width: 480px; z-index: 999; opacity: 1; margin-left: auto; margin-right: auto; left: 0px; margin-bottom: 69px; right: 0px; background-color: rgb(238, 42, 123); display: block;">
                    

                    <div class="tflex tjustify-around titems-center tpx-4">
                        <div class="ttext-xs">
                            <div class="">Dewy Finish. Zero Lagkit</div>
                            <div class="">100g Big Size</div>
                        </div>
                        <div class=" ">
                            <i class="fas fa-shopping-bag"></i>
                            ORDER NOW!
                        </div>
                    </div>
            </button>


            <!-- <button class="order_now tabsolute  tbottom-0 tfixed tfont-medium tmb-5 tmt-4 tpy-3 trounded-full ttext-lg ttext-white tw-10/12 waves-effect" 
                style="position: fixed; max-width: 480px; z-index: 999; opacity: 1; margin-left: auto; margin-right: auto; left: 0; right: 0;background-color: #ee2a7b;">
                ORDER NOW!
            </button> -->
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


                if (data.total < 3000) {
                    console.log('send Purchase Checkout value to Pixel: '+ data.total);
                    console.log('eventID:  '+ data.purchase_event_id);
                    console.log('RAW RESPONSE:', data);                 // 👈 add this


                    fbq('track', 'Purchase', { currency: "PHP",  value: data.total }, {
                        eventID: data.purchase_event_id
                    });
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

    </footer>



</body>
</html>