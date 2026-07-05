
@extends('layouts.frontend')

@section('title', 'About | ' . ($setting->school_name ?? 'Cambridge Public School'))

@section('content')
@php
    $aboutHero = $content->get('about.hero');
    $principalMessage = $content->get('principal.message');
    $aboutItems = ($aboutHero?->items && count($aboutHero->items) > 0) ? collect($aboutHero->items)->map(function ($item) {
        [$title, $text] = array_pad(explode('|', $item, 2), 2, '');
        return [trim($title), trim($text)];
    })->all() : [
        ['Our Mission', 'To provide quality education that supports intellectual, emotional, social, and physical development.'],
        ['Our Vision', 'To be a trusted institution recognized for academic excellence and holistic growth.'],
        ['Our Values', 'Integrity, excellence, inclusivity, innovation, and compassion guide our school culture.'],
    ];
    $aboutPhotoFallbacks = [
        'https://www.sushmasecondary.edu.np/assets/image/sushma_poster.png',
        'https://www.sushmasecondary.edu.np/assets/image/sushma_front.jpg',
        'https://www.sushmasecondary.edu.np/assets/image/sushma_robotics.jpg',
        'https://www.sushmasecondary.edu.np/assets/image/sushma_baby.jpg',
    ];
    $aboutPhotos = collect(range(1, 4))->map(function ($number) use ($content, $aboutPhotoFallbacks) {
        $section = $content->get('about.photo.' . $number);
        $image = $section?->image;

        if ($image && ! \Illuminate\Support\Str::startsWith($image, ['http://', 'https://'])) {
            $image = asset('storage/' . $image);
        }

        return [
            'src' => $image ?: $aboutPhotoFallbacks[$number - 1],
            'alt' => $section?->title ?: 'School campus photo',
        ];
    });
    $principal = $faculties->first(fn ($faculty) => str_contains(strtolower($faculty->designation ?? ''), 'principal')) ?? $faculties->first();
@endphp

