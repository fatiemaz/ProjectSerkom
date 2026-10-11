<?php

namespace App\Policies;

use App\Models\Berita;
use App\Models\User;

class BeritaPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isActive() && ($user->isAdmin() || $user->isOperator());
    }

    public function view(User $user, Berita $berita): bool
    {
        // Melihat boleh untuk semua admin/operator aktif
        return $user->isActive() && ($user->isAdmin() || $user->isOperator());
    }

    public function update(User $user, Berita $berita): bool
    {
        return $this->canManage($user, $berita);
    }

    public function delete(User $user, Berita $berita): bool
    {
        return $this->canManage($user, $berita);
    }

    private function canManage(User $user, Berita $berita): bool
    {
        // User yang tidak aktif tidak boleh apa-apa
        if (! $user->isActive()) {
            return false;
        }

        // Admin boleh semua berita (termasuk milik user yang sudah nonaktif)
        if ($user->isAdmin()) {
            return true;
        }

        // Operator: hanya berita miliknya sendiri,
        // dan pembuat berita harus masih aktif
        $owner = $berita->user;

        return $user->isOperator()
            && $owner
            && $owner->isActive()
            && $user->id_user === $berita->id_user;
    }
}
