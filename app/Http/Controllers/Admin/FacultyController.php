<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    public function index()
    {
        return view('admin.faculties', [
            'items' => Faculty::query()->latest()->paginate(10),
            'item' => new Faculty(),
        ]);
    }

    public function store(Request $request)
    {
        Faculty::create($this->validated($request, null));

        return redirect()->route('admin.faculties.index')->with('success', 'Faculty added.');
    }

    public function edit(Faculty $faculty)
    {
        return view('admin.faculties', [
            'items' => Faculty::query()->latest()->paginate(10),
            'item' => $faculty,
        ]);
    }

    public function update(Request $request, Faculty $faculty)
    {
        $faculty->update($this->validated($request, $faculty));

        return redirect()->route('admin.faculties.index')->with('success', 'Faculty updated.');
    }

    public function destroy(Faculty $faculty)
    {
        $faculty->delete();

        return redirect()->route('admin.faculties.index')->with('success', 'Faculty deleted.');
    }

    private function validated(Request $request, ?Faculty $faculty): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'photo_position_x' => ['required', 'integer', 'min:0', 'max:100'],
            'photo_position_y' => ['required', 'integer', 'min:0', 'max:100'],
            'photo_zoom' => ['required', 'integer', 'min:60', 'max:300'],
            'designation' => ['required', 'string', 'max:120'],
            'qualification' => ['required', 'string', 'max:120'],
            'department' => ['required', 'string', 'max:120'],
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('faculty', 'public');
        } else {
            unset($data['photo']);
        }

        return $data;
    }
}