<main>
    <section class="relative overflow-hidden bg-[#a0183d] py-24 text-white">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 30px 30px;"></div>
        <div class="absolute right-0 top-0 h-96 w-96 -translate-y-1/2 translate-x-1/2 rounded-full bg-[#f5b82e]/20 blur-3xl"></div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <nav class="mb-8 flex items-center gap-2 text-sm font-medium text-pink-100/70">
                <a href="{{ route('home') }}" class="hover:text-[#f5b82e]">Home</a>
                <span>/</span>
                <span class="text-white">About Us</span>
            </nav>
            <h1 class="font-display max-w-4xl text-4xl font-black leading-tight sm:text-6xl">{{ $aboutHero?->title ?? 'About Our School' }}</h1>
            <p class="mt-6 max-w-3xl text-lg leading-8 text-pink-100/90">{{ $aboutHero?->subtitle ?? 'Over a decade of shaping young minds in Amargadhi-5, Dadeldhura through holistic education and unwavering dedication.' }}</p>
        </div>
    </section>

    <section class="relative bg-white py-20">
        <div class="relative z-10 mx-auto -mt-10 grid max-w-7xl gap-8 px-4 sm:px-6 md:grid-cols-3 lg:px-8">
            @foreach ($aboutItems as [$title, $text])
                <article class="reveal rounded-3xl border border-gray-100 bg-white p-8 text-center shadow-sm transition duration-300 hover:-translate-y-1 hover:border-[#a0183d]/50 hover:shadow-xl">
                    <div class="mx-auto mb-5 grid h-14 w-14 place-items-center rounded-2xl bg-[#a0183d]/10 font-black text-[#a0183d]">{{ $loop->iteration }}</div>
                    <h2 class="text-2xl font-black text-[#111827] transition group-hover:text-[#a0183d]">{{ $title }}</h2>
                    <p class="mt-4 leading-7 text-slate-600">{{ $text }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section class="bg-[#fbfaf7] py-20">
        <div class="mx-auto grid max-w-7xl items-center gap-16 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
            <div class="reveal-left">
                <p class="mb-3 text-sm font-bold uppercase tracking-widest text-[#f5b82e]">Our Story</p>
                <h2 class="font-display text-4xl font-black leading-tight text-[#111827]">Established in {{ $setting->established_year ?? '2062 B.S.' }}<br><span class="text-[#a0183d]">Growing Every Year</span></h2>
                <div class="mt-6 space-y-5 text-lg leading-8 text-slate-600">
                    <p>{{ $setting->school_name ?? 'Cambridge Public School' }} was established in Amargadhi-5, Dadeldhura, with a clear vision: to provide quality education accessible to every child in the region.</p>
                    <p>Our journey is defined by academic excellence, innovative teaching, and holistic development. Education here is about character, curiosity, capability, and confidence.</p>
                    <p>Today, the school continues to grow with dedicated teachers, active students, modern facilities, and a culture that values discipline and care.</p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-5">
                @foreach ($aboutPhotos as $photo)
                    <div class="reveal overflow-hidden rounded-2xl shadow-lg {{ $loop->even ? 'mt-8' : '' }}">
                        <img src="{{ $photo['src'] }}" alt="{{ $photo['alt'] }}" class="aspect-square h-full w-full object-cover transition duration-500 hover:scale-105">
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="relative overflow-hidden bg-[#111827] py-20 text-white">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#f5b82e 1px, transparent 1px); background-size: 24px 24px;"></div>
        <div class="relative mx-auto grid max-w-7xl gap-6 px-4 sm:px-6 md:grid-cols-4 lg:px-8">
            @foreach ([[$setting->established_year ?? '2062', 'Year Established'], ['1000+', 'Students'], ['50+', 'Teachers'], ['20+', 'Activities']] as [$number, $label])
                <div class="reveal rounded-3xl border border-white/10 bg-white/8 p-8 text-center">
                    <p class="font-display text-4xl font-black text-[#f5b82e]">{{ $number }}</p>
                    <p class="mt-2 font-medium text-pink-100/80">{{ $label }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section class="bg-white py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-12 text-center">
                <p class="text-sm font-bold uppercase tracking-widest text-[#f5b82e]">Leadership</p>
                <h2 class="font-display mt-3 text-4xl font-black text-[#111827]">Message From the Principal</h2>
                <div class="mx-auto mt-4 h-1 w-24 rounded-full bg-[#f5b82e]"></div>
            </div>
            <div class="mx-auto max-w-4xl rounded-[2rem] bg-[#fbfaf7] p-8 shadow-sm ring-1 ring-gray-100 md:p-10">
                <blockquote class="border-l-4 border-[#f5b82e] pl-6 text-lg italic leading-9 text-slate-700">
                    {{ $principalMessage?->body ?? 'Our school is committed to fostering essential skills and helping students achieve their goals by identifying latent talents and stimulating innovative thinking.' }}
                </blockquote>
                <div class="mt-8 flex items-center gap-4">
                    <img src="{{ $principal?->photo ? asset('storage/' . $principal->photo) : 'https://www.sushmasecondary.edu.np/assets/image/bodh_raj.png' }}" alt="{{ $principal?->name ?? 'Principal' }}" class="h-16 w-16 rounded-full object-cover">
                    <div>
                        <p class="font-black text-[#111827]">{{ $principal?->name ?? 'Mr. Bodh Raj Nepal' }}</p>
                        <p class="font-medium text-[#a0183d]">{{ $principal?->designation ?? 'Principal' }}, {{ $setting->school_name ?? 'Cambridge Public School' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="border-t border-gray-200 bg-[#fbfaf7] py-20">
        <div class="mx-auto max-w-4xl px-4 text-center">
            <h2 class="font-display text-4xl font-black text-[#111827]">Ready to Join Our School?</h2>
            <p class="mx-auto mt-4 max-w-2xl text-lg leading-8 text-slate-600">Admissions are open for the new academic year. Start the application process and secure your child's future.</p>
            <a href="{{ route('admission') }}" class="mt-8 inline-flex rounded-2xl bg-[#a0183d] px-10 py-4 font-bold text-white shadow-lg transition hover:-translate-y-1 hover:bg-[#111827]">Apply for Admission</a>
        </div>
    </section>
</main>
@endsection
