<?php

// Products array - easy to manage and update
$products = [
     [
        'id' => 0,
        'name' => '3X BRIGHTENING GLASS SKIN',
        'price' => 999,
        'image' => 'https://matildasbeauty.com/filemanager/f3231c212de84129ad2940ef0e6bf8b1.png',
        'description' => 'Includes Gold Serum (worth ₱799)',
        'promo_text_1' => 'SET + SERUM + VIT C + Sunblock',
        'promo_text_2' => 'Repair • Fade • Glow',
        'promo_text_3' => '⚡ Best for Faster Results',
        'badge' => '⭐ Best for Faster Results',
        'stock' => '4',
        'most_recommended' => '⭐ Most Recommended for faster results',
    ],
    [
        'id' => 1,
        'name' => 'Glass Skin Starter Set',
        'price' => 599,
        'image' => 'https://matildasbeauty.com/filemanager/039e6a163080491180101a5372348a3b.webp',
        'description' => '',
        'promo_text_1' => '1 SET',
        'promo_text_2' => '🎁 FREE SHIPPING',
        'promo_text_3' => '',
        'badge' => 'For Daily UV Protection & Glow',
        'stock' => '2',
        'most_recommended' => ''
    ],
    [
        'id' => 2, 
        'name' => 'Brightening Glass Skin Duo',
        'price' => 649,
        'image' => 'https://matildasbeauty.com/filemanager/3479431c5cf54729a1d3656e47c8d86c.png',
        'description' => '',
        'promo_text_1' => 'MissTisa SET + VIT C',
        'promo_text_2' => 'Fade • Brighten • Glow',
        'promo_text_3' => '',
        'badge' => 'Good for Maintenance Glow',
        'stock' => '22',
        'most_recommended' => ''
    ],
    [
        'id' => 3,
        'name' => '✨ DOUBLE GLOW DEAL ✨',
        'price' => 799,
        'image' => 'https://matildasbeauty.com/filemanager/d49337dc27b946c1bacf3279551429fc.png',
        'description' => '',
        'promo_text_1' => '2 Box MissTisa SET',
        'promo_text_2' => '🎁 FREE VIT C',
        'promo_text_3' => '',
        'badge' => 'for Severe Melasma & Wrinkles',
        'stock' => '2',
        'most_recommended' => ''
    ]
    
];

// Convert products to JavaScript format for frontend
$products_json = json_encode($products);

$customerTestimonials = [
     [
        'label' => 'Ashley T.',
        'name' => 'Ashley T.',
        'stars' => 5,
        'comment' => 'Mas glowing at fresh na ang skin ko!',
        'before_image' => 'https://matildasbeauty.com/filemanager/a4f96ab1ec0d475e8cfe8330eacbf1d7.webp',
        'after_image' => 'https://matildasbeauty.com/filemanager/7e3f77204741472cb4d27c0f7be16737.webp',
    ],
     [
        'label' => 'Ashley T.',
        'name' => 'Ashley T.',
        'stars' => 5,
        'comment' => 'Mas glowing at fresh na ang skin ko!',
        'before_image' => 'https://matildasbeauty.com/filemanager/53050eb5513e47e2943b369c02023522.webp',
        'after_image' => 'https://matildasbeauty.com/filemanager/8e592aa7c0ae4117bb4edaf2fda8327c.webp',
    ],
    [
        'label' => 'Ashley T.',
        'name' => 'Ashley T.',
        'stars' => 5,
        'comment' => 'Mas glowing at fresh na ang skin ko!',
        'before_image' => 'https://matildasbeauty.com/filemanager/0cf424c1ba1148e0a4cdc0cd626fbe72.webp',
        'after_image' => 'https://matildasbeauty.com/filemanager/588dc9c8b6c4481793def250d5a2fafb.webp',
    ],
    [
        'label' => 'Liza M.',
        'name' => 'Liza',
        'stars' => 5,
        'comment' => 'Mas smooth at bright tingnan ang skin ko.',
        'before_image' => 'https://matildasbeauty.com/filemanager/26b26176b48c4cb9b6cac53767c840e0.webp',
        'after_image' => 'https://matildasbeauty.com/filemanager/4cd5b0955bda482a89a599223cf062e6.webp',
    ],
    [
        'label' => 'Girley O.',
        'name' => 'Girley',
        'stars' => 5,
        'comment' => 'Fresh na fresh ang glow kahit simple lang routine.',
        'before_image' => 'https://matildasbeauty.com/filemanager/aebf25c4c423422f85051b7087a1164e.webp',
        'after_image' => 'https://matildasbeauty.com/filemanager/4f7d82251c904b31b2b2197541877fb8.webp',
    ],
];

$productShowcase = [
   
    [
        'name' => 'MissTisa Gold Serum',
        'subtitle' => 'Anti-Aging Glass Skin Serum',
        'description' => 'Boosts Glass Skin glow while helping smooth wrinkles.
                            Brightens, hydrates and supports younger-looking skin.',
        'image' => 'https://matildasbeauty.com/filemanager/59c797c50f2342f58f69054826da24bc.webp',
        'icon' => 'fa-sun',
        'link' => '#submit_btn',
    ],
    [
        'name' => 'Pomelo Vitamin C',
        'subtitle' => 'Brightening Glow Serum',
        'description' => 'Brightens dull skin and boosts a fresh, radiant glow.
                            Helps even skin tone for clearer-looking Glass Skin.',
        'image' => 'https://matildasbeauty.com/filemanager/0af40895f67a4e4da73047ed286c0e0a.webp',
        'icon' => 'fa-spa',
        'link' => '#submit_btn',
    ],
    [
        'name' => 'MissTisa Set',
        'subtitle' => 'Pinkish Glass Skin Set',
        'description' => 'Brighter Glass Skin while targeting dark spots & melasma.
                            Helps smooth wrinkles for younger-looking skin.',
        'image' => 'https://matildasbeauty.com/filemanager/039e6a163080491180101a5372348a3b.webp',
        'icon' => 'fa-spa',
        'link' => '#submit_btn',
    ],
    [
        'name' => 'Lotion Sunscreen 100g',
        'subtitle' => 'Pinkish Glass Skin Body Lotion',
        'description' => 'Brightens and hydrates for smoother, glowing skin.
                            Helps even body skin tone for an all-over glow.',
        'image' => 'https://matildasbeauty.com/filemanager/69d5a2c7ad6f4544ae8df9a612970f64.webp',
        'icon' => 'fa-tint',
        'link' => '#submit_btn',
    ],

];

$glowConcernFeature = [
    'eyebrow' => '4 REASONS WHY',
    'title' => 'HINDI GLASS SKIN FACE MO?',
    'subtitle' => 'Alamin kung ano ang humahadlang sa fresh, smooth at glowing skin.',
    'concerns' => [
        [
            'title' => 'DULL & HAGGARD',
            'description' => 'Mukhang pagod at walang glow.',
            'image' => 'https://matildasbeauty.com/filemanager/a4f96ab1ec0d475e8cfe8330eacbf1d7.webp',
            'icon' => 'fa-tired',
        ],
        [
            'title' => 'DRY & ROUGH',
            'description' => 'Hindi smooth at ramdam ang pagka-dry.',
            'image' => 'https://matildasbeauty.com/filemanager/53050eb5513e47e2943b369c02023522.webp',
            'icon' => 'fa-water',
        ],
        [
            'title' => 'UNEVEN SKIN TONE',
            'description' => 'Hindi pantay ang kulay ng mukha.',
            'image' => 'https://matildasbeauty.com/filemanager/0cf424c1ba1148e0a4cdc0cd626fbe72.webp',
            'icon' => 'fa-braille',
        ],
        [
            'title' => 'DARK SPOTS / PEKAS',
            'description' => 'Nakakabawas sa clear at radiant-looking skin.',
            'image' => 'https://matildasbeauty.com/filemanager/26b26176b48c4cb9b6cac53767c840e0.webp',
            'icon' => 'fa-spa',
        ],
    ],
    'goal_title' => 'HINDI LANG “MAPUTI” ANG',
    'goal_highlight' => 'GLASS SKIN.',
    'goal_subtitle' => 'Ang tunay na goal ay:',
    'goals' => [
        ['title' => 'BRIGHT', 'description' => 'Mas maliwanag at fresh-looking', 'icon' => 'fa-star'],
        ['title' => 'SMOOTH', 'description' => 'Makinis at soft na texture', 'icon' => 'fa-tint'],
        ['title' => 'EVEN', 'description' => 'Pantay ang kulay at tone ng skin', 'icon' => 'fa-spa'],
        ['title' => 'HYDRATED', 'description' => 'Moisturized skin that naturally glows', 'icon' => 'fa-heart'],
    ],
    'banner_image' => 'https://matildasbeauty.com/filemanager/7e3f77204741472cb4d27c0f7be16737.webp',
    'banner_text' => 'Ito ang goal ng MissTisa',
    'banner_highlight' => 'PINKISH GLASS SKIN ROUTINE!',
];

