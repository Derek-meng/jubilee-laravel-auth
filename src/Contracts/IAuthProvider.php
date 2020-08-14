<?php

namespace Jubilee\Auth\Contracts;

use Illuminate\Foundation\Auth\User;

interface IAuthProvider
{
    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User;
}
