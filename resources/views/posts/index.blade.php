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
        <div class = "content-item">
          <div class = "content-flex">
            <div class= "content-user"><a href="{{ route('users.show', $post->user_id )}}">{{ $post->user->name }}</a></div>
            <div class = "content-created"><?php echo date('Y年n月j日 H時i分', strtotime($post->created_at))?></div>
          </div>

          <ul class = "content">
            <div class = "content-left">
              <li class= "content-list">
                <a href="{{ route('users.show', $post->user_id )}}">
                <?php if(!empty($post->user->image)): ?>
                  <img src="{{ asset('storage/' . $post->user->image) }}" alt="ユーザー写真" width = "100" height = "100">
                <?php else: ?>
                  <img src="{{ asset('storage/default.jpg') }}" alt="ユーザー写真" width = "100" height = "100">
                <?php endif; ?> 
                </a>
              </li>
            </div>
            <div class = "content-right">
              <li class= "content-list content-font content-title"><a href="{{ route('posts.show' , $post->id) }}">{{ $post->title }}</li>
              <li class= "content-list content-text">{{ $post->content}}</li></a>
              <li class= "content-list content-center"><a href="{{ route('posts.show', $post->id)}}">もっと見る</a></li>
            </div>
          </ul> 
        </div>
        @endforeach
      </div>
      <div class = "pagination">
        {{ $posts->links() }}
      </div>
    </div>

  </div>
</div>
@endsection
