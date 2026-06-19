<x-guest-layout>
    <div class="mb-8">
        <p class="text-sm font-semibold uppercase tracking-wide text-green-700">Verifikasi Email</p>
        <h2 class="mt-2 text-2xl font-bold text-gray-950">Cek kotak masuk Anda</h2>
        <p class="mt-2 text-sm leading-6 text-gray-500">Kami sudah mengirim tautan verifikasi ke email yang digunakan saat pendaftaran. Klik tautan tersebut untuk mengaktifkan akun.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-5 rounded-lg border border-green-100 bg-green-50 px-4 py-3 text-sm font-medium text-green-700">
            Tautan verifikasi baru sudah dikirim ke email Anda.
        </div>
    @endif

    <div class="mt-6 grid gap-3 sm:grid-cols-[1fr_auto] sm:items-center">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <x-primary-button class="w-full justify-center rounded-lg bg-green-700 px-5 py-3 text-sm normal-case tracking-normal hover:bg-green-800 focus:bg-green-800 focus:ring-green-600 sm:w-auto">
                Kirim ulang email
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="w-full rounded-lg border border-gray-200 px-5 py-3 text-sm font-semibold text-gray-600 hover:border-green-700 hover:text-green-700 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 sm:w-auto">
                Keluar
            </button>
        </form>
    </div>
</x-guest-layout>
