@extends('layouts.app')
@section('title','新規投稿')
@section('content')
<div class = "top">
  <div class= "wrapper">
    <p class = "form-message">投稿を編集する</p>
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

        <form action = "{{ url('posts/'.$post->id) }}" method = "post" enctype="multipart/form-data">
          @csrf
          @method('PUT')
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
            <textarea name = "content" class="form-content" id="form-content" placeholder="詳細を入力してください">{{$post->content}}</textarea>
            <?php else: ?>
            <textarea name = "content" class="form-content" id="form-content" placeholder="詳細を入力してください"></textarea>
            <?php endif; ?>
          </div>
          <div class = "image-up">
            @foreach($post->photos as $photo)
            <div class='image-top' >
              <div class=' image-content'>
                <div class='image-list'>
                <img src="{{ asset('storage/' . $photo->image ) }}" alt="写真" width = 138.5px height = 120px>
                <a href="#" data-id="{{ $photo->id }}"  class="form-delete">削除</a>

                </div>
              </div>
            </div>
            @endforeach
          </div>
          <div class = "form-flex">
            <div class="form-group" id = "form-append">
              <?php if($count != 4): ?>
              <label class = "label-create" for="form-image">image</label>
              <input type="file" name="image[]" class = "form-image" id="form-image" multiple="multiple">
              <?php else: ?>
              <?php endif; ?>
            </div>
            <div class="form-group">
              <input type = "hidden" name = "user_id" value = "{{ Auth::id() }}" >
              <button type="submit" class="btn btn-primary btn-margin">作成する</button>
            </div>
          </div>
        </form>
      <form action="{{ action('PhotosController@destroy', $photo->id) }}" id="form_{{ $photo->id }}"class = "delete-form" method="post" style="display:inline">
        @csrf
        @method('delete')
      </form>
    </div>
  </div>
</div>
@endsection