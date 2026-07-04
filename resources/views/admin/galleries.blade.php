@extends('adminlte::page')

@section('title', 'Galleries')

@section('content_header')
    <h1>Galleries</h1>
@endsection

@section('content')
@include('admin.partials.alerts')

<div class="card">
    <div class="card-header"><strong>{{ $item->exists ? 'Edit Gallery' : 'Add Gallery' }}</strong></div>
    <form method="POST" action="{{ $item->exists ? route('admin.galleries.update', $item) : route('admin.galleries.store') }}" enctype="multipart/form-data">
        @csrf
        @if ($item->exists) @method('PUT') @endif
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 form-group"><label>Title</label><input name="title" class="form-control" value="{{ old('title', $item->title) }}" required></div>
                <div class="col-md-6 form-group">
                    <label>Cover image</label>
                    <input name="cover_image" type="file" accept="image/*" class="form-control">
                    @if ($item->cover_image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $item->cover_image) }}" alt="Current gallery cover" style="height: 70px; max-width: 160px; object-fit: cover;">
                            <small class="d-block text-muted">{{ $item->cover_image }}</small>
                        </div>
                    @endif
                </div>
                <div class="col-md-12 form-group"><label>Description</label><textarea name="description" rows="4" class="form-control">{{ old('description', $item->description) }}</textarea></div>
            </div>
        </div>
        <div class="card-footer"><button class="btn btn-primary">{{ $item->exists ? 'Update' : 'Save' }}</button><a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">Cancel</a></div>
    </form>
</div>

@include('admin.partials.resource-table', ['columns' => ['title' => 'Title', 'cover_image' => 'Cover Image', 'description' => 'Description'], 'route' => 'admin.galleries'])
@endsection
