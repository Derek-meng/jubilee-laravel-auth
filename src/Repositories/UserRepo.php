<?php

namespace Jubilee\Auth\Repositories;

use Jubilee\Auth\Contracts\IAuthProvider;
use Jubilee\Auth\Entries\User;
use Jubilee\Auth\Util\LaravelLoggerUtil;

class UserRepo implements IAuthProvider
{
    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?\Illuminate\Foundation\Auth\User
    {
        try {
            /** @var User|null $user */
            $user = User::where('email', $email)->first();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $user = null;
        }

        return $user;
    }

    /**
     * @param array $attribute
     * @return User|null
     */
    public function create(array $attribute): ?User
    {
        try {
            $user = User::create($attribute);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $user = null;
        }

        return $user;
    }
}
