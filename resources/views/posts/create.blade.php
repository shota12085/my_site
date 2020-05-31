@extends('layouts.app')

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
      <form action = "{{ route('posts.store') }}" method = "post">
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
            <label for="form-image">image</label>
            <input type="file" name="image" class="form-control" id="form-image" enctype="multipart/form-data">
          </div>
          <input type = "hidden" name = "user_id" value = "{{ Auth::id() }}" >
          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
  </div>
</div>
@endsection