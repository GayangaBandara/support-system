@extends('layout.app')

@section('content')
<div class="container mt-4">

    <h2 class="text-center mb-4">Support Agent Dashboard</h2>

    <!-- Search & Sort -->
    <div class="mb-4">
        <form action="{{ route('agent.tickets.index') }}" method="get">
            <div class="row align-items-center g-2">

                <div class="col-md-3">
                    <select class="form-select" name="sort">
                        <option value="customer_name" {{ request('sort', 'created_at') == 'customer_name' ? 'selected' : '' }}>Customer Name</option>
                        <option value="created_at" {{ request('sort', 'created_at') == 'created_at' ? 'selected' : '' }}>Opened Time</option>
                        <option value="updated_at" {{ request('sort') == 'updated_at' ? 'selected' : '' }}>Last Updated</option>
                        <option value="status" {{ request('sort') == 'status' ? 'selected' : '' }}>Status</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <select class="form-select" name="sort_dir">
                        <option value="asc" {{ request('sort_dir', 'desc') == 'asc' ? 'selected' : '' }}>Ascending</option>
                        <option value="desc" {{ request('sort_dir', 'desc') == 'desc' ? 'selected' : '' }}>Descending</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <input 
                        type="text" 
                        name="q" 
                        value="{{ request('q') }}" 
                        class="form-control" 
                        placeholder="Reference, customer name or phone number">
                </div>

                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>

            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-light">
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
                @forelse($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->customer_name }}</td>
                    <td>{{ $ticket->email }}</td>
                    <td>{{ $ticket->phone ?? 'N/A' }}</td>

                    <!--  UPDATED HANDLED BY -->
                    <td class="text-nowrap">
                        @if($ticket->lastCommentedAgent)
                            {{ $ticket->lastCommentedAgent->name }}
                            <span class="badge bg-primary">Agent</span>
                        @else
                            <span class="text-muted">None</span>
                        @endif
                    </td>

                    <td>
                        @if($ticket->status == 0)
                            <span class="badge bg-success px-3 py-2">Open</span>
                        @else
                            <span class="badge bg-secondary px-3 py-2">Closed</span>
                        @endif
                    </td>

                    <td>{{ $ticket->created_at->diffForHumans() }}</td>

                    <td>
                        <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-sm btn-primary px-3">
                            View
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-muted">No tickets found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-3 d-flex justify-content-center">
        {{ $tickets->appends(request()->query())->links() }}
    </div>

</div>
@endsection