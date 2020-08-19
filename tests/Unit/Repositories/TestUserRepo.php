<?php

namespace Jubilee\Auth\Tests\Unit\Repositories;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Jubilee\Auth\AuthProvider;
use Jubilee\Auth\Entries\User;
use Jubilee\Auth\Repositories\UserRepo;
use Orchestra\Testbench\TestCase;

class TestUserRepo extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var EloquentFactory
     */
    private $factory;

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array|string[]
     */
    protected function getPackageProviders($app): array
    {
        return [AuthProvider::class];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'test');
        $app['config']->set('database.connections.test', [
            'driver'   => 'mysql',
            'database' => 'jubile',
            'prefix'   => '',
            'host'     => 'mysql',
            'username' => 'root',
            'password' => 'root'
        ]);
    }

    public function setUp()
    {
        parent::setUp();
        $this->artisan('migrate', ['--database' => 'test']);
        $path = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..'
            . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'factories';
        $this->factory = EloquentFactory::construct(\Faker\Factory::create(), $path);
    }

    public function testFindByEmail()
    {
        /** @var User $expected */
        $expected = $this->factory->create(User::class);
        $repo = app(UserRepo::class);
        $actual = $repo->findByEmail($expected->email);
        $this->assertInstanceOf(\Illuminate\Foundation\Auth\User::class, $actual);
        $this->assertEquals($expected->email, $actual->email);
    }

    public function testCreate()
    {
        $email = '654654678';
        $password = '79879894';
        $repo = app(UserRepo::class);
        $user = $repo->create([
            'email'    => $email,
            'password' => $password
        ]);
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($email, $user->email);
        $this->assertEquals($password, $user->password);
    }

    public function testCreateOrUpdate()
    {
        $email = '654654678';
        $password = '79879894';
        $repo = app(UserRepo::class);
        $user = $repo->updateOrCreate([
            'email' => $email
        ], [
            'email'    => $email,
            'password' => $password
        ]);
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($email, $user->email);
        $this->assertEquals($password, $user->password);
    }
}
