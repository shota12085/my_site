@extends('layouts.app')


@section('content')
  <div class= "wrapper">
    <div class = "container">
      Hello World!!
      @foreach ($posts as $post)
      <ul>
        <li>投稿者：<a href="{{ route('users.show', $post->user_id )}}">{{ $post->user->name }}</a></li>
        <li>タイトル：{{ $post->title }}</li>
        <li>内容：{{ $post->content}}</li>
        <a href="{{ route('posts.show', $post->id)}}">詳細</a>
      </ul> 
      @endforeach
    </div>
      {{ $posts->links() }}
  </div>
@endsection
