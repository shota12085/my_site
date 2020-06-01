@extends('layouts.app')
@section('title',$user->name . ' - mypage')
@section('content')
  <div class= "wrapper">
    <div class = "container">
      <div>投稿者：{{ $user->name }}</div>
      @foreach ($user->posts as $post)
      <ul>
        <li>タイトル：{{ $post->title }}</li>
        <li>内容：{{ $post->content}}</li>
      </ul> 
      @endforeach
    </div>
  </div>
@endsection