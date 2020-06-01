@extends('layouts.app')
@section('title',$post->title . ' - My Site')
@section('content')
  <div class= "wrapper">
    <div class = "container">
      Hello World!!
      <ul>
        <li>投稿者：{{ $post->user->name }}</li>
        <li>タイトル：{{ $post->title }}</li>
        @foreach($post->photos as $photo)
        <li><img src="{{ asset('image/' . $photo->image ) }}" alt="写真" width = 300px height = 200px></li>
        @endforeach
        <li>内容：{{ $post->content}}</li>

      </ul> 
    </div>

    <div class = "comment">
      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
      @if (!empty(Auth::id()))
        <form action = "{{ route('comments.store') }}" method = "post">
          @csrf
            <div class="form-group">
              <label for="form-comment">コメントする</label>
              <input type="text" name="comment" placeholder="コメントを入力してください" class="form-control" id="form-comment">
            </div>
            <input type = "hidden" name = "user_id" value = "{{ Auth::id() }}" >
            <input type = "hidden" name = "post_id" value = "{{ $post->id }}" >
            <button type="submit" class="btn btn-primary">コメントする</button>
        </form>
      @endif

        <div class = "comment-content">
        @foreach ($post->comments as $comment)
          <div class = "comment-content__show"><a href="{{ route('users.show',$comment->user_id )}}">{{ $comment -> user -> name }}</a></div>
          <div class = "comment-content__show">{{ $comment -> comment }}</div>
          <div class = "comment-content__show">{{ $comment -> created_at }}</div>
        </div>
        @endforeach
    </div>
  </div>
@endsection