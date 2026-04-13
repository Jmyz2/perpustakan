<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Pustaka Nusantara</title>
    <!-- Tailwind CSS (CDN for simplicity) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom Theme Configuration -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        nusantara: {
                            gold: '#D4AF37',
                            brown: '#8B4513',
                            dark: '#2C1D11',
                            cream: '#FDFBF7',
                            red: '#8B0000'
                        }
                    },
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>
    <style>
        /* Pattern Batik Semu / Texture */
        .bg-batik-pattern {
            background-color: #fdfbf7;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%238b4513' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .glass-panel {
            background: rgba(253, 251, 247, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(139, 69, 19, 0.1);
        }
    </style>
</head>
<body class="bg-batik-pattern text-nusantara-dark antialiased min-h-screen flex flex-col font-sans">
    
    @yield('content')

</body>
</html>
