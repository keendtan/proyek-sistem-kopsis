@extends('layouts.app')

@section('main')
    <div class="page-heading">
        <h3>Profile</h3>
    </div>

    <div class="page-content">
        <div class="mx-auto max-w-3xl">
            <div class="rounded-3xl bg-[#fdf6f0] p-6 shadow-xl sm:p-8">
                <div class="mb-8 flex flex-col items-center gap-5 sm:flex-row">
                    <span class="flex h-28 w-28 shrink-0 items-center justify-center rounded-full bg-red-800 text-4xl font-bold text-white">
                        {{ Auth::user()->initials() }}
                    </span>
                    <div class="text-center sm:text-left">
                        <h1 class="text-2xl font-bold text-red-900">{{ Auth::user()->name }}</h1>
                        <p class="mt-1 text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <p class="mb-1 text-xs text-gray-500">Location</p>
                        <div class="rounded-full border border-red-100 bg-white px-4 py-3 font-semibold text-red-800">{{ Auth::user()->location ?? '-' }}</div>
                    </div>
                    <div>
                        <p class="mb-1 text-xs text-gray-500">Username</p>
                        <div class="rounded-full border border-red-100 bg-white px-4 py-3 font-semibold text-red-800">{{ Auth::user()->name }}</div>
                    </div>
                    <div>
                        <p class="mb-1 text-xs text-gray-500">Password</p>
                        <div class="rounded-full border border-red-100 bg-white px-4 py-3 font-semibold tracking-widest text-red-800">••••••••</div>
                    </div>
                    <div>
                        <p class="mb-1 text-xs text-gray-500">Gmail</p>
                        <div class="truncate rounded-full border border-red-100 bg-white px-4 py-3 font-semibold text-red-800">{{ Auth::user()->email }}</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection