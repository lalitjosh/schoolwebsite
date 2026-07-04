@extends('adminlte::page')

@section('title', 'Page Sections')

@section('content_header')
    <h1>Page Sections</h1>
@endsection

@section('content')
@include('admin.partials.alerts')

<div class="card">
    <div class="card-header"><strong>Frontend Content Manager</strong></div>
    <div class="card-body">
        <p class="mb-3 text-muted">
            Edit the copy used on the public website pages. Select a page below, then click Edit on the section you want to change.
        </p>

        <form method="GET" action="{{ route('admin.page-contents.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-4 form-group mb-md-0">
                    <label>Filter by page</label>
                    <select name="page" class="form-control" onchange="this.form.submit()">
                        <option value="">All pages</option>
                        @foreach ($pages as $page)
                            <option value="{{ $page }}" @selected($selectedPage === $page)>{{ $page }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-8 d-flex align-items-end">
                    <a href="{{ route('admin.page-contents.index') }}" class="btn btn-outline-secondary">Clear Filter</a>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-sm table-bordered mb-0">
                <thead>
                    <tr>
                        <th width="180">Page</th>
                        <th>Backend keys used by frontend</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sectionGuide as $page => $keys)
                        <tr>
                            <td><strong>{{ $page }}</strong></td>
                            <td>
                                @foreach ($keys as $key)
                                    <code class="mr-2">{{ $key }}</code>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header"><strong>{{ $item->exists ? 'Edit Section' : 'Add Section' }}</strong></div>
    <form method="POST" action="{{ $item->exists ? route('admin.page-contents.update', $item) : route('admin.page-contents.store') }}" enctype="multipart/form-data">
        @csrf
        @if ($item->exists) @method('PUT') @endif

        <div class="card-body">
            <div class="alert alert-info">
                Use these sections to edit public page copy, feature lists, buttons, and optional images. Do not change the key for existing sections unless you are also changing the frontend code.
            </div>

            <div class="row">
                <div class="col-md-4 form-group">
                    <label>Key</label>
                    <input name="key" class="form-control" value="{{ old('key', $item->key) }}" placeholder="home.hero" required>
                </div>
                <div class="col-md-4 form-group">
                    <label>Page</label>
                    <input name="page" class="form-control" value="{{ old('page', $item->page) }}" placeholder="Home" required>
                </div>
                <div class="col-md-4 form-group">
                    <label>Section</label>
                    <input name="section" class="form-control" value="{{ old('section', $item->section) }}" placeholder="Hero" required>
                </div>

                <div class="col-md-4 form-group">
                    <label>Eyebrow / Label</label>
                    <input name="eyebrow" class="form-control" value="{{ old('eyebrow', $item->eyebrow) }}">
                </div>
                <div class="col-md-8 form-group">
                    <label>Title</label>
                    <input name="title" class="form-control" value="{{ old('title', $item->title) }}">
                </div>

                <div class="col-md-12 form-group">
                    <label>Subtitle</label>
                    <textarea name="subtitle" rows="3" class="form-control">{{ old('subtitle', $item->subtitle) }}</textarea>
                </div>

                <div class="col-md-12 form-group">
                    <label>Body</label>
                    <textarea name="body" rows="5" class="form-control">{{ old('body', $item->body) }}</textarea>
                </div>

                <div class="col-md-6 form-group">
                    <label>Items / Features</label>
                    <textarea name="items_text" rows="6" class="form-control" placeholder="One item per line">{{ old('items_text', implode(PHP_EOL, $item->items ?? [])) }}</textarea>
                    <small class="text-muted">Use one item per line. These appear as cards, bullets, or feature lists depending on the page.</small>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Image</label>
                        <input name="image" type="file" accept="image/*" class="form-control">
                        @if ($item->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="Current section image" style="height: 90px; max-width: 220px; object-fit: cover;">
                                <small class="d-block text-muted">{{ $item->image }}</small>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Button Label</label>
                            <input name="button_label" class="form-control" value="{{ old('button_label', $item->button_label) }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Button URL</label>
                            <input name="button_url" class="form-control" value="{{ old('button_url', $item->button_url) }}" placeholder="/admissions">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Sort order</label>
                            <input name="sort_order" type="number" min="0" class="form-control" value="{{ old('sort_order', $item->sort_order ?? 0) }}" required>
                        </div>
                        <div class="col-md-6 form-group pt-4">
                            <div class="form-check mt-2">
                                <input name="is_active" value="1" type="checkbox" class="form-check-input" @checked(old('is_active', $item->is_active ?? true))>
                                <label class="form-check-label">Active</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button class="btn btn-primary">{{ $item->exists ? 'Update' : 'Save' }}</button>
            <a href="{{ route('admin.page-contents.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

@include('admin.partials.resource-table', ['columns' => ['key' => 'Key', 'page' => 'Page', 'section' => 'Section', 'title' => 'Title', 'is_active' => 'Active'], 'route' => 'admin.page-contents'])
@endsection
