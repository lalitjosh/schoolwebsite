@extends('layouts.frontend')

@section('title', 'Result | ' . ($setting->school_name ?? 'Cambridge Public School'))

@section('content')
@php($resultHero = $content->get('result.hero'))
<main>
    <section class="relative overflow-hidden bg-gradient-to-br from-[#111827] via-[#a0183d] to-[#111827] py-24 text-white">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 30px 30px;"></div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <nav class="mb-8 flex items-center gap-2 text-sm font-medium text-pink-100/70">
                <a href="{{ route('home') }}" class="hover:text-[#16a34a]">Home</a>
                <span>/</span>
                <span class="text-white">Result</span>
            </nav>
            <div class="inline-flex rounded-full bg-[#16a34a] px-6 py-2.5 text-sm font-bold text-[#111827]">{{ $resultHero?->eyebrow ?? 'Result' }}</div>
            <h1 class="font-display mt-6 max-w-4xl text-4xl font-black leading-tight sm:text-6xl">{{ $resultHero?->title ?? 'Student Result Information' }}</h1>
            <p class="mt-6 max-w-3xl text-lg leading-8 text-pink-100/90">{{ $resultHero?->subtitle ?? 'Entrance and exam result notices can be linked here when the school publishes them.' }}</p>
        </div>
    </section>

    <section class="bg-[#fbfaf7] px-4 py-20 sm:px-6 lg:px-8">
        <div class="mx-auto grid max-w-6xl gap-8 lg:grid-cols-[0.8fr_1.2fr]">
            <div class="rounded-[2rem] bg-[#a0183d] p-8 text-white shadow-xl">
                <p class="text-sm font-bold uppercase tracking-widest text-[#16a34a]">Result Desk</p>
                <h2 class="font-display mt-3 text-3xl font-black">Check Latest Updates</h2>
                <p class="mt-5 leading-8 text-pink-100/80">Published exam results, admission results, and official result files from the school office are listed here.</p>
            </div>
            <div class="rounded-[2rem] bg-white p-8 shadow-sm ring-1 ring-gray-100">
                <h2 class="font-display text-3xl font-black text-[#111827]">{{ $resultHero?->body ? \Illuminate\Support\Str::before($resultHero->body, '.') : 'Results will be available soon' }}</h2>
                <p class="mt-4 leading-8 text-slate-600">{{ $resultHero?->body ?? 'Please contact the school office or check the notice board for the latest result publication updates.' }}</p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ $resultHero?->button_url ?: route('contact') }}" class="rounded-2xl bg-[#a0183d] px-7 py-3 text-center font-bold text-white transition hover:bg-[#111827]">{{ $resultHero?->button_label ?? 'Contact Office' }}</a>
                    <a href="{{ route('news') }}#notice-board" class="rounded-2xl border border-gray-200 px-7 py-3 text-center font-bold text-[#111827] transition hover:bg-gray-50">View Notices</a>
                </div>
            </div>
        </div>

        <div class="mx-auto mt-12 max-w-6xl">
            <div class="mb-8 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm font-bold uppercase tracking-widest text-[#16a34a]">Published Results</p>
                    <h2 class="font-display mt-2 text-3xl font-black text-[#111827]">Latest Result Notices</h2>
                </div>
                <a href="{{ route('contact') }}" class="text-sm font-bold text-[#a0183d] hover:text-[#111827]">Need help?</a>
            </div>

            <div class="grid gap-5">
                @forelse (($results ?? collect()) as $result)
                    <article class="rounded-[1.5rem] bg-white p-6 shadow-sm ring-1 ring-gray-100 transition hover:-translate-y-1 hover:shadow-xl">
                        <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
                            <div>
                                <div class="mb-3 flex flex-wrap gap-2 text-xs font-bold uppercase tracking-wider">
                                    @if ($result->exam_name)
                                        <span class="rounded-full bg-pink-50 px-3 py-1 text-[#a0183d]">{{ $result->exam_name }}</span>
                                    @endif
                                    @if ($result->grade)
                                        <span class="rounded-full bg-amber-50 px-3 py-1 text-[#9a650f]">{{ $result->grade }}</span>
                                    @endif
                                    @if ($result->academic_year)
                                        <span class="rounded-full bg-gray-100 px-3 py-1 text-slate-600">{{ $result->academic_year }}</span>
                                    @endif
                                </div>
                                <h3 class="text-xl font-black text-[#111827]">{{ $result->title }}</h3>
                                @if ($result->description)
                                    <p class="mt-3 max-w-3xl leading-7 text-slate-600">{{ $result->description }}</p>
                                @endif
                                @if ($result->result_date)
                                    <p class="mt-3 text-sm font-semibold text-slate-500">Published: {{ $result->result_date->format('M d, Y') }}</p>
                                @endif
                            </div>

                            <div class="flex shrink-0 flex-col gap-3 sm:flex-row lg:flex-col">
                                @if ($result->file)
                                    <a href="{{ asset('storage/' . $result->file) }}" target="_blank" rel="noopener" class="rounded-2xl bg-[#a0183d] px-6 py-3 text-center text-sm font-bold text-white transition hover:bg-[#111827]">View File</a>
                                @endif
                                @if ($result->external_url)
                                    <a href="{{ $result->external_url }}" target="_blank" rel="noopener" class="rounded-2xl border border-gray-200 px-6 py-3 text-center text-sm font-bold text-[#111827] transition hover:bg-gray-50">Open Link</a>
                                @endif
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="rounded-[1.5rem] bg-white p-8 text-center shadow-sm ring-1 ring-gray-100">
                        <h3 class="text-xl font-black text-[#111827]">No results published yet</h3>
                        <p class="mt-3 text-slate-600">Please check again later or contact the school office.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</main>
@endsection
@extends('layouts.frontend')

@section('content')
<div class="container mt-5">
    <h1>Notices Page</h1>
</div>
@endsection@extends('layouts.frontend')
