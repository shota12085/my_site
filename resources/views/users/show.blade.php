@extends('layouts.app')
@section('title',$user->name . ' - mypage')
@section('content')
<div class = "top">
  <div class= "wrapper">
    <div class = "user-show">
      <?php if($user->image): ?> 
      <img class = "user-image" src = "{{ asset('storage/' . $user->image) }}" width = 150 height = 150 >
      <?php else: ?>
        <img class = "user-image" src = "{{ asset('storage/default.jpg') }}" width = 150 height = 150>
      <?php endif; ?>
      <div class = "user-name">{{ $user->name }}</div>
      <?php if(Auth::id()== $user->id): ?> 
      <a class = "user-edit" href = "{{ route('users.edit' , $user->id) }}">Edit Profile</a>
      <?php endif; ?>
      <div class = "count"><?php echo $count . "件の投稿をしています" ?></div>
    </div>
    <?php if($count > 0): ?>
    <div class = "show-main">
      @foreach ($posts as $index=>$post)
      <div class = "user-content">
        <div class = "user-flex">
          <div class = "show-title show-title--width"><a href="{{ route('posts.show' , $post->id)}}">{{$post->title}} </a></div>
          <div class = "show-created"><?php echo date('Y年n月j日 H時i分', strtotime($post->created_at))?></div>
        </div>
        <div class = "show-content">{{ $post->content}}</div>
        <div class = "show-link"><a href="{{ route('posts.show' , $post->id)}}">もっと見る </a></div>
      </div>
      @endforeach
    </div>
    <?php else: ?>
    <div class = "show-main">
      投稿はありません
    </div>
    <?php endif; ?>
      <div class = "pagination">
        {{$posts->links()}}
      </div>
  </div>
</div>
@endsection