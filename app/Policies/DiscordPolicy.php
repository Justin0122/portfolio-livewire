<?php

namespace App\Policies;

use App\Models\Discord;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiscordPolicy
{
    use HandlesAuthorization;

    public function allowRestify(User $user = null): bool
    {
        return true;
    }

    public function show(User $user = null, Discord $model): bool
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

    public function update(User $user, Discord $model): bool
    {
        return false;
    }

    public function updateBulk(User $user, Discord $model): bool
    {
        return false;
    }

    public function deleteBulk(User $user, Discord $model): bool
    {
        return false;
    }

    public function delete(User $user, Discord $model): bool
    {
        return false;
    }
}
