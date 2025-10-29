<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Posts</h1>

    @if($posts)
    <table>
        <thead> 
            <th>id  </th>
            <th>title   </th>
            <th>content  </th>
        </thead>
        <tbody>
             @foreach($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->content }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
   
    @endif

<hr>

    <form action="{{ route('posts.create')}}" method="get">
        @csrf
        <label for="title">Title</label>
    <input type="text" name="title" required>
        <label for="content">Content</label>
    <input type="text" name="content" required>

    <input type="submit" name="submit">

    </form>
    

</body>
</html>