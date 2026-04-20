<p>Hello {{ $reply->ticket->customer_name }}</p>

<p>You have a new reply for your ticket.</p>

<p>Message: {{ $reply->message }}</p>

<p>Reference: {{ $reply->ticket->ref }}</p>