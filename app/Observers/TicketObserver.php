<?php

namespace App\Observers;

use App\Models\Ticket;
use Filament\Notifications\Notification;
use App\Notifications\TicketCreatedNotification;

class TicketObserver
{
    /**
     * Handle the Ticket "created" event.
     */
    public function created(Ticket $ticket): void
    {

        // Additional Checks
        // Queues: If you are using queues, make sure the queue worker is running. Use php artisan queue:work or php artisan queue:listen.
        // Environment: Ensure you're not in a read-only environment (e.g., production database).

        // Get the assigned user from the relationship
        $assignedTo = $ticket->assignedTo; // This resolves to the User model instance

            // Send a notification to the database for the assigned user
            Notification::make()
            ->title('A new ticket has been created and assigned to you.')
            ->sendToDatabase($assignedTo);

    }

    //ini cara kedua yg work dia guna alternatif notification dari laravel
    // public function created(Ticket $ticket): void
    // {
    //     $assignedTo = $ticket->assignedTo;

    //     if ($assignedTo) {
    //         $assignedTo->notify(new TicketCreatedNotification($ticket));
    //     }
    // }
}