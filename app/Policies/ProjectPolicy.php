<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function allowRestify(User $user = null): bool
    {
        return true;
    }

    public function show(User $user = null, Project $model): bool
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

    public function update(User $user, Project $model): bool
    {
        return false;
    }

    public function updateBulk(User $user, Project $model): bool
    {
        return false;
    }

    public function deleteBulk(User $user, Project $model): bool
    {
        return false;
    }

    public function delete(User $user, Project $model): bool
    {
        return false;
    }
}
