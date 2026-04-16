@extends('layouts.app')

@section('content')

<h2>Ticket Details</h2>

<p><strong>Reference:</strong> {{ $ticket->ref }}</p>
<p><strong>Name:</strong> {{ $ticket->customer_name }}</p>
<p><strong>Email:</strong> {{ $ticket->email }}</p>
<p><strong>Phone:</strong> {{ $ticket->phone }}</p>
<p><strong>Description:</strong> {{ $ticket->description }}</p>

@endsection
