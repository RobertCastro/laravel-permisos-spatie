<?php

namespace App\Policies;

use App\Models\Program;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProgramPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('list programs');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Program  $Program
     * @return mixed
     */
    public function view(User $user, Program $program)
    {
        if ($user->can('show programs')) return true;

        return $user->id === $program->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create programs');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Program  $Program
     * @return mixed
     */
    public function update(User $user, Program $program)
    {
        if ($user->can('update own programs')) {
            return $user->id === $program->user_id;
        }

        return $user->can('update programs');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Program  $Program
     * @return mixed
     */
    public function delete(User $user, Program $program)
    {
        if ($user->can('delete own programs')) {
            return $user->id === $program->user_id;
        }

        return $user->can('delete programs');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Program  $Program
     * @return mixed
     */
    public function restore(User $user, Program $program)
    {
        if ($user->can('restore own programs')) {
            return $user->id === $program->user_id;
        }

        return $user->can('restore programs');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Program  $Program
     * @return mixed
     */
    public function forceDelete(User $user, Program $program)
    {
        //
    }
}
