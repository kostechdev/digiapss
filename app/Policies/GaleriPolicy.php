<?php

namespace App\Policies;

use App\Models\Galeri;
use App\Models\User;

class GaleriPolicy
{
    public function before(User $user, string $ability): bool|null
    {
        if ($user->role === 'admin') {
            return true;
        }
        return null;
    }

    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'operator', 'warga'], true);
    }

    public function view(User $user, Galeri $galeri): bool
    {
        return in_array($user->role, ['admin', 'operator', 'warga'], true);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'operator', 'warga'], true);
    }

    public function update(User $user, Galeri $galeri): bool
    {
        return in_array($user->role, ['admin', 'operator', 'warga'], true);
    }

    public function delete(User $user, Galeri $galeri): bool
    {
        return in_array($user->role, ['admin', 'operator', 'warga'], true);
    }

    public function restore(User $user, Galeri $galeri): bool
    {
        return in_array($user->role, ['admin'], true);
    }

    public function forceDelete(User $user, Galeri $galeri): bool
    {
        return in_array($user->role, ['admin'], true);
    }
}