$routineFeature = [
    'title' => '4-STEP ROUTINE',
    'subtitle' => 'FOR PINKISH GLASS SKIN',
    'steps' => [
        [
            'number' => '1',
            'title' => 'CLEANSE',
            'description' => 'Start with clean skin.',
            'image' => 'https://matildasbeauty.com/filemanager/867d45d1d363436982cd06aa4be08de2.png',
            'accent_icon' => 'fa-spa',
        ],
        [
            'number' => '2',
            'title' => 'REFRESH',
            'description' => 'Refresh and brighten.',
            'image' => 'https://matildasbeauty.com/filemanager/d5ef9da6485941bc8c13a7ff095fb5a8.png',
            'accent_icon' => 'fa-tint',
        ],
        [
            'number' => '3',
            'title' => 'PROTECT & GLOW',
            'description' => 'Protect in the morning.',
            'image' => 'https://matildasbeauty.com/filemanager/87ccff434bc74017a2d2269feb5be9fb.png',
            'accent_icon' => 'fa-sun',
            'badge' => 'SPF 50',
        ],
        [
            'number' => '4',
            'title' => 'NOURISH & RENEW',
            'description' => 'Repair at night.',
            'image' => 'https://matildasbeauty.com/filemanager/28df449eb8d14348bc9780418abd8b2a.png',
            'accent_icon' => 'fa-moon',
        ],
    ],
    'trust_items' => [
        ['icon' => 'fa-leaf', 'text' => 'Gentle & Effective'],
        ['icon' => 'fa-heart', 'text' => 'For All Skin Types'],
        ['icon' => 'fa-shield-alt', 'text' => 'Dermatologist Tested'],
    ],
];

