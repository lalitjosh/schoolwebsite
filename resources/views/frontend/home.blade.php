
@section('title', ($setting->school_name ?? 'Cambridge Public School') . ' Amargadhi-5, Dadeldhura | PG to Grade 12')

@section('content')
@php
    $hero = $heroSlides->first();
    $homeHero = $content->get('home.hero');
    $homeAbout = $content->get('home.about');
    $homeFeatures = $content->get('home.features');
    $homeStats = $content->get('home.stats');
    $homeCta = $content->get('home.cta');
    $principalMessage = $content->get('principal.message');
    $heroImage = $hero?->image ? asset('storage/' . $hero->image) : 'https://www.sushmasecondary.edu.np/assets/image/sushma.jpg';
    $principalImage = $principalMessage?->image ? asset('storage/' . $principalMessage->image) : ($principal?->photo ? asset('storage/' . $principal->photo) : 'https://www.sushmasecondary.edu.np/assets/image/bodh_raj.png');
    $programs = [
        ['title' => $content->get('academics.elementary')?->eyebrow ?? 'Kids School', 'level' => $content->get('academics.elementary')?->subtitle ?? 'Nursery - Grade 3', 'url' => route('academics.elementary'), 'text' => $content->get('academics.elementary')?->body ?? 'Playful learning, early literacy, numeracy, creativity, discipline, and social confidence.'],
        ['title' => $content->get('academics.primary')?->eyebrow ?? 'Middle School', 'level' => $content->get('academics.primary')?->subtitle ?? 'Grade 4 - 8', 'url' => route('academics.primary'), 'text' => $content->get('academics.primary')?->body ?? 'Strong fundamentals, projects, reading habits, STEM exposure, clubs, and guided growth.'],
        ['title' => $content->get('academics.secondary')?->eyebrow ?? 'High School', 'level' => $content->get('academics.secondary')?->subtitle ?? 'Grade 9 - 12', 'url' => route('academics.secondary'), 'text' => $content->get('academics.secondary')?->body ?? 'Exam readiness, labs, leadership, career counseling, and higher-study preparation.'],
    ];
    $stats = ($homeStats?->items && count($homeStats->items) > 0) ? collect($homeStats->items)->map(function ($item) {
        [$number, $label] = array_pad(explode('|', $item, 2), 2, '');
        $label = trim($label);
        $number = match (strtolower($label)) {
            'students' => '1000+',
            'years' => '17+',
            default => trim($number),
        };

        return [$number, $label];
    })->all() : [['1000+', 'Students'], ['50+', 'Teachers'], ['17+', 'Years'], ['40+', 'Activities']];
    $features = ($homeFeatures?->items && count($homeFeatures->items) > 0) ? collect($homeFeatures->items)->map(function ($item) {
        [$title, $text] = array_pad(explode('|', $item, 2), 2, '');
        return [trim($title), trim($text)];
    })->all() : [
        ['Modern Learning', 'Smart teaching methods, practical activities, and student-centered classrooms.'],
        ['Expert Faculty', 'Experienced teachers who guide every child with care and academic clarity.'],
        ['Career Counseling', 'Structured guidance for stream selection, higher education, and future goals.'],
        ['Safe Environment', 'Disciplined, caring, and secure campus culture for confident learning.'],
    ];
    $typewriterPhrases = $homeHero?->items ?: ['Minds Flourish', 'Leaders Emerge', 'Futures Begin', 'Dreams Take Root'];
@endphp

