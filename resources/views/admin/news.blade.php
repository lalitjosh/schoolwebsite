@extends('adminlte::page')

@section('title', 'News')

@section('content_header')
    <h1>News</h1>
@endsection

@section('content')
@include('admin.partials.alerts')

<div class="card">
    <div class="card-header"><strong>{{ $item->exists ? 'Edit News' : 'Add News' }}</strong></div>
    <form method="POST" action="{{ $item->exists ? route('admin.news.update', $item) : route('admin.news.store') }}" enctype="multipart/form-data">
        @csrf
        @if ($item->exists) @method('PUT') @endif
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 form-group"><label>Title</label><input name="title" class="form-control" value="{{ old('title', $item->title) }}" required></div>
                <div class="col-md-6 form-group"><label>Slug</label><input name="slug" class="form-control" value="{{ old('slug', $item->slug) }}" placeholder="auto generated if blank"></div>
                <div class="col-md-12 form-group">
                    <label>Featured image</label>
                    <input name="featured_image" type="file" accept="image/*" class="form-control">
                    @if ($item->featured_image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $item->featured_image) }}" alt="Current featured image" style="height: 70px; max-width: 160px; object-fit: cover;">
                            <small class="d-block text-muted">{{ $item->featured_image }}</small>
                        </div>
                    @endif
                </div>
                <div class="col-md-12 form-group"><label>Content</label><textarea name="content" rows="6" class="form-control" required>{{ old('content', $item->content) }}</textarea></div>
                <div class="col-md-12 form-check ml-3"><input name="featured" value="1" type="checkbox" class="form-check-input" @checked(old('featured', $item->featured ?? false))><label class="form-check-label">Featured</label></div>
            </div>
        </div>
        <div class="card-footer"><button class="btn btn-primary">{{ $item->exists ? 'Update' : 'Save' }}</button><a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Cancel</a></div>
    </form>
</div>

@include('admin.partials.resource-table', ['columns' => ['title' => 'Title', 'slug' => 'Slug', 'featured' => 'Featured'], 'route' => 'admin.news'])
@endsection
