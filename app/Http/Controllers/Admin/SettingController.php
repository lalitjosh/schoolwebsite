<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SchoolSettingsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function edit(SchoolSettingsService $settings): View
    {
        return view('admin.settings', [
            'setting' => $settings->current(),
        ]);
    }

    public function update(Request $request, SchoolSettingsService $settings): RedirectResponse
    {
        $data = $request->validate([
            'school_name' => ['required', 'string', 'max:180'],
            'tagline' => ['nullable', 'string', 'max:180'],
            'established_year' => ['nullable', 'string', 'max:40'],
            'phone' => ['nullable', 'string', 'max:40'],
            'email' => ['nullable', 'email', 'max:180'],
            'address' => ['nullable', 'string', 'max:1000'],
            'map_embed_url' => ['nullable', 'url', 'max:1000'],
            'map_external_url' => ['nullable', 'url', 'max:255'],
            'facebook' => ['nullable', 'url', 'max:255'],
            'instagram' => ['nullable', 'url', 'max:255'],
            'youtube' => ['nullable', 'url', 'max:255'],
            'footer_about' => ['nullable', 'string', 'max:1000'],
            'footer_credit' => ['nullable', 'string', 'max:180'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'favicon' => ['nullable', 'file', 'mimes:ico,png,jpg,jpeg,svg,webp', 'max:1024'],
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('settings', 'public');
        } else {
            unset($data['logo']);
        }

        if ($request->hasFile('favicon')) {
            $data['favicon'] = $request->file('favicon')->store('settings', 'public');
        } else {
            unset($data['favicon']);
        }

        $settings->update($data);

        return redirect()->route('admin.settings.edit')->with('success', 'Website settings updated.');
    }
}
