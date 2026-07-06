
@section('title', ($program['eyebrow'] ?? 'Academics') . ' | ' . ($setting->school_name ?? 'Cambridge Public School'))

@section('content')
@php
    $program = $program ?? [
        'eyebrow' => 'Academics',
        'title' => 'Learning that balances fundamentals, projects, and exam readiness.',
        'level' => 'PG to Grade 12',
        'description' => 'Cambridge Public School supports students through early learning, middle school foundations, and high school preparation.',
        'features' => ['Kids School: Nursery - Grade 3', 'Middle School: Grade 4 - 8', 'High School: Grade 9 - 12', 'Practical learning and projects', 'Co-curricular activities', 'Guidance and mentoring'],
    ];

    $label = strtolower($program['eyebrow'] ?? '');
    $type = str_contains($label, 'kids') ? 'kids' : (str_contains($label, 'middle') ? 'middle' : (str_contains($label, 'high') ? 'high' : 'overview'));
    $assetBase = 'https://www.sushmasecondary.edu.np/assets/image/';

    $page = [
        'kids' => [
            'crumb' => 'Kids School',
            'badge' => 'Nursery to Class 3',
            'headline' => 'Tiny steps, big discoveries.',
            'lead' => 'A warm early-years experience built around play, language, numbers, confidence, creativity, and social habits.',
            'image' => $assetBase . 'kids.jpg',
            'intro_label' => 'Why Parents Love Us',
            'intro_title' => 'Nurturing the Whole Child',
            'intro' => 'The early years shape how children feel about school. Our classrooms help young learners feel safe, expressive, curious, and ready to discover learning through stories, games, crafts, movement, and friendship.',
            'cards_title' => 'What We Explore Everyday',
            'cards' => [
                ['Language Skills', 'Stories, phonics, speaking confidence, rhymes, and early reading habits.'],
                ['Number Sense', 'Counting, patterns, shapes, comparison, sorting, and playful mathematics.'],
                ['Creative Growth', 'Drawing, music, craft, role play, movement, and imaginative expression.'],
                ['Social Habits', 'Sharing, listening, classroom routines, respect, care, and independence.'],
            ],
            'journey' => [
                ['Discover', 'Nursery', 'Colors, shapes, motor skills, classroom adjustment, and joyful routines.'],
                ['Express', 'LKG', 'Vocabulary, songs, stories, counting, confidence, and group play.'],
                ['Prepare', 'UKG-Class 3', 'Reading, writing, arithmetic, curiosity, and independent learning habits.'],
            ],
            'cta' => 'Admissions for Nursery through Class 3 are open. Visit the school and see the learning environment in person.',
        ],
        'middle' => [
            'crumb' => 'Middle School',
            'badge' => 'Class 4 to 8',
            'headline' => 'Foundations strong, thinking independent.',
            'lead' => 'A bridge from early foundations to deeper subject knowledge, projects, analysis, presentation, and confident study habits.',
            'image' => $assetBase . 'sushma_robotics.jpg',
            'intro_label' => 'Academic Transition',
            'intro_title' => 'A Bridge to Advanced Education',
            'intro' => 'Classes 4-8 mark an important shift toward subject depth and independent reasoning. Students learn through structured lessons, projects, lab-style activities, reading, teamwork, and regular academic support.',
            'cards_title' => 'Core Curriculum',
            'cards' => [
                ['English & Nepali', 'Reading, writing, grammar, speaking, comprehension, and presentation.'],
                ['Mathematics', 'Number systems, geometry, measurement, logic, and problem solving.'],
                ['Science & Technology', 'Observation, experiments, robotics exposure, environment, and inquiry.'],
                ['Social Studies', 'Community, culture, history, geography, values, and citizenship.'],
            ],
            'journey' => [
                ['Explore', 'Class 4-5', 'Strengthen literacy, numeracy, curiosity, and classroom confidence.'],
                ['Apply', 'Class 6-7', 'Projects, teamwork, reasoning, science activities, and study discipline.'],
                ['Prepare', 'Class 8', 'Foundation for secondary level, assessments, mentoring, and subject clarity.'],
            ],
            'cta' => 'Admissions for Classes 4-8 are open for students ready to grow with confidence and discipline.',
        ],
        'high' => [
            'crumb' => 'Secondary & +2',
            'badge' => 'Class 9 to 12',
            'headline' => 'Focused preparation for future study.',
            'lead' => 'SEE preparation and higher secondary pathways supported by experienced faculty, mentoring, subject practice, and career guidance.',
            'image' => $assetBase . 'see.png',
            'intro_label' => 'Secondary Focus',
            'intro_title' => 'SEE Readiness and +2 Pathways',
            'intro' => 'Senior students need clarity, confidence, and direction. We support them through subject depth, exam strategy, practical exposure, personal mentoring, and guidance for Science, Management, and Hotel Management pathways.',
            'cards_title' => 'SEE Subjects and Preparation',
            'cards' => [
                ['English & Nepali', 'Writing practice, grammar, reading, expression, and exam technique.'],
                ['Mathematics', 'Concept clarity, problem solving, model questions, and regular practice.'],
                ['Science', 'Theory, diagrams, lab exposure, observation, and application.'],
                ['Career Guidance', 'Stream selection, counseling, confidence, and future planning.'],
            ],
            'journey' => [
                ['Build', 'Class 9', 'Subject depth, disciplined study, lab work, and concept foundation.'],
                ['Perform', 'Class 10', 'SEE strategy, model tests, feedback, revision, and confidence.'],
                ['Advance', 'Class 11-12', 'Science, Management, Education, Law and Career preparation.'],
            ],
            'cta' => 'Talk with our admission team about SEE preparation and +2 streams for the new academic session.',
        ],
        'overview' => [
            'crumb' => 'Academics',
            'badge' => 'PG to Grade 12',
            'headline' => 'Learning designed for every stage.',
            'lead' => $program['description'],
            'image' => $assetBase . 'sushma_front.jpg',
            'intro_label' => 'Academic Framework',
            'intro_title' => 'From curiosity to confidence',
            'intro' => 'Our academic structure supports children from early discovery through middle-school foundations and secondary preparation.',
            'cards_title' => 'Programs',
            'cards' => [
                ['Kids School', 'Nursery to Class 3 with play-based learning and early foundations.'],
                ['Middle School', 'Classes 4-8 with projects, fundamentals, and independent thinking.'],
                ['High School', 'Classes 9-12 with exam readiness, mentoring, and future planning.'],
            ],
            'journey' => [],
            'cta' => 'Choose the right program and begin the admission process today.',
        ],
    ][$type];

    if (! empty($program['image'])) {
        $page['image'] = asset('storage/' . $program['image']);
    }
