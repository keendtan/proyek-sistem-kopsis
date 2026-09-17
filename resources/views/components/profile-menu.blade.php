<div x-data="{ openProfile: false, openLogoutConfirm: false }" class="relative">
    <button type="button" @click="openProfile = true" aria-label="Buka profil" class="icon-btn flex h-9 w-9 items-center justify-center rounded-full text-current transition hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white/60">
        <span class="flex h-9 w-9 items-center justify-center rounded-full bg-red-800 text-white">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 6.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0" />
            </svg>
        </span>
    </button>

    <div x-cloak x-show="openProfile" x-transition.opacity @keydown.escape.window="openProfile = false" class="fixed inset-0 z-50 min-h-screen overflow-y-auto bg-[#fffaf7]" role="dialog" aria-modal="true" aria-labelledby="profile-title">
        <div class="min-h-screen w-full bg-[#fffaf7]">
            <div class="flex items-center gap-4 rounded-b-[22px] bg-[#ad292d] px-5 py-5 text-white sm:px-10">
                <button type="button" @click="openProfile = false" aria-label="Kembali" class="rounded-full p-1 hover:bg-white/15 focus:outline-none focus:ring-2 focus:ring-white/70">
                    <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 5l-7 7 7 7M9 12h10" /></svg>
                </button>
                <h2 id="profile-title" class="text-2xl font-bold tracking-wide">Profile</h2>
            </div>

            <div class="mx-auto grid min-h-[calc(100vh-92px)] w-full max-w-6xl items-center gap-10 px-6 py-12 sm:grid-cols-[220px_1fr] sm:px-12 lg:gap-16 lg:px-20">
                <div class="flex justify-center">
                    <img src="{{ asset('assets/images/faces/1.jpg') }}" alt="Foto profil {{ Auth::user()->name }}" class="h-40 w-40 rounded-full object-cover ring-8 ring-[#e7edf4] sm:h-48 sm:w-48" style="width: 10rem; height: 10rem; max-width: 10rem; object-fit: cover;">
                </div>
                <div class="space-y-3">
        <div class="grid grid-cols-[105px_1fr] items-center gap-3 sm:grid-cols-[115px_1fr]">
            <span class="text-base font-bold text-[#8d8d8d] sm:text-lg">Location</span>
                        <div class="truncate rounded-xl bg-white px-5 py-3 text-sm font-bold text-[#ad292d] shadow-[0_4px_12px_rgba(0,0,0,0.12)]">{{ Auth::user()->location ?? '-' }}</div>
        </div>
        <div class="grid grid-cols-[105px_1fr] items-center gap-3 sm:grid-cols-[115px_1fr]">
            <span class="text-base font-bold text-[#8d8d8d] sm:text-lg">Username</span>
                        <div class="truncate rounded-xl bg-white px-5 py-3 text-sm font-bold text-[#ad292d] shadow-[0_4px_12px_rgba(0,0,0,0.12)]">{{ Auth::user()->name }}</div>
        </div>
        <div class="grid grid-cols-[105px_1fr] items-center gap-3 sm:grid-cols-[115px_1fr]">
            <span class="text-base font-bold text-[#8d8d8d] sm:text-lg">Password</span>
                        <div class="rounded-xl bg-white px-5 py-3 text-sm font-bold tracking-widest text-[#ad292d] shadow-[0_4px_12px_rgba(0,0,0,0.12)]">••••••••</div>
        </div>
        <div class="grid grid-cols-[105px_1fr] items-center gap-3 sm:grid-cols-[115px_1fr]">
            <span class="text-base font-bold text-[#8d8d8d] sm:text-lg">Gmail</span>
                        <div class="truncate rounded-xl bg-white px-5 py-3 text-sm font-bold text-[#ad292d] shadow-[0_4px_12px_rgba(0,0,0,0.12)]">{{ Auth::user()->email }}</div>
        </div>

                        <button type="button" @click="openProfile = false; openLogoutConfirm = true" class="mt-5 flex w-full items-center justify-center gap-3 rounded-xl bg-[#f8dfe0] py-3.5 text-sm font-bold text-[#ad292d] shadow-[0_4px_12px_rgba(0,0,0,0.12)] hover:bg-[#f2c9ca]">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
            Logout
        </button>
                </div>
            </div>
        </div>
    </div>

    <div x-cloak x-show="openLogoutConfirm" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4" role="dialog" aria-modal="true" aria-labelledby="logout-title">
        <div @click.outside="openLogoutConfirm = false" class="w-full max-w-sm rounded-3xl bg-white p-8 text-center shadow-xl">
            <div class="mb-3 flex justify-center">
                <span class="flex h-14 w-14 items-center justify-center rounded-full bg-red-100 text-red-700">
                    <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                </span>
            </div>
            <h2 id="logout-title" class="mb-1 text-xl font-bold text-red-800">Logout</h2>
            <p class="mb-5 text-gray-500">Yakin ingin keluar?</p>
            <div class="flex gap-3">
                <button type="button" @click="openLogoutConfirm = false" class="flex-1 rounded-full border border-red-800 py-2 font-semibold text-red-800 hover:bg-red-50">Batal</button>
                <form method="POST" action="{{ route('logout') }}" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full rounded-full bg-red-800 py-2 font-semibold text-white hover:bg-red-900">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>