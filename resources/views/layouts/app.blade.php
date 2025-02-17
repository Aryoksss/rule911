<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Anime</title>
    <title>{{ config('app.name', 'Laravel') }}</title>
    

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: #f8fafc;
            background-image: 
                radial-gradient(at 40% 20%, rgba(99, 102, 241, 0.1) 0px, transparent 50%),
                radial-gradient(at 80% 0%, rgba(139, 92, 246, 0.1) 0px, transparent 50%),
                radial-gradient(at 0% 50%, rgba(245, 158, 11, 0.1) 0px, transparent 50%);
            background-attachment: fixed;
        }

        .wrapper {
            flex: 1 0 auto;
        }

        footer {
            flex-shrink: 0;
        }

        /* Glass Effect */
        .glass-effect {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Modern Loading Spinner */
        .modern-spinner {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: conic-gradient(from 0deg, #6366f1, #ffffff);
            animation: spin 1s linear infinite;
            mask: radial-gradient(farthest-side, #0000 calc(100% - 6px), #000 0);
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <x-banner />

    <!-- Navigation -->
    <nav class="glass-effect shadow-sm sticky top-0 z-50">
        @livewire('navigation-menu')
    </nav>

    <!-- Main Content Wrapper -->
    <div class="wrapper">
        <!-- Page Heading -->
        @if (isset($header))
            <header class="glass-effect shadow-sm">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="h-8 w-1 bg-gradient-to-b from-indigo-500 to-purple-600 rounded-full"></div>
                            {{ $header }}
                        </div>
                    </div>
                </div>
            </header>
        @endif

        <!-- Main Content -->
        <main class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-lg shadow-sm p-6 transition-all duration-300 ease-in-out">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="glass-effect mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Company Info -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ config('app.name', 'Laravel') }}</h3>
                    <p class="text-gray-600">Building better solutions for a connected world.</p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors">About Us</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors">Services</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors">Contact</a></li>
                    </ul>
                </div>

                <!-- Legal -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Legal</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors">Terms of Service</a></li>
                    </ul>
                </div>
            </div>

            <div class="mt-8 pt-8 border-t border-gray-200">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-600 mb-4 md:mb-0">© {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
                    <div class="flex space-x-6">
                        <!-- Social Media Icons -->
                        <a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Loading Indicator -->
    <div id="loading-indicator" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
        <div class="glass-effect p-6 rounded-xl flex items-center space-x-4">
            <div class="modern-spinner"></div>
            <span class="text-gray-700 font-medium">Loading...</span>
        </div>
    </div>

    @stack('modals')
    @livewireScripts

    <script>
        // Show/hide loading indicator
        document.addEventListener('livewire:loading', () => {
            document.getElementById('loading-indicator').classList.remove('hidden');
        });
        
        document.addEventListener('livewire:load', () => {
            document.getElementById('loading-indicator').classList.add('hidden');
        });
    </script>
</body>
</html>