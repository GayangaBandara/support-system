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

<a href="/">Back</a>

</body>
</html>