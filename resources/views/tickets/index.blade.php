@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h2>Support Agent Dashboard</h2>

    <!-- Search & Sort Form -->
    <div class="my-4">
        <form action="" method="get">
            <div class="row">
                <div class="col-3">
                    <select class="form-control" name="sort">
                        <option value="customer_name" {{ request('sort', 'created_at') == 'customer_name' ? 'selected' : null }}>Customer Name</option>
                        <option value="created_at" {{ request('sort', 'created_at') == 'created_at' ? 'selected' : null }}>Opened Time</option>
                        <option value="updated_at" {{ request('sort', 'created_at') == 'updated_at' ? 'selected' : null }}>Last Updated Time</option>
                        <option value="status" {{ request('sort', 'created_at') == 'status' ? 'selected' : null }}>Status</option>
                    </select>
                </div>
                <div class="col-3">
                    <select class="form-control" name="sort_dir">
                        <option value="asc" {{ request('sort_dir', 'desc') == 'asc' ? 'selected' : null }}>Ascending</option>
                        <option value="desc" {{ request('sort_dir', 'desc') == 'desc' ? 'selected' : null }}>Descending</option>
                    </select>
                </div>
                <div class="col-4">
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Reference, customer name or phone number">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </div>
            </div>
        </form>
    </div>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Handled By</th>
                <th>Status</th>
                <th>Created Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->customer_name }}</td>
                    <td>{{ $ticket->email }}</td>
                    <td>{{ $ticket->phone }}</td>

                    <td>
                        {{ $ticket->user ? $ticket->user->name : 'Not Assigned' }}
                    </td>

                    <td>
                        @if($ticket->status == 0)
                            <span class="badge bg-success">Open</span>
                        @else
                            <span class="badge bg-secondary">Closed</span>
                        @endif
                    </td>

                    <td>{{ $ticket->created_at->diffForHumans() }}</td>

                    <td>
                        <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-sm btn-primary">
                            View
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $tickets->links() }}
</div>
@endsection