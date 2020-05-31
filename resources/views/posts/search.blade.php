@extends('layouts.app')

@section('content')
  <div class= "wrapper">
    <div class = "container">
      検索結果は {{$posts->total()}} 件です
      @foreach ($posts as $post)
      <ul>
        <li>投稿者：<a href="{{ route('users.show', $post->user_id )}}">{{ $post->user->name }}</a></li>
        <li>タイトル：{{ $post->title }}</li>
        <li>内容：{{ $post->content}}</li>
        <a href="{{ route('posts.show', $post->id)}}">詳細</a>
      </ul> 
      @endforeach
    </div>
    {{ $posts->appends(['keyword' => $keyword ])->links() }}

    
  </div>
@endsection
