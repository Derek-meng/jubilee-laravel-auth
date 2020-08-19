<?php

namespace Jubilee\Auth\Services;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Jubilee\Auth\Entries\User;
use Jubilee\Auth\Http\Requests\Auth\LoginRequest;
use Jubilee\Auth\Http\Requests\Auth\RegisterRequest;
use Jubilee\Auth\Repositories\UserRepo;

class AuthenticateService
{
    use ThrottlesLogins;

    /** @var UserRepo $repo */
    private $repo;

    /**
     * AuthenticateService constructor.
     * @param UserRepo $repo
     */
    public function __construct(UserRepo $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * @param LoginRequest $request
     * @param StatefulGuard $guard
     * @return User|null
     * @throws ValidationException
     */
    public function login(LoginRequest $request, StatefulGuard $guard): ?User
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            $this->sendLockoutResponse($request);
        }
        $user = $this->repo->findByEmail($request->getEmail());
        if (!is_null($user) && Hash::check($request->getPassword(), $user->password)) {
            $guard->login($user);
        } else {
            $user = null;
        }

        return $user;
    }

    /**
     * @param RegisterRequest $request
     * @return User|null
     */
    public function register(RegisterRequest $request): ?User
    {
        $attribute = [
            'email'    => $request->getEmail(),
            'password' => Hash::make($request->getPassword()),
        ];

        return $this->repo->create($attribute);
    }
}
