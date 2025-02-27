<?php

namespace App\Policies;

use App\Models\Label;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LabelPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('label_access');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Label $label): bool
    {
        return $user->hasPermission('label_show');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('label_create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Label $label): bool
    {
        return $user->hasPermission('label_edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Label $label): bool
    {
        return $user->hasPermission('label_delete');
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermission('label_delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Label $label): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Label $label): bool
    {
        return false;
    }
}