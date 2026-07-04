@extends('adminlte::page')

@section('title', 'Admission Inquiries')

@section('content_header')
    <h1>Admission Inquiries</h1>
@endsection

@section('content')
@include('admin.partials.alerts')

<div class="card">
    <div class="card-body table-responsive p-0">
        <table class="table table-striped mb-0">
            <thead><tr><th>Student</th><th>Grade</th><th>Parent</th><th>Phone</th><th>Email</th><th>Previous School</th><th width="90">Action</th></tr></thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td>{{ $item->student_name }}</td><td>{{ $item->grade }}</td><td>{{ $item->parent_name }}</td><td>{{ $item->phone }}</td><td>{{ $item->email }}</td><td>{{ $item->previous_school }}</td>
                        <td><form method="POST" action="{{ route('admin.admission-inquiries.destroy', $item) }}" onsubmit="return confirm('Delete this inquiry?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Delete</button></form></td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted">No inquiries yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $items->links() }}</div>
</div>
@endsection
