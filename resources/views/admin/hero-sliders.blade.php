@extends('adminlte::page')

@section('title', 'Hero Sliders')

@section('content_header')
    <h1>Hero Sliders</h1>
@endsection

@section('content')
@include('admin.partials.alerts')

<div class="card">
    <div class="card-header"><strong>{{ $item->exists ? 'Edit Slide' : 'Add Slide' }}</strong></div>
    <form method="POST" action="{{ $item->exists ? route('admin.hero-sliders.update', $item) : route('admin.hero-sliders.store') }}" enctype="multipart/form-data">
        @csrf
        @if ($item->exists) @method('PUT') @endif
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 form-group"><label>Title</label><input name="title" class="form-control" value="{{ old('title', $item->title) }}" required></div>
                <div class="col-md-6 form-group">
                    <label>Image</label>
                    <input name="image" type="file" accept="image/*" class="form-control" @required(! $item->exists)>
                    @if ($item->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="Current hero image" style="height: 70px; max-width: 160px; object-fit: cover;">
                            <small class="d-block text-muted">{{ $item->image }}</small>
                        </div>
                    @endif
                </div>
                <div class="col-md-9 form-group"><label>Subtitle</label><input name="subtitle" class="form-control" value="{{ old('subtitle', $item->subtitle) }}"></div>
                <div class="col-md-3 form-group"><label>Sort order</label><input name="sort_order" type="number" min="0" class="form-control" value="{{ old('sort_order', $item->sort_order ?? 0) }}" required></div>
                <div class="col-md-12 form-check ml-3"><input name="status" value="1" type="checkbox" class="form-check-input" @checked(old('status', $item->status ?? true))><label class="form-check-label">Active</label></div>
            </div>
        </div>
        <div class="card-footer"><button class="btn btn-primary">{{ $item->exists ? 'Update' : 'Save' }}</button><a href="{{ route('admin.hero-sliders.index') }}" class="btn btn-secondary">Cancel</a></div>
    </form>
</div>

@include('admin.partials.resource-table', ['columns' => ['title' => 'Title', 'image' => 'Image', 'sort_order' => 'Order', 'status' => 'Active'], 'route' => 'admin.hero-sliders'])
@endsection
