@extends('layouts.app')
@section('title','新規投稿')
@section('content')
<div class = "top">
  <div class= "wrapper">
    <p class = "form-message">何か呟いてみよう！！</p>
    <div class = "form-field">
    @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif

        <form action = "{{ route('posts.store') }}" method = "post" enctype="multipart/form-data">
          @csrf
            <div class="form-group">
              <label class = "label-create" for="form-title">title</label>
              <?php if(!empty($post->title)): ?> 
              <input type="text" name="title" placeholder="タイトルを入力してください" class="form-title" id="form-title" value="{{ $post->title }}">
              <?php else: ?>
              <input type="text" name="title" placeholder="タイトルを入力してください" class="form-title" id="form-title" >
              <?php endif; ?>
            </div>
            <div class="form-group">
              <label class = "label-create" for="form-content">content</label>
              <?php if(!empty($post->content)): ?> 
              <textarea name = "content" class="form-content" id="form-content" placeholder="詳細を入力してください" value="{{ $post->content }}"></textarea>
              <?php else: ?>
              <textarea name = "content" class="form-content" id="form-content" placeholder="詳細を入力してください"></textarea>
              <?php endif; ?>
            </div>
            <div class="form-group">
              <label class = "label-create" for="form-path">link</label>
              <?php if(!empty($post->link)): ?> 
              <input type = "text" name = "path" class="form-title" id="form-path" placeholder="1枚目の写真にリンクを貼ることができます" value="{{ $post->path }}">
              <?php else: ?>
              <input type = "text" name = "path" class="form-title" id="form-path" placeholder="1枚目の写真にリンクを貼ることができます">
              <?php endif; ?>
            </div>
            <div class = "image-up"></div>
            <div class = "form-flex">
              <div class="form-group">
                <label class = "label-create" for="form-image">image</label>
                <input type="file" name="image[]" class = "form-image" id="form-image" multiple="multiple">
              </div>
              <div class="form-group">
                <input type = "hidden" name = "user_id" value = "{{ Auth::id() }}" >
                <button type="submit" class="btn btn-primary btn-margin">作成する</button>
              </div>
            </div>
        </form>
    </div>
  </div>
</div>
@endsection