<?php

namespace App\Policies;

use App\Models\Penduduk;
use App\Models\User;

class PendudukPolicy
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

    public function view(User $user, Penduduk $penduduk): bool
    {
        return in_array($user->role, ['admin', 'operator', 'warga'], true);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'operator', 'warga'], true);
    }

    public function update(User $user, Penduduk $penduduk): bool
    {
        return in_array($user->role, ['admin', 'operator', 'warga'], true);
    }

    public function delete(User $user, Penduduk $penduduk): bool
    {
        return in_array($user->role, ['admin', 'operator', 'warga'], true);
    }

    public function restore(User $user, Penduduk $penduduk): bool
    {
        return in_array($user->role, ['admin'], true);
    }

    public function forceDelete(User $user, Penduduk $penduduk): bool
    {
        return in_array($user->role, ['admin'], true);
    }
}
