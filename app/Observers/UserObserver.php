<?php

namespace App\Observers;

use App\User;
use Orchid\Platform\Models\Role;

class UserObserver
{
    /**
     * @param \App\User $model
     */
    public function created(User $model)
    {
        $role = Role::whereSlug('users')->firstOrFail();

        $model->addRole($role);
    }
}