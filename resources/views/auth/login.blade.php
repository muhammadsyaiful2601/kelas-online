<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-8">
        <!-- Logo -->
        <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-blue-50 text-blue-600 mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2-2m-2-4h.01M17 16a4 4 0 01-8 0 4 4 0 018 0z"></path>
            </svg>
        </div>

        <!-- Welcome Heading -->
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Welcome back!</h1>

        <!-- Sign up link -->
        <p class="text-sm text-gray-600 mb-6">
            Don't have an account yet?
            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-500 font-medium">Sign up now</a>
        </p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <input
                id="email"
                type="email"
                name="email"
                placeholder="Email address"
                class="block w-full px-4 py-3 text-gray-900 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-500" />
        </div>

        <!-- Password -->
        <div class="mb-6 relative">
            <input
                id="password"
                type="password"
                name="password"
                placeholder="Password"
                class="block w-full px-4 py-3 text-gray-900 border border-gray-300 rounded-xl pr-12 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                required
                autocomplete="current-password"
            />
            <!-- Eye toggle -->
            <button type="button" id="toggle-password" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.482 7.745 7.764 5 12 5c4.237 0 8.518 2.745 9.542 7 1.024-4.253 5.305-7 9.542-7 4.237 0 8.518 2.745 9.542 7 1.024-4.253 5.305-7 9.542-7s5.305 7 9.542 7"></path>
                </svg>
            </button>
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-500" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                <label for="remember_me" class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</label>
            </div>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-500 underline">{{ __('Forgot password?') }}</a>
            @endif
        </div>

        <!-- Log In Button -->
        <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl transition-all focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 outline-none">
            {{ __('Log in') }}
        </button>

        <!-- OR Divider -->
        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <span class="w-full border-t border-gray-200"></span>
            </div>
            <div class="relative flex justify-center text-xs uppercase">
                <span class="bg-white px-2 text-gray-400">Or</span>
            </div>
        </div>

        <!-- SSO Link -->
        <div class="mb-6">
            <a href="#" class="block text-center text-sm text-blue-600 hover:text-blue-500 underline">
                {{ __('Log in with SSO') }}
            </a>
        </div>
    </form>
</x-guest-layout>

<script>
    // Password eye toggle
    document.getElementById('toggle-password').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
</script>
