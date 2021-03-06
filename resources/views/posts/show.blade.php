@extends('layouts.app')
@section('title',$post->title . ' - My Site')
@section('content')
<div class = "top">

  <div class= "wrapper">
    <div class = "show-main">
      <div class = "show-flex">
        <div class = "show-user">
          <a href="{{ route('users.show', $post->user_id )}}">
          <?php if(!empty($post->user->image)): ?>
            <img src="{{ asset('storage/' . $post->user->image) }}" alt="ユーザー写真" width = "60" height = "60" >
          <?php else: ?>
            <img src="{{ asset('storage/default.jpg') }}" alt="ユーザー写真" width = "60" height = "60">
          <?php endif; ?> 
          </a>
        <a href="{{ route('users.show', $post->user_id )}}" class = "show-username">{{ $post->user->name }}</a>
        </div>
        <?php if(Auth::id() == $post->user_id): ?>
        <div class = "show-edit">
          <a href="{{route('posts.edit',$post->id)}}" class = "show-editlink">編集</a>
          <form action="{{ action('PostsController@destroy', $post->id) }}" method="post" style="display:inline">
            @csrf
            @method('delete')
            <input type="submit" class = "show-delete" value = "削除">
          </form>
        </div>
        <?php endif; ?>
      </div>
      <div class = "show-title">
        {{ $post->title }}
      </div>
      <?php if($count > 0): ?>
      <ul class = "show-image">
      <?php if($post->path): ?>
        <li class = "show-imagelist"><a href="{{ $post->path }}" class = "imagelink"><img src="{{ asset('storage/' .$photo->image ) }}" id = "bigPic" alt="写真" width = 600px height = 300px></a></li>
      <?php else: ?>  
        <li class = "show-imagelist"><img src="{{ asset('storage/' .$photo->image ) }}" id = "bigPic" alt="写真" width = 600px height = 300px></li>
      <?php endif; ?>
    </ul>
      <div class = "show-link"><a href="{{ $post->path }}">動画を見る</a></div>
      <ul class = "show-image">
        <?php if($count > 1): ?>
          @foreach($post->photos as $photo)
          <li class = "show-imagelist">
            <img src="{{ asset('storage/' .$photo->image ) }}" data-name = "{{ asset('storage/' .$photo->image ) }}" class = "thumb" alt="写真" width = 150px height = 100px>
          </li>
          @endforeach
          <?php endif; ?>
        </ul>
        <?php endif; ?>
        <?php if($post->path): ?>
          <?php endif; ?>
          <div id = "modal" class = "displayNone">
            <p id = "close">閉じる</p>
            <img src="" id = "modalImage" alt="写真" width = 760px height = 600px>
          </div>
          <div class = "content-created--right"><?php echo date('Y年n月j日 H時i分', strtotime($post->created_at))?></div>
          <div class = "show-content">{{ $post->content}}</div>
          
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
          <label for="form-comment" class = "label-create">コメントする</label>
          <textarea name="comment" placeholder="コメントを入力してください" class="form-comment" id="form-comment"></textarea>
        </div>
        <input type = "hidden" name = "user_id" value = "{{ Auth::id() }}" >
        <input type = "hidden" name = "post_id" value = "{{ $post->id }}" >
        <button type="submit" class="btn btn-primary">コメントする</button>
      </form>
      @endif
      <?php if(count($post->comments) > 0): ?>
      <div class = comment-list>
        <p class = "comment-main">コメント一覧</p>
      <?php else: ?>
        <p class = "comment-not">コメントはありません</p>
      <?php endif; ?>
        @foreach ($post->comments as $comment)
        <div class = "comment-content">
          <div class = "comment-flex">
            <div class = "comment-user"><a href="{{ route('users.show',$comment->user_id )}}">{{ $comment -> user -> name }}</a></div>
            <div class = "comment-created"><?php echo date('Y年n月j日 H時i分', strtotime($comment->created_at))?></div>
          </div>
          <div class = "comment-content__show">{{ $comment -> comment }}</div>
        </div>
          @endforeach
      </div>
  </div>
</div>
@endsection