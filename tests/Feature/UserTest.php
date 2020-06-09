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
    }

    public function testUpdateUser()
    {
        $user = \App\User::where('name','laravel')->first();
        $user->name = "PHP";
        $user->email = "PHP@test.com";
        $user->password = \Hash::make('password');
        $user->image = 'image';
        $this->assertNotNull($user);
        $this->assertTrue(\Hash::check('password', $user->password));
        $user->update();
    }
    public function testDeleteUser()
    {
        $readUser = \App\User::where('name', 'PHP')->first();
        $readUser->delete();
        $this->assertDeleted($readUser);
    }
}
