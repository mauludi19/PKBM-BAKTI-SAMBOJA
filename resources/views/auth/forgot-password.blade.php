<x-guest-layout>
    <div class="mb-8">
        <p class="text-sm font-semibold uppercase tracking-wide text-green-700">Bantuan Akun</p>
        <h2 class="mt-2 text-2xl font-bold text-gray-950">Lupa password?</h2>
        <p class="mt-2 text-sm leading-6 text-gray-500">Masukkan email akun Anda. Kami akan mengirim tautan untuk membuat password baru.</p>
    </div>

    <x-auth-session-status class="mb-4 rounded-lg border border-green-100 bg-green-50 px-4 py-3 text-sm text-green-700" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-2 block w-full rounded-lg border-gray-200 focus:border-green-600 focus:ring-green-600" type="email" name="email" :value="old('email')" required autofocus placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-7">
            <x-primary-button class="w-full justify-center rounded-lg bg-green-700 px-5 py-3 text-sm normal-case tracking-normal hover:bg-green-800 focus:bg-green-800 focus:ring-green-600">
                Kirim tautan reset
            </x-primary-button>
        </div>

        <p class="mt-6 text-center text-sm text-gray-500">
            Ingat password?
            <a href="{{ route('login') }}" class="font-semibold text-green-700 hover:text-green-800">Kembali masuk</a>
        </p>
    </form>
</x-guest-layout>
