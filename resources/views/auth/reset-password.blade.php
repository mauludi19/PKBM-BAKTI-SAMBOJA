<x-guest-layout>
    <div class="mb-8">
        <p class="text-sm font-semibold uppercase tracking-wide text-green-700">Reset Password</p>
        <h2 class="mt-2 text-2xl font-bold text-gray-950">Buat password baru</h2>
        <p class="mt-2 text-sm leading-6 text-gray-500">Gunakan password baru yang mudah diingat tetapi tetap aman untuk akun Anda.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-2 block w-full rounded-lg border-gray-200 focus:border-green-600 focus:ring-green-600" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-5">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="mt-2 block w-full rounded-lg border-gray-200 focus:border-green-600 focus:ring-green-600" type="password" name="password" required autocomplete="new-password" />
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
                Simpan password baru
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
