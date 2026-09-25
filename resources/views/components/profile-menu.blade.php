<div x-data="{ openProfile: false, openLogoutConfirm: false }" class="relative">
    <style>
        .cravecourt-profile-content { width: min(1040px, calc(100% - 40px)); margin: 0 auto; padding-top: 88px; padding-bottom: 64px; }
        .cravecourt-profile-avatar { display: flex; width: 224px; height: 224px; align-items: center; justify-content: center; border-radius: 9999px; background: #c8c5ef; box-shadow: inset 0 0 0 8px rgba(255, 255, 255, 0.28); }
        .cravecourt-profile-layout { display: grid; grid-template-columns: 224px minmax(0, 1fr); align-items: center; column-gap: 72px; }
        .cravecourt-profile-fields { width: 100%; display: flex; flex-direction: column; gap: 20px; }
        @media (max-width: 760px) { .cravecourt-profile-content { width: calc(100% - 32px); padding-top: 48px; } .cravecourt-profile-layout { grid-template-columns: 1fr; row-gap: 40px; } .cravecourt-profile-avatar { width: 180px; height: 180px; } }
    </style>
    <button type="button" @click="openProfile = true" aria-label="Buka profil" class="icon-btn flex h-9 w-9 items-center justify-center rounded-full text-current transition hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white/60">
        <span class="flex h-9 w-9 items-center justify-center rounded-full bg-red-800 text-white">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 6.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0" />
            </svg>
        </span>
    </button>

    <div x-cloak x-show="openProfile" x-transition.opacity @keydown.escape.window="openProfile = false" class="fixed inset-0 z-[100] min-h-[100dvh] overflow-y-auto bg-[#fffaf7]" role="dialog" aria-modal="true" aria-labelledby="profile-title">
        <div class="min-h-[100dvh]">
            <header class="rounded-b-[22px] bg-[#b52329] text-white shadow-[0_12px_24px_rgba(181,35,41,0.15)]">
                <div class="mx-auto flex max-w-[1200px] items-center px-5 py-6 sm:px-5 lg:px-5">
                    <button type="button" @click="openProfile = false" aria-label="Kembali" class="mr-4 inline-flex h-10 w-10 items-center justify-center rounded-full text-white transition hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white/70">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" /></svg>
                    </button>
                    <h2 id="profile-title" class="text-3xl font-bold tracking-tight">Profile</h2>
                </div>
            </header>

            <main class="cravecourt-profile-content">
                <div>
                    <div class="cravecourt-profile-layout">
                        <div class="flex justify-start">
                            <div class="cravecourt-profile-avatar">
                                <img src="{{ asset('assets/images/faces/1.jpg') }}" alt="Foto profil {{ Auth::user()->name }}" class="h-[180px] w-[180px] rounded-full border-8 border-white/60 object-cover shadow-sm">
                            </div>
                        </div>

                        <section class="cravecourt-profile-fields">
                            <div class="grid grid-cols-[130px_minmax(0,1fr)] items-center gap-4 sm:gap-6">
                                <p class="text-lg font-bold text-[#8a8a8a]">Location</p>
                                <div class="min-h-[56px] rounded-[18px] bg-white px-5 py-4 text-base font-bold text-[#a33c40] shadow-[0_5px_14px_rgba(0,0,0,0.08)]">{{ Auth::user()->location ?? '-' }}</div>
                            </div>
                            <div class="grid grid-cols-[130px_minmax(0,1fr)] items-center gap-4 sm:gap-6">
                                <p class="text-lg font-bold text-[#8a8a8a]">Username</p>
                                <div class="min-h-[56px] truncate rounded-[18px] bg-white px-5 py-4 text-base font-bold text-[#a33c40] shadow-[0_5px_14px_rgba(0,0,0,0.08)]">{{ Auth::user()->name }}</div>
                            </div>
                            <div class="grid grid-cols-[130px_minmax(0,1fr)] items-center gap-4 sm:gap-6">
                                <p class="text-lg font-bold text-[#8a8a8a]">Password</p>
                                <div class="min-h-[56px] rounded-[18px] bg-white px-5 py-4 text-base font-bold tracking-[0.2em] text-[#a33c40] shadow-[0_5px_14px_rgba(0,0,0,0.08)]">••••••••</div>
                            </div>
                            <div class="grid grid-cols-[130px_minmax(0,1fr)] items-center gap-4 sm:gap-6">
                                <p class="text-lg font-bold text-[#8a8a8a]">Gmail</p>
                                <div class="min-h-[56px] truncate rounded-[18px] bg-white px-5 py-4 text-base font-bold text-[#a33c40] shadow-[0_5px_14px_rgba(0,0,0,0.08)]">{{ Auth::user()->email }}</div>
                            </div>
                            <button type="button" @click.stop="openLogoutConfirm = true; openProfile = false" class="mt-2 flex w-full items-center justify-center gap-3 rounded-[18px] border border-[#e7b9be] bg-[#efc8c9] px-5 py-4 text-base font-bold text-[#a33c40] shadow-[0_5px_14px_rgba(0,0,0,0.08)] transition hover:bg-[#eab3b6] focus:outline-none focus:ring-2 focus:ring-[#b52329] focus:ring-offset-2">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                Logout
                            </button>
                        </section>
                    </div>
                </div>
            </main>
    </div>
    </div>

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