@if (($notices ?? collect())->isNotEmpty())
    <div id="notice-popup" class="fixed inset-0 z-[90] hidden items-center justify-center bg-[#111827]/65 px-4 opacity-0 backdrop-blur-sm transition-opacity duration-300" role="dialog" aria-modal="true">
        <div id="notice-popup-panel" class="max-h-[92vh] w-full max-w-lg translate-y-8 scale-95 overflow-hidden rounded-xl bg-white opacity-0 shadow-2xl transition duration-300">
            <div class="bg-[#a0183d] px-4 py-3 text-white">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-[#f5b82e]">Important Notice</p>
                        <h2 class="font-display mt-1 text-xl font-black">Cambridge Public School</h2>
                    </div>
                    <button type="button" data-notice-close class="grid h-8 w-8 place-items-center rounded-full bg-white/12 text-xl leading-none hover:bg-white/20" aria-label="Close notice">&times;</button>
                </div>
            </div>
            <div class="max-h-[calc(92vh-76px)] overflow-y-auto p-4">
                <div class="overflow-hidden border-l-4 border-[#f5b82e] bg-[#fbfaf7]">
                    <div id="notice-track" class="flex transition-transform duration-500 ease-out">
                        @foreach ($notices as $notice)
                            <article class="notice-slide w-full shrink-0 p-3.5">
                                @if ($notice->image)
                                    <div class="mb-3 flex items-center justify-center overflow-hidden rounded-lg border border-black/5 bg-white p-3" style="height: 230px;">
                                        <img src="{{ asset('storage/' . $notice->image) }}" alt="{{ $notice->title }}" style="display: block; max-height: 100%; max-width: 100%; width: auto; height: auto; object-fit: contain;">
                                    </div>
                                @endif
                                <div class="clear-both rounded-lg bg-white p-3 ring-1 ring-black/5">
                                    <p class="text-[10px] font-black uppercase tracking-[0.16em] text-[#a0183d]">{{ optional($notice->publish_date)->format('M d, Y') ?? 'School Notice' }}</p>
                                    <h3 class="mt-2 text-lg font-black text-[#111827]">{{ $notice->title }}</h3>
                                    <p class="mt-2 text-sm leading-6 text-[#4b5563]">{{ \Illuminate\Support\Str::limit($notice->content, 130) }}</p>
                                    <a href="{{ route('news') }}#notice-board" class="mt-3 inline-flex rounded-lg bg-[#a0183d] px-3 py-1.5 text-xs font-bold text-white">View Notice</a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
                <div class="mt-4 flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
                    <div id="notice-dots" class="flex gap-2" aria-hidden="true"></div>
                    <div class="flex gap-2">
                        <button type="button" data-notice-prev class="rounded-lg border border-black/15 px-3 py-1.5 text-xs font-bold text-[#111827]">Previous</button>
                        <button type="button" data-notice-next class="rounded-lg bg-[#a0183d] px-3 py-1.5 text-xs font-bold text-white">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<main>
    <section class="relative overflow-hidden bg-[#111827] text-white">
        <div id="edu-symbols-layer" class="absolute inset-0 z-10 overflow-hidden"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-[#111827] via-[#64152d] to-[#09090f]"></div>
        <div class="hero-grid absolute inset-0 opacity-45"></div>

        <div class="relative z-20 mx-auto grid min-h-[calc(100vh-112px)] max-w-7xl items-center gap-12 px-4 py-16 sm:px-6 lg:grid-cols-[0.95fr_1.05fr] lg:px-8">
            <div class="reveal-left max-w-3xl">
                <p class="mb-5 inline-flex rounded-full border border-[#f5b82e]/35 bg-[#f5b82e]/15 px-4 py-2 text-xs font-bold uppercase tracking-[0.24em] text-[#f5b82e]">
                    {{ $homeHero?->eyebrow ?? 'Est. ' . ($setting->established_year ?? '2062 BS') . ' - Admissions Open' }}
                </p>
                <h1 class="font-display text-5xl font-black leading-[1.03] sm:text-6xl lg:text-7xl">
                    {{ $homeHero?->title ?? $hero?->title ?? 'Where Young' }} <span class="text-[#f5b82e]" id="hero-typewriter" data-phrases='@json($typewriterPhrases)'>{{ $typewriterPhrases[0] ?? 'Minds Flourish' }}</span>
                </h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-pink-50/85">
                    {{ $homeHero?->subtitle ?? $hero?->subtitle ?? 'Cambridge Public School Amargadhi-5, Dadeldhura nurtures learners from PG to Grade 12 with strong academics, modern teaching, discipline, creativity, and values.' }}
                </p>
                <div class="mt-9 flex flex-col gap-4 sm:flex-row">
                    <a href="{{ $homeHero?->button_url ?: route('admission') }}" class="inline-flex items-center justify-center rounded-2xl bg-[#f5b82e] px-9 py-4 font-bold text-[#111827] shadow-xl transition hover:scale-105 hover:bg-[#fbbf24]">{{ $homeHero?->button_label ?? 'Apply Now' }}</a>
                    <a href="{{ route('about') }}" class="inline-flex items-center justify-center rounded-2xl border-2 border-white/30 px-9 py-4 font-bold text-white transition hover:bg-white/10">Explore School</a>
                </div>
            </div>
            <div class="reveal-right">
                <div class="relative mx-auto max-w-[620px] pt-10 lg:pt-0">
                    <div class="absolute -right-4 -top-1 hidden h-[310px] w-[310px] rounded-full border-2 border-dashed border-[#f5b82e]/25 lg:block"></div>
                    <div class="absolute -left-4 top-0 z-20 rounded-2xl bg-white px-5 py-4 text-[#111827] shadow-2xl sm:left-0 lg:-left-7 lg:top-5">
                        <div class="flex items-center gap-3">
                            <span class="grid h-10 w-10 place-items-center rounded-full bg-[#a0183d]/10 text-[#a0183d]">
                                <span class="text-lg font-black">&#10003;</span>
                            </span>
                            <span>
                                <span class="block text-2xl font-black leading-none text-[#111827]">98%</span>
                                <span class="mt-1 block text-xs font-bold text-slate-500">Pass Rate</span>
                            </span>
                        </div>
                    </div>
                    <div class="relative overflow-hidden rounded-[1.75rem] border border-white/15 bg-white/10 p-3 shadow-2xl backdrop-blur">
                        <img src="{{ $heroImage }}" alt="Cambridge Public School campus and students" class="aspect-[4/3] w-full rounded-[1.35rem] object-cover">
                    </div>
                    <div class="absolute bottom-5 right-4 z-20 rounded-2xl border border-white/15 bg-[#111827]/90 px-5 py-4 text-white shadow-2xl backdrop-blur">
                        <p class="text-sm font-black leading-none">Top</p>
                        <p class="mt-1 text-xs font-bold text-[#f5b82e]">Academics</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="-mt-9 bg-[#fbfaf7] pb-20">
        <div class="relative z-30 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid overflow-hidden rounded-3xl bg-white shadow-xl ring-1 ring-black/5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($stats as [$number, $label])
                    <div class="border-b border-black/5 p-7 sm:border-r lg:border-b-0">
                        <p class="font-display text-4xl font-black text-[#a0183d]">{{ $number }}</p>
                        <p class="mt-2 text-xs font-black uppercase tracking-[0.18em] text-[#667085]">{{ $label }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-white py-20">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-[0.85fr_1.15fr] lg:px-8">
            <div class="reveal">
                <p class="text-xs font-black uppercase tracking-[0.28em] text-[#f5b82e]">{{ $homeAbout?->eyebrow ?? 'About Our School' }}</p>
                <h2 class="font-display mt-3 text-4xl font-black leading-tight text-[#111827] sm:text-5xl">{{ $homeAbout?->title ?? 'Fostering excellence, inspiring futures.' }}</h2>
                <p class="mt-5 leading-8 text-[#4b5563]">{{ $homeAbout?->body ?? 'Cambridge Public School blends academic discipline with creativity, care, communication, and practical learning so every child grows with confidence.' }}</p>
                <a href="{{ $homeAbout?->button_url ?: route('about') }}" class="mt-7 inline-flex rounded-2xl bg-[#a0183d] px-6 py-3 font-bold text-white transition hover:bg-pink-700">{{ $homeAbout?->button_label ?? 'Learn More' }}</a>
            </div>
            <div class="grid gap-5 md:grid-cols-2">
                @foreach ($features as [$title, $text])
                    <article class="reveal rounded-2xl border border-gray-100 bg-[#fbfaf7] p-6 transition hover:border-[#a0183d]/30 hover:shadow-xl">
                        <div class="mb-5 grid h-12 w-12 place-items-center rounded-xl bg-[#a0183d]/8 text-[#a0183d]">
                            <span class="font-black">✓</span>
                        </div>
                        <h3 class="text-lg font-bold text-[#111827]">{{ $title }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-[#667085]">{{ $text }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-[#f7f2f4] py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="reveal max-w-2xl">
                <p class="text-xs font-black uppercase tracking-[0.28em] text-[#a0183d]">Academics</p>
                <h2 class="font-display mt-3 text-4xl font-black text-[#111827]">Programs for every stage of growth.</h2>
            </div>
            <div class="mt-10 grid gap-6 md:grid-cols-3">
                @foreach ($programs as $program)
                    <article class="reveal group rounded-3xl bg-white p-7 shadow-sm ring-1 ring-black/5 transition hover:-translate-y-1 hover:shadow-xl">
                        <p class="text-xs font-black uppercase tracking-[0.2em] text-[#f5b82e]">{{ $program['level'] }}</p>
                        <h3 class="font-display mt-5 text-3xl font-black text-[#111827]">{{ $program['title'] }}</h3>
                        <p class="mt-4 leading-7 text-[#4b5563]">{{ $program['text'] }}</p>
                        <a href="{{ $program['url'] }}" class="mt-6 inline-flex font-bold text-[#a0183d] group-hover:text-pink-700">Explore Program</a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-white py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-[2rem] bg-[#111827] shadow-2xl">
                <div class="absolute inset-0 hero-grid opacity-[0.16]"></div>
                <div class="relative grid lg:grid-cols-[minmax(300px,0.95fr)_1.35fr]">
                    <div class="relative flex min-h-[320px] items-end justify-center overflow-hidden bg-gradient-to-br from-white via-[#f6eef1] to-[#eadde3] px-8 pt-8 lg:min-h-[360px]">
                        <img src="{{ $principalImage }}" alt="{{ $principal?->name ?? 'Mr. Bodh Raj Nepal' }}" class="relative z-10 max-h-[320px] w-full max-w-[340px] object-contain object-bottom lg:max-h-[360px]">
                        <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-[#111827]/45 to-transparent"></div>
                    </div>
                    <div class="p-7 lg:p-12">
                        <p class="text-xs font-bold uppercase tracking-[0.25em] text-[#f5b82e]">{{ $principalMessage?->eyebrow ?? 'A Word From Our Leader' }}</p>
                        <h2 class="font-display mt-3 text-3xl font-bold text-white">{{ $principalMessage?->title ?? 'Message From the Principal' }}</h2>
                        <blockquote class="mt-6 border-l-4 border-[#f5b82e] pl-6 text-base italic leading-loose text-pink-100/85">
                            {{ $principalMessage?->body ?? 'Our School is committed to fostering essential skills and helping students achieve their goals by identifying latent talents and stimulating innovative thinking.' }}
                        </blockquote>
                        <p class="mt-7 font-bold text-white">{{ $principal?->name ?? 'Harkesh Bahdur Shanki' }}</p>
                        <p class="text-sm font-medium text-pink-200/60">{{ $principal?->designation ?? 'Principal' }}, Cambridge Public School</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#a0183d] py-20 text-white">
        <div class="mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
            <p class="text-xs font-bold uppercase tracking-[0.3em] text-[#f5b82e]">{{ $homeCta?->eyebrow ?? 'Join Our Community' }}</p>
            <h2 class="font-display mt-4 text-4xl font-bold leading-tight sm:text-5xl">{{ $homeCta?->title ?? 'Give Your Child the Gift of Quality Education' }}</h2>
            <p class="mx-auto mt-5 max-w-2xl leading-8 text-pink-100/80">{{ $homeCta?->subtitle ?? 'Admissions are now open for this academic year. Limited seats available, secure your child\'s future today.' }}</p>
            <div class="mt-8 flex flex-col justify-center gap-4 sm:flex-row">
                <a href="{{ $homeCta?->button_url ?: route('admission') }}" class="rounded-2xl bg-[#f5b82e] px-9 py-4 font-bold text-[#111827] transition hover:bg-[#fbbf24]">{{ $homeCta?->button_label ?? 'Apply Now' }}</a>
                <a href="{{ route('contact') }}" class="rounded-2xl border-2 border-white/30 px-9 py-4 font-bold text-white transition hover:bg-white/10">Contact Us</a>
            </div>
        </div>
    </section>
</main>
@endsection
@extends('layouts.frontend')
