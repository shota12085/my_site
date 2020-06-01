@extends('layouts.app')
@section('title','My Site')

@section('content')
<div class = "top">
  <div class= "wrapper">
    <div class = "main-contents">
      <div class = "search">
        <form action="{{ route('posts.search') }}" method = 'get'>
          <input class = "search-input" name = "keyword" >
          <input class = "search-btn" type = "submit" value="検索">
          @if (session('error'))
          <p class="text-danger mt-3">
            {{ session('error') }}
          </p>
          @endif
        </form>
      </div>
      <div class = "contents">
        @foreach ($posts as $post)
        <ul class = "content">
          <div class = content-color>
            <li class= "content-list">投稿者：<a href="{{ route('users.show', $post->user_id )}}">{{ $post->user->name }}</a></li>
            <li class= "content-list">タイトル：{{ $post->title }}</li>
            <li class= "content-list">内容：{{ $post->content}}</li>
            <li class= "content-list"><a href="{{ route('posts.show', $post->id)}}">詳細</a></li>
          </div>
        </ul> 
        @endforeach
      </div>
      <div class = "pagination">
        {{ $posts->links() }}
      </div>
    </div>

  </div>
</div>
@endsection
