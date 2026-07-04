<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Result;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResultController extends Controller
{
    public function index(): View
    {
        return view('admin.results', [
            'items' => Result::query()->latest('result_date')->latest()->paginate(10),
            'item' => new Result(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Result::create($this->validated($request));

        return redirect()->route('admin.results.index')->with('success', 'Result added.');
    }

    public function edit(Result $result): View
    {
        return view('admin.results', [
            'items' => Result::query()->latest('result_date')->latest()->paginate(10),
            'item' => $result,
        ]);
    }

    public function update(Request $request, Result $result): RedirectResponse
    {
        $result->update($this->validated($request));

        return redirect()->route('admin.results.index')->with('success', 'Result updated.');
    }

    public function destroy(Result $result): RedirectResponse
    {
        $result->delete();

        return redirect()->route('admin.results.index')->with('success', 'Result deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'exam_name' => ['nullable', 'string', 'max:120'],
            'grade' => ['nullable', 'string', 'max:80'],
            'academic_year' => ['nullable', 'string', 'max:40'],
            'result_date' => ['nullable', 'date'],
            'description' => ['nullable', 'string', 'max:3000'],
            'file' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp,doc,docx,xls,xlsx', 'max:5120'],
            'external_url' => ['nullable', 'url', 'max:255'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('results', 'public');
        } else {
            unset($data['file']);
        }

        $data['is_published'] = $request->boolean('is_published');

        return $data;
    }
}
