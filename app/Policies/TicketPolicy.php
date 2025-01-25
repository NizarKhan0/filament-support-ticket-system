<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Auth\Access\Response;

class TicketPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('ticket_access');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Ticket $ticket): bool
    {
        return $user->hasPermission('ticket_show');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('ticket_create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Ticket $ticket): bool
    {
        //kalau nak guna authorize dgn gate , tapi kat sini dah define kt view tu hanya user yg dh asssign dgn ticket dia sendiri akan di display
        // return $user->hasPermission('ticket_edit')&& $user->id === $ticket->assigned_to;

        //boleh guna mcm ni klau nak bagi full access kat admin
        // if($user->hasRole(Role::ROLES['Admin'])){
        //     return true;
        // }else{
        //     return $user->hasPermission('ticket_edit')&& $user->id === $ticket->assigned_to;
        // }

        return $user->hasPermission('ticket_edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Ticket $ticket): bool
    {
        return $user->hasPermission('ticket_delete');
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermission('ticket_delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Ticket $ticket): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Ticket $ticket): bool
    {
        return false;
    }
}
