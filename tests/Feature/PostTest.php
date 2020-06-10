<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Post;
use App\User;
use App\Photo;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPostCreate()
    {   
        $user = new \App\User;
        $user->name = 'test'; 
        $user->email = 'test@test.test.com'; 
        $user->password = \Hash::make('password');
        $user->save();

        $post = new \App\Post;
        $post->title = "Hello";
        $post->content = "World";
        $post->path = "http://";
        $post->user_id = $user->id;
        $post->save();
        
        $photo = new \App\Photo;
        $photo->image = 'image';
        $photo->post_id = $post->id;

        $readPost = \App\Post::where('title','Hello')->first();
        $readUser = \App\User::where('email','test@test.test.com')->first();
        $this->assertNotNull($readPost);
        $this->assertNotNull($readUser);
        $this->assertTrue(\Hash::check('password', $readUser->password));
        \App\Post::where('content','World')->delete();
        \App\User::where('name','test')->delete();
    }
    // public function testPostUpdate()
    // {

    // }
}
