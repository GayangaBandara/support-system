<?php

namespace App\Listeners;

use App\Events\TicketCreated;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketCreated as TicketCreatedMail;

class SendNewTicketMail
{
    public function handle(TicketCreated $event)
    {
        if ($event->ticket->email) {
            Mail::to($event->ticket->email)
                ->send(new TicketCreatedMail($event->ticket));
        }
    }
}
