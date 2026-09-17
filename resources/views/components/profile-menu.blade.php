<div x-data="{ openProfile: false, openLogoutConfirm: false }" class="relative">
    <button type="button" @click="openProfile = true" aria-label="Buka profil" class="icon-btn flex h-9 w-9 items-center justify-center rounded-full text-current transition hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white/60">
        <span class="flex h-9 w-9 items-center justify-center rounded-full bg-red-800 text-white">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 6.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0" />
            </svg>
        </span>
    </button>

    <template x-teleport="body">
        <div x-cloak x-show="openProfile" x-transition.opacity @keydown.escape.window="openProfile = false" class="fixed inset-0 z-[100] min-h-[100dvh] overflow-y-auto bg-[#fffaf7]" role="dialog" aria-modal="true" aria-labelledby="profile-title">
            <div class="min-h-[100dvh] w-full">
                <div class="rounded-b-[22px] bg-[#b52329] px-5 py-5 text-white sm:px-10">
                    <div class="mx-auto flex w-full max-w-5xl items-center gap-4">
                        <button type="button" @click="openProfile = false" aria-label="Kembali" class="rounded-full p-2 hover:bg-white/15 focus:outline-none focus:ring-2 focus:ring-white/70">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 5l-7 7 7 7M9 12h10" /></svg>
                        </button>
                        <h2 id="profile-title" class="text-2xl font-bold">Profile</h2>
                    </div>
                </div>

                <div class="mx-auto flex w-full max-w-5xl flex-col items-center gap-8 px-5 py-12 sm:px-10 sm:py-20 lg:flex-row lg:items-center lg:gap-20">
                    <section class="flex w-full shrink-0 justify-center lg:w-64">
                        <img src="{{ asset('assets/images/faces/1.jpg') }}" alt="Foto profil {{ Auth::user()->name }}" class="h-44 w-44 rounded-full border-8 border-[#e5eaf8] object-cover shadow-sm sm:h-48 sm:w-48">
                    </section>

                    <section class="w-full max-w-2xl">
                        <div class="space-y-3">
                            <div class="grid grid-cols-[112px_1fr] items-center gap-5">
                                <p class="text-base font-bold text-[#898989] sm:text-lg">Location</p>
                                <div class="min-w-0 rounded-2xl bg-white px-5 py-3.5 text-sm font-bold text-[#a33c40] shadow-[0_5px_14px_rgba(0,0,0,0.12)]">{{ Auth::user()->location ?? '-' }}</div>
                            </div>
                            <div class="grid grid-cols-[112px_1fr] items-center gap-5">
                                <p class="text-base font-bold text-[#898989] sm:text-lg">Username</p>
                                <div class="min-w-0 truncate rounded-2xl bg-white px-5 py-3.5 text-sm font-bold text-[#a33c40] shadow-[0_5px_14px_rgba(0,0,0,0.12)]">{{ Auth::user()->name }}</div>
                            </div>
                            <div class="grid grid-cols-[112px_1fr] items-center gap-5">
                                <p class="text-base font-bold text-[#898989] sm:text-lg">Password</p>
                                <div class="rounded-2xl bg-white px-5 py-3.5 text-sm font-bold tracking-widest text-[#a33c40] shadow-[0_5px_14px_rgba(0,0,0,0.12)]">••••••••</div>
                            </div>
                            <div class="grid grid-cols-[112px_1fr] items-center gap-5">
                                <p class="text-base font-bold text-[#898989] sm:text-lg">Gmail</p>
                                <div class="min-w-0 truncate rounded-2xl bg-white px-5 py-3.5 text-sm font-bold text-[#a33c40] shadow-[0_5px_14px_rgba(0,0,0,0.12)]">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                        <button type="button" @click.stop="openLogoutConfirm = true; openProfile = false" class="mt-4 flex w-full items-center justify-center gap-3 rounded-2xl bg-[#efc4c6] py-3.5 text-sm font-bold text-[#a33c40] shadow-[0_5px_14px_rgba(0,0,0,0.1)] transition hover:bg-[#eab3b6] focus:outline-none focus:ring-2 focus:ring-[#b52329] focus:ring-offset-2">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                            Logout
                        </button>
                    </section>
                </div>
            </div>
        </div>

    </template>

    <div x-cloak x-show="openLogoutConfirm" class="fixed inset-0 z-[110] flex min-h-[100dvh] items-center justify-center bg-black/40 px-4" role="dialog" aria-modal="true" aria-labelledby="logout-title">
            <div @click.outside="openLogoutConfirm = false" class="w-full max-w-[435px] rounded-3xl bg-white px-9 py-9 text-center shadow-xl">
            <div class="mb-4 flex justify-center">
                <span class="flex h-16 w-16 items-center justify-center rounded-full bg-[#ffe0e1] text-[#b52329]">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                </span>
            </div>
            <h2 id="logout-title" class="mb-1 text-xl font-bold text-[#a33c40]">Logout</h2>
            <p class="mb-6 text-lg text-[#929292]">Yakin ingin keluar?</p>
            <div class="flex gap-3">
                <button type="button" @click="openLogoutConfirm = false" class="flex-1 rounded-full border border-[#b98789] py-3 font-semibold text-[#a33c40] hover:bg-[#fff5f5]">Batal</button>
                <form method="POST" action="{{ route('logout') }}" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full rounded-full bg-[#b52329] py-3 font-semibold text-white hover:bg-[#991d22]">Logout</button>
                </form>
            </div>
            </div>
        </div>
</div>