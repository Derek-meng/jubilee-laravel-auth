<?php

namespace Jubilee\Auth\Services;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Hash;
use Jubilee\Auth\Entries\User;
use Jubilee\Auth\Http\Requests\Facebook\FeedBackRequest;
use Jubilee\Auth\Repositories\UserRepo;
use Laravel\Socialite\Two\FacebookProvider;

class FacebookCitizenService
{
    /** @var FacebookProvider $client */
    private $client;

    /**
     * FacebookService constructor.
     * @param FacebookProvider $client
     */
    public function __construct(FacebookProvider $client)
    {
        $this->client = $client;
    }

    /**
     * @return FacebookProvider
     */
    public function client(): FacebookProvider
    {
        return $this->client;
    }

    /**
     * @param FeedBackRequest $request
     * @param UserRepo $repo
     * @param StatefulGuard $guard
     * @return User|null
     */
    public function attachUsers(FeedBackRequest $request, UserRepo $repo, StatefulGuard $guard): ?User
    {
        $citizen = null;
        if (is_null($request->getErrorCode()) && is_null($request->getErrorMessage())) {
            $user = $this->client->fields(['email'])->user();
            $citizen = $repo->firstOrNew(
                [
                    'email' => $user->getEmail()
                ], [
                    'email' => $user->getEmail(),
                ]
            );
            $isSuccess = false;
            if (!is_null($citizen)) {
                $attributes = !is_null($citizen->password) ?
                    [
                        'facebook_id' => $user->getId(),
                    ] :
                    [
                        'facebook_id' => $user->getId(),
                        'password'    => Hash::make(uniqid())
                    ];
                $isSuccess = $repo->update($citizen, $attributes);
            }
            if ($isSuccess) {
                $guard->login($citizen);
            } else {
                $citizen = null;
            }
        }

        return $citizen;
    }
}
