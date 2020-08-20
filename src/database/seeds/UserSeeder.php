<?php

use Illuminate\Database\Seeder;
use Jubilee\Auth\Http\Requests\Auth\RegisterRequest;
use Jubilee\Auth\Services\AuthenticateService;

class UserSeeder extends Seeder
{
    public function run()
    {
        $request = new RegisterRequest([
            'email'    => 'a0985265734@gmail.com',
            'password' => '123456',
        ]);
        /** @var AuthenticateService $service */
        $service = app(AuthenticateService::class);
        $service->register($request, null);
    }
}

