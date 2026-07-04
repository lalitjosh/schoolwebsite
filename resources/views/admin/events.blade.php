@extends('adminlte::page')

@section('title', 'Events')

@section('content_header')
    <h1>Events</h1>
@endsection

@section('content')
@include('admin.partials.alerts')

<div class="card">
    <div class="card-header"><strong>{{ $item->exists ? 'Edit Event' : 'Add Event' }}</strong></div>
    <form method="POST" action="{{ $item->exists ? route('admin.events.update', $item) : route('admin.events.store') }}" enctype="multipart/form-data">
        @csrf
        @if ($item->exists) @method('PUT') @endif
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 form-group"><label>Title</label><input name="title" class="form-control" value="{{ old('title', $item->title) }}" required></div>
                <div class="col-md-3 form-group"><label>Date</label><input name="event_date" type="date" class="form-control" value="{{ old('event_date', optional($item->event_date)->format('Y-m-d')) }}"></div>
                <div class="col-md-3 form-group"><label>Location</label><input name="location" class="form-control" value="{{ old('location', $item->location) }}"></div>
                <div class="col-md-12 form-group">
                    <label>Image</label>
                    <input name="image" type="file" accept="image/*" class="form-control">
                    @if ($item->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="Current event image" style="height: 70px; max-width: 160px; object-fit: cover;">
                            <small class="d-block text-muted">{{ $item->image }}</small>
                        </div>
                    @endif
                </div>
                <div class="col-md-12 form-group"><label>Description</label><textarea name="description" rows="4" class="form-control">{{ old('description', $item->description) }}</textarea></div>
            </div>
        </div>
        <div class="card-footer"><button class="btn btn-primary">{{ $item->exists ? 'Update' : 'Save' }}</button><a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancel</a></div>
    </form>
</div>

@include('admin.partials.resource-table', ['columns' => ['title' => 'Title', 'event_date' => 'Date', 'location' => 'Location'], 'route' => 'admin.events'])
@endsection
