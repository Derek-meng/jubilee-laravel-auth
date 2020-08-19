<?php

namespace Jubilee\Auth\Tests\Unit\Services;

use Illuminate\Cache\RateLimiter;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Hash;
use Jubilee\Auth\Entries\User;
use Jubilee\Auth\Http\Requests\Auth\LoginRequest;
use Jubilee\Auth\Http\Requests\Auth\RegisterRequest;
use Jubilee\Auth\Repositories\UserRepo;
use Jubilee\Auth\Services\AuthenticateService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TestAuthenticateService extends TestCase
{
    public function testSuccessLogin()
    {
        app()->bind(RateLimiter::class, function () {
            $mock = $this->getMockBuilder(RateLimiter::class)->disableOriginalConstructor()->getMock();
            $mock->method('tooManyAttempts')->willReturn(false);

            return $mock;
        });
        $mockRepo = $this->getMockRepo();
        /** @var MockObject|User $userMock */
        $userMock = $this->getMockBuilder(User::class)->getMock();
        $userMock->password = 456798;
        $mockRepo->method('findByEmail')->willReturn($userMock);
        $service = new AuthenticateService($mockRepo);
        /** @var StatefulGuard|MockObject $mockGuard */
        $mockGuard = $this->getMockBuilder(StatefulGuard::class)->getMock();
        $mockGuard->method('login');
        Hash::shouldReceive('check')->once()->andReturn(true);
        $user = $service->login(new LoginRequest(['email' => '123', 'password' => '456']), $mockGuard);
        $this->assertInstanceOf(User::class, $user);
    }

    public function testFailLogin()
    {
        app()->bind(RateLimiter::class, function () {
            $mock = $this->getMockBuilder(RateLimiter::class)->disableOriginalConstructor()->getMock();
            $mock->method('tooManyAttempts')->willReturn(false);

            return $mock;
        });
        $mockRepo = $this->getMockRepo();
        /** @var MockObject|User $userMock */
        $userMock = $this->getMockBuilder(User::class)->getMock();
        $userMock->password = 456798;
        $mockRepo->method('findByEmail')->willReturn($userMock);
        $service = new AuthenticateService($mockRepo);
        /** @var StatefulGuard|MockObject $mockGuard */
        $mockGuard = $this->getMockBuilder(StatefulGuard::class)->getMock();
        $mockGuard->method('login');
        Hash::shouldReceive('check')->once()->andReturn(false);
        $user = $service->login(new LoginRequest(['email' => '123', 'password' => '456']), $mockGuard);
        $this->assertNull($user);
    }

    public function testRegister()
    {
        $repo = $this->getMockRepo();
        /** @var MockObject|User $userMock */
        $userMock = $this->getMockBuilder(User::class)->getMock();
        $repo->method('create')->willReturn($userMock);
        $service = new AuthenticateService($repo);
        Hash::shouldReceive('make')->once()->andReturn('48797949');
        $user = $service->register(new RegisterRequest([
            'email'    => '123456789@gmail',
            'password' => '78978979'
        ]));
        $this->assertInstanceOf(User::class, $user);
    }

    /**
     * @return UserRepo|MockObject
     */
    private function getMockRepo()
    {
        /** @var MockObject|UserRepo $mockRepo */
        $mockRepo = $this->getMockBuilder(UserRepo::class)->getMock();

        return $mockRepo;
    }
}
