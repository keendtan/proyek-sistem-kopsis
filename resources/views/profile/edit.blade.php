<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background: #f4f3f1;
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }
    </style>
</head>
<body class="min-h-screen bg-[#f4f2f2] text-[#3d3d3d] antialiased">
    <div class="mx-auto max-w-[1200px] px-4 py-6 sm:px-6 lg:px-10">
        <header class="flex items-center rounded-b-[22px] bg-[#b52329] px-5 py-5 text-white shadow-[0_12px_24px_rgba(181,35,41,0.15)] sm:px-8 lg:px-10">
            <a href="{{ route('home') }}" aria-label="Kembali" class="mr-4 inline-flex h-10 w-10 items-center justify-center rounded-full text-white transition hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white/70">
                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-3xl font-bold tracking-tight sm:text-4xl">Profile</h1>
        </header>

        <main class="mx-auto max-w-5xl px-2 py-12 sm:py-14 lg:px-8">
            <div class="mx-auto max-w-4xl rounded-[28px] bg-[#f7f2f2] p-6 sm:p-8 lg:p-10">
                <div class="grid items-center gap-8 lg:grid-cols-[220px_minmax(0,1fr)]">
                    <div class="flex justify-center lg:justify-start">
                        <div class="flex h-56 w-56 items-center justify-center rounded-full bg-[#c8c5ef] shadow-[inset_0_0_0_8px_rgba(255,255,255,0.28)]">
                            <img src="{{ asset('assets/images/faces/1.jpg') }}" alt="Foto profil {{ Auth::user()->name }}" class="h-44 w-44 rounded-full border-8 border-white/60 object-cover shadow-sm">
                        </div>
                    </div>

                    <div class="w-full space-y-5">
                        <div class="grid grid-cols-[130px_minmax(0,1fr)] items-center gap-4 sm:gap-6">
                            <p class="text-lg font-bold text-[#8a8a8a]">Location</p>
                            <div class="min-h-[56px] rounded-[18px] bg-white px-5 py-4 text-base font-bold text-[#a33c40] shadow-[0_5px_14px_rgba(0,0,0,0.08)]">
                                {{ Auth::user()->location ?? '-' }}
                            </div>
                        </div>

                        <div class="grid grid-cols-[130px_minmax(0,1fr)] items-center gap-4 sm:gap-6">
                            <p class="text-lg font-bold text-[#8a8a8a]">Username</p>
                            <div class="min-h-[56px] truncate rounded-[18px] bg-white px-5 py-4 text-base font-bold text-[#a33c40] shadow-[0_5px_14px_rgba(0,0,0,0.08)]">
                                {{ Auth::user()->name }}
                            </div>
                        </div>

                        <div class="grid grid-cols-[130px_minmax(0,1fr)] items-center gap-4 sm:gap-6">
                            <p class="text-lg font-bold text-[#8a8a8a]">Password</p>
                            <div class="min-h-[56px] rounded-[18px] bg-white px-5 py-4 text-base font-bold tracking-[0.2em] text-[#a33c40] shadow-[0_5px_14px_rgba(0,0,0,0.08)]">
                                ••••••••
                            </div>
                        </div>

                        <div class="grid grid-cols-[130px_minmax(0,1fr)] items-center gap-4 sm:gap-6">
                            <p class="text-lg font-bold text-[#8a8a8a]">Gmail</p>
                            <div class="min-h-[56px] truncate rounded-[18px] bg-white px-5 py-4 text-base font-bold text-[#a33c40] shadow-[0_5px_14px_rgba(0,0,0,0.08)]">
                                {{ Auth::user()->email }}
                            </div>
                        </div>

                        <form method="POST" action="{{ route('logout') }}" class="pt-2">
                            @csrf
                            <button type="submit" class="mt-2 flex w-full items-center justify-center gap-3 rounded-[18px] border border-[#e7b9be] bg-[#efc8c9] px-5 py-4 text-lg font-bold text-[#a33c40] shadow-[0_5px_14px_rgba(0,0,0,0.08)] transition hover:bg-[#eab3b6] focus:outline-none focus:ring-2 focus:ring-[#b52329] focus:ring-offset-2">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
