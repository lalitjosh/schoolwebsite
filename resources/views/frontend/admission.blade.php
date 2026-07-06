
@section('title', 'Admissions | ' . ($setting->school_name ?? 'Cambridge Public School'))

@section('content')
@php
    $admissionHero = $content->get('admissions.hero');
    $steps = $admissionHero?->items ?: ['Submit inquiry form', 'Schedule school tour', 'Student interaction', 'Complete enrollment'];
    $stepDescriptions = [
        'Share student and parent details so our admission office can review your inquiry.',
        'Bring the required documents and visit the campus for counseling and guidance.',
        'The student meets our team for a friendly assessment and parent discussion.',
        'Complete admission formalities, confirm the seat, and prepare for classes.',
    ];
@endphp

<main>
    <section class="relative overflow-hidden bg-gradient-to-br from-[#111827] via-[#a0183d] to-[#111827] py-24 text-white">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 30px 30px;"></div>
        <div class="absolute right-0 top-0 h-96 w-96 -translate-y-1/2 translate-x-1/2 rounded-full bg-[#f5b82e]/20 blur-3xl"></div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <nav class="mb-8 flex items-center gap-2 text-sm font-medium text-pink-100/70">
                <a href="{{ route('home') }}" class="hover:text-[#f5b82e]">Home</a>
                <span>/</span>
                <span class="text-white">Admissions</span>
            </nav>
            <div class="inline-flex rounded-full bg-[#f5b82e] px-6 py-2.5 text-sm font-bold text-[#111827] shadow-lg">
                {{ $admissionHero?->eyebrow ?? 'Now Open: Admissions 2083-2084' }}
            </div>
            <h1 class="font-display mt-6 max-w-4xl text-4xl font-black leading-tight sm:text-6xl">{{ $admissionHero?->title ?? 'Begin Your Childs Journey to Excellence' }}</h1>
            <p class="mt-6 max-w-3xl text-lg leading-8 text-pink-100/90">{{ $admissionHero?->subtitle ?? 'Fill out the inquiry form below and our admissions team will contact you to schedule a tour and consultation.' }}</p>
        </div>
    </section>

    <section class="relative bg-[#fbfaf7] py-24">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 sm:px-6 lg:grid-cols-12 lg:gap-16 lg:px-8">
            <aside class="lg:col-span-4">
                <div class="sticky top-36 rounded-[2rem] bg-white p-7 shadow-xl ring-1 ring-gray-100">
                    <h2 class="font-display text-3xl font-black text-[#111827]">Admission Information</h2>
                    <div class="mt-8 space-y-6">
                        @foreach ($steps as $step)
                            <div class="group flex gap-4">
                                <span class="grid h-11 w-11 shrink-0 place-items-center rounded-2xl bg-[#a0183d]/10 font-black text-[#a0183d] group-hover:bg-[#a0183d] group-hover:text-[#f5b82e]">{{ $loop->iteration }}</span>
                                <div>
                                    <p class="font-bold text-[#111827]">{{ $step }}</p>
                                    <p class="mt-1 text-sm leading-6 text-slate-600">{{ $stepDescriptions[$loop->index] ?? 'Our admission team will guide you through this step.' }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-10 rounded-3xl bg-[#a0183d] p-6 text-white">
                        <p class="text-xs font-bold uppercase tracking-widest text-[#f5b82e]">Required Documents</p>
                        <p class="mt-3 text-sm leading-7 text-pink-50/80">Birth certificate, previous mark sheet, passport photos, and parent or guardian identity copy.</p>
                    </div>
                </div>
            </aside>

            <div class="lg:col-span-8">
                <div class="rounded-[2rem] bg-white p-6 shadow-xl ring-1 ring-gray-100 md:p-8">
                    <div class="mb-8">
                        <p class="text-sm font-bold uppercase tracking-widest text-[#f5b82e]">Admission Form</p>
                        <h2 class="font-display mt-2 text-3xl font-black text-[#111827]">Admission Inquiry Form</h2>
                        <p class="mt-2 text-sm text-slate-500">Please fill out the form accurately. Required fields are marked by the browser.</p>
                    </div>

                    <form method="POST" action="{{ route('admission.store') }}" class="space-y-6">
                        @csrf
                        <div class="grid gap-6 sm:grid-cols-2">
                            <label class="block">
                                <span class="mb-2 block text-sm font-bold text-slate-700">Student Name</span>
                                <input name="student_name" value="{{ old('student_name') }}" required placeholder="Full name" class="w-full rounded-xl border border-gray-200 bg-gray-50 px-5 py-3.5 text-sm outline-none transition focus:border-[#a0183d] focus:bg-white focus:ring-2 focus:ring-[#a0183d]/20">
                            </label>
                            <label class="block">
                                <span class="mb-2 block text-sm font-bold text-slate-700">Date of Birth</span>
                                <input name="dob" value="{{ old('dob') }}" required type="date" class="w-full rounded-xl border border-gray-200 bg-gray-50 px-5 py-3.5 text-sm outline-none transition focus:border-[#a0183d] focus:bg-white focus:ring-2 focus:ring-[#a0183d]/20">
                            </label>
                            <div>
                                <span class="mb-2 block text-sm font-bold text-slate-700">Gender</span>
                                <div class="flex min-h-[50px] flex-wrap items-center gap-4 rounded-xl border border-gray-200 bg-gray-50 px-5 py-3.5">
                                    @foreach (['Male', 'Female', 'Other'] as $gender)
                                        <label class="inline-flex items-center gap-2 text-sm font-medium text-slate-700">
                                            <input type="radio" name="gender" value="{{ $gender }}" required @checked(old('gender') === $gender)>
                                            <span>{{ $gender }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <label class="block">
                                <span class="mb-2 block text-sm font-bold text-slate-700">Applying for Class</span>
                                <input name="grade" value="{{ old('grade') }}" required placeholder="Class / Grade" class="w-full rounded-xl border border-gray-200 bg-gray-50 px-5 py-3.5 text-sm outline-none transition focus:border-[#a0183d] focus:bg-white focus:ring-2 focus:ring-[#a0183d]/20">
                            </label>
                            <label class="block">
                                <span class="mb-2 block text-sm font-bold text-slate-700">Parent Name</span>
                                <input name="parent_name" value="{{ old('parent_name') }}" required placeholder="Parent / Guardian" class="w-full rounded-xl border border-gray-200 bg-gray-50 px-5 py-3.5 text-sm outline-none transition focus:border-[#a0183d] focus:bg-white focus:ring-2 focus:ring-[#a0183d]/20">
                            </label>
                            <label class="block">
                                <span class="mb-2 block text-sm font-bold text-slate-700">Phone Number</span>
                                <input name="phone" value="{{ old('phone') }}" required placeholder="98XXXXXXXX" class="w-full rounded-xl border border-gray-200 bg-gray-50 px-5 py-3.5 text-sm outline-none transition focus:border-[#a0183d] focus:bg-white focus:ring-2 focus:ring-[#a0183d]/20">
                            </label>
                            <label class="block">
                                <span class="mb-2 block text-sm font-bold text-slate-700">Email Address</span>
                                <input name="email" value="{{ old('email') }}" type="email" placeholder="optional@email.com" class="w-full rounded-xl border border-gray-200 bg-gray-50 px-5 py-3.5 text-sm outline-none transition focus:border-[#a0183d] focus:bg-white focus:ring-2 focus:ring-[#a0183d]/20">
                            </label>
                            <label class="block">
                                <span class="mb-2 block text-sm font-bold text-slate-700">Previous School</span>
                                <input name="previous_school" value="{{ old('previous_school') }}" placeholder="Optional" class="w-full rounded-xl border border-gray-200 bg-gray-50 px-5 py-3.5 text-sm outline-none transition focus:border-[#a0183d] focus:bg-white focus:ring-2 focus:ring-[#a0183d]/20">
                            </label>
                        </div>
                        <label class="block">
                            <span class="mb-2 block text-sm font-bold text-slate-700">Message</span>
                            <textarea name="message" rows="5" placeholder="Any questions or notes?" class="w-full resize-none rounded-xl border border-gray-200 bg-gray-50 px-5 py-3.5 text-sm outline-none transition focus:border-[#a0183d] focus:bg-white focus:ring-2 focus:ring-[#a0183d]/20">{{ old('message') }}</textarea>
                        </label>
                        <button class="inline-flex w-full items-center justify-center rounded-2xl bg-[#a0183d] px-7 py-4 font-black text-white shadow-lg transition hover:-translate-y-1 hover:bg-[#111827]">Submit Admission Inquiry</button>
                        <p class="text-center text-xs font-medium text-slate-300">Your information is secure. We will contact you soon.</p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
@extends('layouts.frontend')
