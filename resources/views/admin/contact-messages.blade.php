@extends('adminlte::page')

@section('title', 'Contact Messages')

@section('content_header')
    <h1>Contact Messages</h1>
@endsection

@section('content')
@include('admin.partials.alerts')

<div class="card">
    <div class="card-body table-responsive p-0">
        <table class="table table-striped mb-0">
            <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Subject</th><th>Message</th><th width="90">Action</th></tr></thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td>{{ $item->name }}</td><td>{{ $item->email }}</td><td>{{ $item->phone }}</td><td>{{ $item->subject }}</td><td>{{ \Illuminate\Support\Str::limit($item->message, 120) }}</td>
                        <td><form method="POST" action="{{ route('admin.contact-messages.destroy', $item) }}" onsubmit="return confirm('Delete this message?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Delete</button></form></td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted">No messages yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $items->links() }}</div>
</div>
@endsection
