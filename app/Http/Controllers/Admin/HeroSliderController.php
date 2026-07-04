<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlider;
use Illuminate\Http\Request;

class HeroSliderController extends Controller
{
    public function index()
    {
        return view('admin.hero-sliders', [
            'items' => HeroSlider::query()->orderBy('sort_order')->latest()->paginate(10),
            'item' => new HeroSlider(),
        ]);
    }

    public function store(Request $request)
    {
        HeroSlider::create($this->validated($request, null));

        return redirect()->route('admin.hero-sliders.index')->with('success', 'Hero slide added.');
    }

    public function edit(HeroSlider $heroSlider)
    {
        return view('admin.hero-sliders', [
            'items' => HeroSlider::query()->orderBy('sort_order')->latest()->paginate(10),
            'item' => $heroSlider,
        ]);
    }

    public function update(Request $request, HeroSlider $heroSlider)
    {
        $heroSlider->update($this->validated($request, $heroSlider));

        return redirect()->route('admin.hero-sliders.index')->with('success', 'Hero slide updated.');
    }

    public function destroy(HeroSlider $heroSlider)
    {
        $heroSlider->delete();

        return redirect()->route('admin.hero-sliders.index')->with('success', 'Hero slide deleted.');
    }

    private function validated(Request $request, ?HeroSlider $heroSlider): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'subtitle' => ['nullable', 'string', 'max:500'],
            'image' => [$heroSlider?->exists ? 'nullable' : 'required', 'image', 'max:2048'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'status' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('hero', 'public');
        } elseif ($heroSlider?->exists) {
            unset($data['image']);
        }

        $data['status'] = $request->boolean('status');

        return $data;
    }
}
