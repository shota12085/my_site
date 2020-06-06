@extends('layouts.app')
@section('title',$user->name . ' - mypage')
@section('content')
<div class = "top">
  <div class= "wrapper">
    <div class = "show-main">
      <?php if($user->image): ?> 
      <img src = "{{ asset('storage/' . $user->image) }}" width = 100 height = 100>
      <?php else: ?>
        <img src = "{{ asset('storage/default.jpg') }}" width = 100 height = 100>
      <?php endif; ?>
      <div>投稿者：{{ $user->name }}</div>
      トータル<?php echo $count . "件の投稿があります" ?>
    </div>

    <div class = "show-main">
      @foreach ($posts as $post)
      <div class = "user-content">
        <div class = "user-flex">
          <div class = "show-title show-title--width"><a href="{{ route('posts.show' , $post->id)}}">{{$post->title}} </a></div>
          <div class = "show-created"><?php echo date('Y年n月j日 H時i分', strtotime($post->created_at))?></div>
        </div>
        <div class = "show-content">{{ $post->content}}</div>
        <div class = "show-image--count"><?php echo $post->image . "件の投稿があります" ?></div>
      </div>
      @endforeach
    </div>
      <div class = "pagination">
        {{$posts->links()}}
      </div>
  </div>
</div>
@endsection