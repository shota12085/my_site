@extends('layouts.app')
@section('title','検索結果')
@section('content')
<div class = "top">
  <div class= "wrapper">
    <div class = "main-contents">
      <p class = "search-result">検索結果は <span class = "search-color">{{$posts->total()}}</span>件です</p>
      <div class = "contents">
        @foreach ($posts as $post)
        <div class = "content-item">
          <div class= "content-user"><a href="{{ route('users.show', $post->user_id )}}">{{ $post->user->name }}</a></div>

          <ul class = "content">
            <div class = "content-left">
              <li class= "content-list">
                <a href="{{ route('users.show', $post->user_id )}}">
                <?php if(!empty($post->user->image)): ?>
                  <img src="{{ asset('userimage/' . $post->user->image) }}" alt="ユーザー写真" width = "100" height = "100">
                <?php else: ?>
                  <img src="{{ asset('userimage/default.jpg') }}" alt="ユーザー写真" width = "100" height = "100">
                <?php endif; ?> 
                </a>
              </li>
            </div>
            <div class = "content-right">
              <li class= "content-list content-font content-title"><a href="{{ route('posts.show' , $post->id) }}">{{ $post->title }}</a></li>
              <li class= "content-list content-text">{{ $post->content}}</li>
              <li class= "content-list content-center"><a href="{{ route('posts.show', $post->id)}}">もっと見る</a></li>
            </div>
          </ul> 
        </div>
        @endforeach
      </div>
      <div class = "pagination">
      {{ $posts->appends(['keyword' => $keyword ])->links() }}
      </div>
    </div>

  </div>
</div>
  @endsection