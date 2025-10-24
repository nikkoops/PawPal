<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success Stories - PawPal</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        html, body {
            overflow-x: hidden;
            overflow-y: auto;
            height: auto;
            min-height: 100vh;
        }
        
        .story-image {
            transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
            vertical-align: top;
            display: block;
            line-height: 0;
            font-size: 0;
            margin: 0;
            padding: 0;
            border: 0;
            filter: brightness(1) contrast(1.05) saturate(1.1);
        }
        
        .story-image:hover {
            filter: brightness(1.1) contrast(1.1) saturate(1.2);
            transform: scale(1.02);
        }
        
        img {
            vertical-align: top;
            display: block;
            line-height: 0;
            font-size: 0;
            margin: 0;
            padding: 0;
            border: 0;
        }
        
        #minnie-carousel, #dello-carousel {
            line-height: 0;
            font-size: 0;
            margin: 0;
            padding: 0;
            width: fit-content;
            height: fit-content;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25), 0 0 0 1px rgba(255, 255, 255, 0.1);
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #faf8f3 0%, #f7f4ef 50%, #f4f0eb 100%);
            position: relative;
            min-height: 100vh;
        }
        
        .gradient-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #faf8f3 0%, #f7f4ef 25%, #f4f0eb 50%, #f1ede7 75%, #eee9e3 100%);
            opacity: 0.1;
            animation: gradientShift 8s ease-in-out infinite;
        }
        
        @keyframes gradientShift {
            0%, 100% { transform: translateX(-100%); }
            50% { transform: translateX(100%); }
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .hover-lift {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .hover-lift:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 32px 64px -12px rgba(0, 0, 0, 0.35);
        }
        
        .text-shadow {
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            25% { transform: translateY(-15px) rotate(1deg); }
            50% { transform: translateY(-20px) rotate(0deg); }
            75% { transform: translateY(-10px) rotate(-1deg); }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 5px rgba(251, 146, 60, 0.5); }
            50% { box-shadow: 0 0 20px rgba(251, 146, 60, 0.8), 0 0 30px rgba(251, 146, 60, 0.6); }
        }
        
        @keyframes heartbeat {
            0%, 100% { transform: scale(1); }
            25% { transform: scale(1.1); }
            50% { transform: scale(1.15); }
            75% { transform: scale(1.05); }
        }
        
        @keyframes particleFloat {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out;
        }
        
        .animate-slide-in-left {
            animation: slideInLeft 0.6s ease-out forwards;
        }
        
        .animate-slide-in-right {
            animation: slideInRight 0.6s ease-out forwards;
        }
        
        .animate-pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }
        
        .animate-heartbeat {
            animation: heartbeat 1.5s ease-in-out infinite;
        }

        .glass-effect {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .story-card {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.1),
                0 1px 3px rgba(0, 0, 0, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }
        
        .enhanced-btn {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #ff912b 0%, #ff7b00 100%);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .enhanced-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s ease;
        }
        
        .enhanced-btn:hover::before {
            left: 100%;
        }
        
        .enhanced-btn:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 15px 35px rgba(255, 145, 43, 0.4);
        }
        
        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 145, 43, 0.6);
            border-radius: 50%;
            animation: particleFloat 4s linear infinite;
        }
        
        .hover-lift {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .hover-lift:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 32px 64px -12px rgba(0, 0, 0, 0.35);
        }
        
        .text-shadow {
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .story-section:nth-child(even) {
            animation-delay: 0.3s;
        }
        
        .story-section:nth-child(odd) {
            animation-delay: 0.1s;
        }
        
        .paw-print {
            position: absolute;
            width: 50px;
            height: 45px;
            opacity: 0.15;
            pointer-events: none;
        }
        
        /* Main paw pad */
        .paw-print::before {
            content: '';
            position: absolute;
            width: 24px;
            height: 20px;
            background: #f39c42;
            border-radius: 50% 50% 60% 60%;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }
        
        /* Not needed for this style */
        .paw-print::after {
            display: none;
        }
        
        .paw-print .toe {
            position: absolute;
            background: #f39c42;
            border-radius: 50%;
        }
        
        .paw-print .toe:nth-child(1) {
            width: 9px;
            height: 12px;
            top: 0;
            left: 12px;
            transform: rotate(-10deg);
        }
        
        .paw-print .toe:nth-child(2) {
            width: 10px;
            height: 14px;
            top: -3px;
            left: 20px;
            transform: rotate(0deg);
        }
        
        .paw-print .toe:nth-child(3) {
            width: 9px;
            height: 12px;
            top: 0;
            right: 12px;
            transform: rotate(10deg);
        }
        
        @keyframes pawFloat {
            0%, 100% { 
                transform: translateY(0px) rotate(0deg); 
                opacity: 0.1;
            }
            25% { 
                transform: translateY(-10px) rotate(5deg); 
                opacity: 0.15;
            }
            50% { 
                transform: translateY(-15px) rotate(0deg); 
                opacity: 0.2;
            }
            75% { 
                transform: translateY(-8px) rotate(-5deg); 
                opacity: 0.15;
            }
        }
        
        .paw-print.animate {
            animation: pawFloat 8s ease-in-out infinite;
        }
        
        .paw-print.animate:nth-child(2n) {
            animation-delay: 2s;
            animation-duration: 10s;
        }
        
        .paw-print.animate:nth-child(3n) {
            animation-delay: 4s;
            animation-duration: 12s;
        }
        
        .paw-print.animate:nth-child(4n) {
            animation-delay: 6s;
            animation-duration: 9s;
        }
    </style>
</head>
<body class="gradient-bg min-h-screen">
    <!-- Floating Particles -->
    <div class="fixed inset-0 pointer-events-none z-0">
        <div class="particle" style="left: 10%; animation-delay: 0s;"></div>
        <div class="particle" style="left: 20%; animation-delay: 1s;"></div>
        <div class="particle" style="left: 30%; animation-delay: 2s;"></div>
        <div class="particle" style="left: 40%; animation-delay: 3s;"></div>
        <div class="particle" style="left: 50%; animation-delay: 4s;"></div>
        <div class="particle" style="left: 60%; animation-delay: 1.5s;"></div>
        <div class="particle" style="left: 70%; animation-delay: 2.5s;"></div>
        <div class="particle" style="left: 80%; animation-delay: 3.5s;"></div>
        <div class="particle" style="left: 90%; animation-delay: 0.5s;"></div>
    </div>
    
    <!-- Paw Print Background Decorations -->
    <div class="fixed inset-0 pointer-events-none z-0">
        <!-- Top Section Paws -->
        <div class="paw-print animate" style="top: 10%; left: 15%;">
            <div class="toe"></div>
            <div class="toe"></div>
            <div class="toe"></div>
        </div>
        <div class="paw-print animate" style="top: 20%; right: 20%;">
            <div class="toe"></div>
            <div class="toe"></div>
            <div class="toe"></div>
        </div>
        <div class="paw-print animate" style="top: 35%; left: 8%;">
            <div class="toe"></div>
            <div class="toe"></div>
            <div class="toe"></div>
        </div>
        <div class="paw-print animate" style="top: 45%; right: 12%;">
            <div class="toe"></div>
            <div class="toe"></div>
            <div class="toe"></div>
        </div>
        
        <!-- Middle Section Paws -->
        <div class="paw-print animate" style="top: 55%; left: 18%;">
            <div class="toe"></div>
            <div class="toe"></div>
            <div class="toe"></div>
        </div>
        <div class="paw-print animate" style="top: 65%; right: 25%;">
            <div class="toe"></div>
            <div class="toe"></div>
            <div class="toe"></div>
        </div>
        <div class="paw-print animate" style="top: 75%; left: 10%;">
            <div class="toe"></div>
            <div class="toe"></div>
            <div class="toe"></div>
        </div>
        <div class="paw-print animate" style="top: 85%; right: 15%;">
            <div class="toe"></div>
            <div class="toe"></div>
            <div class="toe"></div>
        </div>
        
        <!-- Additional Scattered Paws -->
        <div class="paw-print animate" style="top: 30%; left: 85%;">
            <div class="toe"></div>
            <div class="toe"></div>
            <div class="toe"></div>
        </div>
        <div class="paw-print animate" style="top: 50%; left: 90%;">
            <div class="toe"></div>
            <div class="toe"></div>
            <div class="toe"></div>
        </div>
        <div class="paw-print animate" style="top: 70%; right: 5%;">
            <div class="toe"></div>
            <div class="toe"></div>
            <div class="toe"></div>
        </div>
        <div class="paw-print animate" style="top: 25%; left: 5%;">
            <div class="toe"></div>
            <div class="toe"></div>
            <div class="toe"></div>
        </div>
    </div>
    
    <!-- Enhanced Background Pattern -->
    <div class="fixed inset-0 opacity-5 pointer-events-none">
        <div class="absolute top-20 left-10 w-32 h-32 bg-orange-300 rounded-full blur-3xl animate-float"></div>
        <div class="absolute top-1/3 right-20 w-40 h-40 bg-amber-300 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-1/3 left-1/4 w-36 h-36 bg-yellow-300 rounded-full blur-3xl animate-float" style="animation-delay: 4s;"></div>
        <div class="absolute bottom-20 right-1/3 w-28 h-28 bg-orange-400 rounded-full blur-3xl animate-float" style="animation-delay: 6s;"></div>
    </div>

    <!-- Header -->
    <x-header />

    <!-- Enhanced Hero Section -->
    <section class="relative py-10 px-4 overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-10 right-10 opacity-20 animate-float">
            <svg class="w-20 h-20 text-orange-400" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
        </div>
        <div class="absolute bottom-10 left-10 opacity-20 animate-float" style="animation-delay: 3s;">
            <svg class="w-16 h-16 text-amber-400" fill="currentColor" viewBox="0 0 24 24">
                <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
        </div>
        
        <div class="max-w-6xl mx-auto text-center">
            <!-- Enhanced Page Header -->
            <section class="relative py-8 overflow-hidden mb-8">
                <!-- Floating particles for header -->
                <div class="absolute inset-0 pointer-events-none">
                    <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-orange-400 rounded-full animate-pulse opacity-60"></div>
                    <div class="absolute top-1/2 right-1/3 w-3 h-3 bg-amber-400 rounded-full animate-pulse opacity-40" style="animation-delay: 1s;"></div>
                    <div class="absolute bottom-1/3 left-1/2 w-2 h-2 bg-orange-500 rounded-full animate-pulse opacity-50" style="animation-delay: 2s;"></div>
                </div>
                
                <div class="relative max-w-6xl mx-auto px-4 text-center">
                    <div class="animate-fade-in-up">
                        <!-- Header -->
                        <div class="mb-6">
                            <h1 class="text-5xl md:text-6xl lg:text-7xl font-black mb-6">
                                <span class="bg-gradient-to-r from-slate-800 via-slate-600 to-slate-800 bg-clip-text text-transparent">
                                    FURever Homes
                                </span>
                                <br>
                                <span class="bg-gradient-to-r from-orange-600 via-orange-500 to-amber-500 bg-clip-text text-transparent">
                                    Found
                                </span>
                            </h1>
                            
                            <p class="text-base md:text-lg text-slate-700 leading-relaxed max-w-4xl mx-auto mb-6">
                                Every rescue has a story. Every adoption is a new beginning. 
                                <br class="hidden md:block">
                                <span class="text-orange-600 font-semibold">Discover the heartwarming journeys</span> of pets who found their perfect families.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Enhanced Stories Container -->
            <div class="space-y-32">
                <!-- Story 1: MINNIE -->
                <div class="story-section group story-card rounded-3xl overflow-hidden animate-fade-in-up hover-lift p-8 lg:p-12">
                    <div class="grid md:grid-cols-2 gap-12 items-center">
                        <!-- Image Section -->
                        <div class="relative animate-slide-in-left mt-8">
                            <div class="relative rounded-3xl shadow-2xl overflow-hidden" style="width: fit-content; height: fit-content;">
                                <div class="relative" id="minnie-carousel" style="line-height: 0; font-size: 0; width: fit-content; height: fit-content;">
                                <img src="{{ asset('images/Image (1).jpeg') }}" alt="MINNIE - Image 1" class="story-image block transition-transform duration-700 group-hover:scale-105" data-index="0" style="display: block; margin: 0; padding: 0; border: 0; width: auto; height: auto;">
                                <img src="{{ asset('images/Image (4).jpeg') }}" alt="MINNIE - Image 2" class="story-image absolute top-0 left-0 block opacity-0 transition-transform duration-700 group-hover:scale-105" data-index="1" style="display: block; margin: 0; padding: 0; border: 0; width: auto; height: auto;">
                                <img src="{{ asset('images/Image (5).jpeg') }}" alt="MINNIE - Image 3" class="story-image absolute top-0 left-0 block opacity-0 transition-transform duration-700 group-hover:scale-105" data-index="2" style="display: block; margin: 0; padding: 0; border: 0; width: auto; height: auto;">
                                <img src="{{ asset('images/Image (6).jpeg') }}" alt="MINNIE - Image 4" class="story-image absolute top-0 left-0 block opacity-0 transition-transform duration-700 group-hover:scale-105" data-index="3" style="display: block; margin: 0; padding: 0; border: 0; width: auto; height: auto;">
                            </div>
                            <!-- Enhanced Navigation Controls -->
                            <button onclick="prevImage('minnie')" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/95 hover:bg-white text-gray-700 hover:text-orange-600 p-3 rounded-full shadow-xl hover:shadow-2xl transition-all duration-300 z-20 backdrop-blur-sm border border-white/50 hover:scale-110">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <button onclick="nextImage('minnie')" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/95 hover:bg-white text-gray-700 hover:text-orange-600 p-3 rounded-full shadow-xl hover:shadow-2xl transition-all duration-300 z-20 backdrop-blur-sm border border-white/50 hover:scale-110">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                            
                            <!-- Enhanced Image Counter -->
                            <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 glass-effect text-white px-6 py-3 rounded-full text-sm font-semibold shadow-xl border border-white/30">
                                <span id="minnie-counter">1 / 4</span>
                            </div>
                            
                            <!-- Love Indicator -->
                            <div class="absolute top-6 right-6 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                <div class="bg-red-500/90 text-white p-3 rounded-full animate-heartbeat">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        </div>
                        
                        <!-- Enhanced Content Section -->
                        <div class="animate-slide-in-right">
                            <div class="mb-8 text-left">
                                <div class="inline-flex items-center gap-2 mb-4">
                                    <svg class="w-4 h-4 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <span class="text-orange-600 font-bold uppercase tracking-wider text-xs">Former Shelter Dog</span>
                                </div>
                                <h2 class="text-4xl lg:text-5xl font-black text-gray-900 mb-6 tracking-tight text-shadow text-left">MINNIE</h2>
                            </div>
                            
                            <!-- Enhanced Story Info Card -->
                            <div class="bg-gradient-to-br from-slate-800 via-slate-900 to-gray-900 rounded-3xl p-10 mb-10 text-white shadow-2xl border border-slate-700/50 hover:border-orange-500/30 transition-all duration-500 text-left">
                                <div class="relative text-left">
                                    <div class="absolute -top-2 -right-2 w-4 h-4 bg-orange-500 rounded-full animate-pulse"></div>
                                    <p class="text-base leading-relaxed mb-6 text-slate-100 text-justify">
                                        From being the star of our Luvapawlooza Adoption Drive in Ayala Malls Serin to finding her fur-ever home 🥹
                                        <span class="text-orange-400 font-bold bg-orange-400/10 px-2 py-1 rounded-lg">Minnie</span> has always been a playful, sweet, and affectionate fur baby since she arrived at our adoption house, pero ngayon, ang kanyang fur-mily na ang magiging receiving end ng kanyang pagkamalambing! 🐶
                                    </p>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-left">
                                        <div class="bg-gradient-to-br from-slate-700/80 to-slate-800/80 rounded-2xl p-6 border border-slate-600/50 hover:border-orange-400/50 transition-all duration-300 text-left">
                                            <div class="flex items-center gap-3 mb-3">
                                                <svg class="w-5 h-5 text-orange-400" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                                </svg>
                                                <p class="text-orange-400 uppercase tracking-wider font-bold text-sm">FURPARENTS</p>
                                            </div>
                                            <p class="font-semibold text-white text-base text-left">Maria and Jose Santos</p>
                                        </div>
                                        <div class="bg-gradient-to-br from-slate-700/80 to-slate-800/80 rounded-2xl p-6 border border-slate-600/50 hover:border-orange-400/50 transition-all duration-300 text-left">
                                            <div class="flex items-center gap-3 mb-3">
                                                <svg class="w-5 h-5 text-orange-400" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                                </svg>
                                                <p class="text-orange-400 uppercase tracking-wider font-bold text-sm">LOCATION</p>
                                            </div>
                                            <p class="font-semibold text-white text-base text-left">Alfonso, Cavite - Philippines</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-8 text-left">
                                <p class="text-gray-700 text-base leading-relaxed font-medium text-left">
                                    You, too, can open your home to a shelter animal and change their life forever. 
                                    <span class="text-xl">✨</span>
                                </p>
                            </div>
                            
                            <!-- Enhanced Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="{{ route('home') }}" class="enhanced-btn group text-white font-semibold text-sm py-4 px-8 rounded-2xl transition-all duration-400 flex items-center justify-center gap-3 shadow-2xl relative z-10">
                                    <span class="relative z-10">Apply Now</span>
                                    <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform duration-300 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                                <button onclick="toggleLove('minnie')" id="minnie-love-btn" class="group border-3 border-orange-500 text-orange-600 hover:bg-orange-50 hover:border-orange-600 font-semibold text-sm py-4 px-8 rounded-2xl transition-all duration-400 flex items-center justify-center gap-3 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 hover:scale-105">
                                    <svg class="w-6 h-6 group-hover:scale-125 transition-transform duration-300 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                    <span>Love This Story</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Story 2: DELLO -->
                <div class="story-section group story-card rounded-3xl overflow-hidden animate-fade-in-up hover-lift p-8 lg:p-12">
                    <div class="grid md:grid-cols-2 gap-12 items-center">
                        <!-- Content Section -->
                        <div class="animate-slide-in-left order-2 lg:order-1">
                            <div class="mb-6 text-left">
                                <div class="flex items-center gap-2 mb-4">
                                    <svg class="w-4 h-4 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <span class="text-orange-600 font-bold uppercase tracking-wider text-xs">Former Shelter Dog</span>
                                </div>
                                <h2 class="text-3xl lg:text-4xl font-black text-gray-900 mb-4 tracking-tight text-shadow text-left">DELLO</h2>
                            </div>
                            
                            <!-- Enhanced Story Info Card -->
                            <div class="bg-gradient-to-br from-slate-800 via-slate-900 to-gray-900 rounded-3xl p-8 mb-6 text-white shadow-2xl border border-slate-700/50 hover:border-orange-500/30 transition-all duration-500 text-left">
                                <div class="relative text-left">
                                    <div class="absolute -top-2 -right-2 w-4 h-4 bg-orange-500 rounded-full animate-pulse"></div>
                                    <p class="text-base leading-relaxed mb-8 text-slate-100 text-justify">
                                        Our <span class="text-orange-400 font-bold bg-orange-400/10 px-2 py-1 rounded-lg">Dello</span> is the first aspaw we rescued from Laguna, and we've witnessed his journey to complete recovery and transformation, from being a shy and scared 4-month-old puppy, to being a joyful, hyper, and attention-seeking doggo. He even had his photos taken during our Paw-sion for Photos session and showed off his goofy and lovable personality!
                                    </p>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-left">
                                        <div class="bg-gradient-to-br from-slate-700/80 to-slate-800/80 rounded-2xl p-6 border border-slate-600/50 hover:border-orange-400/50 transition-all duration-300 text-left">
                                            <div class="flex items-center gap-3 mb-3">
                                                <svg class="w-5 h-5 text-orange-400" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                                </svg>
                                                <p class="text-orange-400 uppercase tracking-wider font-bold text-sm">FURPARENTS</p>
                                            </div>
                                            <p class="font-semibold text-white text-base text-left">Anthony and Lisa Cruz</p>
                                        </div>
                                        <div class="bg-gradient-to-br from-slate-700/80 to-slate-800/80 rounded-2xl p-6 border border-slate-600/50 hover:border-orange-400/50 transition-all duration-300 text-left">
                                            <div class="flex items-center gap-3 mb-3">
                                                <svg class="w-5 h-5 text-orange-400" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                                </svg>
                                                <p class="text-orange-400 uppercase tracking-wider font-bold text-sm">LOCATION</p>
                                            </div>
                                            <p class="font-semibold text-white text-base text-left">Quezon City - Philippines</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-8 text-left">
                                <p class="text-gray-700 text-base leading-relaxed font-medium text-left">
                                    Start your adoption journey today and give a deserving pet their second chance at happiness. 
                                    <span class="text-xl">🏠</span>
                                </p>
                            </div>
                            
                            <!-- Enhanced Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="{{ route('home') }}" class="enhanced-btn group text-white font-semibold text-sm py-4 px-8 rounded-2xl transition-all duration-400 flex items-center justify-center gap-3 shadow-2xl relative z-10">
                                    <span class="relative z-10">Apply Now</span>
                                    <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform duration-300 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                                <button onclick="toggleLove('dello')" id="dello-love-btn" class="group border-3 border-orange-500 text-orange-600 hover:bg-orange-50 hover:border-orange-600 font-semibold text-sm py-4 px-8 rounded-2xl transition-all duration-400 flex items-center justify-center gap-3 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 hover:scale-105">
                                    <svg class="w-6 h-6 group-hover:scale-125 transition-transform duration-300 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                    <span>Love This Story</span>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Image Section -->
                        <div class="relative animate-slide-in-right order-1 lg:order-2 mt-8">
                            <div class="relative rounded-3xl shadow-2xl overflow-hidden" style="width: fit-content; height: fit-content;">
                                <div class="relative" id="dello-carousel" style="line-height: 0; font-size: 0; width: fit-content; height: fit-content;">
                                    <img src="{{ asset('images/Image (10).jpeg') }}" alt="DELLO - Image 1" class="story-image block transition-all duration-700" data-index="0" style="display: block; margin: 0; padding: 0; border: 0; width: auto; height: auto;">
                                    <img src="{{ asset('images/Image (7).jpeg') }}" alt="DELLO - Image 2" class="story-image absolute top-0 left-0 block opacity-0 transition-all duration-700" data-index="1" style="display: block; margin: 0; padding: 0; border: 0; width: auto; height: auto;">
                                    <img src="{{ asset('images/Image (8).jpeg') }}" alt="DELLO - Image 3" class="story-image absolute top-0 left-0 block opacity-0 transition-all duration-700" data-index="2" style="display: block; margin: 0; padding: 0; border: 0; width: auto; height: auto;">
                                    <img src="{{ asset('images/Image (9).jpeg') }}" alt="DELLO - Image 4" class="story-image absolute top-0 left-0 block opacity-0 transition-all duration-700" data-index="3" style="display: block; margin: 0; padding: 0; border: 0; width: auto; height: auto;">
                                </div>
                                
                                <!-- Enhanced Navigation Controls -->
                                <button onclick="prevImage('dello')" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/95 hover:bg-white text-gray-700 hover:text-orange-600 p-3 rounded-full shadow-xl hover:shadow-2xl transition-all duration-300 z-20 backdrop-blur-sm border border-white/50 hover:scale-110">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                </button>
                                <button onclick="nextImage('dello')" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/95 hover:bg-white text-gray-700 hover:text-orange-600 p-3 rounded-full shadow-xl hover:shadow-2xl transition-all duration-300 z-20 backdrop-blur-sm border border-white/50 hover:scale-110">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                                
                                <!-- Enhanced Image Counter -->
                                <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 glass-effect text-white px-6 py-3 rounded-full text-sm font-semibold shadow-xl border border-white/30">
                                    <span id="dello-counter">1 / 4</span>
                                </div>
                                
                                <!-- Love Indicator -->
                                <div class="absolute top-6 right-6 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                    <div class="bg-red-500/90 text-white p-3 rounded-full animate-heartbeat">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Carousel functionality
        const carousels = {
            'minnie': {
                images: ['Image (1).jpeg', 'Image (4).jpeg', 'Image (5).jpeg', 'Image (6).jpeg'],
                currentIndex: 0,
                intervalId: null
            },
            'dello': {
                images: ['Image (10).jpeg', 'Image (7).jpeg', 'Image (8).jpeg', 'Image (9).jpeg'],
                currentIndex: 0,
                intervalId: null
            }
        };

        function showImage(storyName, index) {
            const carousel = document.getElementById(storyName + '-carousel');
            const images = carousel.querySelectorAll('.story-image');
            
            images.forEach((img, i) => {
                if (i === index) {
                    img.style.opacity = '1';
                } else {
                    img.style.opacity = '0';
                }
            });
            
            carousels[storyName].currentIndex = index;
            
            // Update counter
            const counter = document.getElementById(storyName + '-counter');
            if (counter) {
                counter.textContent = `${index + 1} / ${images.length}`;
            }
        }

        function nextImage(storyName) {
            const carousel = carousels[storyName];
            const nextIndex = (carousel.currentIndex + 1) % carousel.images.length;
            showImage(storyName, nextIndex);
        }

        function prevImage(storyName) {
            const carousel = carousels[storyName];
            const prevIndex = (carousel.currentIndex - 1 + carousel.images.length) % carousel.images.length;
            showImage(storyName, prevIndex);
        }

        function startAutoplay(storyName) {
            carousels[storyName].intervalId = setInterval(() => {
                nextImage(storyName);
            }, 4000); // Change image every 4 seconds
        }

        function stopAutoplay(storyName) {
            if (carousels[storyName].intervalId) {
                clearInterval(carousels[storyName].intervalId);
            }
        }

        function toggleLove(storyName) {
            const btn = document.getElementById(storyName + '-love-btn');
            const svg = btn.querySelector('svg');
            
            if (btn.classList.contains('loved')) {
                btn.classList.remove('loved');
                svg.setAttribute('fill', 'none');
                btn.classList.remove('bg-red-50', 'text-red-500');
                btn.classList.add('bg-white', 'text-slate-600');
            } else {
                btn.classList.add('loved');
                svg.setAttribute('fill', 'currentColor');
                btn.classList.remove('bg-white', 'text-slate-600');
                btn.classList.add('bg-red-50', 'text-red-500');
            }
        }

        // Initialize carousels when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Start autoplay for both carousels
            startAutoplay('minnie');
            startAutoplay('dello');
            
            // Pause autoplay on hover
            Object.keys(carousels).forEach(storyName => {
                const carousel = document.getElementById(storyName + '-carousel');
                carousel.addEventListener('mouseenter', () => stopAutoplay(storyName));
                carousel.addEventListener('mouseleave', () => startAutoplay(storyName));
            });
        });
    </script>
</body>
</html>