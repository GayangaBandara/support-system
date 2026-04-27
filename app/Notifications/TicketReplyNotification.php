<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketReplyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Comment $comment)
    {
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Reply on Your Support Ticket - ' . $this->comment->ticket->ref)
            ->greeting('Hello ' . $this->comment->ticket->customer_name . ',')
            ->line('There is a new reply on your support ticket.')
            ->line('Reply: ' . $this->comment->content)
            ->action('View Ticket', url('/tickets/' . $this->comment->ticket->id))
            ->line('Thank you for using our support system.');
    }
}
