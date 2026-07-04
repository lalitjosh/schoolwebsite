<div class="card">
    <div class="card-header"><strong>Records</strong></div>
    <div class="card-body table-responsive p-0">
        <table class="table table-striped table-hover mb-0">
            <thead>
                <tr>
                    @foreach ($columns as $label)
                        <th>{{ $label }}</th>
                    @endforeach
                    <th width="150">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $row)
                    <tr>
                        @foreach ($columns as $key => $label)
                            <td>{{ is_bool($row->{$key}) ? ($row->{$key} ? 'Yes' : 'No') : \Illuminate\Support\Str::limit((string) $row->{$key}, 80) }}</td>
                        @endforeach
                        <td>
                            <a href="{{ route($route . '.edit', $row) }}" class="btn btn-sm btn-info">Edit</a>
                            <form method="POST" action="{{ route($route . '.destroy', $row) }}" class="d-inline" onsubmit="return confirm('Delete this record?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="{{ count($columns) + 1 }}" class="text-center text-muted">No records yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $items->links() }}</div>
</div>
