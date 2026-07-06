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
use App\Models\Subscriber;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home', [
            'setting' => Setting::query()->latest()->first(),
            'heroSlides' => $this->normalizeHeroSlides(HeroSlider::query()
                ->where('status', true)
                ->orderBy('sort_order')
                ->latest()
                ->take(3)
                ->get()),
            'notices' => Notice::query()
                ->latest('publish_date')
                ->take(4)
                ->get(),
            'latestNotices' => $this->latestNoticeTickerItems(),
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
            'principal' => $this->principalFaculty(),
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
                'level' => 'PG to Grade 12',
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

    public function subscribe(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->only('email'), [
            'email' => ['required', 'email', 'max:150', 'unique:subscribers,email'],
        ], [
            'email.unique' => 'This email address is already subscribed.',
        ]);

        if ($validator->fails()) {
            return redirect(route('news') . '#subscribe')
                ->withErrors($validator)
                ->withInput();
        }

        Subscriber::create($validator->validated());

        return redirect(route('news') . '#subscribe')
            ->with('success', 'Thank you for subscribing. You will receive notice and event reminders.');
    }

    private function principalFaculty(): ?Faculty
    {
        return Faculty::query()
            ->where('designation', 'like', '%principal%')
            ->oldest('id')
            ->first();
    }
    private function sharedViewData(array $extra = []): array
    {
        return array_merge([
            'setting' => Setting::query()->latest()->first(),
            'latestNotices' => $this->latestNoticeTickerItems(),
            'faculties' => Faculty::query()
                ->latest()
                ->take(8)
                ->get(),
            'principal' => $this->principalFaculty(),
            'content' => $this->pageContent(),
        ], $extra);
    }

    private function latestNoticeTickerItems(int $limit = 4): \Illuminate\Support\Collection
    {
        return Notice::query()
            ->latest('publish_date')
            ->latest()
            ->take($limit * 3)
            ->get()
            ->unique(fn (Notice $notice) => Str::lower(trim($notice->title)))
            ->take($limit)
            ->values();
    }

    private function pageContent(): \Illuminate\Support\Collection
    {
        return PageContent::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(fn (PageContent $section) => $this->normalizePageContent($section))
            ->keyBy('key');
    }

    private function normalizeHeroSlides(\Illuminate\Support\Collection $slides): \Illuminate\Support\Collection
    {
        return $slides->map(function (HeroSlider $slide) {
            $slide->title = $this->normalizeSchoolLevelText($slide->title);
            $slide->subtitle = $this->normalizeSchoolLevelText($slide->subtitle);

            return $slide;
        });
    }

    private function normalizePageContent(PageContent $section): PageContent
    {
        foreach (['eyebrow', 'title', 'subtitle', 'body', 'button_label'] as $field) {
            $section->{$field} = $this->normalizeSchoolLevelText($section->{$field});
        }

        if (is_array($section->items)) {
            $section->items = array_map(fn ($item) => $this->normalizeSchoolLevelText($item), $section->items);
        }

        return $section;
    }

    private function normalizeSchoolLevelText(?string $value): ?string
    {
        return $value === null ? null : str_replace('PG to Grade 10', 'PG to Grade 12', $value);
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

        $section = $this->normalizePageContent($section);

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
