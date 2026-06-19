<x-guest-layout>
    <div class="mb-8">
        <p class="text-sm font-semibold uppercase tracking-wide text-green-700">Portal Akun</p>
        <h2 class="mt-2 text-2xl font-bold text-gray-950">Masuk ke PKBM Bakti Samboja</h2>
        <p class="mt-2 text-sm leading-6 text-gray-500">Gunakan email dan password yang sudah terdaftar untuk mengakses dashboard.</p>
    </div>

    <x-auth-session-status class="mb-4 rounded-lg border border-green-100 bg-green-50 px-4 py-3 text-sm text-green-700" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-2 block w-full rounded-lg border-gray-200 focus:border-green-600 focus:ring-green-600" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-5">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="mt-2 block w-full rounded-lg border-gray-200 focus:border-green-600 focus:ring-green-600"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-5 flex items-center justify-between gap-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-green-700 shadow-sm focus:ring-green-600" name="remember">
                <span class="ms-2 text-sm text-gray-600">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-semibold text-green-700 hover:text-green-800" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <div class="mt-7">
            <x-primary-button class="w-full justify-center rounded-lg bg-green-700 px-5 py-3 text-sm normal-case tracking-normal hover:bg-green-800 focus:bg-green-800 focus:ring-green-600">
                Masuk
            </x-primary-button>
        </div>

        @if (Route::has('register'))
            <p class="mt-6 text-center text-sm text-gray-500">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-semibold text-green-700 hover:text-green-800">Daftar sekarang</a>
            </p>
        @endif
    </form>
</x-guest-layout>
