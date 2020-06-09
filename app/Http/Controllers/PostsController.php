<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Requests\PostInput;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $posts = Post::latest()->paginate(5);
        $posts->load('user');
        return View('posts.index',['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return View('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostInput $request)
    {
        $post = new Post;

        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = $request->user_id;
        $post->save();
        if(!empty($request->file('image'))){

            foreach ($request->file('image') as $photo) {
                $image = $photo->store('public');
                $post->photos()->create(['image'=> basename($image),'post_id' => $post->id]);
            }
        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        $post->load('user','comments','photos');
        $photo = $post->photos->first();
        $count = count($post->photos);
        // dd($photo);
        return View('posts.show', compact('post','photo','count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $post->load('user','photos');
        $count = count($post->photos);
        return View('posts.edit',compact('post','count'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {   
        // dd($request->file('image'));
        // dd($request);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->path = $request->path;
        $post->save();
        if(!empty($request->file('image'))){

            foreach ($request->file('image') as $photo) {
                $image = $photo->store('public');
                // dd($image);
                $post->photos()->create(['image'=> basename($image),'post_id' => $post->id]);
            }
        }
        return redirect(route('posts.show',$post->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {   
        $del = $post->load('user','photos');
        $del->delete();
        return redirect('/')->with('message', '投稿を削除しました');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        
        $posts = Post::latest()->where('title', 'like', '%'.$keyword.'%')->orwhere('content', 'like', '%'.$keyword.'%')
        ->paginate(5);
        if($posts->total() > 0) {   
            return view('posts.search',[
                'posts' => $posts,
                'keyword' => $keyword,
                ]);

        }else{
            return redirect('/')->with('error', '検索結果がありませんでした');
        }
    }
    
}
