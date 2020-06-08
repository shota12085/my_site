<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $user = new \App\User;
        $user->name = "laravel";
        $user->email = "laravel@test.com";
        $user->password = \Hash::make('password');
        $user->save();

        $readUser = \App\User::where('name', 'laravel')->first();
        $this->assertNotNull($readUser);
        $this->assertTrue(\Hash::check('password', $readUser->password));

        \App\User::where('email', 'laravel@test.com')->delete();
    }

    public function testUpdateUser()
    {
        $user = new \App\User;
        $user->name = "php";
        $user->email = "php@test.com";
        $user->password = \Hash::make('password');
        $user->save();
        $readUser = \App\User::where('name', 'php')->first();
        $this->assertNotNull($readUser);
        $this->assertTrue(\Hash::check('password', $readUser->password));

        $user->name = "PHP";
        $user->email = "PHP@test.com";
        $user->password = \Hash::make('password');
        $user->image = 'image';
        $user->update();
    }
    public function testDeleteUser()
    {
        $readUser = \App\User::where('name', 'PHP')->first();
        $readUser->delete();
        $this->assertDeleted($readUser);
    }
}
