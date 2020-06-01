@extends('layouts.app')
@section('title','新規投稿')
@section('content')
<div class= "wrapper">
    <div class = "container">
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
            <label for="form-title">title</label>
            <input type="text" name="title" placeholder="タイトルを入力してください" class="form-control" id="form-title">
          </div>
          <div class="form-group">
            <label for="form-content">content</label>
            <textarea name = "content" class="form-control" id="form-content"></textarea>
          </div>
          <div class="form-group">
            <div class = "image-up"></div>
            <label for="form-image">image</label>
            <input type="file" name="image[]" id="form-image" multiple="multiple">
          </div>
          <input type = "hidden" name = "user_id" value = "{{ Auth::id() }}" >
          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
  </div>
</div>
@endsection