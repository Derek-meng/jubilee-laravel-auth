<?php

namespace Jubilee\Auth\Tests\Unit\Services;

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
    public function testAttachUsers()
    {
        /** @var FacebookProvider|MockObject $client */
        $client = $this->getMockBuilder(FacebookProvider::class)->disableOriginalConstructor()->getMock();
        $user = $this->getMockBuilder(User::class)->getMock();
        $user->method('getEmail')->willReturn('12345687@gmail.com');
        $user->method('getId')->willReturn("1");
        $client->method('fields')->willReturnSelf();
        $client->method('user')->willReturn($user);
        $service = new FacebookCitizenService($client);
        /** @var UserRepo|MockObject $mockRepo */
        $mockRepo = $this->getMockBuilder(UserRepo::class)->getMock();
        $orm = $this->getMockBuilder(UserORM::class)->getMock();
        $mockRepo->method('updateOrCreate')->willReturn($orm);
        Hash::shouldReceive('make')->once()->andReturn('48797949');
        $result = $service->attachUsers(new FeedBackRequest(), $mockRepo);
        $this->assertInstanceOf(\Jubilee\Auth\Entries\User::class, $result);
    }
}
