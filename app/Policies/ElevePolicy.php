<?php

namespace App\Policies;

use App\Models\Eleve;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ElevePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Eleve  $eleve
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Eleve $eleve)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Eleve  $eleve
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Eleve $eleve)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Eleve  $eleve
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Eleve $eleve)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Eleve  $eleve
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Eleve $eleve)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Eleve  $eleve
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Eleve $eleve)
    {
        //
    }

    public function notpayed(User $user, Eleve $eleve)
    {

    }
}
