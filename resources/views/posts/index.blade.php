<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <main>
    <div class= "wrapper">
      <div class = "container">
        Hello World!!
        @foreach ($posts as $post)
        <div>{{ $post->title }}</div>
        <div>{{ $post->content}}</div>
        @endforeach
      </div>
    </div>

</body>
</html>
