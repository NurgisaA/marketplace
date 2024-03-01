<?php

namespace App\Policies;

use App\Constants\UserRoles;
use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role == UserRoles::ADMIN->value;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $user_model): bool
    {
        return $user->role == UserRoles::ADMIN->value;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role == UserRoles::ADMIN->value;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $user_model): bool
    {
        return $user->role == UserRoles::ADMIN->value;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $user_model): bool
    {
        return $user->role == UserRoles::ADMIN->value;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $user_model): bool
    {
        return $user->role == UserRoles::ADMIN->value;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $user_model): bool
    {
        return $user->role == UserRoles::ADMIN->value;
    }
}