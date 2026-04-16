<!DOCTYPE html>
<html>
<head>
    <title>Ticket System</title>
</head>
<body>

<h1>Create Ticket</h1>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color:red;">{{ session('error') }}</p>
@endif

<!-- Create Ticket Form -->
<form action="{{ route('tickets.store') }}" method="POST">
    @csrf

    <input type="text" name="customer_name" placeholder="Name" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="text" name="phone" placeholder="Phone"><br><br>
    <textarea name="description" placeholder="Description" required></textarea><br><br>

    <button type="submit">Create Ticket</button>
</form>

<hr>

<h2>Search Ticket</h2>

<form action="{{ route('tickets.search') }}" method="GET">
    <input type="text" name="reference" placeholder="Enter Reference">
    <button type="submit">Search</button>
</form>

</body>
</html>