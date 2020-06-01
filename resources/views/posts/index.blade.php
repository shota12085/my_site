@extends('layouts.app')
@section('title','My Site')

@section('content')
  <div class= "wrapper">
    <div class = "container">
      <div class = "search">
        <form action="{{ route('posts.search') }}" method = 'get'>
          <input id = "search-input" name = "keyword" >
          <input id = "search-btn" type = "submit" value="検索">
        @if (session('error'))
          <p class="text-danger mt-3">
            {{ session('error') }}
        </p>
        @endif
        </form>
      </div>
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
