<?php

namespace App\Policies;

use App\Models\MenuItem;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MenuItemPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isOwner();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MenuItem $menuItem): bool
    {
        return $user->isAdmin() || $menuItem->restaurant->user->id == $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
   
        if ($user->isAdmin()) {
            return Response::allow();
        }
        if ($user->isOwner()) {
            $numberOfAllowdenuItems = $user->subscription->plan->numberOfItems();
            $numberOfItems = $user->restaurant->menuItems?->count() ?? 0;
            if ($numberOfItems < $numberOfAllowdenuItems) {
                return Response::allow();
            }
        }
        return Response::deny('You have exceeded the allowed number of menu items');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MenuItem $menuItem): bool
    {
        return $user->isAdmin() || $menuItem->restaurant->user->id == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MenuItem $menuItem): bool
    {
        return $user->isAdmin() || $menuItem->restaurant->user->id == $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MenuItem $menuItem): bool
    {
        return $user->isAdmin() || $menuItem->restaurant->user->id == $user->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MenuItem $menuItem): bool
    {
        return $user->isAdmin() || $menuItem->restaurant->user->id == $user->id;
    }
}
