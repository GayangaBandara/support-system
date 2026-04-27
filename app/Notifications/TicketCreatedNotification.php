<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Ticket $ticket)
    {
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Ticket Created Successfully - Reference: ' . $this->ticket->ref)
            ->greeting('Hello ' . $this->ticket->customer_name . ',')
            ->line('Your support ticket has been created successfully.')
            ->line('Ticket Reference: ' . $this->ticket->ref)
            ->line('Description: ' . $this->ticket->description)
            ->action('View Your Ticket', url('/tickets/' . $this->ticket->id))
            ->line('Thank you for contacting support. We will get back to you soon.');
    }
}
