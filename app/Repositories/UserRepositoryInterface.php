<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function getByEmail(string $email): ?User;
    public function createToken(User $user, string $tokenName): string;
    public function deleteCurrentToken(User $user): void;
}
