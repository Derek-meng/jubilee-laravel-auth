<?php

namespace Jubilee\Auth\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Jubilee\Auth\Http\Requests\Facebook\FeedBackRequest;
use Jubilee\Auth\Repositories\UserRepo;
use Jubilee\Auth\Services\FacebookCitizenService;

class FacebookController extends Controller
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
     * @return RedirectResponse
     */
    public function feedback(FeedBackRequest $request, FacebookCitizenService $service)
    {
        $service->attachUsers($request, app(UserRepo::class), Auth::guard());

        return redirect()->to(config('custom_auth.home_url'));
    }
}
