@extends('layout.app')

@section('content')

<h2 class="text-center mb-4">Support Ticket</h2>

<div class="card mb-4">
    <div class="card-body">
        <table class="table table-sm">
            <tr>
                <th>Name:</th>
                <td>{{ $ticket->customer_name }}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{ $ticket->email }}</td>
            </tr>
            <tr>
                <th>Phone:</th>
                <td>{{ $ticket->phone ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Reference:</th>
                <td>{{ $ticket->ref }}</td>
            </tr>
            <tr>
                <th>Status:</th>
                <td>
                    @if($ticket->status == 0)
                        <span class="badge bg-info">Open</span>
                    @else
                        <span class="badge bg-success">Closed</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Description:</th>
                <td>{{ $ticket->description }}</td>
            </tr>
        </table>
    </div>
</div>

<!-- NEW COMMENTS SECTION (Below Ticket Details) -->
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Replies</h5>
    </div>

    <div class="card-body">

        <!-- Show replies -->
        @forelse($ticket->comments as $comment)
            <div class="border-bottom pb-3 mb-3">
                <strong class="d-block">
                    {{ $comment->user ? $comment->user->name : 'Customer' }}
                </strong>
                <small class="text-muted d-block">
                    {{ $comment->created_at->diffForHumans() }}
                </small>

                <p class="mt-2 mb-0">{{ $comment->content }}</p>
            </div>
        @empty
            <p class="text-muted">No replies yet.</p>
        @endforelse

    </div>
</div>


<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Add Reply</h5>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('comments.store') }}">
            @csrf

            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

            <div class="mb-3">
                <textarea name="content" class="form-control" rows="4" placeholder="Write your reply..." required></textarea>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-success">Send Reply</button>
            </div>
        </form>
    </div>
</div>

<div class="mt-3">
    <a href="/" class="btn btn-outline-secondary">Back</a>
</div>

@endsection