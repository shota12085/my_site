<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {   
        $count = Post::where('user_id',$user->id)->count();
        $posts = Post::latest()->where('user_id',$user->id)->paginate(5);
        $photos = DB::table('users')->where('users.id',$user->id)->join('posts', 'users.id' , '=' , 'posts.user_id')
                    ->leftJoin('photos', 'posts.id' , '=' , 'photos.post_id')
                    ->select('posts.id','posts.title','posts.content','photos.image')->get();
        return View('users.show',compact('user','count','photos','posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return View('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {   
        $user->name = $request->name;
        $user->email = $request->email;
        if(!empty($request->file('image'))){
            if($user->image){
                Storage::delete('public/' . $user->image);
                $photo = $request->file('image');
                $image = $photo->store('public');
                $user->image = basename($image);
            }else{
                $photo = $request->file('image');
                $image = $photo->store('public');
                $user->image = basename($image);
            }
        }
        $user->update();

        return redirect(route('users.show', $user->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
