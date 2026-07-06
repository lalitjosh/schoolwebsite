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
                <div class="flex shrink-0 items-center gap-2 bg-[#f5b82e] px-3 text-xs font-bold uppercase tracking-widest text-[#111827] sm:px-4">
                    <span class="grid h-6 w-6 place-items-center rounded-full border border-[#111827]/20 bg-white/70 font-black lowercase leading-none sm:hidden">i</span>
                    <span class="hidden sm:inline">Notice</span>
                </div>
                <div class="ticker-wrapper relative min-w-0 flex-1 overflow-hidden py-1.5">
                    <div class="absolute inset-y-0 left-0 z-10 w-8 bg-gradient-to-r from-[#a0183d] to-transparent"></div>
                    <div class="absolute inset-y-0 right-0 z-10 w-8 bg-gradient-to-l from-[#a0183d] to-transparent"></div>
                    <div class="flex whitespace-nowrap">
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
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div data-mobile-menu class="fixed inset-0 z-[200] hidden bg-[#111827]/60 backdrop-blur-sm lg:hidden">
        <div class="ml-auto flex h-full w-full max-w-sm translate-x-full flex-col overflow-y-auto bg-[#fbfaf7] shadow-2xl ring-1 ring-black/10 transition duration-300" data-mobile-panel>
            <div class="bg-[#111827] px-5 pb-6 pt-5 text-white">
                <div class="flex items-start justify-between gap-4">
                    <a href="{{ route('home') }}" class="flex min-w-0 items-center gap-3">
                        <span class="grid h-12 w-12 shrink-0 place-items-center rounded-xl bg-white p-1">
                            <img src="{{ $logo }}" alt="{{ $schoolName }} logo" class="h-full w-full object-contain">
                        </span>
                        <span class="min-w-0">
                            <span class="block truncate font-bold leading-tight">{{ $schoolName }}</span>
                            <span class="mt-1 block text-xs text-white/60">{{ $setting->tagline ?? 'Fostering Excellence, Inspiring Futures' }}</span>
                        </span>
                    </a>
                    <button type="button" data-mobile-menu-close class="grid h-10 w-10 shrink-0 place-items-center rounded-full bg-white/10 text-2xl leading-none text-white transition hover:bg-white/20" aria-label="Close menu">&times;</button>
                </div>
                <a href="{{ route('admission') }}" class="mt-5 inline-flex w-full items-center justify-center rounded-xl bg-[#f5b82e] px-4 py-3 text-sm font-black text-[#111827] shadow-lg transition hover:bg-[#fbbf24]">Enroll Now</a>
            </div>

            <div class="flex-1 px-5 py-5">
                <p class="px-2 text-[11px] font-black uppercase tracking-[0.22em] text-[#a0183d]">Menu</p>
                <div class="mt-3 grid gap-1.5">
                    @foreach ($navItems as $item)
                        @if (! in_array($item['label'], ['Admissions'], true))
                            <a href="{{ $item['url'] }}" class="flex items-center justify-between rounded-xl px-4 py-3 text-sm font-bold transition {{ $item['active'] ? 'bg-[#a0183d] text-white shadow-md' : 'bg-white text-slate-800 ring-1 ring-black/5 hover:bg-pink-50 hover:text-[#a0183d]' }}">
                                <span>{{ $item['label'] }}</span>
                                <span class="{{ $item['active'] ? 'bg-white/20 text-white' : 'bg-[#f5b82e]/30 text-[#a0183d]' }} grid h-6 w-6 place-items-center rounded-full text-xs">&rsaquo;</span>
                            </a>
                        @endif
                    @endforeach
                </div>

                <div class="mt-6 rounded-2xl bg-white p-3 shadow-sm ring-1 ring-black/5">
                    <p class="px-2 text-[11px] font-black uppercase tracking-[0.2em] text-slate-500">Academics</p>
                    <div class="mt-2 grid gap-1">
                        @foreach ($programLinks as $program)
                            <a href="{{ $program['url'] }}" class="rounded-xl px-3 py-3 transition hover:bg-[#fbfaf7]">
                                <span class="block text-sm font-bold text-[#111827]">{{ $program['label'] }}</span>
                                <span class="mt-0.5 block text-xs font-medium text-slate-500">{{ $program['meta'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="mt-5 rounded-2xl bg-[#a0183d] p-4 text-white shadow-sm">
                    <p class="text-xs font-black uppercase tracking-[0.2em] text-[#f5b82e]">Contact</p>
                    <p class="mt-2 text-sm font-semibold">{{ $setting->phone ?? '9801181818' }}</p>
                    <p class="mt-1 break-words text-xs text-white/70">{{ $setting->email ?? 'admin@cambridgeps.edu.np' }}</p>
                </div>
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
