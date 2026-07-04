<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageContentController extends Controller
{
    public function index(Request $request): View
    {
        $selectedPage = $request->query('page');
        $query = PageContent::query()
            ->when($selectedPage, fn ($query) => $query->where('page', $selectedPage))
            ->orderBy('page')
            ->orderBy('sort_order');

        return view('admin.page-contents', [
            'items' => $query->paginate(12)->withQueryString(),
            'item' => new PageContent([
                'is_active' => true,
                'sort_order' => 0,
            ]),
            'pages' => PageContent::query()
                ->select('page')
                ->distinct()
                ->orderBy('page')
                ->pluck('page'),
            'selectedPage' => $selectedPage,
            'sectionGuide' => $this->sectionGuide(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        PageContent::create($this->validated($request));

        return redirect()->route('admin.page-contents.index')->with('success', 'Page section added.');
    }

    public function edit(Request $request, PageContent $pageContent): View
    {
        $selectedPage = $request->query('page');
        $query = PageContent::query()
            ->when($selectedPage, fn ($query) => $query->where('page', $selectedPage))
            ->orderBy('page')
            ->orderBy('sort_order');

        return view('admin.page-contents', [
            'items' => $query->paginate(12)->withQueryString(),
            'item' => $pageContent,
            'pages' => PageContent::query()
                ->select('page')
                ->distinct()
                ->orderBy('page')
                ->pluck('page'),
            'selectedPage' => $selectedPage,
            'sectionGuide' => $this->sectionGuide(),
        ]);
    }

    public function update(Request $request, PageContent $pageContent): RedirectResponse
    {
        $pageContent->update($this->validated($request, $pageContent));

        return redirect()->route('admin.page-contents.index')->with('success', 'Page section updated.');
    }

    public function destroy(PageContent $pageContent): RedirectResponse
    {
        $pageContent->delete();

        return redirect()->route('admin.page-contents.index')->with('success', 'Page section deleted.');
    }

    private function validated(Request $request, ?PageContent $pageContent = null): array
    {
        $data = $request->validate([
            'key' => ['required', 'string', 'max:120', 'unique:page_contents,key,' . $pageContent?->id],
            'page' => ['required', 'string', 'max:80'],
            'section' => ['required', 'string', 'max:120'],
            'eyebrow' => ['nullable', 'string', 'max:180'],
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:1000'],
            'body' => ['nullable', 'string'],
            'items_text' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'button_label' => ['nullable', 'string', 'max:120'],
            'button_url' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ]);

        $data['items'] = collect(preg_split('/\r\n|\r|\n/', $data['items_text'] ?? ''))
            ->map(fn (string $item): string => trim($item))
            ->filter()
            ->values()
            ->all();
        unset($data['items_text']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('page-sections', 'public');
        } else {
            unset($data['image']);
        }

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }

    private function sectionGuide(): array
    {
        return [
            'Home' => ['home.hero', 'home.about', 'home.features', 'home.stats', 'home.cta', 'principal.message'],
            'About' => ['about.hero', 'about.photo.1', 'about.photo.2', 'about.photo.3', 'about.photo.4', 'principal.message'],
            'Academics' => ['academics.overview', 'academics.elementary', 'academics.primary', 'academics.secondary'],
            'Admissions' => ['admissions.hero'],
            'Notice/Event' => ['news.hero'],
            'Gallery' => ['gallery.hero'],
            'Faculty' => ['faculty.hero'],
            'Contact' => ['contact.hero'],
            'Result' => ['result.hero'],
        ];
    }
}
