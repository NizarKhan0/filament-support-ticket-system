<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketCreatedNotification extends Notification
{
    use Queueable;

    //declare variable
    private $ticket;

    /**
     * Create a new notification instance.
     */
    public function __construct($ticket)
    {
        //bole juga declare guna construct ni
        $this->ticket = $ticket;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toDatabase($notifiable): array
    {
        //noify->id ni bersmaan ibarat user id
        // $ticket = Ticket::find($notifiable->id);
        return [
            'title' => 'Ticket Created',
            'message' => "A new ticket has been created and assigned to you.",
            'ticket_id' => $this->ticket->id,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}