<?php

namespace Jubilee\Auth\Tests\Unit\Services;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Hash;
use Jubilee\Auth\Entries\User as UserORM;
use Jubilee\Auth\Http\Requests\Facebook\FeedBackRequest;
use Jubilee\Auth\Repositories\UserRepo;
use Jubilee\Auth\Services\FacebookCitizenService;
use Laravel\Socialite\Contracts\User;
use Laravel\Socialite\Two\FacebookProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TestFacebookService extends TestCase
{
    public function testAttachUsersSuccess()
    {
        $service = $this->createService();
        /** @var UserRepo|MockObject $mockRepo */
        $mockRepo = $this->getMockBuilder(UserRepo::class)->getMock();
        /** @var UserORM|MockObject $orm */
        $orm = $this->getMockBuilder(UserORM::class)->getMock();
        $orm->email = '12345687@gmail.com';
        $mockRepo->method('update')->willReturn(true);
        $mockRepo->method('firstOrNew')->willReturn($orm);
        Hash::shouldReceive('make')->once()->andReturn('48797949');
        /** @var StatefulGuard|MockObject $mockGuard */
        $mockGuard = $this->getMockBuilder(StatefulGuard::class)->getMock();
        $mockGuard->method('login');
        $result = $service->attachUsers(new FeedBackRequest(), $mockRepo, $mockGuard);
        $this->assertInstanceOf(\Jubilee\Auth\Entries\User::class, $result);
    }

    public function testAttachUsersFail()
    {
        $service = $this->createService();
        /** @var UserRepo|MockObject $mockRepo */
        $mockRepo = $this->getMockBuilder(UserRepo::class)->getMock();
        /** @var UserORM|MockObject $orm */
        $orm = $this->getMockBuilder(UserORM::class)->getMock();
        $orm->email = '12345687@gmail.com';
        $mockRepo->method('update')->willReturn(false);
        $mockRepo->method('firstOrNew')->willReturn($orm);
        Hash::shouldReceive('make')->once()->andReturn('48797949');
        /** @var StatefulGuard|MockObject $mockGuard */
        $mockGuard = $this->getMockBuilder(StatefulGuard::class)->getMock();
        $result = $service->attachUsers(new FeedBackRequest(), $mockRepo, $mockGuard);
        $this->assertNull($result);
    }

    /**
     * @return FacebookCitizenService
     */
    private function createService(): FacebookCitizenService
    {
        /** @var FacebookProvider|MockObject $client */
        $client = $this->getMockBuilder(FacebookProvider::class)->disableOriginalConstructor()->getMock();
        $user = $this->getMockBuilder(User::class)->getMock();
        $user->method('getEmail')->willReturn('12345687@gmail.com');
        $user->method('getId')->willReturn("1");
        $client->method('fields')->willReturnSelf();
        $client->method('user')->willReturn($user);
        $service = new FacebookCitizenService($client);

        return $service;
    }
}
