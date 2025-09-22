<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PawPal Admin')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        background: '#ffffff',
                        foreground: '#8d6e63',
                        card: '#f5f5f5',
                        'card-foreground': '#8d6e63',
                        primary: '#ffb74d',
                        'primary-foreground': '#ffffff',
                        secondary: '#ffcc80',
                        'secondary-foreground': '#8d6e63',
                        muted: '#f5f5f5',
                        'muted-foreground': '#8d6e63',
                        accent: '#ffcc80',
                        'accent-foreground': '#8d6e63',
                        destructive: '#e57373',
                        'destructive-foreground': '#ffffff',
                        border: '#e0e0e0',
                        input: '#ffffff',
                        ring: '#ffb74d'
                    },
                    fontFamily: {
                        'serif': ['Montserrat', 'serif'],
                        'sans': ['Open Sans', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        .btn-primary {
            @apply inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2;
        }
        .btn-secondary {
            @apply inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-secondary text-secondary-foreground hover:bg-secondary/80 h-10 px-4 py-2;
        }
        .input {
            @apply flex h-10 w-full rounded-md border border-border bg-input px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50;
        }
    </style>
</head>
<body class="min-h-screen bg-background">
    @yield('content')

    <script>
        // Initialize Lucide icons
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
        });
    </script>
</body>
</html>