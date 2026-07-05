
@section('title', 'Gallery | ' . ($setting->school_name ?? 'Cambridge Public School'))

@section('content')
@php
    $galleryHero = $content->get('gallery.hero');
    $fallbackImages = collect([
        ['title' => 'School Campus', 'category' => 'Campus', 'description' => 'A look at the school environment where students learn, gather, and grow.', 'image' => 'https://www.sushmasecondary.edu.np/assets/image/sushma_front.jpg'],
        ['title' => 'Classroom Activity', 'category' => 'Activities', 'description' => 'Students taking part in practical lessons and everyday classroom learning.', 'image' => 'https://www.sushmasecondary.edu.np/assets/image/sushma_robotics.jpg'],
        ['title' => 'Kids Learning', 'category' => 'Kids', 'description' => 'Early learners exploring creativity, habits, and guided discovery.', 'image' => 'https://www.sushmasecondary.edu.np/assets/image/kids.jpg'],
        ['title' => 'School Life', 'category' => 'Events', 'description' => 'Moments from activities, celebrations, and student life around campus.', 'image' => 'https://www.sushmasecondary.edu.np/assets/image/sushma_baby.jpg'],
    ]);
    $photos = ($galleries ?? collect())->flatMap(function ($gallery) {
        $images = $gallery->images && $gallery->images->isNotEmpty()
            ? $gallery->images->map(fn ($image) => [
                'title' => $image->caption ?: $gallery->title,
                'category' => $gallery->title,
                'description' => $gallery->description,
                'image' => asset('storage/' . $image->image),
            ])
            : collect();

        if ($gallery->cover_image) {
            $images->prepend([
                'title' => $gallery->title,
                'category' => $gallery->title,
                'description' => $gallery->description,
                'image' => asset('storage/' . $gallery->cover_image),
            ]);
        }

        return $images;
    })->values();
    if ($photos->isEmpty()) {
        $photos = $fallbackImages;
    }
    $categories = $photos->pluck('category')->unique()->values();
@endphp

<main>
    <section class="relative overflow-hidden bg-gradient-to-br from-[#111827] via-[#a0183d] to-[#111827] py-24 text-white">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 30px 30px;"></div>
        <div class="absolute right-0 top-0 h-96 w-96 -translate-y-1/2 translate-x-1/2 rounded-full bg-[#f5b82e]/20 blur-3xl"></div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <nav class="mb-8 flex items-center gap-2 text-sm font-medium text-pink-100/70">
                <a href="{{ route('home') }}" class="hover:text-[#f5b82e]">Home</a>
                <span>/</span>
                <span class="text-white">Gallery</span>
            </nav>
            <div class="inline-flex rounded-full bg-[#f5b82e] px-6 py-2.5 text-sm font-bold text-[#111827]">School Memories</div>
            <h1 class="font-display mt-6 max-w-4xl text-4xl font-black leading-tight sm:text-6xl">{{ $galleryHero?->title ?? 'Our Gallery' }}</h1>
            <p class="mt-6 max-w-3xl text-lg leading-8 text-pink-100/90">{{ $galleryHero?->subtitle ?? 'A visual journey through school life, academic achievements, sports events, classrooms, and campus moments.' }}</p>
        </div>
    </section>

    <section class="sticky top-[112px] z-40 border-b border-gray-200 bg-white py-4 shadow-sm">
        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap gap-2" data-gallery-filters>
                <button type="button" data-gallery-filter="All" class="gallery-filter-active rounded-full px-4 py-2 text-sm font-bold transition">All Photos</button>
                @foreach ($categories as $category)
                    <button type="button" data-gallery-filter="{{ $category }}" class="rounded-full bg-gray-100 px-4 py-2 text-sm font-bold text-slate-600 transition hover:bg-pink-50 hover:text-[#a0183d]">{{ $category }}</button>
                @endforeach
            </div>
            <p class="text-sm font-bold text-slate-500"><span data-gallery-count>{{ $photos->count() }}</span> photos</p>
        </div>
    </section>

    <section class="min-h-screen bg-[#fbfaf7] py-12 sm:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="columns-1 gap-5 sm:columns-2 lg:columns-3">
                @foreach ($photos as $photo)
                    <button type="button" data-gallery-card data-category="{{ $photo['category'] }}" data-src="{{ $photo['image'] }}" data-title="{{ $photo['title'] }}" data-description="{{ $photo['description'] ?? '' }}" class="group mb-5 block w-full break-inside-avoid overflow-hidden rounded-2xl bg-white text-left shadow-sm ring-1 ring-gray-100 transition hover:-translate-y-1 hover:shadow-xl">
                        <img src="{{ $photo['image'] }}" alt="{{ $photo['title'] }}" class="w-full object-cover transition duration-700 group-hover:scale-105" style="height: 240px; object-fit: cover;" loading="lazy">
                        <div class="p-4">
                            @if (strcasecmp($photo['category'], $photo['title']) !== 0)
                                <p class="text-xs font-bold uppercase tracking-widest text-[#f5b82e]">{{ $photo['category'] }}</p>
                            @endif
                            <h2 class="font-bold text-[#111827]">{{ $photo['title'] }}</h2>
                            @if (! empty($photo['description']))
                                <p class="mt-2 text-sm leading-6 text-slate-600">{{ \Illuminate\Support\Str::limit($photo['description'], 130) }}</p>
                            @endif
                        </div>
                    </button>
                @endforeach
            </div>
        </div>
    </section>

    <div data-gallery-lightbox class="fixed inset-0 z-[100] hidden items-center justify-center bg-[#111827]/90 p-4">
        <button type="button" data-gallery-close class="absolute right-5 top-5 grid h-11 w-11 place-items-center rounded-full bg-white/10 text-2xl text-white hover:bg-white/20" aria-label="Close gallery image">&times;</button>
        <button type="button" data-gallery-prev class="absolute left-4 top-1/2 hidden -translate-y-1/2 rounded-full bg-white/10 px-4 py-3 font-black text-white hover:bg-white/20 sm:block" aria-label="Previous image">Prev</button>
        <figure class="w-full max-w-5xl">
            <img data-gallery-lightbox-image src="" alt="" class="max-h-[78vh] w-full rounded-3xl object-contain">
            <figcaption class="mt-4 rounded-2xl bg-black/35 p-4 text-center text-white">
                <h2 data-gallery-lightbox-title class="font-bold"></h2>
                <p data-gallery-lightbox-description class="mx-auto mt-2 max-h-32 max-w-3xl overflow-y-auto text-sm leading-6 text-white/85"></p>
            </figcaption>
        </figure>
        <button type="button" data-gallery-next class="absolute right-4 top-1/2 hidden -translate-y-1/2 rounded-full bg-white/10 px-4 py-3 font-black text-white hover:bg-white/20 sm:block" aria-label="Next image">Next</button>
    </div>
</main>
@endsection
@extends('layouts.frontend')