$ingredientFeature = [
    'woman_image' => 'https://matildasbeauty.com/filemanager/2df6c324da154be9b41996541c22fc6e.webp',
    'product_image' => 'https://matildasbeauty.com/filemanager/f3231c212de84129ad2940ef0e6bf8b1.png',
    'eyebrow' => 'WHY MISSTISA?',
    'title' => 'POWERFUL INGREDIENTS',
    'subtitle' => 'BEHIND YOUR PINKISH GLASS SKIN',
    'support_text' => 'Scientifically chosen. Gentle on skin. Visible results.',
    'ingredients' => [
        [
            'name' => 'NIACINAMIDE',
            'tagline' => 'BRIGHTER • HEALTHIER • STRONGER',
            'theme' => 'white',
            'image' => 'https://matildasbeauty.com/filemanager/9bf854a856574f8da08d799f17ceb583.webp',
            'bullets' => [
                'Brightens dull and tired-looking skin',
                'Helps improve uneven skin tone',
                'Strengthens skin barrier for healthier glow',
            ],
        ],
        [
            'name' => 'ALPHA ARBUTIN',
            'tagline' => 'CLEARER • EVEN • SPOT-LESS',
            'theme' => 'white',
            'image' => 'https://matildasbeauty.com/filemanager/0462f5cdad3844bb9b14ef1fd50cb48a.webp',
            'bullets' => [
                'Helps fade dark spots and discoloration',
                'Supports a more even-looking skin tone',
                'Reveals natural radiance',
            ],
        ],
        [
            'name' => 'TRANEXAMIC ACID',
            'tagline' => 'DARK SPOT CARE • BRIGHTER SKIN',
            'theme' => 'white',
            'image' => 'https://matildasbeauty.com/filemanager/fab4c426e0ef42debf871fa29f7af391.webp',
            'bullets' => [
                'Helps reduce appearance of dark spots',
                'Improves look of melasma and pimple marks',
                'Promotes clearer, more even-looking skin',
            ],
        ],
        [
            'name' => 'HYDRATING & SOOTHING CARE',
            'tagline' => 'DEEP HYDRATION • CALM • PROTECT',
            'theme' => 'white',
            'image' => 'https://matildasbeauty.com/filemanager/d169e4e9baff4601988ea0a499185f88.webp',
            'bullets' => [
                'Intensely hydrates for plump, dewy skin',
                'Calms redness and soothes sensitive skin',
                'Leaves skin soft, smooth and comfortable',
            ],
        ],
    ],
    'benefits' => [
        ['title' => 'BRIGHTENS', 'description' => 'Helps reveal radiant and healthy-looking glow every day.', 'icon' => 'fa-star', 'image' => 'https://matildasbeauty.com/filemanager/f809c7099e1b47c7b3cf4ff095e9647c.webp'],
        ['title' => 'SMOOTHENS', 'description' => 'Refines skin texture for a softer, smoother and glassy finish.', 'icon' => 'fa-water', 'image' => 'https://matildasbeauty.com/filemanager/770393f5d4cd42cdaf8b0825aa24634b.webp'],
        ['title' => 'EVENS OUT', 'description' => 'Helps improve uneven skin tone for a more balanced appearance.', 'icon' => 'fa-sun', 'image' => 'https://matildasbeauty.com/filemanager/352ead791d6945b2b5a43d6165110537.webp'],
        ['title' => 'FADES DARK SPOTS', 'description' => 'Helps reduce the look of dark spots, melasma and pimple marks.', 'icon' => 'fa-dot-circle', 'image' => 'https://matildasbeauty.com/filemanager/b97f0c3abf0143ac9ae78872b70085df.webp'],
        ['title' => 'HYDRATES DEEPLY', 'description' => 'Delivers long-lasting moisture for plump, dewy and bouncy skin.', 'icon' => 'fa-tint', 'image' => 'https://matildasbeauty.com/filemanager/d71c35af43164e17a88f86d877af5d67.webp'],
        ['title' => 'STRENGTHENS BARRIER', 'description' => 'Strengthens skin barrier to protect from dryness, irritation and dullness.', 'icon' => 'fa-shield-alt', 'image' => 'https://matildasbeauty.com/filemanager/fe020964a96e4dc4a9a66098b34aca56.webp'],
    ],
    'closing_line_1' => 'COMPLETE CARE. VISIBLE GLOW. CONFIDENT YOU.',
    'closing_line_2' => 'THAT’S THE MISSTISA GLASS SKIN LOOK! ✨',
    'bottom_text' => 'GENTLE TODAY, GLOWING TOMORROW',
];
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Nunito:wght@600;700;800;900&display=swap" rel="stylesheet">

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

        .customer-testimonial-carousel {
            padding: 10px 14px 18px;
            background: linear-gradient(180deg, #fff7fb 0%, #fff 100%);
        }

        .testimonial-carousel-shell {
            position: relative;
            overflow: hidden;
            border: 1.5px solid #ff8aba;
            border-radius: 20px;
            background:
                radial-gradient(circle at 92% 0%, rgba(250, 25, 158, .13), transparent 28%),
                linear-gradient(135deg, #fff 0%, #fff0f7 100%);
            box-shadow: 0 12px 30px rgba(233, 30, 99, .12);
        }

        .testimonial-carousel-track {
            display: flex;
            transition: transform .35s ease;
        }

        .testimonial-slide {
            min-width: 100%;
            padding: 18px 14px 20px;
        }

        .testimonial-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
            padding: 8px 18px 8px 8px;
            border-radius: 999px;
            background: linear-gradient(135deg, #ff5aa0 0%, #e91e63 100%);
            color: #fff;
            font-size: 18px;
            line-height: 1;
            font-weight: 900;
            letter-spacing: .02em;
            box-shadow: 0 8px 18px rgba(233, 30, 99, .22);
        }

        .testimonial-badge i {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            color: #e91e63;
            font-size: 18px;
        }

        .testimonial-before-after {
            position: relative;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            align-items: stretch;
        }

        .testimonial-photo {
            position: relative;
            overflow: hidden;
            min-height: 172px;
            border-radius: 15px;
            background: #ffe4f0;
        }

        .testimonial-photo img {
            width: 100%;
            height: 100%;
            min-height: 172px;
            object-fit: cover;
            object-position: center;
        }

        .testimonial-photo-label {
            position: absolute;
            left: 0;
            bottom: 0;
            min-width: 82px;
            padding: 8px 12px;
            border-radius: 0 12px 0 0;
            background: linear-gradient(135deg, #ff5aa0 0%, #e91e63 100%);
            color: #fff;
            font-size: 17px;
            line-height: 1;
            font-weight: 900;
            text-align: center;
        }

        .testimonial-photo:last-child .testimonial-photo-label {
            left: auto;
            right: 0;
            border-radius: 12px 0 0 0;
        }

        .testimonial-arrow {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 46px;
            height: 46px;
            border: 4px solid #fff;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transform: translate(-50%, -50%);
            background: #e91e63;
            color: #fff;
            font-size: 21px;
            box-shadow: 0 8px 18px rgba(233, 30, 99, .28);
            z-index: 2;
        }

        .testimonial-stars {
            display: flex;
            justify-content: center;
            gap: 7px;
            margin: 16px 0 8px;
            color: #e91e63;
            font-size: 26px;
            line-height: 1;
        }

        .testimonial-comment {
            margin: 0;
            color: #25202a;
            font-size: 21px;
            line-height: 1.25;
            font-weight: 800;
            text-align: center;
        }

        .testimonial-name {
            margin-top: 7px;
            color: #8a405f;
            font-size: 13px;
            font-weight: 800;
            text-align: center;
        }

        .testimonial-carousel-btn {
            position: absolute;
            top: 50%;
            z-index: 3;
            width: 34px;
            height: 34px;
            border: 1px solid #ffc0d8;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, .92);
            color: #e91e63;
            cursor: pointer;
            box-shadow: 0 8px 18px rgba(233, 30, 99, .12);
        }

        .testimonial-carousel-btn.prev { left: 8px; }
        .testimonial-carousel-btn.next { right: 8px; }

        .testimonial-dots {
            display: flex;
            justify-content: center;
            gap: 7px;
            padding: 0 0 16px;
        }

        .testimonial-dot {
            width: 8px;
            height: 8px;
            border: 0;
            border-radius: 50%;
            background: #ffc0d8;
            cursor: pointer;
            padding: 0;
        }

        .testimonial-dot.is-active {
            width: 24px;
            border-radius: 99px;
            background: #e91e63;
        }

        @media (max-width: 390px) {
            .customer-testimonial-carousel { padding-left: 10px; padding-right: 10px; }
            .testimonial-slide { padding: 14px 10px 17px; }
            .testimonial-badge { font-size: 15px; }
            .testimonial-photo,
            .testimonial-photo img { min-height: 148px; }
            .testimonial-photo-label { min-width: 70px; font-size: 14px; }
            .testimonial-arrow { width: 40px; height: 40px; font-size: 18px; }
            .testimonial-stars { font-size: 22px; }
            .testimonial-comment { font-size: 18px; }
        }

        .misstisa-product-carousel {
            position: relative;
            overflow: hidden;
            padding: 24px 0 26px;
            background: #fff;
            /* border-top: 1px solid #ffd1e3; */
            /* border-bottom: 1px solid #ffd1e3; */
        }

        .misstisa-product-carousel-header {
            padding: 0 16px 14px;
            text-align: center;
        }

        .misstisa-product-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 220px;
            padding: 7px 18px;
            border-radius: 999px;
            background: linear-gradient(135deg, #ff5fa3, #ed1368);
            color: #fff;
            font-size: 15px;
            line-height: 1;
            font-weight: 900;
            letter-spacing: .16em;
        }

        .misstisa-product-carousel-header h2 {
            margin: 8px 0 2px;
            color: #201827;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 34px;
            line-height: 1.05;
            font-weight: 900;
        }

        .misstisa-product-carousel-header h2 span {
            color: #ed1368;
        }

        .misstisa-product-carousel-header p {
            margin: 0;
            color: #5f5360;
            font-size: 13px;
            font-weight: 700;
        }

        .misstisa-product-viewport {
            position: relative;
            overflow: hidden;
            padding: 0 42px;
            background: transparent;
        }

        .misstisa-product-track {
            display: flex;
            align-items: stretch;
            gap: 14px;
            transition: transform .35s ease;
            will-change: transform;
        }

        .misstisa-product-card {
            position: relative;
            min-width: 82%;
            overflow: hidden;
            padding: 14px 12px 16px;
            border: 2px solid rgba(255, 151, 194, .62);
            border-radius: 22px;
            background: #fff;
            text-align: center;
            box-shadow: 0 12px 28px rgba(237, 19, 104, .10);
            transform: scale(.92);
            opacity: .72;
            transition: transform .35s ease, opacity .35s ease, box-shadow .35s ease;
        }

        .misstisa-product-card.is-active {
            transform: scale(1);
            opacity: 1;
            box-shadow: 0 18px 38px rgba(237, 19, 104, .18);
        }

        .misstisa-product-image {
            width: 100%;
            height: 180px;
            margin: 0 auto 12px;
            object-fit: contain;
            filter: drop-shadow(0 12px 18px rgba(105, 35, 66, .14));
        }

        .misstisa-product-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            margin-bottom: 3px;
            color: #ed1368;
            font-size: 18px;
        }

        .misstisa-product-card h3 {
            margin: 0;
            color: #ed1368;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 24px;
            line-height: 1.05;
            font-weight: 900;
        }

        .misstisa-product-card h4 {
            margin: 3px 0 8px;
            color: #201827;
            font-size: 14px;
            line-height: 1.2;
            font-weight: 900;
        }

        .misstisa-product-card p {
            min-height: 58px;
            margin: 0;
            color: #5f5360;
            font-size: 13px;
            line-height: 1.38;
            font-weight: 650;
        }

        .misstisa-product-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-width: 150px;
            min-height: 36px;
            margin-top: 12px;
            padding: 0 16px;
            border-radius: 999px;
            background: linear-gradient(135deg, #ff6fab, #ed1368);
            color: #fff;
            font-size: 13px;
            line-height: 1;
            font-weight: 900;
            box-shadow: 0 10px 20px rgba(237, 19, 104, .18);
        }

        .misstisa-product-nav {
            position: absolute;
            top: 50%;
            z-index: 4;
            width: 40px;
            height: 40px;
            border: 0;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transform: translateY(-50%);
            background: rgba(255,255,255,.94);
            color: #ed1368;
            font-size: 18px;
            box-shadow: 0 10px 22px rgba(237, 19, 104, .15);
            cursor: pointer;
        }

        .misstisa-product-nav.prev { left: 10px; }
        .misstisa-product-nav.next { right: 10px; }

        .misstisa-product-dots {
            display: flex;
            justify-content: center;
            gap: 9px;
            padding-top: 16px;
        }

        .misstisa-product-dot {
            width: 9px;
            height: 9px;
            border: 0;
            border-radius: 50%;
            background: #ffc0d8;
            padding: 0;
            cursor: pointer;
        }

        .misstisa-product-dot.is-active {
            width: 22px;
            border-radius: 999px;
            background: #ed1368;
        }

        @media (max-width: 390px) {
            .misstisa-product-carousel-header h2 { font-size: 30px; }
            .misstisa-product-viewport { padding: 0 34px; }
            .misstisa-product-card {
                min-width: 86%;
                padding-left: 10px;
                padding-right: 10px;
            }
            .misstisa-product-image { height: 152px; }
            .misstisa-product-card h3 { font-size: 21px; }
            .misstisa-product-card p { font-size: 12px; }
            .misstisa-product-nav {
                width: 34px;
                height: 34px;
            }
        }

        .glow-concern-section {
            position: relative;
            overflow: hidden;
            padding: 24px 14px 0;
            background:
                radial-gradient(circle at 5% 16%, rgba(255, 0, 96, .08), transparent 22%),
                radial-gradient(circle at 95% 7%, rgba(255, 0, 96, .10), transparent 18%),
                linear-gradient(180deg, #fff 0%, #fff7fb 55%, #fff 100%);
            border-top: 1px solid #ffd1e3;
            border-bottom: 1px solid #ffd1e3;
        }

        .glow-concern-header {
            text-align: center;
            margin-bottom: 14px;
        }

        .glow-concern-eyebrow {
            display: block;
            color: #2b2429;
            font-size: 18px;
            line-height: 1;
            font-weight: 950;
            letter-spacing: .02em;
        }

        .glow-concern-title {
            margin: 3px 0 0;
            color: #ed1368;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 32px;
            line-height: .98;
            font-weight: 900;
            text-transform: uppercase;
        }

        .glow-concern-subtitle {
            margin: 6px 0 0;
            color: #4a3d45;
            font-size: 12px;
            line-height: 1.35;
            font-weight: 700;
        }

        .glow-concern-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .glow-concern-card {
            overflow: hidden;
            border: 1.5px solid #ff9cc4;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 8px 18px rgba(237, 19, 104, .08);
        }

        .glow-concern-image {
            width: 100%;
            height: 108px;
            object-fit: cover;
            object-position: center;
            background: #fff;
        }

        .glow-concern-card-body {
            display: grid;
            grid-template-columns: 42px 1fr;
            gap: 8px;
            align-items: center;
            min-height: 72px;
            padding: 8px;
            background: linear-gradient(180deg, #fff6fa, #fff);
        }

        .glow-concern-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #ed1368;
            color: #fff;
            font-size: 18px;
            box-shadow: inset 0 0 0 5px rgba(255,255,255,.2);
        }

        .glow-concern-card h3 {
            margin: 0;
            color: #ed1368;
            font-size: 13px;
            line-height: 1.05;
            font-weight: 950;
        }

        .glow-concern-card p {
            margin: 3px 0 0;
            color: #2b2429;
            font-size: 11px;
            line-height: 1.25;
            font-weight: 650;
        }

        .glow-goal-card {
            margin-top: 12px;
            overflow: hidden;
            border: 1.5px solid #ffc0d8;
            border-radius: 14px;
            background: rgba(255,255,255,.92);
            text-align: center;
            box-shadow: 0 10px 22px rgba(237, 19, 104, .08);
        }

        .glow-goal-title {
            padding: 14px 12px 7px;
        }

        .glow-goal-title strong {
            display: block;
            color: #2b2429;
            font-size: 16px;
            line-height: 1;
            font-weight: 950;
        }

        .glow-goal-title span {
            display: block;
            color: #ed1368;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 34px;
            line-height: 1;
            font-weight: 900;
        }

        .glow-goal-title small {
            display: block;
            color: #4a3d45;
            font-size: 12px;
            font-weight: 700;
        }

        .glow-goal-list {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 8px;
            padding: 8px 10px 14px;
        }

        .glow-goal-item {
            min-width: 0;
        }

        .glow-goal-icon {
            width: 44px;
            height: 44px;
            margin: 0 auto 6px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #fff, #ffe2ee);
            color: #ed1368;
            border: 1px solid #ffc0d8;
            font-size: 17px;
        }

        .glow-goal-item strong {
            display: block;
            color: #ed1368;
            font-size: 10px;
            line-height: 1;
            font-weight: 950;
        }

        .glow-goal-item span {
            display: block;
            margin-top: 3px;
            color: #4a3d45;
            font-size: 8px;
            line-height: 1.15;
            font-weight: 700;
        }

        .glow-routine-banner {
            position: relative;
            display: grid;
            grid-template-columns: 72px 1fr;
            gap: 10px;
            align-items: center;
            margin: 16px -14px 0;
            padding: 10px 18px;
            background: #ed1368;
            color: #fff;
            box-shadow: 0 -8px 20px rgba(237, 19, 104, .12);
        }

        .glow-routine-banner img {
            width: 66px;
            height: 66px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #fff;
        }

        .glow-routine-banner span {
            display: block;
            color: rgba(255,255,255,.9);
            font-size: 13px;
            line-height: 1.1;
            font-weight: 750;
        }

        .glow-routine-banner strong {
            display: block;
            margin-top: 2px;
            color: #fff55a;
            font-size: 19px;
            line-height: 1.05;
            font-weight: 950;
        }

        @media (max-width: 390px) {
            .glow-concern-section { padding-left: 10px; padding-right: 10px; }
            .glow-concern-title { font-size: 27px; }
            .glow-concern-image { height: 96px; }
            .glow-concern-card-body {
                grid-template-columns: 36px 1fr;
                min-height: 70px;
                gap: 6px;
                padding: 7px;
            }
            .glow-concern-icon {
                width: 36px;
                height: 36px;
                font-size: 15px;
            }
            .glow-concern-card h3 { font-size: 11px; }
            .glow-concern-card p { font-size: 9px; }
            .glow-goal-title span { font-size: 30px; }
            .glow-goal-list { gap: 5px; padding-left: 7px; padding-right: 7px; }
            .glow-goal-icon {
                width: 38px;
                height: 38px;
                font-size: 15px;
            }
            .glow-routine-banner { margin-left: -10px; margin-right: -10px; }
            .glow-routine-banner strong { font-size: 16px; }
        }

        .routine-feature-section {
            position: relative;
            overflow: hidden;
            padding: 26px 14px 10px;
            /* background:
                radial-gradient(circle at 12% 9%, rgba(255, 0, 96, .08), transparent 18%),
                radial-gradient(circle at 90% 92%, rgba(255, 0, 96, .10), transparent 20%),
                linear-gradient(180deg, #fff8fb 0%, #fff 52%, #fff2f8 100%);
            border-top: 1px solid #ffd0e1;
            border-bottom: 1px solid #ffd0e1; */
        }

        .routine-feature-section * {
            box-sizing: border-box;
        }

        .routine-feature-header {
            position: relative;
            text-align: center;
            margin-bottom: 12px;
        }

        .routine-feature-title {
            margin: 0;
            color: #ed1368;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 34px;
            line-height: .92;
            font-weight: 900;
            letter-spacing: .02em;
            text-transform: uppercase;
        }

        .routine-feature-subtitle {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 2px;
            color: #201827;
            font-size: 18px;
            line-height: 1.05;
            font-weight: 950;
            letter-spacing: .02em;
            text-transform: uppercase;
        }

        .routine-feature-subtitle::before,
        .routine-feature-subtitle::after {
            content: "";
            width: 7px;
            height: 7px;
            display: inline-block;
            background: #ff6aa2;
            clip-path: polygon(50% 0%, 63% 37%, 100% 50%, 63% 63%, 50% 100%, 37% 63%, 0% 50%, 37% 37%);
        }

        .routine-step-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 8px;
        }

        .routine-step-card {
            position: relative;
            min-height: 202px;
            overflow: visible;
            border: 1px solid #ffd0e1;
            border-radius: 10px;
            background: linear-gradient(180deg, #fff 0%, #fff4f8 100%);
            box-shadow: 0 8px 18px rgba(237, 19, 104, .07);
        }

        .routine-step-topline {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            min-height: 42px;
            padding: 10px 8px 0;
            color: #ed1368;
            line-height: 1;
        }

        .routine-step-number {
            width: 24px;
            height: 24px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #ed1368;
            color: #fff;
            font-size: 13px;
            font-weight: 950;
            box-shadow: 0 7px 14px rgba(237, 19, 104, .18);
        }

        .routine-step-title {
            min-width: 0;
            color: #ed1368;
            font-size: 13px;
            font-weight: 950;
            letter-spacing: .01em;
            line-height: 1.04;
            text-transform: uppercase;
        }

        .routine-step-sparkle {
            color: #ff8bb7;
            font-size: 11px;
        }

        .routine-step-description {
            position: relative;
            z-index: 2;
            margin: 3px 0 0;
            color: #201827;
            font-size: 10px;
            line-height: 1.15;
            font-weight: 750;
            text-align: center;
        }

        .routine-step-image-wrap {
            position: relative;
            z-index: 1;
            height: 138px;
            margin: 4px 10px 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .routine-step-image-wrap::before {
            content: "";
            position: absolute;
            inset: 30px 10px 4px;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(255, 194, 217, .50), transparent 68%);
            filter: blur(4px);
        }

        .routine-step-image {
            position: relative;
            z-index: 1;
            width: 100%;
            height: 132px;
            object-fit: contain;
            filter: drop-shadow(0 10px 10px rgba(237, 19, 104, .13));
        }

        .routine-step-accent {
            position: absolute;
            z-index: 2;
            left: 11px;
            bottom: 12px;
            color: #ed1368;
            font-size: 20px;
            text-shadow: 0 4px 10px rgba(237, 19, 104, .12);
        }

        .routine-step-badge {
            position: absolute;
            z-index: 3;
            right: 10px;
            bottom: 14px;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #ed1368;
            background: rgba(255,255,255,.94);
            color: #ed1368;
            font-size: 10px;
            line-height: .95;
            font-weight: 950;
            text-align: center;
        }

        .routine-step-card:nth-child(1)::after,
        .routine-step-card:nth-child(3)::after {
            content: "\f061";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            position: absolute;
            z-index: 5;
            right: -21px;
            top: 50%;
            width: 34px;
            height: 34px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #ed1368;
            color: #fff;
            font-size: 15px;
            border: 3px solid #fff;
            box-shadow: 0 8px 18px rgba(237, 19, 104, .22);
            transform: translateY(-50%);
        }

        .routine-trust-strip {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            align-items: center;
            gap: 1px;
            margin: 10px 0 0;
            overflow: hidden;
            border-radius: 8px;
            background: #ed1368;
            box-shadow: 0 10px 20px rgba(237, 19, 104, .16);
        }

        .routine-trust-item {
            min-height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            padding: 7px 5px;
            color: #fff;
            font-size: 9px;
            line-height: 1.1;
            font-weight: 800;
            text-align: center;
            background: rgba(255,255,255,.08);
        }

        .routine-trust-item i {
            font-size: 12px;
        }

        @media (max-width: 390px) {
            .routine-feature-section { padding-left: 9px; padding-right: 9px; }
            .routine-feature-title { font-size: 29px; }
            .routine-feature-subtitle { font-size: 15px; }
            .routine-step-card { min-height: 190px; }
            .routine-step-topline {
                min-height: 40px;
                gap: 5px;
                padding-left: 6px;
                padding-right: 6px;
            }
            .routine-step-number {
                width: 23px;
                height: 23px;
                font-size: 12px;
            }
            .routine-step-title { font-size: 11px; }
            .routine-step-description { font-size: 9px; }
            .routine-step-image-wrap {
                height: 128px;
                margin-left: 7px;
                margin-right: 7px;
            }
            .routine-step-image { height: 122px; }
            .routine-step-card:nth-child(1)::after,
            .routine-step-card:nth-child(3)::after {
                right: -19px;
                width: 30px;
                height: 30px;
                font-size: 13px;
                border-width: 2px;
            }
            .routine-trust-item {
                font-size: 8px;
                padding-left: 3px;
                padding-right: 3px;
            }
        }

        .ingredient-feature-section {
            position: relative;
            overflow: hidden;
            padding: 24px 12px 28px;
            /* background:
                radial-gradient(circle at 92% 4%, rgba(255, 113, 173, .20), transparent 22%),
                radial-gradient(circle at 6% 68%, rgba(255, 113, 173, .15), transparent 24%),
                linear-gradient(180deg, #fff6fa 0%, #fff 42%, #fff1f7 100%);
            border-top: 1px solid #ffd1e3;
            border-bottom: 1px solid #ffd1e3; */
        }

        .ingredient-feature-section * {
            box-sizing: border-box;
        }

        .ingredient-feature-header {
            position: relative;
            min-height: 359px   ;
            padding: 4px 0 0;
        }

        .ingredient-feature-eyebrow {
            position: relative;
            z-index: 2;
            width: max-content;
            max-width: 100%;
            margin: 0 auto 16px;
            padding: 10px 22px;
            border-radius: 999px;
            background: linear-gradient(135deg, #f51b76 0%, #d80f5f 100%);
            color: #fff;
            font-size: 18px;
            line-height: 1;
            font-weight: 900;
            text-align: center;
            letter-spacing: .02em;
            box-shadow: 0 10px 24px rgba(233, 30, 99, .22);
        }

        .ingredient-feature-title {
            position: relative;
            z-index: 2;
            max-width: 255px;
        }

        .ingredient-feature-copy-block {
            position: relative;
            z-index: 2;
            margin-top: 84px;
        }

        .ingredient-feature-title h2 {
            margin: 0;
            color: #e41467;
            font-family: Impact, "Arial Black", sans-serif;
            font-size: 44px;
            line-height: .95;
            letter-spacing: .01em;
        }

        .ingredient-feature-title p {
            margin: 7px 0 0;
            color: #303030;
            font-size: 18px;
            line-height: 1.05;
            font-weight: 900;
        }

        .ingredient-feature-strip {
            position: relative;
            z-index: 2;
            width: max-content;
            max-width: 255px;
            margin-top: 16px;
            padding: 8px 16px;
            border-radius: 999px;
            background: linear-gradient(90deg, rgba(255,255,255,.2), #ff5ca0 18%, #ff5ca0 82%, rgba(255,255,255,.2));
            color: #fff;
            font-size: 13px;
            line-height: 1.25;
            font-weight: 850;
            text-align: center;
            box-shadow: 0 10px 18px rgba(233, 30, 99, .16);
        }

        .ingredient-feature-woman {
            position: absolute;
            right: -18px;
            bottom: 0;
            z-index: 1;
            width: 235px;
            height: 285px;
            object-fit: cover;
            object-position: center;
            border-radius: 46% 0 0 46%;
            filter: drop-shadow(0 12px 22px rgba(135, 46, 82, .16));
            -webkit-mask-image: linear-gradient(90deg, transparent 0%, #000 12%, #000 100%);
            mask-image: linear-gradient(90deg, transparent 0%, #000 12%, #000 100%);
        }

        .ingredient-feature-bubbles {
            position: absolute;
            inset: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .ingredient-feature-bubbles span {
            position: absolute;
            display: block;
            border-radius: 50%;
            border: 1px solid rgba(245, 27, 118, .28);
            background: radial-gradient(circle at 32% 28%, rgba(255,255,255,.96), rgba(255, 126, 174, .22) 52%, rgba(255,255,255,.18));
        }

        .ingredient-feature-bubbles span:nth-child(1) { width: 46px; height: 46px; right: -8px; top: 8px; }
        .ingredient-feature-bubbles span:nth-child(2) { width: 24px; height: 24px; left: 22px; top: 205px; }
        .ingredient-feature-bubbles span:nth-child(3) { width: 34px; height: 34px; right: 18px; bottom: 18px; }

        .ingredient-feature-list {
            position: relative;
            z-index: 2;
            display: grid;
            gap: 0;
            margin-top: 4px;
        }

        .ingredient-feature-row {
            display: grid;
            grid-template-columns: 118px 1fr;
            gap: 12px;
            align-items: center;
            min-height: 164px;
            padding: 18px 0;
            border-top: 1px solid rgba(255, 179, 209, .68);
        }

        .ingredient-feature-row:first-child {
            border-top: 0;
        }

        .ingredient-feature-visual {
            position: relative;
            width: 118px;
            height: 118px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ingredient-feature-visual img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .ingredient-feature-copy h3 {
            margin: 0;
            color: #ff0060;
            font-family: "Cormorant Garamond", Georgia, serif;
            font-size: 36px;
            line-height: .88;
            letter-spacing: .04em;
            text-transform: uppercase;
            text-shadow: 0 2px 0 rgba(255, 255, 255, .9);
        }

        .ingredient-feature-tagline {
            display: inline-block;
            max-width: 100%;
            margin: 7px 0 9px;
            padding: 6px 12px;
            border-radius: 999px;
            background: linear-gradient(135deg, #ff7eb6 0%, #ed1368 100%);
            color: #fff;
            font-family: "Nunito", Arial, sans-serif;
            font-size: 11px;
            line-height: 1;
            font-weight: 900;
            letter-spacing: .055em;
            text-transform: uppercase;
            white-space: normal;
            box-shadow: 0 7px 15px rgba(237, 19, 104, .18);
        }

        .ingredient-feature-copy ul {
            display: grid;
            gap: 6px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .ingredient-feature-copy li {
            display: flex;
            align-items: flex-start;
            gap: 7px;
            color: #3c2b34;
            font-family: "Nunito", Arial, sans-serif;
            font-size: 13px;
            line-height: 1.32;
            font-weight: 750;
            list-style-type: none !important;
        }

        .ingredient-feature-copy li i {
            color: #e41467;
            font-size: 14px;
            line-height: 1.2;
            flex: 0 0 auto;
        }

        .ingredient-benefits-card {
            overflow: hidden;
            margin-top: 12px;
            border: 1px solid #ffc0d8;
            border-radius: 20px;
            /* background:
                radial-gradient(circle at 15% 18%, rgba(255,255,255,.7), transparent 19%),
                radial-gradient(circle at 90% 45%, rgba(255,255,255,.45), transparent 17%),
                linear-gradient(180deg, #ff87b5 0%, #ff5d9d 48%, #ffa7ca 100%); */
            box-shadow: 0 16px 34px rgba(233, 30, 99, .18);
        }

        .ingredient-benefits-title {
            padding: 31px 12px 14px;
            background: linear-gradient(180deg, #e91e63, rgba(255, 255, 255, .25));
            color: #fff;
            font-family: "Nunito", Arial, sans-serif;
            font-size: 20px;
            line-height: 1.05;
            font-weight: 900;
            text-align: center;
            letter-spacing: .06em;
            text-shadow: 0 2px 8px rgba(96, 13, 45, .18);
        }

        .ingredient-benefits-title span {
            display: block;
            margin-top: 4px;
            color: #fff;
            font-size: 42px;
            line-height: .92;
            letter-spacing: .03em;
            text-shadow: 0 4px 16px rgba(145, 13, 65, .25);
        }

        .ingredient-benefits-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px 10px;
            padding: 14px 12px 18px;
        }

        .ingredient-benefit {
            position: relative;
            display: block;
            min-height: 285px;
            padding: 4px 0 0;
            border: 0;
            text-align: center;
        }

        .ingredient-benefit-number {
            position: absolute;
            top: 3px;
            left: 2px;
            z-index: 4;
            width: 46px;
            height: 46px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 3px solid #fff;
            background: linear-gradient(180deg, #ff2a86 0%, #e80062 100%);
            color: #fff;
            font-size: 25px;
            line-height: 1;
            font-weight: 950;
            box-shadow: 0 8px 18px rgba(102, 13, 51, .22);
        }

        .ingredient-benefit-icon {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto -11px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 4px solid #ff2a86;
            border-radius: 50%;
            background: rgba(255,255,255,.42);
            color: #e41467;
            font-size: 54px;
            box-shadow:
                inset 0 0 0 2px rgba(255,255,255,.82),
                0 13px 22px rgba(131, 20, 69, .18);
        }

        .ingredient-benefit-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .ingredient-benefit h4 {
            position: relative;
            z-index: 3;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 45px;
            width: calc(100% - 8px);
            margin: 0 auto;
            padding: 8px 8px;
            border-radius: 999px;
            background: linear-gradient(180deg, #ff3d91 0%, #e80062 100%);
            color: #fff;
            font-family: "Nunito", Arial, sans-serif;
            font-size: 20px;
            line-height: 1;
            letter-spacing: .01em;
            font-weight: 950;
            text-shadow: 0 2px 6px rgba(100, 8, 43, .16);
            box-shadow: 0 8px 16px rgba(145, 13, 65, .20);
        }

        .ingredient-benefit-divider {
            display: none;
        }

        .ingredient-benefit-divider:before,
        .ingredient-benefit-divider:after {
            display: none;
        }

        .ingredient-benefit p {
            min-height: 88px;
            margin: -8px 0 0;
            padding: 20px 9px 11px;
            border: 1px solid rgba(255, 41, 134, .45);
            border-radius: 14px;
            background: rgba(255,255,255,.88);
            color: #1f2933;
            font-family: "Nunito", Arial, sans-serif;
            font-size: 14px;
            line-height: 1.22;
            font-weight: 850;
            box-shadow: 0 8px 15px rgba(145, 13, 65, .09);
        }

        .ingredient-feature-close {
            padding: 16px 10px 18px;
            text-align: center;
        }

        .ingredient-feature-close strong {
            display: block;
            color: #e41467;
            font-size: 16px;
            line-height: 1.25;
            font-weight: 950;
            letter-spacing: .04em;
        }

        .ingredient-feature-close span {
            display: block;
            margin-top: 2px;
            color: #e41467;
            font-size: 20px;
            line-height: 1.15;
            font-weight: 950;
            letter-spacing: .05em;
        }

        .ingredient-feature-footer {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            align-items: end;
            padding-top: 4px;
        }

        .ingredient-feature-product {
            width: 100%;
            height: 128px;
            object-fit: contain;
            filter: drop-shadow(0 12px 18px rgba(145, 36, 82, .16));
        }

        .ingredient-feature-bottom-text {
            color: #e41467;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 25px;
            line-height: 1.02;
            font-weight: 900;
            text-align: center;
        }

        @media (max-width: 390px) {
            .ingredient-feature-section { padding-left: 10px; padding-right: 10px; }
            .ingredient-feature-header { min-height: 372px; }
            .ingredient-feature-copy-block { margin-top: 28px; }
            .ingredient-feature-title { max-width: 228px; }
            .ingredient-feature-title h2 { font-size: 36px; }
            .ingredient-feature-title p { font-size: 16px; }
            .ingredient-feature-strip { max-width: 228px; font-size: 11px; }
            .ingredient-feature-woman {
                right: -18px;
                width: 210px;
                height: 260px;
            }
            .ingredient-feature-row {
                grid-template-columns: 98px 1fr;
                gap: 10px;
                min-height: 152px;
            }
            .ingredient-feature-visual {
                width: 98px;
                height: 98px;
            }
            .ingredient-feature-visual img {
                width: 100%;
                height: 100%;
            }
            .ingredient-feature-copy h3 { font-size: 25px; }
            .ingredient-feature-tagline { font-size: 10px; }
            .ingredient-feature-copy li { font-size: 12px; }
            .ingredient-benefits-title {
                font-size: 16px;
                letter-spacing: .05em;
            }
            .ingredient-benefits-title span {
                font-size: 35px;
            }
            .ingredient-benefits-grid {
                gap: 14px 8px;
                padding-left: 8px;
                padding-right: 8px;
            }
            .ingredient-benefit {
                display: block;
                min-height: 252px;
                padding: 2px 0 0;
            }
            .ingredient-benefit-number {
                width: 38px;
                height: 38px;
                font-size: 21px;
            }
            .ingredient-benefit-icon {
                width: 124px;
                height: 124px;
                margin: 0 auto -9px;
                font-size: 42px;
            }
            .ingredient-benefit h4 {
                min-height: 39px;
                width: 100%;
                padding: 7px 6px;
                font-size: 16px;
            }
            .ingredient-benefit-divider {
                display: none;
            }
            .ingredient-benefit-divider:before,
            .ingredient-benefit-divider:after {
                display: none;
            }
            .ingredient-benefit p {
                min-height: 83px;
                padding: 18px 7px 9px;
                font-size: 11px;
                line-height: 1.2;
            }
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
        </div>


        <img src="https://matildasbeauty.com/filemanager/cadcf12597bc454fb5aeb6599d821027.webp" width="480" height="480" class="tw-full" alt="BUY 1 take 1">

        <div class="tfont-semibold ttext-center ttext-white tp-2 ttext-lg" style="background-color: black;">
            <i class="fas fa-check-circle" style="color: #12bc39;"></i> LEGIT | 🚚 Fast Delivery | 💸 COD | <i class="fas fa-check-circle tmb-2" style="color: #12bc39;"></i> FDA 
        </div>

        <div class="tflex tw-full tflex-wrap tjustify-center tpy-3 tpx-3 tmb-3">
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2" style="color: #f52d87;"></i><b> Korean Glass Skin</b></div>
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #f52d87;"></i> <b>Pinkish Skin</b></div>
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2" style="color: #f52d87;"></i><b>Melasma</b></div>
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #f52d87;"></i><b> Kulubot</b> </div>
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #f52d87;"></i><b> Wrinkles</b> </div>
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2 ttext-lg" style="color: #f52d87;"></i><b> No More Pekas</b></div>
          
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2" style="color: #12bc39;"></i> No Irritation</div>
            <div class="tw-1/2"><i class="fas fa-check-circle tmb-2" style="color: #12bc39;"></i> For Sensitive Skin</div>
            <div class="tw-full"><i class="fas fa-check-circle tmb-2" style="color: #12bc39;"></i> Proven & tested by many users</div>
        </div>

        <section class="glow-concern-section" aria-label="Why your skin glow is missing">
            <div class="glow-concern-header">
                <span class="glow-concern-eyebrow tmb-5">{{ $glowConcernFeature['eyebrow'] }}</span>
                <h2 class="glow-concern-title tmb-3">{{ $glowConcernFeature['title'] }}</h2>
                <p class="glow-concern-subtitle">{{ $glowConcernFeature['subtitle'] }}</p>
            </div>

            <div class="glow-concern-grid">
                @foreach ($glowConcernFeature['concerns'] as $concern)
                    <article class="glow-concern-card">
                        <img class="glow-concern-image" src="{{ $concern['image'] }}" loading="lazy" width="220" height="140" alt="{{ $concern['title'] }}">
                        <div class="glow-concern-card-body">
                            <span class="glow-concern-icon"><i class="fas {{ $concern['icon'] }}"></i></span>
                            <div>
                                <h3>{{ $concern['title'] }}</h3>
                                <p>{{ $concern['description'] }}</p>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
<!-- 
            <div class="glow-goal-card">
                <div class="glow-goal-title">
                    <strong>{{ $glowConcernFeature['goal_title'] }}</strong>
                    <span>{{ $glowConcernFeature['goal_highlight'] }}</span>
                    <small>{{ $glowConcernFeature['goal_subtitle'] }}</small>
                </div>

                <div class="glow-goal-list">
                    @foreach ($glowConcernFeature['goals'] as $goal)
                        <div class="glow-goal-item">
                            <span class="glow-goal-icon"><i class="fas {{ $goal['icon'] }}"></i></span>
                            <strong>{{ $goal['title'] }}</strong>
                            <span>{{ $goal['description'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div> -->

            <div class="glow-routine-banner">
                <img src="{{ $glowConcernFeature['banner_image'] }}" loading="lazy" width="80" height="80" alt="MissTisa glass skin result">
                <div>
                    <span>{{ $glowConcernFeature['banner_text'] }}</span>
                    <strong>{{ $glowConcernFeature['banner_highlight'] }}</strong>
                </div>
            </div>
        </section>




        <h4 class="tfont-medium tpy-3 tmt-8 ttext-xl ttext-center">HAPPY & SATISFIED CUSTOMERS</h4>

        <section class="customer-testimonial-carousel" aria-label="Customer testimonials before and after">
            <div class="testimonial-carousel-shell" data-testimonial-carousel>
                <div class="testimonial-carousel-track">
                    @foreach ($customerTestimonials as $testimonial)
                        <article class="testimonial-slide">
                            <div class="testimonial-badge">
                                <i class="fas fa-user"></i>
                                <span>{{ $testimonial['label'] }}</span>
                            </div>

                            <div class="testimonial-before-after">
                                <div class="testimonial-photo">
                                    <img src="{{ $testimonial['before_image'] }}" loading="lazy" width="220" height="220" alt="{{ $testimonial['name'] }} before using MissTisa">
                                    <span class="testimonial-photo-label">BEFORE</span>
                                </div>
                                <div class="testimonial-photo">
                                    <img src="{{ $testimonial['after_image'] }}" loading="lazy" width="220" height="220" alt="{{ $testimonial['name'] }} after using MissTisa">
                                    <span class="testimonial-photo-label">AFTER</span>
                                </div>
                                <span class="testimonial-arrow" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                            </div>

                            <div class="testimonial-stars" aria-label="{{ $testimonial['stars'] }} star rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="{{ $i <= $testimonial['stars'] ? 'fas' : 'far' }} fa-star"></i>
                                @endfor
                            </div>

                            <p class="testimonial-comment">“{{ $testimonial['comment'] }}” <i class="fas fa-heart" style="color:#f06292;font-size:.8em;"></i></p>
                            <div class="testimonial-name">{{ $testimonial['name'] }}</div>
                        </article>
                    @endforeach
                </div>

                <button type="button" class="testimonial-carousel-btn prev" data-testimonial-prev aria-label="Previous testimonial">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button type="button" class="testimonial-carousel-btn next" data-testimonial-next aria-label="Next testimonial">
                    <i class="fas fa-chevron-right"></i>
                </button>

                <div class="testimonial-dots" aria-label="Testimonial slides">
                    @foreach ($customerTestimonials as $index => $testimonial)
                        <button type="button" class="testimonial-dot {{ $index === 0 ? 'is-active' : '' }}" data-testimonial-dot="{{ $index }}" aria-label="Go to testimonial {{ $index + 1 }}"></button>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="ingredient-feature-section" aria-label="MissTisa powerful ingredients">
            <div class="ingredient-feature-bubbles" aria-hidden="true">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <div class="ingredient-feature-header">
                <div class="ingredient-feature-eyebrow">
                    <i class="fas fa-spa"></i>
                    {{ $ingredientFeature['eyebrow'] }}
                    <i class="fas fa-spa"></i>
                </div>

                <div class="ingredient-feature-copy-block">
                    <div class="ingredient-feature-title">
                        <h2>{{ $ingredientFeature['title'] }}</h2>
                        <p>{{ $ingredientFeature['subtitle'] }}</p>
                    </div>

                    <div class="ingredient-feature-strip">{{ $ingredientFeature['support_text'] }}</div>
                </div>

                <img class="ingredient-feature-woman" src="{{ $ingredientFeature['woman_image'] }}" loading="lazy" width="320" height="420" alt="MissTisa glowing skin model">
            </div>

            <div class="ingredient-feature-list">
                @foreach ($ingredientFeature['ingredients'] as $ingredient)
                    <article class="ingredient-feature-row {{ $ingredient['theme'] }}">
                        <div class="ingredient-feature-visual">
                            <img src="{{ $ingredient['image'] }}" loading="lazy" width="120" height="120" alt="{{ $ingredient['name'] }}">
                        </div>
                        <div class="ingredient-feature-copy">
                            <h3>{{ $ingredient['name'] }}</h3>
                            <span class="ingredient-feature-tagline">{{ $ingredient['tagline'] }}</span>
                            <ul>
                                @foreach ($ingredient['bullets'] as $bullet)
                                    <li><i class="far fa-check-circle"></i>{{ $bullet }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="ingredient-benefits-card tmt-10">
                <div class="ingredient-benefits-title tbg-pink-600">WHAT IT DOES FOR YOUR <span>GLASS SKIN</span></div>
                <div class="ingredient-benefits-grid">
                    @foreach ($ingredientFeature['benefits'] as $index => $benefit)
                        <article class="ingredient-benefit">
                            <span class="ingredient-benefit-number">{{ $index + 1 }}</span>
                            <div class="ingredient-benefit-icon">
                                @if (!empty($benefit['image']))
                                    <img src="{{ $benefit['image'] }}" loading="lazy" width="140" height="140" alt="{{ $benefit['title'] }}">
                                @else
                                    <i class="fas {{ $benefit['icon'] }}"></i>
                                @endif
                            </div>
                            <div>
                                <h4>{{ $benefit['title'] }}</h4>
                                <div class="ingredient-benefit-divider"><i class="fas {{ $benefit['icon'] }}"></i></div>
                                <p>{{ $benefit['description'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="ingredient-feature-close">
                    <strong>{{ $ingredientFeature['closing_line_1'] }}</strong>
                    <span>{{ $ingredientFeature['closing_line_2'] }}</span>
                </div>
            </div>

        </section>

                <section class="routine-feature-section tmb-3" aria-label="4-step routine for pinkish glass skin">
            <div class="routine-feature-header">
                <h2 class="routine-feature-title">{{ $routineFeature['title'] }}</h2>
                <div class="routine-feature-subtitle">{{ $routineFeature['subtitle'] }}</div>
            </div>

            <div class="routine-step-grid">
                @foreach ($routineFeature['steps'] as $step)
                    <article class="routine-step-card">
                        <div class="routine-step-topline">
                            <span class="routine-step-number">{{ $step['number'] }}</span>
                            <span class="routine-step-title">{{ $step['title'] }}</span>
                            <i class="fas fa-star routine-step-sparkle"></i>
                        </div>
                        <p class="routine-step-description">{{ $step['description'] }}</p>

                        <div class="routine-step-image-wrap">
                            <img class="routine-step-image" src="{{ $step['image'] }}" loading="lazy" width="210" height="140" alt="{{ $step['title'] }} MissTisa routine step">
                        </div>

                        <span class="routine-step-accent"><i class="fas {{ $step['accent_icon'] }}"></i></span>
                        @if (!empty($step['badge']))
                            <span class="routine-step-badge">{{ $step['badge'] }}</span>
                        @endif
                    </article>
                @endforeach
            </div>

            <div class="routine-trust-strip">
                @foreach ($routineFeature['trust_items'] as $trustItem)
                    <div class="routine-trust-item">
                        <i class="fas {{ $trustItem['icon'] }}"></i>
                        <span>{{ $trustItem['text'] }}</span>
                    </div>
                @endforeach
            </div>
        </section> <!-- 4-step routine  -->


        <!-- <img class="tmb-3" src="https://matildasbeauty.com/filemanager/e0e5c84809e94f03b4546c96530c6639.webp" loading="lazy" width="480" height="480" alt="mudra before & After"> -->
        <!-- <img class="tmb-3" src="https://matildasbeauty.com/filemanager/e835b9e4bc9f4cad803cf3c3a6ef4473.webp" loading="lazy" width="480" height="480" alt="mudra before & After">
        <img class="tmb-3" src="https://matildasbeauty.com/filemanager/36f85481a2114cc891d25704ddfa02ae.webp" loading="lazy" width="480" height="480" alt="Happy Users">
        <img class="tmb-3" src="https://matildasbeauty.com/filemanager/47e5c4f66a294471b45863de264aefa4.webp" loading="lazy" width="480" height="350" alt="28_days_challenge">
        <img class="tmb-3" src="https://matildasbeauty.com/filemanager/caeeb8c393854078ab638ce543f2daea.webp" loading="lazy" width="480" height="480" alt="MissTisa Lotion - New Image"> -->

       
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


        <section class="misstisa-product-carousel tmy-5" aria-label="MissTisa products" data-product-carousel>
            <div class="misstisa-product-carousel-header">
                <div class="misstisa-product-pill">CHOOSE YOUR GLOW</div>
                <h2><span>MissTisa</span> Products</h2>
                <p>Complete care for a more radiant, younger-looking you.</p>
            </div>

            <div class="misstisa-product-viewport">
                <div class="misstisa-product-track">
                    @foreach ($productShowcase as $index => $productItem)
                        <article class="misstisa-product-card {{ $index === 2 ? 'is-active' : '' }}">
                            <img class="misstisa-product-image" src="{{ $productItem['image'] }}" loading="lazy" width="360" height="240" alt="{{ $productItem['name'] }}">
                            <div class="misstisa-product-icon"><i class="fas {{ $productItem['icon'] }}"></i></div>
                            <h3>{{ $productItem['name'] }}</h3>
                            <h4>{{ $productItem['subtitle'] }}</h4>
                            <p>{{ $productItem['description'] }}</p>
                            <a class="misstisa-product-link" href="{{ $productItem['link'] }}">View Details <i class="fas fa-arrow-right"></i></a>
                        </article>
                    @endforeach
                </div>

                <button type="button" class="misstisa-product-nav prev" data-product-prev aria-label="Previous product">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button type="button" class="misstisa-product-nav next" data-product-next aria-label="Next product">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            <div class="misstisa-product-dots" aria-label="Product slides">
                @foreach ($productShowcase as $index => $productItem)
                    <button type="button" class="misstisa-product-dot {{ $index === 2 ? 'is-active' : '' }}" data-product-dot="{{ $index }}" aria-label="Go to product {{ $index + 1 }}"></button>
                @endforeach
            </div>
        </section> <!-- CHOOSE YOUR GLOW -->


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


                <!-- <h1 class="tfont-bold tpy-5 ttext-3xl ttext-center ttext-red ttext-white tmt-10" style="
                    background: #ff5f29;
                    background: linear-gradient(90deg, rgba(255, 95, 41, 1) 0%, rgba(253, 29, 29, 1) 40%, rgba(252, 145, 69, 1) 100%);
                ">NEW PRODUCT!</h1> -->

                <!-- <img class="tmb-3" src="https://matildasbeauty.com/filemanager/55c2868e86fc435aae2b55a4c96fe6f8.webp" loading="lazy" width="480" height="480" alt="pmelo serum">
                <img class="" src="https://matildasbeauty.com/filemanager/7463ba9ebfd44727a67b35d1777826a4.webp" loading="lazy" width="480" height="480" alt="pmelo serum"> -->



                <!-- ORDER PROMO -->
                <div class="th-full tflex tflex-col tmax-w-2xl tmx-auto tbg-white tp-3">
                    <!-- Header -->

                    <!-- Product Selection -->
                    <div class="tflex tflex-col">
                        <h2 class="ttext-center ttext-base tfont-bold ttext-gray-800 tmb-2">
                            <span class="ttext-lg">🌟</span> MissTisa Beauty Collection
                        </h2>

                        <div class="tborder-dashed ttext-center tmy-2 tpy-1" style="border: 2px solid #ee2a7b; border-style: dashed;">
                            <span class="tfont-bold  ttext-center" style="font-size: 20px;"><i class="fas fa-gift ttext-3xl" style="color: red"></i> 8.8 Promo – Ends Soon! <i class="fas fa-gift ttext-3xl" style="color: red"></i></span>
                            <span class="ttext-md tfont-bold tflex tjustify-center" style="color: #ff0021;">
                                ⏰
                                <div id="timer_top">18:38</div>
                                mins
                            </span>
                            {{-- <span class="theme-color tfont-medium tml-2"> FREE 2 Gifts</span> --}}
                        </div><!-- BUY 1 TAKE 1 -->
                        
                        

                        <div class="tgrid tgap-2 tmt-5">
                            <?php foreach ($products as $index => $product): ?>
                            <div class="product-card tgrid tgrid-cols-2 tgap-2 trelative <?= $index === 0 ? 'product-selected' : '' ?> tmb-3 tbg-white tborder-2 tborder-gray-300 tcursor-pointer tduration-200 tp-2 tpb-1 trelative trounded-lg ttransition-all" onclick="selectProduct(this, <?= $product['price'] ?>, <?= $product['id'] ?>)">
                                <div class="tcol-span-2">
                                    <h2 class="ttext-2xl ttext-misstisa-pink tfont-semibold ttext-center"><?= htmlspecialchars($product['name']) ?></h2>
                                </div>
                                <div class="trelative tcol-span-1">
                                    <div class="trounded-md" style="">
                                        <img style="height: 135px!important;" src="<?= htmlspecialchars($product['image']) ?>" alt="BUY 1 TAKE 1" class="trounded-md">
                                    </div>
                                    <div class="tabsolute tmx-auto tpx-3 trounded-md" style="left: -6%;bottom: -4%; background: #e91e63;">
                                        <span class="tfont-bold ttext-3xl ttext-white" style="">₱<?= number_format($product['price']) ?></span>
                                    </div><!-- PRICE -->
                                </div>    
                                
                                <div class="tcol-span-1">
                                    <span class="tbg-pink-600 ttext-white tpx-2 tpy-1 trounded-md ttext-xs">{{ $product['badge'] }}</span>
                                    <div class="tmt-4">
                                        <!-- TITLE -->
                                        <!-- <h3 class="tfont-bold ttext-center ttext-gray-800 ttext-xs" style="font-size: 17px;"><?= htmlspecialchars($product['name']) ?></h3> -->
                                        <p class="ttext-gray-700 tfont-semibold">{{ $product['promo_text_1'] }}</p>
                                        <p class="ttext-gray-700 ">{{ $product['promo_text_2'] }}</p>
                                        <span style="font-size: 11px;">{{ $product['description'] }}</span>
                                        <!-- <p class="ttext-gray-700 ">{{ $product['promo_text_3'] }}</p> -->
                                    </div>
                                   
                                    <!-- CIRCLE RADIO BUTTON -->
                                    <div class="check-circle tabsolute tw-6 th-6 trounded-full tflex titems-center tjustify-center ttext-xs tfont-bold" style="top: 4px;right: 4px;">✓</div>
                                    
                                    <!-- QUANTITY -->
                                    <div id="quantity-container-<?= $product['id'] ?>" class="tflex titems-center tjustify-center tmb-1 tmt-2 <?= $index !== 0 ? 'thidden' : '' ?>">
                                        <div class="tflex titems-center tbg-white tborder-2 tborder-pink-200 trounded-md tpx-1 tpy-1 tshadow-sm">
                                            <button onclick="changeQuantity(<?= $product['id'] ?>, -1); event.stopPropagation();" class="tw-6 th-6 tbg-gradient-to-r tfrom-pink-400 tto-pink-500 trounded-md tflex titems-center tjustify-center hover:tfrom-pink-500 hover:tto-pink-600 ttext-white tfont-bold tshadow-sm ttransition-all tduration-200 active:tscale-95">-</button>
                                            <span id="quantity-<?= $product['id'] ?>" class="tmx-3 tfont-bold ttext-lg ttext-gray-800 tmin-w-[24px] ttext-center">1</span>
                                            <button onclick="changeQuantity(<?= $product['id'] ?>, 1); event.stopPropagation();" class="tw-6 th-6 tbg-gradient-to-r tfrom-pink-400 tto-pink-500 trounded-md tflex titems-center tjustify-center hover:tfrom-pink-500 hover:tto-pink-600 ttext-white tfont-bold tshadow-sm ttransition-all tduration-200 active:tscale-95">+</button>
                                        </div>
                                    </div>
                                </div>    

                                <p style="color: red; bottom: 2%; left: 31%; font-weight: 500;" class="ttext-sm ttext-center tabsolute">(Only {{ $product['stock'] }} Left!)</p>

                                @if ($product['most_recommended'])
                                    <span class="tabsolute tbg-white tborder-2 tborder-pink-600 tpx-3 trounded-md ttext-sm" 
                                    style="top: -6%; left: 23%; top: 5;">{{ $product['most_recommended'] }}</span>
                                @endif

                            </div>
                            <?php endforeach; ?>
                        </div>

                    </div>
                    
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

        // function selectProduct(element, price, productIndex) {
        //     // Check if this is the only selected product and prevent deselection
        //     if (element.classList.contains('product-selected') && selectedProducts.length === 1) {
        //         // Don't allow deselecting the last selected product
        //         return;
        //     }
            
        //     // Toggle selection
        //     if (element.classList.contains('product-selected')) {
        //         // Deselect product
        //         element.classList.remove('product-selected');
        //         element.classList.add('product-unselected');
        //         element.classList.remove('tborder-pink-500', 'tbg-pink-50');
        //         element.classList.add('tborder-gray-300', 'tbg-white');
                
        //         // Hide quantity container
        //         document.getElementById(`quantity-container-${productIndex}`).classList.add('thidden');
                
        //         // Reset quantity and remove from selected products
        //         quantities[productIndex] = 0;
        //         document.getElementById(`quantity-${productIndex}`).textContent = 1;
        //         selectedProducts = selectedProducts.filter(index => index !== productIndex);
        //     } else {
        //         // Select product
        //         element.classList.remove('product-unselected');
        //         element.classList.add('product-selected');
        //         element.classList.remove('tborder-gray-300', 'tbg-white');
        //         element.classList.add('tborder-pink-500', 'tbg-pink-50');
                
        //         // Show quantity container
        //         document.getElementById(`quantity-container-${productIndex}`).classList.remove('thidden');
                
        //         // Set initial quantity and add to selected products
        //         quantities[productIndex] = 1;
        //         document.getElementById(`quantity-${productIndex}`).textContent = 1;
        //         if (!selectedProducts.includes(productIndex)) {
        //             selectedProducts.push(productIndex);
        //         }
        //     }
            
        //     updateTotal();
        // }


        function selectProduct(element, price, productIndex) {
            // Deselect all other products
            document.querySelectorAll('.product-card').forEach((card, index) => {
                if (index !== productIndex) {
                    card.classList.remove('product-selected');
                    card.classList.add('product-unselected');
                    card.classList.remove('tborder-pink-500', 'tbg-pink-50');
                    card.classList.add('tborder-gray-300', 'tbg-white');

                    // Hide quantity container
                    const quantityContainer = document.getElementById(`quantity-container-${index}`);
                    if (quantityContainer) {
                        quantityContainer.classList.add('thidden');
                    }

                    // Reset quantity
                    quantities[index] = 0;
                    const quantitySpan = document.getElementById(`quantity-${index}`);
                    if (quantitySpan) {
                        quantitySpan.textContent = 1;
                    }
                }
            });

            // Select current product
            element.classList.remove('product-unselected');
            element.classList.add('product-selected');
            element.classList.remove('tborder-gray-300', 'tbg-white');
            element.classList.add('tborder-pink-500', 'tbg-pink-50');

            // Show quantity container
            const quantityContainer = document.getElementById(`quantity-container-${productIndex}`);
            if (quantityContainer) {
                quantityContainer.classList.remove('thidden');
            }

            // Set quantity and selected products
            quantities[productIndex] = 1;
            const quantitySpan = document.getElementById(`quantity-${productIndex}`);
            if (quantitySpan) {
                quantitySpan.textContent = 1;
            }
            selectedProducts = [productIndex];

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
        document.addEventListener('DOMContentLoaded', function () {
            var carousel = document.querySelector('[data-testimonial-carousel]');
            if (!carousel) return;

            var track = carousel.querySelector('.testimonial-carousel-track');
            var slides = carousel.querySelectorAll('.testimonial-slide');
            var dots = carousel.querySelectorAll('[data-testimonial-dot]');
            var prev = carousel.querySelector('[data-testimonial-prev]');
            var next = carousel.querySelector('[data-testimonial-next]');
            var currentIndex = 0;
            var startX = 0;
            var endX = 0;
            var autoScrollTimer = null;

            function goToSlide(index) {
                if (!slides.length) return;

                currentIndex = (index + slides.length) % slides.length;
                track.style.transform = 'translateX(-' + (currentIndex * 100) + '%)';

                Array.prototype.forEach.call(dots, function (dot, dotIndex) {
                    dot.classList.toggle('is-active', dotIndex === currentIndex);
                });
            }

            function startAutoScroll() {
                if (autoScrollTimer) {
                    clearInterval(autoScrollTimer);
                }

                autoScrollTimer = setInterval(function () {
                    goToSlide(currentIndex + 1);
                }, 2000);
            }

            function restartAutoScroll() {
                startAutoScroll();
            }

            if (prev) {
                prev.addEventListener('click', function () {
                    goToSlide(currentIndex - 1);
                    restartAutoScroll();
                });
            }

            if (next) {
                next.addEventListener('click', function () {
                    goToSlide(currentIndex + 1);
                    restartAutoScroll();
                });
            }

            Array.prototype.forEach.call(dots, function (dot) {
                dot.addEventListener('click', function () {
                    goToSlide(parseInt(dot.getAttribute('data-testimonial-dot'), 10) || 0);
                    restartAutoScroll();
                });
            });

            carousel.addEventListener('touchstart', function (event) {
                startX = event.touches[0].clientX;
            }, { passive: true });

            carousel.addEventListener('touchend', function (event) {
                endX = event.changedTouches[0].clientX;
                if (Math.abs(startX - endX) < 40) return;
                goToSlide(startX > endX ? currentIndex + 1 : currentIndex - 1);
                restartAutoScroll();
            }, { passive: true });

            startAutoScroll();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var carousel = document.querySelector('[data-product-carousel]');
            if (!carousel) return;

            var viewport = carousel.querySelector('.misstisa-product-viewport');
            var track = carousel.querySelector('.misstisa-product-track');
            var cards = carousel.querySelectorAll('.misstisa-product-card');
            var dots = carousel.querySelectorAll('[data-product-dot]');
            var prev = carousel.querySelector('[data-product-prev]');
            var next = carousel.querySelector('[data-product-next]');
            var currentIndex = Math.min(2, cards.length - 1);
            var startX = 0;
            var endX = 0;

            function updateProductCarousel() {
                if (!cards.length || !track || !viewport) return;

                var activeCard = cards[currentIndex];
                var cardCenter = activeCard.offsetLeft + (activeCard.offsetWidth / 2);
                var viewportCenter = viewport.offsetWidth / 2;
                var translateX = viewportCenter - cardCenter;

                track.style.transform = 'translateX(' + translateX + 'px)';

                Array.prototype.forEach.call(cards, function (card, index) {
                    card.classList.toggle('is-active', index === currentIndex);
                });

                Array.prototype.forEach.call(dots, function (dot, index) {
                    dot.classList.toggle('is-active', index === currentIndex);
                });
            }

            function goToProduct(index) {
                currentIndex = (index + cards.length) % cards.length;
                updateProductCarousel();
            }

            if (prev) {
                prev.addEventListener('click', function () {
                    goToProduct(currentIndex - 1);
                });
            }

            if (next) {
                next.addEventListener('click', function () {
                    goToProduct(currentIndex + 1);
                });
            }

            Array.prototype.forEach.call(dots, function (dot) {
                dot.addEventListener('click', function () {
                    goToProduct(parseInt(dot.getAttribute('data-product-dot'), 10) || 0);
                });
            });

            carousel.addEventListener('touchstart', function (event) {
                startX = event.touches[0].clientX;
            }, { passive: true });

            carousel.addEventListener('touchend', function (event) {
                endX = event.changedTouches[0].clientX;
                if (Math.abs(startX - endX) < 40) return;
                goToProduct(startX > endX ? currentIndex + 1 : currentIndex - 1);
            }, { passive: true });

            window.addEventListener('resize', updateProductCarousel);
            setTimeout(updateProductCarousel, 80);
            updateProductCarousel();
        });
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
