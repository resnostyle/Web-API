<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class UserPolicy
{
    use HandlesAuthorization;

    private function _canWrite(User $user, User $model) {
        if (($user->id == $model->id && $user->can('edit-profile')) ||
            $user->can('edit-other_user_profiles')) {
            return true;
        }
        return false;
    }

    private function _canRead(User $user, User $model) {
        if (($user->id == $model->id && $user->can('view-profile')) ||
            $user->can('view-other_profiles')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        $this->_canRead($user, $model);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if (blank($user) || $user->can('create-user')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        $this->_canWrite($user, $model);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        $this->_canWrite($user, $model);
    }
}
