<x-guest-layout>
    <div class="mb-8">
        <p class="text-sm font-semibold uppercase tracking-wide text-green-700">Pendaftaran Akun</p>
        <h2 class="mt-2 text-2xl font-bold text-gray-950">Buat akun baru</h2>
        <p class="mt-2 text-sm leading-6 text-gray-500">Daftarkan akun untuk mengakses layanan digital PKBM Bakti Samboja.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" value="Nama lengkap" />
            <x-text-input id="name" class="mt-2 block w-full rounded-lg border-gray-200 focus:border-green-600 focus:ring-green-600" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama sesuai identitas" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-5">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-2 block w-full rounded-lg border-gray-200 focus:border-green-600 focus:ring-green-600" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-5">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="mt-2 block w-full rounded-lg border-gray-200 focus:border-green-600 focus:ring-green-600"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-5">
            <x-input-label for="password_confirmation" value="Konfirmasi password" />
            <x-text-input id="password_confirmation" class="mt-2 block w-full rounded-lg border-gray-200 focus:border-green-600 focus:ring-green-600"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-7">
            <x-primary-button class="w-full justify-center rounded-lg bg-green-700 px-5 py-3 text-sm normal-case tracking-normal hover:bg-green-800 focus:bg-green-800 focus:ring-green-600">
                Daftar
            </x-primary-button>
        </div>

        <p class="mt-6 text-center text-sm text-gray-500">
            Sudah punya akun?
            <a class="font-semibold text-green-700 hover:text-green-800" href="{{ route('login') }}">Masuk di sini</a>
        </p>
    </form>
</x-guest-layout>
