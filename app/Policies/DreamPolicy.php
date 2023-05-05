<?php

namespace App\Policies;

use App\Models\Dream;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DreamPolicy
{
    use HandlesAuthorization;

    public function allowRestify(User $user = null): bool
    {
        return true;
    }

    public function show(User $user = null, Dream $model): bool
    {
        return true;
    }

    public function store(User $user): bool
    {
        return false;
    }

    public function storeBulk(User $user): bool
    {
        return false;
    }

    public function update(User $user, Dream $model): bool
    {
        return false;
    }

    public function updateBulk(User $user, Dream $model): bool
    {
        return false;
    }

    public function deleteBulk(User $user, Dream $model): bool
    {
        return false;
    }

    public function delete(User $user, Dream $model): bool
    {
        return false;
    }
}
