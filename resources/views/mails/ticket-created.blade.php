<p>Hello {{ $ticket->customer_name }},</p>

<p>Thank you for creating a support ticket. We have received your request and will get back to you as soon as possible.</p>

<p><strong>Ticket Reference:</strong> {{ $ticket->ref }}</p>
<p><strong>Status:</strong> Open</p>

<p><strong>Your Message:</strong></p>
<p>{{ $ticket->description }}</p>

<p>You can track your ticket status at any time using your reference number above.</p>

<p>Best regards,<br>Support Team</p>