@extends('adminlte::page')

@section('title', 'Results')

@section('content_header')
    <h1>Results</h1>
@endsection

@section('content')
@include('admin.partials.alerts')

<div class="card">
    <div class="card-header"><strong>{{ $item->exists ? 'Edit Result' : 'Add Result' }}</strong></div>
    <form method="POST" action="{{ $item->exists ? route('admin.results.update', $item) : route('admin.results.store') }}" enctype="multipart/form-data">
        @csrf
        @if ($item->exists) @method('PUT') @endif

        <div class="card-body">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Title</label>
                    <input name="title" class="form-control" value="{{ old('title', $item->title) }}" required>
                </div>

                <div class="col-md-3 form-group">
                    <label>Exam name</label>
                    <input name="exam_name" class="form-control" value="{{ old('exam_name', $item->exam_name) }}" placeholder="SEE, Terminal Exam">
                </div>

                <div class="col-md-3 form-group">
                    <label>Grade/Class</label>
                    <input name="grade" class="form-control" value="{{ old('grade', $item->grade) }}" placeholder="Class 10">
                </div>

                <div class="col-md-3 form-group">
                    <label>Academic year</label>
                    <input name="academic_year" class="form-control" value="{{ old('academic_year', $item->academic_year) }}" placeholder="2081">
                </div>

                <div class="col-md-3 form-group">
                    <label>Result date</label>
                    <input name="result_date" type="date" class="form-control" value="{{ old('result_date', optional($item->result_date)->format('Y-m-d')) }}">
                </div>

                <div class="col-md-6 form-group">
                    <label>External result URL</label>
                    <input name="external_url" type="url" class="form-control" value="{{ old('external_url', $item->external_url) }}" placeholder="https://...">
                </div>

                <div class="col-md-12 form-group">
                    <label>Upload result file</label>
                    <input name="file" type="file" accept=".pdf,.jpg,.jpeg,.png,.webp,.doc,.docx,.xls,.xlsx" class="form-control">
                    @if ($item->file)
                        <small class="d-block mt-2 text-muted">Current file: {{ $item->file }}</small>
                    @endif
                </div>

                <div class="col-md-12 form-group">
                    <label>Description</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description', $item->description) }}</textarea>
                </div>

                <div class="col-md-12 form-check ml-3">
                    <input name="is_published" value="1" type="checkbox" class="form-check-input" @checked(old('is_published', $item->is_published ?? true))>
                    <label class="form-check-label">Published on website</label>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button class="btn btn-primary">{{ $item->exists ? 'Update' : 'Save' }}</button>
            <a href="{{ route('admin.results.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

@include('admin.partials.resource-table', ['columns' => ['title' => 'Title', 'exam_name' => 'Exam', 'grade' => 'Grade', 'academic_year' => 'Year', 'is_published' => 'Published'], 'route' => 'admin.results'])
@endsection
