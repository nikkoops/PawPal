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
                        background: '#faf5ff',
                        foreground: '#374151',
                        card: '#ffffff',
                        'card-foreground': '#374151',
                        primary: '#9334e9',
                        'primary-foreground': '#ffffff',
                        secondary: '#c084fc',
                        'secondary-foreground': '#ffffff',
                        muted: '#f3f4f6',
                        'muted-foreground': '#6b7280',
                        accent: '#c084fc',
                        'accent-foreground': '#ffffff',
                        destructive: '#ef4444',
                        'destructive-foreground': '#ffffff',
                        border: '#e5e7eb',
                        input: '#ffffff',
                        ring: '#9334e9'
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
            @apply flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors duration-200 text-muted-foreground hover:text-foreground hover:bg-muted min-h-[48px] whitespace-nowrap;
        }
        .nav-link.active {
            @apply bg-primary text-primary-foreground;
        }
        .nav-link span {
            @apply flex-1 truncate;
        }
        
        /* Responsive navigation text */
        @media (max-width: 1024px) {
            .nav-link {
                @apply text-xs px-3 py-2 space-x-2;
            }
        }
        
        /* Ensure sidebar is wide enough for all text */
        @media (min-width: 1024px) {
            .sidebar-width {
                width: 280px;
            }
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
        
        /* Custom z-index utilities for proper layering */
        .z-45 { z-index: 45; }
        
        /* Ensure proper scrolling behavior */
        .admin-layout {
            height: 100vh;
            overflow: hidden;
        }
        
        .admin-content {
            height: calc(100vh - 5rem);
            overflow-y: auto;
            padding-top: 1rem;
        }
        
        /* Ensure page titles have enough space */
        @media (max-width: 768px) {
            .admin-content {
                padding-top: 1.5rem;
            }
        }
    </style>
</head>
<body class="min-h-screen bg-background overflow-x-hidden">
    <!-- Mobile sidebar overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 z-45 bg-black/50 lg:hidden hidden" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <div id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 lg:w-72 bg-card/95 backdrop-blur-sm border-r border-border sidebar-transition transform -translate-x-full lg:translate-x-0">
        <div class="flex h-full flex-col">
            <!-- Logo -->
            <div class="flex h-20 items-center justify-between px-6 border-b border-border">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 min-w-0">
                    <i data-lucide="heart" class="h-8 w-8 text-primary flex-shrink-0"></i>
                    <span class="text-xl lg:text-2xl font-serif font-bold text-foreground truncate">PawPal Admin</span>
                </a>
                <button class="lg:hidden p-2 rounded-md hover:bg-muted flex-shrink-0" onclick="toggleSidebar()">
                    <i data-lucide="x" class="h-5 w-5"></i>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" title="Dashboard">
                    <i data-lucide="layout-dashboard" class="h-5 w-5 flex-shrink-0"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                <a href="{{ route('admin.pets.index') }}" class="nav-link {{ request()->routeIs('admin.pets.*') ? 'active' : '' }}" title="Pet Management">
                    <i data-lucide="heart" class="h-5 w-5 flex-shrink-0"></i>
                    <span class="font-medium">Pet Management</span>
                </a>
                <a href="{{ route('admin.form-questions.index') }}" class="nav-link {{ request()->routeIs('admin.form-questions.*') ? 'active' : '' }}" title="Form Builder">
                    <i data-lucide="file-text" class="h-5 w-5 flex-shrink-0"></i>
                    <span class="font-medium">Form Builder</span>
                </a>
                <a href="{{ route('admin.applications.index') }}" class="nav-link {{ request()->routeIs('admin.applications.*') ? 'active' : '' }}" title="Applications">
                    <i data-lucide="users" class="h-5 w-5 flex-shrink-0"></i>
                    <span class="font-medium">Applications</span>
                </a>
                <a href="{{ route('admin.analytics.index') }}" class="nav-link {{ request()->routeIs('admin.analytics.*') ? 'active' : '' }}" title="Analytics">
                    <i data-lucide="bar-chart-3" class="h-5 w-5 flex-shrink-0"></i>
                    <span class="font-medium">Analytics</span>
                </a>
            </nav>

            <!-- Admin info -->
            <div class="p-4 border-t border-border">
                <div class="bg-white/95 backdrop-blur-sm rounded-lg border border-border p-4">
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

    <!-- Main content wrapper -->
    <div class="lg:pl-72 min-h-screen">
        <!-- Top bar - Fixed -->
        <div class="fixed top-0 right-0 left-0 lg:left-72 z-40 h-16 bg-background/95 backdrop-blur-sm border-b border-border">
            <div class="flex h-16 items-center justify-between px-4 lg:px-6">
                <button class="lg:hidden p-2 rounded-md hover:bg-muted flex-shrink-0" onclick="toggleSidebar()">
                    <i data-lucide="menu" class="h-5 w-5"></i>
                </button>

                <div class="flex items-center space-x-2 lg:space-x-4 ml-auto">
                    <div class="inline-flex items-center px-2 lg:px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <span class="hidden sm:inline">System Online</span>
                        <span class="sm:hidden">Online</span>
                    </div>
                    <span class="text-xs lg:text-sm text-muted-foreground hidden md:inline">
                        Last updated: <span id="current-time"></span>
                    </span>
                </div>
            </div>
        </div>

        <!-- Page content - With increased top margin to prevent overlap -->
        <main class="admin-content pt-20 px-4 lg:px-6 pb-6">
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