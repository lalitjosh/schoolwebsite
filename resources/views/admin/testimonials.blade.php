@extends('adminlte::page')

@section('title', 'Testimonials')

@section('content_header')
    <h1>Testimonials</h1>
@endsection

@section('content')
@include('admin.partials.alerts')

<div class="card">
    <div class="card-header"><strong>{{ $item->exists ? 'Edit Testimonial' : 'Add Testimonial' }}</strong></div>
    <form method="POST" action="{{ $item->exists ? route('admin.testimonials.update', $item) : route('admin.testimonials.store') }}" enctype="multipart/form-data">
        @csrf
        @if ($item->exists) @method('PUT') @endif
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 form-group"><label>Name</label><input name="name" class="form-control" value="{{ old('name', $item->name) }}" required></div>
                <div class="col-md-4 form-group"><label>Designation</label><input name="designation" class="form-control" value="{{ old('designation', $item->designation) }}" required></div>
                <div class="col-md-4 form-group">
                    <label>Photo</label>
                    <input name="photo" type="file" accept="image/*" class="form-control">
                    @if ($item->photo)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $item->photo) }}" alt="Current testimonial photo" style="height: 70px; max-width: 160px; object-fit: cover;">
                            <small class="d-block text-muted">{{ $item->photo }}</small>
                        </div>
                    @endif
                </div>
                <div class="col-md-12 form-group"><label>Message</label><textarea name="message" rows="4" class="form-control" required>{{ old('message', $item->message) }}</textarea></div>
            </div>
        </div>
        <div class="card-footer"><button class="btn btn-primary">{{ $item->exists ? 'Update' : 'Save' }}</button><a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Cancel</a></div>
    </form>
</div>

@include('admin.partials.resource-table', ['columns' => ['name' => 'Name', 'designation' => 'Designation', 'message' => 'Message'], 'route' => 'admin.testimonials'])
@endsection
