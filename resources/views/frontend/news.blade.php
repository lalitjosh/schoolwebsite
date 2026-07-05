
@section('title', 'Notice/Event | ' . ($setting->school_name ?? 'Cambridge Public School'))

@section('content')
@php
    $newsHero = $content->get('news.hero');
    $heroTitle = in_array($newsHero?->title, ['News & Events', 'Latest updates from school life.'], true)
        ? 'Notice/Event'
        : ($newsHero?->title ?? 'Notice/Event');
    $heroSubtitle = $newsHero?->subtitle ?: 'Important notices, uploaded announcements, and school event updates.';
@endphp
<main>
    <section class="relative overflow-hidden bg-gradient-to-br from-[#111827] via-[#a0183d] to-[#111827] py-16 text-white md:py-24">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 30px 30px;"></div>
        <div class="absolute -right-24 -top-24 h-96 w-96 rounded-full bg-[#f5b82e]/20 blur-3xl"></div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <nav class="mb-8 flex items-center gap-2 text-sm font-medium text-pink-100/70">
                <a href="{{ route('home') }}" class="hover:text-[#f5b82e]">Home</a>
                <span>/</span>
                <span class="text-white">Notice/Event</span>
            </nav>
            <div class="inline-flex rounded-full bg-[#f5b82e] px-5 py-2 text-xs font-bold uppercase tracking-widest text-[#111827]">School Updates</div>
            <h1 class="font-display mt-5 text-4xl font-black tracking-tight text-white sm:text-5xl">{{ $heroTitle }}</h1>
            <p class="mt-4 max-w-2xl text-lg leading-8 text-pink-100/90">{{ $heroSubtitle }}</p>
        </div>
    </section>

    <section id="notice-board" class="border-b border-gray-200 bg-[#fbfaf7] py-16 md:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                <div>
                    <p class="text-sm font-bold uppercase tracking-widest text-[#f5b82e]">Notice Board</p>
                    <h2 class="font-display mt-2 text-3xl font-black text-[#111827]">Latest Notices</h2>
                </div>
                <a href="#events" class="rounded-lg bg-pink-50 px-4 py-2 text-sm font-bold text-[#a0183d] hover:bg-[#a0183d] hover:text-white">View Events</a>
            </div>

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @forelse (($notices ?? collect()) as $notice)
                    <button
                        type="button"
                        data-notice-card
                        data-notice-title="{{ $notice->title }}"
                        data-notice-date="{{ optional($notice->publish_date)->format('M d, Y') ?? 'Latest' }}"
                        data-notice-content="{{ $notice->content }}"
                        data-notice-image="{{ $notice->image ? asset('storage/' . $notice->image) : '' }}"
                        class="reveal overflow-hidden rounded-3xl bg-white text-left shadow-sm ring-1 ring-gray-100 transition hover:-translate-y-1 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-[#a0183d]"
                    >
                        @if ($notice->image)
                            <img src="{{ asset('storage/' . $notice->image) }}" alt="{{ $notice->title }}" class="w-full object-cover" style="height: 224px; object-fit: cover;">
                        @else
                            <div class="grid h-40 place-items-center bg-[#a0183d] px-6 text-center text-xl font-black text-white">{{ $notice->title }}</div>
                        @endif
                        <div class="p-6">
                            <p class="text-xs font-bold uppercase tracking-widest text-[#a0183d]">Notice - {{ optional($notice->publish_date)->format('M d, Y') ?? 'Latest' }}</p>
                            <h3 class="mt-2 text-xl font-black text-[#111827]">{{ $notice->title }}</h3>
                            <p class="mt-3 leading-7 text-slate-600">{{ \Illuminate\Support\Str::limit($notice->content, 160) }}</p>
                            <span class="mt-4 inline-flex text-sm font-bold text-[#a0183d]">Open Notice</span>
                        </div>
                    </button>
                @empty
                    <div class="rounded-3xl bg-white p-10 text-center shadow-sm ring-1 ring-gray-100 md:col-span-3">
                        <h3 class="text-lg font-bold text-slate-800">No Notices Published</h3>
                        <p class="mt-2 text-sm text-slate-500">Upload notices from the admin dashboard to update this section.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="events" class="bg-white py-16 md:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                <div>
                    <p class="text-sm font-bold uppercase tracking-widest text-[#f5b82e]">Calendar</p>
                    <h2 class="font-display mt-2 text-3xl font-black text-[#111827]">School Events</h2>
                </div>
            </div>

            <div class="grid gap-5 md:grid-cols-3">
                @forelse ($events as $event)
                    <article class="reveal rounded-3xl bg-[#fbfaf7] p-6 shadow-sm ring-1 ring-gray-100 transition hover:-translate-y-1 hover:shadow-xl">
                        <p class="text-sm font-black text-[#f5b82e]">{{ optional($event->event_date)->format('M d, Y') ?? 'Coming Soon' }}</p>
                        <h3 class="mt-3 text-xl font-black text-[#111827]">{{ $event->title }}</h3>
                        <p class="mt-3 text-sm leading-7 text-slate-600">{{ $event->description ? \Illuminate\Support\Str::limit($event->description, 130) : ($event->location ?? 'School campus') }}</p>
                    </article>
                @empty
                    <div class="rounded-3xl bg-[#fbfaf7] p-10 text-center shadow-sm ring-1 ring-gray-100 md:col-span-3">
                        <h3 class="text-lg font-bold text-slate-800">No Upcoming Events</h3>
                        <p class="mt-2 text-sm text-slate-500">Check back later for new schedules.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <div data-notice-detail class="fixed inset-0 z-[100] hidden items-center justify-center bg-[#111827]/80 p-4">
        <div class="w-full max-w-2xl overflow-hidden rounded-2xl bg-white shadow-2xl">
            <div class="flex items-center justify-between gap-4 bg-[#a0183d] px-5 py-4 text-white">
                <div>
                    <p data-notice-detail-date class="text-xs font-black uppercase tracking-[0.18em] text-[#f5b82e]"></p>
                    <h2 data-notice-detail-title class="font-display mt-1 text-2xl font-black"></h2>
                </div>
                <button type="button" data-notice-detail-close class="grid h-9 w-9 place-items-center rounded-full bg-white/10 text-2xl leading-none hover:bg-white/20" aria-label="Close notice">&times;</button>
            </div>
            <div class="p-5">
                <img data-notice-detail-image src="" alt="" class="mb-5 hidden w-full rounded-xl object-cover" style="max-height: 340px; object-fit: cover;">
                <p data-notice-detail-content class="whitespace-pre-line leading-8 text-slate-700"></p>
            </div>
        </div>
    </div>

    <section class="relative overflow-hidden bg-[#3a1724] py-16 text-white">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 30px 30px;"></div>
        <div class="relative mx-auto max-w-xl px-4 text-center">
            <h2 class="font-display text-3xl font-black">Stay Updated</h2>
            <p class="mt-3 text-sm text-pink-100/90">Subscribe to receive notice and event reminders.</p>
            <form class="mt-6 flex flex-col gap-2 sm:flex-row">
                <input type="email" placeholder="Email address" class="flex-1 rounded-lg border border-white/20 bg-[#273751] px-4 py-3 text-sm text-white outline-none focus:ring-2 focus:ring-[#f5b82e]">
                <button type="button" class="rounded-lg bg-[#f5b82e] px-5 py-3 text-sm font-black text-[#111827]">Subscribe</button>
            </form>
        </div>
    </section>
</main>
@endsection
@extends('layouts.frontend')
