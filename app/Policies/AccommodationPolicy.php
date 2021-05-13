<?php

namespace App\Policies;

use App\User;
use App\Accommodation;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccommodationPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @param User $user
     * @param Accommodation $accommodation
     * @return bool
     */
    public function update(User $user,Accommodation $accommodation)
    {
        return $user->id === $accommodation->user_id;

    }
}
