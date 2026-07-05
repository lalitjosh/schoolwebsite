@extends('adminlte::page')

@section('title', 'Subscribers')

@section('content_header')
    <h1>Subscribers</h1>
@endsection

@section('content')
<div class="container-fluid">
    @include('admin.partials.alerts')
    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-striped mb-0">
                <thead><tr><th>Email</th><th>Subscribed At</th><th>Action</th></tr></thead>
                <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->created_at?->format('M d, Y h:i A') }}</td>
                        <td><form method="POST" action="{{ route('admin.subscribers.destroy', $item) }}" onsubmit="return confirm('Delete this subscriber?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Delete</button></form></td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-center text-muted">No subscribers yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">{{ $items->links() }}</div>
    </div>
</div>
@endsection