
@section('title', 'Contact | ' . ($setting->school_name ?? 'Cambridge Public School'))

@section('content')
@php($contactHero = $content->get('contact.hero'))
<main>
    <section class="relative overflow-hidden bg-gradient-to-br from-[#111827] via-[#a0183d] to-[#111827] py-24 text-white">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 30px 30px;"></div>
        <div class="absolute -left-20 -top-20 h-80 w-80 rounded-full bg-[#f5b82e]/20 blur-3xl"></div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <nav class="mb-8 flex items-center gap-2 text-sm font-medium text-pink-100/70">
                <a href="{{ route('home') }}" class="hover:text-[#f5b82e]">Home</a>
                <span>/</span>
                <span class="text-white">Contact Us</span>
            </nav>
            <div class="inline-flex rounded-full bg-[#f5b82e] px-6 py-2.5 text-sm font-bold text-[#111827]">We are here to help</div>
            <h1 class="font-display mt-6 max-w-4xl text-4xl font-black leading-tight sm:text-6xl">{{ $contactHero?->title ?? 'Get in Touch With Us' }}</h1>
            <p class="mt-6 max-w-3xl text-lg leading-8 text-pink-100/90">{{ $contactHero?->subtitle ?? 'Visit, call, or send us a message. Our team is happy to answer questions about admissions and programs.' }}</p>
        </div>
    </section>

    <section id="contact-form" class="relative bg-[#fbfaf7] py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-12 grid gap-6 md:grid-cols-3">
                @foreach ([
                    ['Visit Us', $setting->address ?? 'Amargadhi-5, Dadeldhura, Sudurpashchim Province, Nepal', 'Sudurpashchim Province, Nepal'],
                    ['Call Us', $setting->phone ?? '9801181818', 'Office hours support'],
                    ['Email Us', $setting->email ?? 'admin@cambridgeps.edu.np', 'We reply within 24 hours'],
                ] as [$title, $main, $sub])
                    <article class="group rounded-3xl bg-white p-8 text-center shadow-sm ring-1 ring-gray-100 transition hover:-translate-y-1 hover:shadow-xl">
                        <div class="mx-auto mb-5 grid h-16 w-16 place-items-center rounded-2xl bg-[#fbfaf7] text-2xl font-black text-[#a0183d] transition group-hover:scale-110 group-hover:bg-[#a0183d]/5">{{ $loop->iteration }}</div>
                        <h3 class="text-xl font-black text-[#111827] transition group-hover:text-[#a0183d]">{{ $title }}</h3>
                        <p class="mt-3 text-sm font-medium leading-7 text-slate-600">{{ $main }}</p>
                        <p class="text-sm font-medium leading-7 text-slate-500">{{ $sub }}</p>
                    </article>
                @endforeach
            </div>

            <div class="grid gap-10 lg:grid-cols-2">
                <div class="overflow-hidden rounded-[2rem] bg-white p-5 shadow-xl ring-1 ring-gray-100">
                    <h2 class="font-display mb-5 text-3xl font-black text-[#111827]">Find Us on the Map</h2>
                    <div class="overflow-hidden rounded-3xl">
                        <iframe src="{{ $setting->map_embed_url ?: 'https://maps.google.com/maps?q=Cambridge+Public+School,+Dadeldhura,+Nepal&t=&z=16&ie=UTF8&iwloc=&output=embed' }}" width="100%" height="430" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="School location"></iframe>
                    </div>
                    <a href="{{ $setting->map_external_url ?: 'https://maps.app.goo.gl/B2VqsmyjQJzm4Wuy8' }}" target="_blank" rel="noopener" class="mt-5 inline-flex items-center justify-center rounded-full bg-[#a0183d] px-6 py-3 text-sm font-bold text-white shadow-lg shadow-pink-900/15 transition hover:bg-[#111827]">
                        Open in Google Maps
                    </a>
                </div>

                <div class="rounded-[2rem] bg-white p-6 shadow-xl ring-1 ring-gray-100 md:p-8">
                    <p class="text-sm font-bold uppercase tracking-widest text-[#f5b82e]">Send Message</p>
                    <h2 class="font-display mt-2 text-3xl font-black text-[#111827]">How can we help?</h2>
                    <p class="mt-2 text-sm text-slate-500">Fill out the form below and we will get back to you as soon as possible.</p>

                    <form method="POST" action="{{ route('contact.store') }}" class="mt-8 space-y-6">
                        @csrf
                        <div class="grid gap-6 sm:grid-cols-2">
                            <label>
                                <span class="mb-2 block text-sm font-bold text-slate-700">Full Name</span>
                                <input name="name" value="{{ old('name') }}" required placeholder="Your name" class="w-full rounded-xl border border-gray-200 bg-gray-50 px-5 py-3.5 text-sm outline-none transition focus:border-[#a0183d] focus:bg-white focus:ring-2 focus:ring-[#a0183d]/20">
                            </label>
                            <label>
                                <span class="mb-2 block text-sm font-bold text-slate-700">Phone Number</span>
                                <input name="phone" value="{{ old('phone') }}" placeholder="98XXXXXXXX" class="w-full rounded-xl border border-gray-200 bg-gray-50 px-5 py-3.5 text-sm outline-none transition focus:border-[#a0183d] focus:bg-white focus:ring-2 focus:ring-[#a0183d]/20">
                            </label>
                        </div>
                        <label>
                            <span class="mb-2 block text-sm font-bold text-slate-700">Email Address</span>
                            <input name="email" value="{{ old('email') }}" required type="email" placeholder="email@example.com" class="w-full rounded-xl border border-gray-200 bg-gray-50 px-5 py-3.5 text-sm outline-none transition focus:border-[#a0183d] focus:bg-white focus:ring-2 focus:ring-[#a0183d]/20">
                        </label>
                        <label>
                            <span class="mb-2 block text-sm font-bold text-slate-700">Subject</span>
                            <input name="subject" value="{{ old('subject') }}" required placeholder="Admission inquiry, meeting, support..." class="w-full rounded-xl border border-gray-200 bg-gray-50 px-5 py-3.5 text-sm outline-none transition focus:border-[#a0183d] focus:bg-white focus:ring-2 focus:ring-[#a0183d]/20">
                        </label>
                        <label>
                            <span class="mb-2 block text-sm font-bold text-slate-700">Message</span>
                            <textarea name="message" rows="5" required placeholder="How can we help you today?" class="w-full resize-none rounded-xl border border-gray-200 bg-gray-50 px-5 py-3.5 text-sm outline-none transition focus:border-[#a0183d] focus:bg-white focus:ring-2 focus:ring-[#a0183d]/20">{{ old('message') }}</textarea>
                        </label>
                        <button class="w-full rounded-2xl bg-[#a0183d] px-7 py-4 font-black text-white shadow-lg transition hover:-translate-y-1 hover:bg-[#111827]">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
@extends('layouts.frontend')
