<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        return view('admin.galleries', [
            'items' => Gallery::query()->latest()->paginate(10),
            'item' => new Gallery(),
        ]);
    }

    public function store(Request $request)
    {
        Gallery::create($this->validated($request, null));

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery added.');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries', [
            'items' => Gallery::query()->latest()->paginate(10),
            'item' => $gallery,
        ]);
    }

    public function update(Request $request, Gallery $gallery)
    {
        $gallery->update($this->validated($request, $gallery));

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery updated.');
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery deleted.');
    }

    private function validated(Request $request, ?Gallery $gallery): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'cover_image' => ['nullable', 'image', 'max:2048'],
            'description' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('gallery', 'public');
        } else {
            unset($data['cover_image']);
        }

        return $data;
    }
}
