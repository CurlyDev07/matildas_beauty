<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Nunito:wght@600;700;800;900&display=swap" rel="stylesheet">
<style>
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
