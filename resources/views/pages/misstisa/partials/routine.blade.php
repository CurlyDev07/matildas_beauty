<?php
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
?>

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
        </section>
