@extends('layouts.app')

@section('content')
  <div class= "wrapper">
    <div class = "container">
      Hello World!!

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