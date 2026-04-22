@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h2>Support Agent Dashboard</h2>

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