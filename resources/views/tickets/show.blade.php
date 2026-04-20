<!DOCTYPE html>
<html>
<head>
    <title>Ticket Details</title>
</head>
<body>

<h1>Ticket Details</h1>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

<p><strong>Name:</strong> {{ $ticket->customer_name }}</p>
<p><strong>Email:</strong> {{ $ticket->email }}</p>
<p><strong>Phone:</strong> {{ $ticket->phone }}</p>
<p><strong>Description:</strong> {{ $ticket->description }}</p>
<p><strong>Reference:</strong> {{ $ticket->ref }}</p>
<p><strong>Status:</strong> 
    {{ $ticket->status == 0 ? 'Open' : 'Closed' }}
</p>

<hr>

<h4>Add Reply</h4>

<form action="{{ route('replies.store', $ticket->id) }}" method="post">
    @csrf

    <textarea name="message" placeholder="Write your reply..." required></textarea><br><br>

    <button type="submit">Send Reply</button>
</form>

<hr>

<h4>Replies</h4>

@forelse($ticket->replies as $reply)
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
        <strong>{{ $reply->user->name ?? 'Agent' }}</strong>
        <p>{{ $reply->message }}</p>
    </div>
@empty
    <p>No replies yet.</p>
@endforelse

<br>
<a href="/">Back</a>

</body>
</html>