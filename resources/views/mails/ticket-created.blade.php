<p>Hi {{ $ticket->customer_name }},</p>

<p>Your ticket has been created successfully.</p>

<p>Reference: {{ $ticket->ref }}</p>

<p>Description: {{ $ticket->description }}</p>

<p>
<a href="{{ route('tickets.show', $ticket->id) }}">
View your ticket
</a>
</p>

<p>Thank you.</p>