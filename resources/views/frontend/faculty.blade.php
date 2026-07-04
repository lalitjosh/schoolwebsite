
@section('title', 'Faculty | ' . ($setting->school_name ?? 'Cambridge Public School'))

@section('content')
@php
    $facultyHero = $content->get('faculty.hero');
    $departments = ($faculties ?? collect())->pluck('department')->filter()->unique()->values();
@endphp

<main>
    <section class="relative overflow-hidden bg-gradient-to-br from-[#111827] via-[#a0183d] to-[#111827] py-24 text-white">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 30px 30px;"></div>
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute left-[12%] top-16 h-16 w-16 rounded-full bg-[#16a34a]/20 blur-xl"></div>
            <div class="absolute bottom-16 right-[18%] h-28 w-28 rounded-full bg-white/10 blur-2xl"></div>
        </div>
        <div class="relative mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <nav class="mb-8 flex justify-center gap-2 text-sm font-medium text-pink-100/70">
                <a href="{{ route('home') }}" class="hover:text-[#16a34a]">Home</a>
                <span>/</span>
                <span class="text-white">Faculty</span>
            </nav>
            <p class="text-sm font-bold uppercase tracking-[0.3em] text-[#16a34a]">{{ $facultyHero?->eyebrow ?? 'Our Directory' }}</p>
            <h1 class="font-display mx-auto mt-5 max-w-4xl text-4xl font-black leading-tight sm:text-6xl">{{ $facultyHero?->title ?? 'Meet Our Faculty' }}</h1>
            <p class="mx-auto mt-5 max-w-2xl text-lg leading-8 text-pink-100/90">{{ $facultyHero?->subtitle ?? 'Browse our faculty, latest announcements, and community updates.' }}</p>
        </div>
    </section>

    <section class="min-h-screen bg-[#fbfaf7] py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex flex-col justify-between gap-4 lg:flex-row lg:items-center">
                <div>
                    <p class="text-sm font-bold uppercase tracking-widest text-[#16a34a]">Teaching Team</p>
                    <h2 class="font-display mt-2 text-3xl font-black text-[#111827]">Faculty Members</h2>
                </div>
                <div class="flex flex-wrap gap-2" data-faculty-filters>
                    <button type="button" data-faculty-filter="All" class="faculty-filter-active rounded-full px-4 py-2 text-sm font-bold">All</button>
                    @foreach ($departments as $department)
                        <button type="button" data-faculty-filter="{{ $department }}" class="rounded-full bg-white px-4 py-2 text-sm font-bold text-slate-600 shadow-sm ring-1 ring-gray-100 hover:bg-pink-50 hover:text-[#a0183d]">{{ $department }}</button>
                    @endforeach
                </div>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($faculties as $faculty)
                    <article data-faculty-card data-department="{{ $faculty->department ?: 'General' }}" class="reveal group overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-gray-100 transition hover:-translate-y-1 hover:shadow-xl">
                        <div class="relative aspect-[4/3] overflow-hidden bg-[#f6eef1]">
                            <img src="{{ $faculty->photo ? asset('storage/' . $faculty->photo) : 'https://images.unsplash.com/photo-1577896851231-70ef18881754?auto=format&fit=crop&w=700&q=80' }}" alt="{{ $faculty->name }}" class="h-full w-full object-contain">
                            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-[#111827]/80 to-transparent p-5">
                                <p class="inline-flex rounded-full bg-[#16a34a] px-3 py-1 text-xs font-black text-[#111827]">{{ $faculty->department ?: 'Faculty' }}</p>
                            </div>
                        </div>
                        <div class="p-6">
                            <h2 class="text-xl font-black text-[#111827]">{{ $faculty->name }}</h2>
                            <p class="mt-1 font-bold text-[#a0183d]">{{ $faculty->designation }}</p>
                            <p class="mt-3 text-sm leading-6 text-slate-600">{{ $faculty->qualification ?: 'Experienced educator' }}</p>
                        </div>
                    </article>
                @empty
                    @foreach (['Principal', 'Science Faculty', 'English Faculty', 'Mathematics Faculty'] as $role)
                        <article class="reveal rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
                            <img src="https://images.unsplash.com/photo-1577896851231-70ef18881754?auto=format&fit=crop&w=700&q=80" alt="{{ $role }}" class="aspect-[4/3] w-full rounded-2xl object-cover">
                            <h2 class="mt-4 text-xl font-black text-[#111827]">{{ $role }}</h2>
                            <p class="font-bold text-[#a0183d]">Experienced educator</p>
                            <p class="mt-2 text-sm text-slate-600">Add faculty records from the admin dashboard.</p>
                        </article>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>
</main>
@endsection
@extends('layouts.frontend')
