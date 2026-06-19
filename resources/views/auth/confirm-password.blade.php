<x-guest-layout>
    <div class="mb-8">
        <p class="text-sm font-semibold uppercase tracking-wide text-green-700">Area Aman</p>
        <h2 class="mt-2 text-2xl font-bold text-gray-950">Konfirmasi password</h2>
        <p class="mt-2 text-sm leading-6 text-gray-500">Masukkan password akun Anda sekali lagi sebelum melanjutkan ke halaman berikutnya.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="mt-2 block w-full rounded-lg border-gray-200 focus:border-green-600 focus:ring-green-600"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-7">
            <x-primary-button class="w-full justify-center rounded-lg bg-green-700 px-5 py-3 text-sm normal-case tracking-normal hover:bg-green-800 focus:bg-green-800 focus:ring-green-600">
                Konfirmasi
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
