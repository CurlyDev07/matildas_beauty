<style>
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
</style>
