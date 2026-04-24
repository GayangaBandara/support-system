@extends('layout.app')

@section('content')

<h2 class="text-center mb-4">Support Ticket</h2>

<!-- Ticket Details -->
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

<!-- Replies Section -->
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Replies</h5>
    </div>

    <div class="card-body">

        @if($ticket->comments->isNotEmpty())

            @foreach($ticket->comments as $comment)
                <div class="border-bottom pb-3 mb-3 {{ $comment->user ? 'bg-light p-2 rounded' : '' }}">

                    <div class="text-muted small">
                        <strong>
                            @if($comment->user)
                                {{ $comment->user->name }}
                                <span class="badge bg-primary">Agent</span>
                            @else
                                {{ $ticket->customer_name }}
                                <span class="badge bg-secondary">Customer</span>
                            @endif
                        </strong>

                        <span class="ms-2">
                            {{ $comment->created_at->format('d M Y h:i A') }}
                        </span>
                    </div>

                    <p class="mt-2 mb-0">{{ $comment->content }}</p>

                </div>
            @endforeach

        @else
            <p class="text-muted">No replies yet.</p>
        @endif

    </div>
</div>

<!-- Add Reply -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Add Reply</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf

            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

            <div class="mb-3">
                <textarea 
                    name="content" 
                    class="form-control" 
                    rows="3" 
                    placeholder="Enter your reply"
                    required
                >{{ old('content') }}</textarea>

                @error('content')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-success mt-2">Add Reply</button>
        </form>
    </div>
</div>

<!-- Back Button -->
<div class="mt-3">
    <a href="/" class="btn btn-outline-secondary">Back</a>
</div>

@endsection