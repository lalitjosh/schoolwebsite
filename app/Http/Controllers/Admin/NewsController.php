<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        return view('admin.news', [
            'items' => News::query()->latest()->paginate(10),
            'item' => new News(),
        ]);
    }

    public function store(Request $request)
    {
        News::create($this->validated($request));

        return redirect()->route('admin.news.index')->with('success', 'News added.');
    }

    public function edit(News $news)
    {
        return view('admin.news', [
            'items' => News::query()->latest()->paginate(10),
            'item' => $news,
        ]);
    }

    public function update(Request $request, News $news)
    {
        $news->update($this->validated($request, $news));

        return redirect()->route('admin.news.index')->with('success', 'News updated.');
    }

    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'News deleted.');
    }

    private function validated(Request $request, ?News $news = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'slug' => ['nullable', 'string', 'max:200'],
            'featured_image' => ['nullable', 'image', 'max:2048'],
            'content' => ['required', 'string'],
            'featured' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('news', 'public');
        } else {
            unset($data['featured_image']);
        }

        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['featured'] = $request->boolean('featured');

        return $data;
    }
}
