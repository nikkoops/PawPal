@extends('admin.layouts.auth')

@section('title', 'Admin Login - PawPal')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <div class="flex justify-center">
                @php
                    $role = request()->query('role', 'shelter_admin');
                    $roleIcon = $role === 'system_admin' ? '🔧' : '🏠';
                    $roleTitle = $role === 'system_admin' ? 'System Admin' : 'Shelter Admin';
                @endphp
                <span style="font-size: 4rem;">{{ $roleIcon }}</span>
            </div>
            <h2 class="mt-6 text-3xl font-serif font-bold text-foreground">{{ $roleTitle }} Login</h2>
            <p class="mt-2 text-sm text-muted-foreground">Sign in to access your dashboard</p>
        </div>

        <div class="bg-white/95 backdrop-blur-sm rounded-lg shadow-xl p-8 border border-border">
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-50/90 backdrop-blur-sm border border-red-200 rounded-lg">
                    <div class="flex">
                        <i data-lucide="alert-circle" class="h-5 w-5 text-red-400"></i>
                        <div class="ml-3">
                            <p class="text-sm text-red-800">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-4 bg-red-50/90 backdrop-blur-sm border border-red-200 rounded-lg">
                    <div class="flex">
                        <i data-lucide="alert-circle" class="h-5 w-5 text-red-400"></i>
                        <div class="ml-3">
                            <p class="text-sm text-red-800">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
                @csrf
                <input type="hidden" name="role" value="{{ request()->query('role', 'shelter_admin') }}">
                <div>
                    <label for="email" class="block text-sm font-medium text-foreground">Email address</label>
                    <input id="email" name="email" type="email" autocomplete="email" required 
                           value="{{ old('email') }}"
                           class="mt-1 appearance-none relative block w-full px-3 py-3 border border-border placeholder-muted-foreground text-foreground rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary focus:z-10 sm:text-sm">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-foreground">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required 
                           class="mt-1 appearance-none relative block w-full px-3 py-3 border border-border placeholder-muted-foreground text-foreground rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary focus:z-10 sm:text-sm">
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember" type="checkbox" 
                               class="h-4 w-4 text-primary focus:ring-primary border-border rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-muted-foreground">Remember me</label>
                    </div>
                </div>

                <div>
                    <button type="submit" 
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-primary-foreground bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-200">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i data-lucide="lock" class="h-5 w-5 text-primary-foreground/70 group-hover:text-primary-foreground/90"></i>
                        </span>
                        Sign in
                    </button>
                </div>
            </form>
        </div>

        <div class="text-center">
            <a href="/" class="text-sm text-primary hover:text-primary/80">
                ← Back to Home
            </a>
            <span class="mx-2 text-muted-foreground">•</span>
            <p class="text-sm text-muted-foreground inline">
                Need help? Contact your system administrator
            </p>
        </div>
    </div>
</div>

<script>
    lucide.createIcons();
</script>
@endsection