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
        .sidebar-transition {
            transition: transform 0.3s ease-in-out;
        }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .nav-link {
            @apply flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors duration-200 text-muted-foreground hover:text-foreground hover:bg-muted;
        }
        .nav-link.active {
            @apply bg-primary text-primary-foreground;
        }
        .btn-primary {
            @apply inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2;
        }
        .btn-secondary {
            @apply inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-secondary text-secondary-foreground hover:bg-secondary/80 h-10 px-4 py-2;
        }
        .btn-destructive {
            @apply inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-destructive text-destructive-foreground hover:bg-destructive/90 h-10 px-4 py-2;
        }
        .btn-sm {
            @apply h-9 px-3;
        }
        .input {
            @apply flex h-10 w-full rounded-md border border-border bg-input px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50;
        }
    </style>
</head>
<body class="min-h-screen bg-background">
    <!-- Mobile sidebar overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 z-40 bg-black/50 lg:hidden hidden" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <div id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-card border-r border-border sidebar-transition transform -translate-x-full lg:translate-x-0 lg:static lg:inset-0">
        <div class="flex h-full flex-col">
            <!-- Logo -->
            <div class="flex h-20 items-center justify-between px-6 border-b border-border">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
                    <i data-lucide="heart" class="h-8 w-8 text-primary"></i>
                    <span class="text-2xl font-serif font-bold text-foreground">PawPal Admin</span>
                </a>
                <button class="lg:hidden p-2 rounded-md hover:bg-muted" onclick="toggleSidebar()">
                    <i data-lucide="x" class="h-5 w-5"></i>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i data-lucide="layout-dashboard" class="h-5 w-5"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.pets.index') }}" class="nav-link {{ request()->routeIs('admin.pets.*') ? 'active' : '' }}">
                    <i data-lucide="heart" class="h-5 w-5"></i>
                    <span>Pet Management</span>
                </a>
                <a href="{{ route('admin.form-questions.index') }}" class="nav-link {{ request()->routeIs('admin.form-questions.*') ? 'active' : '' }}">
                    <i data-lucide="file-text" class="h-5 w-5"></i>
                    <span>Form Builder</span>
                </a>
                <a href="{{ route('admin.applications.index') }}" class="nav-link {{ request()->routeIs('admin.applications.*') ? 'active' : '' }}">
                    <i data-lucide="users" class="h-5 w-5"></i>
                    <span>Applications</span>
                </a>
                <a href="{{ route('admin.analytics.index') }}" class="nav-link {{ request()->routeIs('admin.analytics.*') ? 'active' : '' }}">
                    <i data-lucide="bar-chart-3" class="h-5 w-5"></i>
                    <span>Analytics</span>
                </a>
            </nav>

            <!-- Admin info -->
            <div class="p-4 border-t border-border">
                <div class="bg-white rounded-lg border border-border p-4">
                    <div class="flex items-center space-x-3">
                        <div class="h-10 w-10 rounded-full bg-primary flex items-center justify-center">
                            <span class="text-sm font-medium text-primary-foreground">{{ substr(auth()->user()->name ?? 'AD', 0, 2) }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-foreground">{{ auth()->user()->name ?? 'Admin User' }}</p>
                            <p class="text-xs text-muted-foreground">{{ auth()->user()->email ?? 'admin@pawpal.com' }}</p>
                        </div>
                    </div>
                    <div class="mt-4 flex space-x-2">
                        <button class="btn-secondary btn-sm flex-1">
                            <i data-lucide="settings" class="h-4 w-4 mr-2"></i>
                            Settings
                        </button>
                        <a href="{{ route('admin.logout') }}" class="btn-secondary btn-sm flex-1">
                            <i data-lucide="log-out" class="h-4 w-4 mr-2"></i>
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="lg:pl-64">
        <!-- Top bar -->
        <div class="sticky top-0 z-30 bg-background/95 backdrop-blur-sm border-b border-border">
            <div class="flex h-16 items-center justify-between px-6">
                <button class="lg:hidden p-2 rounded-md hover:bg-muted" onclick="toggleSidebar()">
                    <i data-lucide="menu" class="h-5 w-5"></i>
                </button>

                <div class="flex items-center space-x-4">
                    <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        System Online
                    </div>
                    <span class="text-sm text-muted-foreground">Last updated: <span id="current-time"></span></span>
                </div>
            </div>
        </div>

        <!-- Page content -->
        <main class="p-6">
            @yield('content')
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        function updateCurrentTime() {
            const timeElement = document.getElementById('current-time');
            if (timeElement) {
                timeElement.textContent = new Date().toLocaleTimeString();
            }
        }

        // Initialize Lucide icons
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
            updateCurrentTime();
            setInterval(updateCurrentTime, 1000);
        });
    </script>
</body>
</html>