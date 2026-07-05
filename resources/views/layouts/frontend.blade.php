<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', ($setting->school_name ?? 'Cambridge Public School') . ' | PG to Grade 12')</title>
    <meta name="description" content="Cambridge Public School Amargadhi-5, Dadeldhura provides quality education from PG to Grade 12 with modern teaching, strong academics, and holistic student development.">
    <link rel="canonical" href="{{ url('/') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">
    @if (! empty($setting?->favicon))
        <link rel="icon" href="{{ asset('storage/' . $setting->favicon) }}">
    @else
        <link rel="icon" href="https://www.sushmasecondary.edu.np/assets/image/sushma_logo.png">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen overflow-x-hidden bg-[#fbfaf7] text-[#111827] selection:bg-[#a0183d] selection:text-white">
    @php
        $schoolName = $setting->school_name ?? 'Cambridge Public School';
        $logo = ! empty($setting?->logo) ? asset('storage/' . $setting->logo) : 'https://www.sushmasecondary.edu.np/assets/image/sushma_logo.png';
        $navItems = [
            ['label' => 'Home', 'url' => route('home'), 'active' => request()->routeIs('home')],
            ['label' => 'About', 'url' => route('about'), 'active' => request()->routeIs('about')],
            ['label' => 'Admissions', 'url' => route('admission'), 'active' => request()->routeIs('admission')],
            ['label' => 'Notice/Event', 'url' => route('news'), 'active' => request()->routeIs('news')],
            ['label' => 'Gallery', 'url' => route('gallery'), 'active' => request()->routeIs('gallery')],
            ['label' => 'Faculty', 'url' => route('faculty'), 'active' => request()->routeIs('faculty')],
            ['label' => 'Contact', 'url' => route('contact'), 'active' => request()->routeIs('contact')],
            ['label' => 'Result', 'url' => route('result'), 'active' => request()->routeIs('result')],
        ];
        $programLinks = [
            ['label' => 'Kids School', 'meta' => 'Nursery - Grade 3', 'url' => route('academics.elementary')],
            ['label' => 'Middle School', 'meta' => 'Grade 4 - 8', 'url' => route('academics.primary')],
            ['label' => 'High School', 'meta' => 'Grade 9 - 12', 'url' => route('academics.secondary')],
        ];
    @endphp

    <header id="site-header" class="fixed inset-x-0 top-0 z-[60] flex flex-col bg-white shadow-sm transition-shadow duration-300">
        <div class="mx-auto w-full max-w-[1400px] px-4 sm:px-6 lg:px-8">
            <div class="flex h-20 items-center justify-between gap-4">
                <a href="{{ route('home') }}" class="group flex min-w-0 items-center gap-2 sm:gap-3">
                    <span class="grid h-12 w-12 shrink-0 place-items-center rounded-xl bg-[#f7f7f9] sm:h-16 sm:w-16">
                        <img src="{{ $logo }}" alt="{{ $schoolName }} logo" class="h-10 w-10 object-contain transition duration-300 group-hover:scale-110 sm:h-[60px] sm:w-[60px]">
                    </span>
                    <span class="min-w-0">
                        <span class="block truncate text-[15px] font-bold leading-tight text-slate-900 sm:text-lg">{{ $schoolName }}</span>
                        <span class="hidden text-[11px] font-medium text-slate-500 sm:block">{{ $setting->tagline ?? 'Fostering Excellence, Inspiring Futures' }}</span>
                    </span>
                </a>

                <nav class="hidden items-center gap-6 lg:flex">
                    @foreach ($navItems as $item)
                        @if ($loop->index === 2)
                            <div class="group relative" data-academics-menu>
                                <button class="flex items-center gap-1 text-[14px] font-medium text-slate-700 transition hover:font-bold hover:text-pink-700 hover:underline" type="button" data-academics-toggle aria-expanded="false" aria-haspopup="true">
                                    Academics
                                    <svg class="h-4 w-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/></svg>
                                </button>
                                <div class="absolute left-0 z-[100] mt-2 hidden w-56 rounded-xl border border-gray-100 bg-white p-2 shadow-xl group-hover:block" data-academics-dropdown>
                                    @foreach ($programLinks as $program)
                                        <a href="{{ $program['url'] }}" class="block rounded-lg px-4 py-3 transition hover:bg-pink-50">
                                            <span class="block text-sm font-medium text-slate-900 hover:text-pink-700">{{ $program['label'] }}</span>
                                            <span class="mt-0.5 block text-xs text-slate-500">{{ $program['meta'] }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <a href="{{ $item['url'] }}" class="text-[14px] transition {{ $item['active'] ? 'font-bold text-[#a0183d] underline' : 'font-medium text-slate-700 hover:font-bold hover:text-pink-700 hover:underline' }}">{{ $item['label'] }}</a>
                    @endforeach
                    <a href="{{ route('admission') }}" class="ml-2 rounded-full bg-[#a0183d] px-5 py-2.5 text-[14px] font-medium text-white shadow-sm transition hover:bg-pink-700">Enroll Now</a>
                </nav>

                <button type="button" data-mobile-menu-open class="rounded-lg p-2 text-slate-600 transition hover:bg-gray-100 lg:hidden" aria-label="Open menu">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>

        <div class="border-t border-gray-100 bg-[#a0183d]">
            <div class="mx-auto flex w-full max-w-[1400px] items-stretch">
                <div class="flex shrink-0 items-center gap-2 bg-[#f5b82e] px-4 text-xs font-bold uppercase tracking-widest text-[#111827]">
                    <span class="hidden sm:inline">Notice</span>
                </div>
                <div class="ticker-wrapper relative min-w-0 flex-1 overflow-hidden py-1.5">
                    <div class="absolute inset-y-0 left-0 z-10 w-8 bg-gradient-to-r from-[#a0183d] to-transparent"></div>
                    <div class="absolute inset-y-0 right-0 z-10 w-8 bg-gradient-to-l from-[#a0183d] to-transparent"></div>
                    <div class="flex whitespace-nowrap">
                        @for ($copy = 0; $copy < 2; $copy++)
                            <div class="animate-ticker flex items-center">
                                @forelse (($latestNotices ?? collect()) as $notice)
                                    <a href="{{ route('news') }}" class="group inline-flex items-center gap-3 px-6">
                                        <span class="h-1.5 w-1.5 rounded-full bg-[#f5b82e] opacity-70"></span>
                                        <span class="text-xs font-medium text-white transition group-hover:text-[#f5b82e]">{{ $notice->title }}</span>
                                        <span class="rounded-full bg-white/10 px-2 py-0.5 text-[10px] font-semibold text-white/70">{{ optional($notice->publish_date)->diffForHumans() ?? 'Latest' }}</span>
                                    </a>
                                @empty
                                    @foreach (['Admissions Open for 2083!', 'Quality education from PG to Grade 12', 'Modern learning with values and discipline'] as $notice)
                                        <a href="{{ route('admission') }}" class="group inline-flex items-center gap-3 px-6">
                                            <span class="h-1.5 w-1.5 rounded-full bg-[#f5b82e] opacity-70"></span>
                                            <span class="text-xs font-medium text-white transition group-hover:text-[#f5b82e]">{{ $notice }}</span>
                                            <span class="rounded-full bg-white/10 px-2 py-0.5 text-[10px] font-semibold text-white/70">Latest</span>
                                        </a>
                                    @endforeach
                                @endforelse
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div data-mobile-menu class="fixed inset-0 z-[80] hidden bg-black/50 lg:hidden">
        <div class="ml-auto flex h-full w-full max-w-sm translate-x-full flex-col bg-white p-5 shadow-2xl transition duration-300" data-mobile-panel>
            <div class="flex items-center justify-between">
                <span class="font-bold text-[#111827]">{{ $schoolName }}</span>
                <button type="button" data-mobile-menu-close class="rounded-lg p-2 text-slate-600 hover:bg-gray-100" aria-label="Close menu">&times;</button>
            </div>
            <div class="mt-6 grid gap-2">
                <a href="{{ route('home') }}" class="rounded-lg px-3 py-2 font-semibold text-slate-800 hover:bg-pink-50">Home</a>
                <a href="{{ route('about') }}" class="rounded-lg px-3 py-2 font-semibold text-slate-800 hover:bg-pink-50">About</a>
                @foreach ($programLinks as $program)
                    <a href="{{ $program['url'] }}" class="rounded-lg px-3 py-2 font-semibold text-slate-800 hover:bg-pink-50">{{ $program['label'] }} <span class="block text-xs font-normal text-slate-500">{{ $program['meta'] }}</span></a>
                @endforeach
                <a href="{{ route('admission') }}" class="rounded-lg px-3 py-2 font-semibold text-slate-800 hover:bg-pink-50">Admissions</a>
                <a href="{{ route('news') }}" class="rounded-lg px-3 py-2 font-semibold text-slate-800 hover:bg-pink-50">Notice/Event</a>
                <a href="{{ route('gallery') }}" class="rounded-lg px-3 py-2 font-semibold text-slate-800 hover:bg-pink-50">Gallery</a>
                <a href="{{ route('faculty') }}" class="rounded-lg px-3 py-2 font-semibold text-slate-800 hover:bg-pink-50">Faculty</a>
                <a href="{{ route('contact') }}" class="rounded-lg px-3 py-2 font-semibold text-slate-800 hover:bg-pink-50">Contact</a>
                <a href="{{ route('result') }}" class="rounded-lg px-3 py-2 font-semibold text-slate-800 hover:bg-pink-50">Result</a>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="fixed inset-x-0 top-[112px] z-[70] bg-[#a0183d] px-4 py-3 text-center text-sm font-semibold text-white">
            {{ session('success') }}
        </div>
    @endif

    <div class="pt-[112px]">
        @yield('content')
    </div>

    <footer class="border-t-4 border-[#f5b82e] bg-[#111827] text-gray-300">
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                <div>
                    <div class="mb-4 flex items-center gap-3">
                        <span class="grid h-12 w-12 place-items-center rounded-lg border border-gray-700 bg-white p-1"><img src="{{ $logo }}" alt="{{ $schoolName }} logo" class="h-full w-full object-contain"></span>
                        <span class="font-bold leading-tight text-white">Cambridge Public<br>School</span>
                    </div>
                    <p class="text-sm leading-relaxed text-slate-300">{{ $setting->footer_about ?? 'Established in 2062 BS, empowering young minds from Nursery to Grade 12 with quality education, values, and holistic excellence.' }}</p>
                </div>
                <div>
                    <h3 class="mb-5 text-lg font-bold text-white">Quick Links</h3>
                    <ul class="space-y-3 text-sm">
                        @foreach (array_slice($navItems, 0, 6) as $item)
                            <li><a href="{{ $item['url'] }}" class="text-slate-300 transition hover:text-[#f5b82e] hover:underline">{{ $item['label'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h3 class="mb-5 text-lg font-bold text-white">Our Programs</h3>
                    <ul class="space-y-3 text-sm">
                        @foreach ($programLinks as $program)
                            <li><a href="{{ $program['url'] }}" class="text-slate-300 transition hover:text-[#f5b82e] hover:underline">{{ $program['label'] }} ({{ $program['meta'] }})</a></li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h3 class="mb-5 text-lg font-bold text-white">Contact Us</h3>
                    <ul class="space-y-4 text-sm text-slate-300">
                        <li>{{ $setting->address ?? 'Amargadhi-5, Dadeldhura, Sudurpashchim Province, Nepal' }}</li>
                        <li><a href="tel:{{ $setting->phone ?? '9801181818' }}" class="hover:text-[#f5b82e]">{{ $setting->phone ?? '9801181818' }}</a></li>
                        <li><a href="mailto:{{ $setting->email ?? 'admin@cambridgeps.edu.np' }}" class="hover:text-[#f5b82e]">{{ $setting->email ?? 'admin@cambridgeps.edu.np' }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-12 flex flex-col items-center justify-between gap-3 border-t border-[#a0183d] pt-8 text-sm text-slate-500 md:flex-row">
                <p>&copy; {{ date('Y') }} {{ $schoolName }}. All rights reserved.</p>
                <p>Designed & Developed by <span class="text-[#f5b82e]">{{ $setting->footer_credit ?? 'Er.Lalit Prasad Joshi' }}</span></p>
            </div>
        </div>
    </footer>
</body>
</html>
