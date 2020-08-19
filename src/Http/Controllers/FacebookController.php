<?php

namespace Jubilee\Auth\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Jubilee\Auth\Http\Requests\Facebook\FeedBackRequest;
use Jubilee\Auth\Repositories\UserRepo;
use Jubilee\Auth\Services\FacebookCitizenService;

class FacebookController
{
    /** @var FacebookCitizenService $service */
    private $service;

    /**
     * FacebookController constructor.
     * @param FacebookCitizenService $service
     */
    public function __construct(FacebookCitizenService $service)
    {
        $this->service = $service;
    }

    /**
     * @return RedirectResponse
     */
    public function signIn(): RedirectResponse
    {
        return $this->service->client()->redirect();
    }

    /**
     * @param FeedBackRequest $request
     * @param FacebookCitizenService $service
     */
    public function feedback(FeedBackRequest $request, FacebookCitizenService $service)
    {
        $service->attachUsers($request, app(UserRepo::class));
    }
}