@endphp

<main>
    <section class="relative overflow-hidden bg-gradient-to-b from-[#a0183d] to-[#111827] py-24 text-white">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 30px 30px;"></div>
        <div class="absolute left-10 top-10 h-20 w-20 rounded-full bg-[#f5b82e]/80 blur-xl"></div>
        <div class="absolute bottom-20 right-20 h-32 w-32 rounded-full bg-[#f5b82e]/40 blur-2xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <nav class="mb-8 flex items-center gap-2 text-sm font-medium text-pink-100/70">
                <a href="{{ route('home') }}" class="hover:text-[#f5b82e]">Home</a>
                <span>/</span>
                <a href="{{ route('academics') }}" class="hover:text-[#f5b82e]">Academics</a>
                <span>/</span>
                <span class="text-white">{{ $page['crumb'] }}</span>
            </nav>

            <div class="inline-flex items-center gap-2 rounded-full bg-[#f5b82e] px-6 py-2.5 text-sm font-bold text-[#111827] shadow-lg">
                {{ $page['badge'] }}
            </div>
            <h1 class="font-display mt-6 max-w-4xl text-4xl font-black leading-tight tracking-tight sm:text-6xl lg:text-7xl">
                {{ $program['title'] }}
            </h1>
            <p class="mt-6 max-w-3xl text-lg leading-8 text-pink-100/90 md:text-xl">{{ $program['description'] ?: $page['lead'] }}</p>
        </div>
    </section>

    <section class="relative bg-white py-20">
        <div class="mx-auto grid max-w-7xl items-center gap-16 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
            <div class="reveal-left">
                <div class="overflow-hidden rounded-[2rem] shadow-2xl">
                    <img src="{{ $page['image'] }}" alt="{{ $page['crumb'] }} at {{ $setting->school_name ?? 'Cambridge Public School' }}" class="h-[500px] w-full object-cover transition duration-700 hover:scale-105">
                </div>
            </div>

            <div class="reveal-right">
                <p class="mb-4 flex items-center gap-3 text-sm font-bold uppercase tracking-widest text-[#f5b82e]">
                    <span class="h-0.5 w-8 bg-[#f5b82e]"></span>{{ $page['intro_label'] }}
                </p>
                <h2 class="font-display text-3xl font-black leading-tight text-[#111827] lg:text-5xl">{{ $page['intro_title'] }}</h2>
                <p class="mt-6 text-lg leading-8 text-slate-600">{{ $page['intro'] }}</p>

                <div class="mt-8 space-y-5">
                    @foreach (array_slice($program['features'], 0, 4) as $feature)
                        <div class="group flex items-start gap-4">
                            <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-[#fbfaf7] font-black text-[#a0183d] shadow-sm ring-1 ring-gray-100 transition group-hover:bg-[#a0183d] group-hover:text-[#f5b82e]">{{ $loop->iteration }}</span>
                            <div>
                                <h3 class="font-bold text-[#111827] transition group-hover:text-[#a0183d]">{{ $feature }}</h3>
                                <p class="mt-1 text-sm leading-6 text-slate-500">Managed from Page Sections in the backend.</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#fbfaf7] py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="reveal mx-auto mb-14 max-w-2xl text-center">
                <h2 class="font-display text-3xl font-black text-[#111827] lg:text-5xl">{{ $page['cards_title'] }}</h2>
                <div class="mx-auto mt-4 h-1 w-20 rounded-full bg-[#f5b82e]"></div>
            </div>
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                @foreach ($page['cards'] as [$title, $text])
                    <article class="reveal rounded-3xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-[#a0183d]/30 hover:shadow-xl">
                        <div class="mb-5 grid h-12 w-12 place-items-center rounded-2xl bg-[#a0183d]/10 font-black text-[#a0183d]">{{ $loop->iteration }}</div>
                        <h3 class="text-lg font-black text-[#111827]">{{ $title }}</h3>
                        <p class="mt-3 text-sm leading-7 text-slate-600">{{ $text }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    @if (count($page['journey']) > 0)
        <section class="relative overflow-hidden bg-white py-24">
            <svg class="absolute left-0 top-1/2 hidden w-full -translate-y-1/2 text-gray-50 lg:block" viewBox="0 0 1200 200" fill="none" stroke="currentColor" stroke-width="4" stroke-dasharray="10 10">
                <path d="M-100,100 Q200,200 400,100 T900,100 T1300,100" />
            </svg>
            <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-14 text-center">
                    <h2 class="font-display text-3xl font-black text-[#111827] lg:text-5xl">Learning Journey</h2>
                    <p class="mt-4 text-slate-600">A clear progression from discovery to confident preparation.</p>
                </div>
                <div class="grid gap-8 md:grid-cols-3">
                    @foreach ($page['journey'] as [$verb, $level, $text])
                        <article class="reveal rounded-3xl border border-gray-100 bg-[#fbfaf7] p-7 text-center shadow-sm">
                            <div class="mx-auto mb-5 grid h-16 w-16 place-items-center rounded-full bg-[#a0183d] text-xl font-black text-[#f5b82e]">{{ $loop->iteration }}</div>
                            <h3 class="font-display text-2xl font-black text-[#111827]">{{ $verb }} <span class="block text-lg text-[#f5b82e]">{{ $level }}</span></h3>
                            <p class="mt-4 leading-7 text-slate-600">{{ $text }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="relative overflow-hidden bg-[#f5b82e] py-24">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 4px 4px, #111827 2px, transparent 0); background-size: 40px 40px;"></div>
        <div class="relative mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
            <h2 class="font-display text-4xl font-black text-[#111827] lg:text-5xl">Ready to Join {{ $page['crumb'] }}?</h2>
            <p class="mx-auto mt-5 max-w-2xl text-lg leading-8 text-[#111827]/75">{{ $page['cta'] }}</p>
            <div class="mt-8 flex flex-col justify-center gap-4 sm:flex-row">
                <a href="{{ route('admission') }}" class="rounded-full bg-[#a0183d] px-10 py-4 font-bold text-white shadow-xl transition hover:-translate-y-1 hover:bg-[#111827]">Apply Now</a>
                <a href="{{ route('contact') }}" class="rounded-full border-2 border-[#111827]/20 px-10 py-4 font-bold text-[#111827] transition hover:bg-white/40">Book a Visit</a>
            </div>
        </div>
    </section>
</main>
@endsection
@extends('layouts.frontend')
