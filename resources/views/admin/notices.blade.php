@extends('adminlte::page')

@section('title', 'Notices')

@section('content_header')
    <h1>Notices</h1>
@endsection

@section('content')
@include('admin.partials.alerts')

<div class="card">
    <div class="card-header"><strong>{{ $item->exists ? 'Edit Notice' : 'Add Notice' }}</strong></div>
    <form method="POST" action="{{ $item->exists ? route('admin.notices.update', $item) : route('admin.notices.store') }}" enctype="multipart/form-data">
        @csrf
        @if ($item->exists) @method('PUT') @endif
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 form-group"><label>Title</label><input name="title" class="form-control" value="{{ old('title', $item->title) }}" required></div>
                <div class="col-md-4 form-group"><label>Publish date</label><input name="publish_date" type="date" class="form-control" value="{{ old('publish_date', optional($item->publish_date)->format('Y-m-d')) }}" required></div>
                <div class="col-md-6 form-group">
                    <label>Notice photo</label>
                    <input name="image" type="file" accept="image/*" class="form-control">
                    @if ($item->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="Current notice photo" style="height: 90px; max-width: 220px; object-fit: cover;">
                            <small class="d-block text-muted">{{ $item->image }}</small>
                        </div>
                    @endif
                </div>
                <div class="col-md-12 form-group"><label>Content</label><textarea name="content" rows="4" class="form-control" required>{{ old('content', $item->content) }}</textarea></div>
            </div>
        </div>
        <div class="card-footer"><button class="btn btn-primary">{{ $item->exists ? 'Update' : 'Save' }}</button><a href="{{ route('admin.notices.index') }}" class="btn btn-secondary">Cancel</a></div>
    </form>
</div>

@include('admin.partials.resource-table', ['columns' => ['title' => 'Title', 'publish_date' => 'Date', 'image' => 'Photo', 'content' => 'Content'], 'route' => 'admin.notices'])
@endsection
