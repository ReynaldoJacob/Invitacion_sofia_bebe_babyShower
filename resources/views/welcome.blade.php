<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Naiara Sofía - Bienvenida</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;600&family=Plus+Jakarta+Sans:wght@600;700&family=Great+Vibes&display=swap" rel="stylesheet"/>

    <!-- Tailwind custom theme -->
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "secondary-fixed-dim": "#c9c7b5",
                        "on-surface-variant": "#4d4635",
                        "inverse-primary": "#e9c33e",
                        "primary-fixed-dim": "#e9c33e",
                        "outline-variant": "#d0c6ae",
                        "tertiary": "#855300",
                        "on-error": "#ffffff",
                        "primary-fixed": "#ffe083",
                        "surface-container-highest": "#d5e3fd",
                        "outline": "#7f7662",
                        "error": "#ba1a1a",
                        "surface-dim": "#ccdbf4",
                        "secondary": "#5f5f50",
                        "on-error-container": "#93000a",
                        "on-surface": "#0d1c2f",
                        "on-secondary-fixed": "#1c1c10",
                        "on-tertiary-container": "#835200",
                        "on-background": "#0d1c2f",
                        "on-primary": "#ffffff",
                        "surface-container": "#e6eeff",
                        "secondary-container": "#e2e0cd",
                        "tertiary-fixed-dim": "#ffb95f",
                        "tertiary-fixed": "#ffddb8",
                        "primary": "#735c00",
                        "surface-container-low": "#eff4ff",
                        "on-tertiary-fixed-variant": "#653e00",
                        "surface-bright": "#f8f9ff",
                        "inverse-surface": "#233144",
                        "on-primary-fixed-variant": "#574500",
                        "on-primary-fixed": "#231b00",
                        "on-primary-container": "#715b00",
                        "surface-container-high": "#dde9ff",
                        "error-container": "#ffdad6",
                        "surface-tint": "#735c00",
                        "on-tertiary-fixed": "#2a1700",
                        "background": "#f8f9ff",
                        "tertiary-container": "#ffce95",
                        "secondary-fixed": "#e5e3d0",
                        "inverse-on-surface": "#ebf1ff",
                        "surface": "#f8f9ff",
                        "primary-container": "#fbd34d",
                        "on-secondary-fixed-variant": "#474839",
                        "surface-container-lowest": "#ffffff",
                        "on-secondary": "#ffffff",
                        "on-tertiary": "#ffffff",
                        "surface-variant": "#d5e3fd",
                        "on-secondary-container": "#646354"
                    },
                    borderRadius: {
                        DEFAULT: "0.25rem",
                        lg: "0.5rem",
                        xl: "0.75rem",
                        full: "9999px"
                    },
                    fontFamily: {
                        "body-lg": ["Be Vietnam Pro"],
                        "label-sm": ["Be Vietnam Pro"],
                        "body-md": ["Be Vietnam Pro"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "headline-lg": ["Plus Jakarta Sans"],
                        "display-name": ["Plus Jakarta Sans"],
                        "script": ["Great Vibes", "cursive"]
                    },
                    fontSize: {
                        "body-lg": ["18px", { lineHeight: "28px", fontWeight: "400" }],
                        "label-sm": ["14px", { lineHeight: "20px", fontWeight: "600" }],
                        "body-md": ["16px", { lineHeight: "24px", fontWeight: "400" }],
                        "headline-md": ["24px", { lineHeight: "32px", fontWeight: "600" }],
                        "headline-lg": ["32px", { lineHeight: "40px", fontWeight: "600" }],
                        "display-name": ["48px", { lineHeight: "56px", letterSpacing: "-0.02em", fontWeight: "700" }]
                    },
                    boxShadow: {
                        "soft-amber": "0px 4px 12px rgba(245, 158, 11, 0.15)",
                        "envelope": "0 20px 25px -5px rgba(245, 158, 11, 0.1), 0 10px 10px -5px rgba(245, 158, 11, 0.04)"
                    }
                }
            }
        }
    </script>

    <!-- Envelope styles -->
    <style>
        @keyframes bee-float {
            0%   { transform: translateY(0px)   rotate(-1deg); }
            25%  { transform: translateY(-10px) rotate(1deg);  }
            50%  { transform: translateY(-16px) rotate(-1deg); }
            75%  { transform: translateY(-8px)  rotate(1deg);  }
            100% { transform: translateY(0px)   rotate(-1deg); }
        }

        @keyframes bee-shadow {
            0%   { transform: scaleX(1)    translateY(0px); opacity: 0.18; }
            50%  { transform: scaleX(0.7)  translateY(4px); opacity: 0.08; }
            100% { transform: scaleX(1)    translateY(0px); opacity: 0.18; }
        }

        .envelope-container { perspective: 1000px; }

        .envelope-wrapper {
            animation: bee-float 3s ease-in-out infinite;
            display: inline-block;
            position: relative;
        }

        .envelope-wrapper.is-animating {
            animation-play-state: paused;
        }

        .envelope-shadow {
            width: 200px;
            height: 14px;
            background: radial-gradient(ellipse, rgba(180,130,0,0.35) 0%, transparent 70%);
            border-radius: 50%;
            margin: 10px auto 0;
            animation: bee-shadow 3s ease-in-out infinite;
        }

        .envelope {
            position: relative;
            width: 280px;
            height: 175px;
            background-color: #FEFCE8;
            border-radius: 8px;
            box-shadow: 0 20px 25px -5px rgba(245,158,11,0.1), 0 10px 10px -5px rgba(245,158,11,0.04);
            cursor: pointer;
            transition: box-shadow 0.3s ease;
            z-index: 10;
        }
        .envelope:hover {
            box-shadow: 0 25px 30px -5px rgba(245,158,11,0.18), 0 15px 15px -5px rgba(245,158,11,0.10);
        }
        .envelope-flap {
            position: absolute; top: 0; left: 0;
            width: 0; height: 0;
            border-left: 140px solid transparent;
            border-right: 140px solid transparent;
            border-top: 87px solid #FEFCE8;
            border-bottom: 87px solid transparent;
            transform-origin: top;
            transition: transform 0.6s ease-in-out;
            z-index: 4;
            filter: drop-shadow(0 4px 2px rgba(245,158,11,0.05));
        }
        .envelope-front-bottom {
            position: absolute; bottom: 0; left: 0;
            width: 0; height: 0;
            border-left: 140px solid transparent;
            border-right: 140px solid transparent;
            border-top: 87px solid transparent;
            border-bottom: 87px solid #fef9c3;
            z-index: 3;
        }
        .envelope-front-left {
            position: absolute; bottom: 0; left: 0;
            width: 0; height: 0;
            border-top: 87px solid transparent;
            border-bottom: 87px solid transparent;
            border-left: 140px solid #fef08a;
            border-right: 140px solid transparent;
            z-index: 2;
        }
        .envelope-front-right {
            position: absolute; bottom: 0; right: 0;
            width: 0; height: 0;
            border-top: 87px solid transparent;
            border-bottom: 87px solid transparent;
            border-right: 140px solid #fef08a;
            border-left: 140px solid transparent;
            z-index: 2;
        }
        .card {
            position: absolute;
            top: 5px; left: 10px; right: 10px;
            height: 165px;
            background-color: white;
            border-radius: 8px;
            border: 1px solid rgba(245,158,11,0.2);
            transition: transform 0.6s ease-in-out;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            opacity: 0;
        }
        .is-open .envelope-flap  { transform: rotateX(180deg); z-index: 0; }
        .is-open .card           { transform: translateY(-70px); opacity: 1; z-index: 2; }
        .is-open .envelope-front-bottom,
        .is-open .envelope-front-left,
        .is-open .envelope-front-right { z-index: 5; }

        .bg-img-full {
            background-image: url('/images/background.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background:#1a1a1a; display:flex; align-items:center; justify-content:center; height:100vh; width:100vw; margin:0; padding:0; overflow:hidden;">
    <div id="app" style="width:390px; max-width:100vw; height:100vh; max-height:844px; position:relative; overflow:hidden;"></div>
</body>
</html>
