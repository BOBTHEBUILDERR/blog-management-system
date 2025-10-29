<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Edit Posts</title>
</head>
<body>
    <form action="{{ route('posts.update', $post->id) }}" method="post">
        @csrf
        <label for="title">Title</label>
        <input type="text" name="title" value="{{$post->title}}" required>
        <label for="title">Content</label>
        <input type="text" name="content" value="{{$post->content}}" required>

        <input type="submit" name="submit">

    

    </form>


</body>
</html>