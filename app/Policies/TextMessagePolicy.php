<?php

namespace App\Policies;

use App\Models\TextMessage;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TextMessagePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //test
        return $user->hasPermission('text_message_access');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TextMessage $textMessage): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TextMessage $textMessage): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TextMessage $textMessage): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TextMessage $textMessage): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TextMessage $textMessage): bool
    {
        return false;
    }
}
