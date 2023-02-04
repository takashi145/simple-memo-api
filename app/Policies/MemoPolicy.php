<?php

namespace App\Policies;

use App\Models\Memo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class MemoPolicy
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
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Memo  $memo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Memo $memo)
    {
        return $user->id === $memo->user_id 
                            ? Response::allow() 
                            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Memo  $memo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Memo $memo)
    {
        return $user->id === $memo->user_id 
                            ? Response::allow()
                            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Memo  $memo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Memo $memo)
    {
        return $user->id === $memo->user_id 
                            ? Response::allow()
                            : Response::denyAsNotFound();
    }
}
