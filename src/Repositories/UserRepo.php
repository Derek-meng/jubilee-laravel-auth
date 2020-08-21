<?php

namespace Jubilee\Auth\Repositories;

use Jubilee\Auth\Contracts\IAuthProvider;
use Jubilee\Auth\Entries\User;
use Jubilee\Auth\Util\LaravelLoggerUtil;
use Throwable;

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
        } catch (Throwable $e) {
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
        } catch (Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $user = null;
        }

        return $user;
    }

    /**
     * @param User $user
     * @param array $attributes
     * @return bool
     */
    public function update(User $user, array $attributes): bool
    {
        try {
            /** @var User|null $user */
            $user = $user->fill($attributes);
            $result = $user->save();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $result = false;
        }

        return $result;
    }

    /**
     * @param array $attributes
     * @param array $values
     * @return User|null
     */
    public function firstOrNew(array $attributes, array $values = []): ?User
    {
        try {
            /** @var User|null $user */
            $user = User::firstOrNew($attributes, $values);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $user = null;
        }

        return $user;
    }
}
