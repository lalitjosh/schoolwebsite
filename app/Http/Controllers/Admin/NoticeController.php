<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index()
    {
        return view('admin.notices', [
            'items' => Notice::query()->latest('publish_date')->paginate(10),
            'item' => new Notice(),
        ]);
    }

    public function store(Request $request)
    {
        Notice::create($this->validated($request));

        return redirect()->route('admin.notices.index')->with('success', 'Notice added.');
    }

    public function edit(Notice $notice)
    {
        return view('admin.notices', [
            'items' => Notice::query()->latest('publish_date')->paginate(10),
            'item' => $notice,
        ]);
    }

    public function update(Request $request, Notice $notice)
    {
        $notice->update($this->validated($request));

        return redirect()->route('admin.notices.index')->with('success', 'Notice updated.');
    }

    public function destroy(Notice $notice)
    {
        $notice->delete();

        return redirect()->route('admin.notices.index')->with('success', 'Notice deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'content' => ['required', 'string'],
            'publish_date' => ['required', 'date'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('notices', 'public');
        } else {
            unset($data['image']);
        }

        return $data;
    }
}
