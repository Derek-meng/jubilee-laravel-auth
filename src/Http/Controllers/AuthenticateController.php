<?php

namespace Jubilee\Auth\Http\Controllers;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Jubilee\Auth\Http\Requests\Auth\LoginRequest;
use Jubilee\Auth\Http\Requests\Auth\RegisterRequest;
use Jubilee\Auth\Services\AuthenticateService;

class AuthenticateController extends Controller
{
    /** @var AuthenticateService $service */
    private $service;

    /**
     * AuthenticateController constructor.
     * @param AuthenticateService $service
     */
    public function __construct(AuthenticateService $service)
    {
        $this->service = $service;
    }

    /**
     * @return Factory|View
     */
    public function loginView()
    {
        return view('auth.login');
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function login(LoginRequest $request)
    {
        $user = $this->service->login($request, Auth::guard());

        return is_null($user) ? redirect()->back()->withErrors('未存在帳號,或密碼錯誤') :
            redirect()->to(config('custom_auth.home_url'));
    }

    /**
     * @return Factory|View
     */
    public function registerView()
    {
        return view('auth.register');
    }

    /**
     * @param RegisterRequest $request
     * @return RedirectResponse
     */
    public function register(RegisterRequest $request)
    {
        $user = $this->service->register($request);

        return is_null($user) ? redirect()->back()->withErrors('創建失敗') : redirect()->to(config('authed_redirect_url'));
    }

    /**
     * @return RedirectResponse
     */
    public function logout()
    {
        /** @var StatefulGuard $guard */
        $guard = Auth::guard();
        $guard->logout();

        return redirect()->to(route('auth.login'));
    }
}
