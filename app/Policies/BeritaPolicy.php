<?php

namespace App\Policies;

use App\Models\Berita;
use App\Models\User;

class BeritaPolicy
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

    public function view(User $user, Berita $berita): bool
    {
        return in_array($user->role, ['admin', 'operator', 'warga'], true);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'operator', 'warga'], true);
    }

    public function update(User $user, Berita $berita): bool
    {
        return in_array($user->role, ['admin', 'operator', 'warga'], true);
    }

    public function delete(User $user, Berita $berita): bool
    {
        return in_array($user->role, ['admin', 'operator', 'warga'], true);
    }

    public function restore(User $user, Berita $berita): bool
    {
        return in_array($user->role, ['admin'], true);
    }

    public function forceDelete(User $user, Berita $berita): bool
    {
        return in_array($user->role, ['admin'], true);
    }
}
