<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full page Blog</title>
</head>
<body>
        <h1>Title:        {{$post->title}}
        </h1>
        <h1>Content:        {{$post->content}}
        </h1>

        <h2>Comments</h2>

        <form action="{{ route('posts.comments') }}" method="post">
            @csrf
            <label for="name">Name</label>
            <input type="text" name="name" required>
            <label for="email" >Email</label>
            <input type="email" name="email" >
            <label for="content">Comment</label>
            <input type="text" name="content" required>

            <input type="submit" name="submit" id="">
        </form>
</body>
</html>