@extends('layouts.frontend')

@section('title', 'Notices | ' . ($setting->school_name ?? 'Cambridge Public School'))

@section('content')
    <main class="bg-[#fbfaf7] py-20">
        <div class="mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
            <h1 class="font-display text-4xl font-black text-[#111827]">Notices</h1>
            <p class="mt-4 text-slate-600">Please visit the Notice/Event page for the latest notices.</p>
            <a href="{{ route('news') }}" class="mt-8 inline-flex rounded-2xl bg-[#a0183d] px-7 py-3 font-bold text-white">Open Notice/Event</a>
        </div>
    </main>
@endsection
