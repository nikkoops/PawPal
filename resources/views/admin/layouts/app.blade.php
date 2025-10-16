<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PawPal Admin')</title>
    <!-- Include Inter font for consistency with adoption site -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        background: '#faf5ff',
                        foreground: '#111827',
                        card: '#ffffff',
                        'card-foreground': '#111827',
                        primary: '#9333ea',
                        'primary-foreground': '#ffffff',
                        secondary: '#f3e8ff',
                        'secondary-foreground': '#9333ea',
                        muted: '#f3f4f6',
                        'muted-foreground': '#6b7280',
                        accent: '#9333ea',
                        'accent-foreground': '#ffffff',
                        destructive: '#ef4444',
                        'destructive-foreground': '#ffffff',
                        border: '#e5e7eb',
                        input: '#ffffff',
                        ring: '#9333ea'
                    },
                    fontFamily: {
                        'serif': ['serif'],
                        'sans': ['Inter', '-apple-system', 'BlinkMacSystemFont', 'Segmented UI', 'Roboto', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        /* CSS Variables matching adoption site design system */
        :root {
            --background: #faf5ff;
            --foreground: #111827;
            --card: #ffffff;
            --card-foreground: #111827;
            --container-width: min(100% - 2rem, 1200px);
            --header-height: 4rem;
            --spacing-xs: 0.25rem;
            --spacing-sm: 0.5rem;
            --spacing-md: 1rem;
            --spacing-lg: 2rem;
            --spacing-xl: 4rem;
            --primary: #9333ea;
            --primary-foreground: #ffffff;
            --border: #e5e7eb;
            --muted: #f3f4f6;
            --muted-foreground: #6b7280;
        }

        /* Base typography matching adoption site */
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segmented UI', Roboto, sans-serif;
            font-size: 16px;
            line-height: 1.6;
            color: var(--foreground);
            background: var(--background);
        }

        /* Headings matching adoption site hierarchy */
        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--foreground);
            margin-bottom: 1rem;
            font-family: serif;
            line-height: 1.1;
        }

        h2 {
            font-size: 2rem;
            font-weight: bold;
            color: var(--foreground);
            margin-bottom: 0.75rem;
            font-family: serif;
            line-height: 1.2;
        }

        h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--foreground);
            margin-bottom: 0.5rem;
            line-height: 1.3;
        }

        h4 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--foreground);
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        /* Body text */
        p {
            font-size: 1rem;
            color: var(--muted-foreground);
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        /* Cards matching adoption site */
        .card {
            background: var(--card);
            border-radius: 1rem;
            padding: 2rem;
            border: 1px solid var(--border);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        /* Navigation Link Styling - Force proper alignment */
        .nav-link {
            @apply flex px-4 py-3 rounded-lg text-sm font-medium transition-colors duration-200 text-muted-foreground hover:text-foreground hover:bg-muted min-h-[48px] whitespace-nowrap;
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
        }
        .nav-link.active {
            @apply bg-primary text-primary-foreground hover:bg-primary hover:text-primary-foreground;
        }
        .nav-link i {
            width: 20px !important;
            height: 20px !important;
            flex-shrink: 0 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }
        .nav-link span {
            flex: 1 !important;
            line-height: 20px !important;
            display: flex !important;
            align-items: center !important;
            text-overflow: ellipsis !important;
            overflow: hidden !important;
        }
        
        /* Responsive navigation text */
        @media (max-width: 1024px) {
            .nav-link {
                @apply text-xs px-3 py-2.5 min-h-[40px];
                gap: 8px !important;
            }
            .nav-link i {
                @apply w-4 h-4;
            }
        }
        
        /* Ensure sidebar is wide enough for all text */
        @media (min-width: 1024px) {
            .sidebar-width {
                width: 280px;
            }
        }
        /* Button Styling matching adoption site */
        .btn-primary {
            background: var(--primary);
            color: var(--primary-foreground);
            padding: 0.625rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
            font-size: 0.875rem;
            cursor: pointer;
        }

        .btn-primary:hover {
            background: #7c3aed;
            color: var(--primary-foreground);
            text-decoration: none;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(147, 51, 234, 0.3);
        }

        .btn-secondary {
            background: var(--secondary);
            color: var(--secondary-foreground);
            padding: 0.625rem 1.5rem;
            border: 1px solid var(--border);
            border-radius: 0.5rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
            font-size: 0.875rem;
            cursor: pointer;
        }

        .btn-secondary:hover {
            background: var(--primary);
            color: var(--primary-foreground);
            border-color: var(--primary);
            text-decoration: none;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(147, 51, 234, 0.2);
        }

        .btn-outline {
            background: transparent;
            color: var(--primary);
            padding: 0.625rem 1.5rem;
            border: 1px solid var(--primary);
            border-radius: 0.5rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
            font-size: 0.875rem;
            cursor: pointer;
        }

        .btn-outline:hover {
            background: var(--primary);
            color: var(--primary-foreground);
            text-decoration: none;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(147, 51, 234, 0.2);
        }

        .btn-destructive {
            background: #ef4444;
            color: white;
            padding: 0.625rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
            font-size: 0.875rem;
            cursor: pointer;
        }

        .btn-destructive:hover {
            background: #dc2626;
            color: white;
            text-decoration: none;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(239, 68, 68, 0.3);
        }

        .btn-sm {
            padding: 0.375rem 1rem;
            font-size: 0.75rem;
        }

        /* Input styling matching adoption site */
        .input, input[type="text"], input[type="email"], input[type="password"], input[type="number"], input[type="date"], input[type="file"], select, textarea {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 0.5rem;
            padding: 0.625rem 1rem;
            font-size: 0.875rem;
            line-height: 1.5;
            color: var(--foreground);
            transition: all 0.2s ease;
            width: 100%;
        }

        .input:focus, input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(147, 51, 234, 0.1);
        }

        /* Sidebar styling */
        .sidebar-transition {
            transition: transform 0.3s ease-in-out;
        }

        /* Layout spacing */
        .section {
            padding: var(--spacing-xl) var(--spacing-md);
            max-width: var(--container-width);
            margin: 0 auto;
        }

        .section-header {
            margin-bottom: 2rem;
        }

        /* Gradient background matching adoption site */
        .gradient-bg {
            background: linear-gradient(to bottom, #f3e8ff, #faf5ff);
            min-height: 100vh;
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
            padding: var(--spacing-lg);
            background: var(--background);
        }

        /* Page titles with proper hierarchy */
        .page-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--foreground);
            margin-bottom: 0.5rem;
            font-family: serif;
            line-height: 1.1;
        }

        .page-subtitle {
            font-size: 1.125rem;
            color: var(--muted-foreground);
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        /* Stats cards */
        .stats-card {
            background: var(--card);
            border-radius: 1rem;
            padding: 1.5rem;
            border: 1px solid var(--border);
            transition: all 0.2s ease;
        }

        .stats-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .stats-number {
            font-size: 2rem;
            font-weight: bold;
            color: var(--primary);
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        .stats-label {
            font-size: 0.875rem;
            color: var(--muted-foreground);
            font-weight: 500;
        }

        /* Table styling */
        .table {
            width: 100%;
            background: var(--card);
            border-radius: 0.75rem;
            overflow: hidden;
            border: 1px solid var(--border);
        }

        .table th {
            background: var(--muted);
            color: var(--foreground);
            font-weight: 600;
            padding: 1rem;
            text-align: left;
            font-size: 0.875rem;
            border-bottom: 1px solid var(--border);
        }

        .table td {
            padding: 1rem;
            border-bottom: 1px solid var(--border);
            color: var(--foreground);
        }

        .table tr:last-child td {
            border-bottom: none;
        }

        .table tr:hover {
            background: var(--muted);
        }

        /* Form styling */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: var(--foreground);
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        /* Responsive behavior matching adoption site */
        @media (max-width: 768px) {
            .admin-content {
                padding: var(--spacing-md);
            }
            
            .page-title {
                font-size: 2rem;
            }

            h2 {
                font-size: 1.5rem;
            }

            .card {
                padding: 1.5rem;
            }

            .stats-card {
                padding: 1rem;
            }

            .table th, .table td {
                padding: 0.75rem;
            }
        }

        @media (max-width: 480px) {
            .page-title {
                font-size: 1.75rem;
            }

            .admin-content {
                padding: var(--spacing-sm);
            }

            .card {
                padding: 1rem;
            }
        }

        /* Alert/notification styling */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid;
            font-weight: 500;
        }

        .alert-success {
            background: #ecfdf5;
            border-color: #10b981;
            color: #065f46;
        }

        .alert-error {
            background: #fef2f2;
            border-color: #ef4444;
            color: #991b1b;
        }

        .alert-info {
            background: #eff6ff;
            border-color: #3b82f6;
            color: #1e40af;
        }
    </style>
</head>
<body class="min-h-screen overflow-x-hidden gradient-bg">
    <!-- Mobile sidebar overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 z-45 bg-black/50 lg:hidden hidden" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <div id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 lg:w-72 bg-card/95 backdrop-blur-sm border-r border-border sidebar-transition transform -translate-x-full lg:translate-x-0">
        <div class="flex h-full flex-col">
            <!-- Logo -->
            <div class="flex h-20 items-center justify-between px-6 border-b border-border">
                <a href="{{ auth()->user()->role === 'system_admin' ? route('admin.system.dashboard') : route('admin.shelter.dashboard') }}" class="flex items-center space-x-2 min-w-0">
                    <img src="{{ asset('images/favicon.png') }}" alt="PawPal Logo" class="h-8 w-8 flex-shrink-0 object-contain">
                    <span class="text-xl lg:text-2xl font-serif font-bold text-foreground truncate">PawPal Admin</span>
                </a>
                <button class="lg:hidden p-2 rounded-md hover:bg-muted flex-shrink-0" onclick="toggleSidebar()">
                    <i data-lucide="x" class="h-5 w-5"></i>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-3 overflow-y-auto">
                @if(auth()->user()->role === 'system_admin')
                    {{-- System Admin Navigation --}}
                    <a href="{{ route('admin.system.dashboard') }}" class="nav-link {{ request()->routeIs('admin.system.dashboard') ? 'active' : '' }}" title="Dashboard" style="display: flex !important; align-items: center !important; gap: 14px !important; padding: 12px 16px !important; transition: all 0.3s ease !important; border-radius: 8px !important;" onmouseover="this.style.color='#9334e9'" onmouseout="this.style.color=''">
                        <i data-lucide="layout-dashboard" style="width: 20px !important; height: 20px !important; flex-shrink: 0 !important; transition: color 0.3s ease !important;"></i>
                        <span style="flex: 1 !important; line-height: 20px !important; transition: color 0.3s ease !important;">Dashboard</span>
                    </a>
                    <a href="{{ route('admin.system.users') }}" class="nav-link {{ request()->routeIs('admin.system.users*') ? 'active' : '' }}" title="User Management" style="display: flex !important; align-items: center !important; gap: 14px !important; padding: 12px 16px !important; transition: all 0.3s ease !important; border-radius: 8px !important;" onmouseover="this.style.color='#9334e9'" onmouseout="this.style.color=''">
                        <i data-lucide="users" style="width: 20px !important; height: 20px !important; flex-shrink: 0 !important; transition: color 0.3s ease !important;"></i>
                        <span style="flex: 1 !important; line-height: 20px !important; transition: color 0.3s ease !important;">User Management</span>
                    </a>
                    <a href="{{ route('admin.system.analytics') }}" class="nav-link {{ request()->routeIs('admin.system.analytics') ? 'active' : '' }}" title="Analytics" style="display: flex !important; align-items: center !important; gap: 14px !important; padding: 12px 16px !important; transition: all 0.3s ease !important; border-radius: 8px !important;" onmouseover="this.style.color='#9334e9'" onmouseout="this.style.color=''">
                        <i data-lucide="bar-chart-3" style="width: 20px !important; height: 20px !important; flex-shrink: 0 !important; transition: color 0.3s ease !important;"></i>
                        <span style="flex: 1 !important; line-height: 20px !important; transition: color 0.3s ease !important;">Analytics</span>
                    </a>
                @else
                    {{-- Shelter Admin Navigation --}}
                    <a href="{{ route('admin.shelter.dashboard') }}" class="nav-link {{ request()->routeIs('admin.shelter.dashboard') ? 'active' : '' }}" title="Dashboard" style="display: flex !important; align-items: center !important; gap: 14px !important; padding: 12px 16px !important; transition: all 0.3s ease !important; border-radius: 8px !important;" onmouseover="this.style.color='#9334e9'" onmouseout="this.style.color=''">
                        <i data-lucide="layout-dashboard" style="width: 20px !important; height: 20px !important; flex-shrink: 0 !important; transition: color 0.3s ease !important;"></i>
                        <span style="flex: 1 !important; line-height: 20px !important; transition: color 0.3s ease !important;">Dashboard</span>
                    </a>
                    <a href="{{ route('admin.shelter.pets.index') }}" class="nav-link {{ request()->routeIs('admin.shelter.pets.*') ? 'active' : '' }}" title="Pet Management" style="display: flex !important; align-items: center !important; gap: 14px !important; padding: 12px 16px !important; transition: all 0.3s ease !important; border-radius: 8px !important;" onmouseover="this.style.color='#9334e9'" onmouseout="this.style.color=''">
                        <i data-lucide="heart" style="width: 20px !important; height: 20px !important; flex-shrink: 0 !important; transition: color 0.3s ease !important;"></i>
                        <span style="flex: 1 !important; line-height: 20px !important; transition: color 0.3s ease !important;">Pet Management</span>
                    </a>
                    <a href="{{ route('admin.shelter.applications.index') }}" class="nav-link {{ request()->routeIs('admin.shelter.applications.*') ? 'active' : '' }}" title="Applications" style="display: flex !important; align-items: center !important; gap: 14px !important; padding: 12px 16px !important; transition: all 0.3s ease !important; border-radius: 8px !important;" onmouseover="this.style.color='#9334e9'" onmouseout="this.style.color=''">
                        <i data-lucide="file-text" style="width: 20px !important; height: 20px !important; flex-shrink: 0 !important; transition: color 0.3s ease !important;"></i>
                        <span style="flex: 1 !important; line-height: 20px !important; transition: color 0.3s ease !important;">Applications</span>
                    </a>
                    <a href="{{ route('admin.shelter.analytics') }}" class="nav-link {{ request()->routeIs('admin.shelter.analytics') ? 'active' : '' }}" title="Analytics" style="display: flex !important; align-items: center !important; gap: 14px !important; padding: 12px 16px !important; transition: all 0.3s ease !important; border-radius: 8px !important;" onmouseover="this.style.color='#9334e9'" onmouseout="this.style.color=''">
                        <i data-lucide="bar-chart-3" style="width: 20px !important; height: 20px !important; flex-shrink: 0 !important; transition: color 0.3s ease !important;"></i>
                        <span style="flex: 1 !important; line-height: 20px !important; transition: color 0.3s ease !important;">Analytics</span>
                    </a>
                @endif
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
                        <button class="btn-secondary btn-sm flex-1" style="display: flex !important; align-items: center !important; justify-content: center !important; gap: 6px !important; transition: all 0.3s ease !important;" onmouseover="this.style.color='#9334e9'" onmouseout="this.style.color=''">
                            <i data-lucide="settings" style="width: 16px !important; height: 16px !important; flex-shrink: 0 !important; transition: color 0.3s ease !important;"></i>
                            <span style="transition: color 0.3s ease !important;">Settings</span>
                        </button>
                        <a href="{{ route('admin.logout') }}" class="btn-secondary btn-sm flex-1" style="display: flex !important; align-items: center !important; justify-content: center !important; gap: 6px !important; transition: all 0.3s ease !important;" onmouseover="this.style.color='#9334e9'" onmouseout="this.style.color=''">
                            <i data-lucide="log-out" style="width: 16px !important; height: 16px !important; flex-shrink: 0 !important; transition: color 0.3s ease !important;"></i>
                            <span style="transition: color 0.3s ease !important;">Logout</span>
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