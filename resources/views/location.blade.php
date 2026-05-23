<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Ubicación - Naiara Sofía 🐝</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;600&family=Plus+Jakarta+Sans:wght@600;700&family=Great+Vibes&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Bubblegum+Sans&family=Itim&display=swap" rel="stylesheet"/>

    <!-- Tailwind custom theme (igual que welcome) -->
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-surface-variant": "#4d4635",
                        "outline-variant": "#d0c6ae",
                        "on-surface": "#0d1c2f",
                        "primary": "#735c00",
                        "primary-container": "#fbd34d",
                        "on-primary-container": "#715b00",
                        "surface": "#f8f9ff",
                        "surface-bright": "#f8f9ff",
                        "background": "#f8f9ff",
                    }
                }
            }
        }
    </script>

    <style>
        body { margin: 0; padding: 0; background: #f8f9ff; }
        #app { min-height: 100vh; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/location.js'])
</head>
<body>
    <div id="app"></div>
</body>
</html>
