@extends('adminlte::page')

@section('title', 'Faculty')

@section('content_header')
    <h1>Faculty</h1>
@endsection

@section('css')
    <style>
        .faculty-photo-editor {
            background: #eef3ee;
            border: 1px solid #d7e2da;
            border-radius: 0.75rem;
            height: 280px;
            overflow: hidden;
            position: relative;
            user-select: none;
        }

        .faculty-photo-editor img {
            height: 100%;
            width: 100%;
            object-fit: contain;
        }

        .faculty-photo-empty {
            align-items: center;
            color: #6c757d;
            display: flex;
            font-weight: 600;
            height: 100%;
            justify-content: center;
            text-align: center;
        }
    </style>
@endsection

@section('content')
@include('admin.partials.alerts')

<div class="card">
    <div class="card-header"><strong>{{ $item->exists ? 'Edit Faculty' : 'Add Faculty' }}</strong></div>
    <form method="POST" action="{{ $item->exists ? route('admin.faculties.update', $item) : route('admin.faculties.store') }}" enctype="multipart/form-data">
        @csrf
        @if ($item->exists) @method('PUT') @endif
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 form-group"><label>Name</label><input name="name" class="form-control" value="{{ old('name', $item->name) }}" required></div>
                <div class="col-md-6 form-group">
                    <label>Photo</label>
                    <input name="photo" type="file" accept="image/*" class="form-control" data-faculty-photo-input>
                    <input name="photo_position_x" type="hidden" value="50">
                    <input name="photo_position_y" type="hidden" value="50">
                    <input name="photo_zoom" type="hidden" value="100">
                    <div class="faculty-photo-editor mt-3" data-faculty-photo-editor>
                        @if ($item->photo)
                            <img
                                src="{{ asset('storage/' . $item->photo) }}"
                                alt="Current faculty photo"
                                data-faculty-photo-preview
                            >
                        @else
                            <div class="faculty-photo-empty" data-faculty-photo-empty>Upload a photo to preview.</div>
                        @endif
                    </div>
                    @if ($item->photo)
                        <small class="d-block mt-2 text-muted">{{ $item->photo }}</small>
                    @endif
                    <small class="d-block mt-2 text-muted">The full original photo will fit inside the frame without cropping.</small>
                </div>
                <div class="col-md-4 form-group"><label>Designation</label><input name="designation" class="form-control" value="{{ old('designation', $item->designation) }}" required></div>
                <div class="col-md-4 form-group"><label>Qualification</label><input name="qualification" class="form-control" value="{{ old('qualification', $item->qualification) }}" required></div>
                <div class="col-md-4 form-group"><label>Department</label><input name="department" class="form-control" value="{{ old('department', $item->department) }}" required></div>
            </div>
        </div>
        <div class="card-footer"><button class="btn btn-primary">{{ $item->exists ? 'Update' : 'Save' }}</button><a href="{{ route('admin.faculties.index') }}" class="btn btn-secondary">Cancel</a></div>
    </form>
</div>

@include('admin.partials.resource-table', ['columns' => ['name' => 'Name', 'designation' => 'Designation', 'department' => 'Department'], 'route' => 'admin.faculties'])
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const editor = document.querySelector('[data-faculty-photo-editor]');
            const fileInput = document.querySelector('[data-faculty-photo-input]');

            if (! editor || ! fileInput) {
                return;
            }

            const ensurePreviewImage = (src) => {
                let image = editor.querySelector('[data-faculty-photo-preview]');

                if (! image) {
                    editor.innerHTML = '';
                    image = document.createElement('img');
                    image.alt = 'Faculty photo preview';
                    image.dataset.facultyPhotoPreview = '';
                    editor.appendChild(image);
                }

                image.src = src;
                return image;
            };

            fileInput?.addEventListener('change', (event) => {
                const file = event.target.files?.[0];

                if (! file) {
                    return;
                }

                ensurePreviewImage(URL.createObjectURL(file));
            });
        });
    </script>
@endsection
