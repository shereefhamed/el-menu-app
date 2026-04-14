<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
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
    public function view(User $user, Category $category): bool
    {
        return $user->isAdmin() || $category->restaurant->user->id == $user->id;
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

            $numberOfAllowdCategories = $user->subscription->plan->numberOfCategories();
            $numberOfcategories = $user->restaurant->categories?->count() ?? 0;
            if ($numberOfcategories < $numberOfAllowdCategories) {
                return Response::allow();
            }

        }
        return Response::deny('You have exceeded the allowed number of categories');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Category $category): bool
    {
        return $user->isAdmin() || $category->restaurant->user->id == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Category $category): bool
    {
        return $user->isAdmin() || $category->restaurant->user->id == $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Category $category): bool
    {
        return $user->isAdmin() || $category->restaurant->user->id == $user->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Category $category): bool
    {
        return $user->isAdmin() || $category->restaurant->user->id == $user->id;
    }
}
