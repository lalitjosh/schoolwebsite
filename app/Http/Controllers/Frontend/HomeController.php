<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AdmissionInquiry;
use App\Models\ContactMessage;
use App\Models\Event;
use App\Models\Faculty;
use App\Models\Gallery;
use App\Models\HeroSlider;
use App\Models\News;
use App\Models\Notice;
use App\Models\PageContent;
use App\Models\Result;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home', [
            'setting' => Setting::query()->latest()->first(),
            'heroSlides' => HeroSlider::query()
                ->where('status', true)
                ->orderBy('sort_order')
                ->latest()
                ->take(3)
                ->get(),
            'notices' => Notice::query()
                ->latest('publish_date')
                ->take(4)
                ->get(),
            'latestNotices' => Notice::query()
                ->latest('publish_date')
                ->take(4)
                ->get(),
            'newsItems' => News::query()
                ->latest()
                ->take(3)
                ->get(),
            'events' => Event::query()
                ->orderBy('event_date')
                ->take(3)
                ->get(),
            'faculties' => Faculty::query()
                ->latest()
                ->take(4)
                ->get(),
            'galleries' => Gallery::query()
                ->with('images')
                ->latest()
                ->take(3)
                ->get(),
            'testimonials' => Testimonial::query()
                ->latest()
                ->take(2)
                ->get(),
            'content' => $this->pageContent(),
        ]);
    }

    public function about()
    {
        return view('frontend.about', $this->sharedViewData());
    }

    public function academics()
    {
        return view('frontend.academics', $this->sharedViewData([
            'program' => $this->academicProgram('academics.overview', [
                'eyebrow' => 'Academics',
                'title' => 'Learning that balances fundamentals, projects, and exam readiness.',
                'level' => 'PG to Grade 10',
                'description' => 'Cambridge Public School supports students through early learning, middle school foundations, and high school preparation.',
                'features' => ['Kids School: Nursery - Grade 3', 'Middle School: Grade 4 - 8', 'High School: Grade 9 - 12', 'Practical learning and projects', 'Co-curricular activities', 'Guidance and mentoring'],
            ]),
        ]));
    }

    public function academicsElementary()
    {
        return view('frontend.academics', $this->sharedViewData([
            'program' => $this->academicProgram('academics.elementary', [
                'eyebrow' => 'Kids School',
                'title' => 'A joyful foundation for early learners.',
                'level' => 'Nursery - Grade 3',
                'description' => 'Young children learn through stories, numbers, movement, art, play, habits, and guided discovery.',
                'features' => ['Phonics and early literacy', 'Number sense and patterns', 'Creative expression', 'Social confidence', 'Daily routines and values', 'Play-based assessment'],
            ]),
        ]));
    }

    public function academicsPrimary()
    {
        return view('frontend.academics', $this->sharedViewData([
            'program' => $this->academicProgram('academics.primary', [
                'eyebrow' => 'Middle School',
                'title' => 'Strong fundamentals with practical exploration.',
                'level' => 'Grade 4 - 8',
                'description' => 'Students build language, mathematics, science, social studies, computing, teamwork, and presentation confidence.',
                'features' => ['Project-based learning', 'Reading and writing habits', 'STEM activities', 'Computer literacy', 'Clubs and competitions', 'Regular academic support'],
            ]),
        ]));
    }

    public function academicsSecondary()
    {
        return view('frontend.academics', $this->sharedViewData([
            'program' => $this->academicProgram('academics.secondary', [
                'eyebrow' => 'High School',
                'title' => 'Focused preparation for exams, leadership, and future study.',
                'level' => 'Grade 9 - 12',
                'description' => 'Senior students receive subject depth, lab exposure, exam practice, mentoring, and career counseling.',
                'features' => ['SEE and board preparation', 'Science and computer labs', 'Career counseling', 'Leadership activities', 'Debate and presentations', 'Stream selection guidance'],
            ]),
        ]));
    }

    public function admission()
    {
        return view('frontend.admission', $this->sharedViewData());
    }

    public function gallery()
    {
        return view('frontend.gallery', $this->sharedViewData([
            'galleries' => Gallery::query()
                ->with('images')
                ->latest()
                ->take(12)
                ->get(),
        ]));
    }

    public function news()
    {
        return view('frontend.news', $this->sharedViewData([
            'newsItems' => News::query()
                ->latest()
                ->take(12)
                ->get(),
            'events' => Event::query()
                ->orderBy('event_date')
                ->take(10)
                ->get(),
            'notices' => Notice::query()
                ->latest('publish_date')
                ->take(8)
                ->get(),
        ]));
    }

    public function faculty()
    {
        return view('frontend.faculty', $this->sharedViewData([
            'faculties' => Faculty::query()
                ->latest()
                ->take(24)
                ->get(),
        ]));
    }

    public function result()
    {
        return view('frontend.result', $this->sharedViewData([
            'results' => Result::query()
                ->where('is_published', true)
                ->latest('result_date')
                ->latest()
                ->take(20)
                ->get(),
        ]));
    }

    public function contactPage()
    {
        return view('frontend.contact', $this->sharedViewData());
    }

    public function contact(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:30'],
            'subject' => ['required', 'string', 'max:180'],
            'message' => ['required', 'string', 'max:3000'],
        ]);

        ContactMessage::create($validated);

        return redirect(route('home') . '#contact')
            ->with('success', 'Your message has been sent. We will contact you soon.');
    }

    public function admissionInquiry(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'student_name' => ['required', 'string', 'max:120'],
            'dob' => ['required', 'date'],
            'gender' => ['required', 'string', 'max:30'],
            'parent_name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:150'],
            'grade' => ['required', 'string', 'max:50'],
            'previous_school' => ['nullable', 'string', 'max:150'],
            'message' => ['nullable', 'string', 'max:3000'],
        ]);

        AdmissionInquiry::create($validated);

        return redirect(route('home') . '#admission')
            ->with('success', 'Admission inquiry received. Our team will follow up with you.');
    }

    private function sharedViewData(array $extra = []): array
    {
        return array_merge([
            'setting' => Setting::query()->latest()->first(),
            'latestNotices' => Notice::query()
                ->latest('publish_date')
                ->take(4)
                ->get(),
            'faculties' => Faculty::query()
                ->latest()
                ->take(8)
                ->get(),
            'content' => $this->pageContent(),
        ], $extra);
    }

    private function pageContent(): \Illuminate\Support\Collection
    {
        return PageContent::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->keyBy('key');
    }

    private function academicProgram(string $key, array $defaults): array
    {
        $section = PageContent::query()
            ->where('key', $key)
            ->where('is_active', true)
            ->first();

        if (! $section) {
            return $defaults;
        }

        return [
            'eyebrow' => $section->eyebrow ?: $defaults['eyebrow'],
            'title' => $section->title ?: $defaults['title'],
            'level' => $section->subtitle ?: $defaults['level'],
            'description' => $section->body ?: $defaults['description'],
            'features' => $section->items ?: $defaults['features'],
            'image' => $section->image,
        ];
    }
}
