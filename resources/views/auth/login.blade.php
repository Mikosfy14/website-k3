<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Sistem Manajemen K3</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">
    <div class="flex min-h-screen">
        <!-- Left Side - Image/Branding Section -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden"
            style="background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -translate-x-1/2 -translate-y-1/2">
                </div>
                <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full translate-x-1/2 translate-y-1/2">
                </div>
            </div>

        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/gedung-dieng.jpg') }}" 
             alt="Background K3"
             class="w-full h-full object-cover"
             style="opacity: 0.50;"> <!-- Atur opacity di sini -->
        </div>
    
        <!-- Pattern overlay (opsional) -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full translate-x-1/2 translate-y-1/2"></div>
        </div>

            <div class="relative z-10 flex flex-col items-center justify-center w-full px-12 text-white">
                <!-- Logo/Image Area -->
                <div class="mb-8">
                    <div
                        class="w-48 h-48 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center border-4 border-white/30">
                        <img src="{{ asset('assets/images/logo-k3.png') }}" alt="K3 Logo"
                            class="w-32 h-32 object-contain"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div style="display:none;"
                            class="w-full h-full flex items-center justify-center text-6xl font-bold">
                            K3
                        </div>
                    </div>
                </div>

                <h1 class="text-4xl font-bold mb-4 text-center">Sistem Manajemen K3</h1>
                <p class="text-xl text-center text-white/90 mb-8">
                    Keselamatan dan Kesehatan Kerja
                </p>

                <div class="mt-8 p-6 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-12 h-12 rounded-lg flex items-center justify-center"
                            style="background-color: var(--color-secondary);">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg">Sistem Keamanan Terpadu</h3>
                            <p class="text-sm text-white/80">Jalur evakuasi dan mitigasi bencana</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md">
                <!-- Mobile Logo -->
                <div class="lg:hidden text-center mb-8">
                    <div class="inline-flex w-20 h-20 items-center justify-center rounded-full mb-4"
                        style="background-color: var(--color-primary);">
                        <span class="text-3xl font-bold text-white">K3</span>
                    </div>
                    <h2 class="text-2xl font-bold" style="color: var(--color-primary);">Sistem Manajemen K3</h2>
                </div>

                <!-- Login Form Header -->
                <div class="mb-8">
                    <h2 class="text-3xl font-bold mb-2" style="color: var(--color-primary);">Selamat Datang!</h2>
                    <p class="text-gray-600">Silakan login untuk melanjutkan ke dashboard admin</p>
                </div>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700 font-medium">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            Email Address
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                    </path>
                                </svg>
                            </div>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                autofocus
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent transition-all duration-200 @error('email') border-red-500 @enderror"
                                placeholder="nama@email.com">
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                            </div>
                            <input type="password" name="password" id="password" required
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent transition-all duration-200 @error('password') border-red-500 @enderror"
                                placeholder="Masukkan password">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-lg text-white font-semibold transition-all duration-200 transform hover:scale-105 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-offset-2"
                            style="background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                </path>
                            </svg>
                            Login ke Dashboard
                        </button>
                    </div>
                </form>

                <!-- Footer Info -->
                <div class="mt-8 text-center">
                    <div class="inline-flex items-center px-4 py-2 bg-gray-50 rounded-lg">
                        <svg class="w-5 h-5 mr-2" style="color: var(--color-secondary);" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-xs font-medium text-gray-700">Koneksi Aman SSL</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom focus ring colors using CSS variables */
        input:focus,
        button:focus {
            --tw-ring-color: var(--color-primary);
        }

        input[type="checkbox"]:checked {
            background-color: var(--color-primary);
            border-color: var(--color-primary);
        }
    </style>
</body>

</html>
