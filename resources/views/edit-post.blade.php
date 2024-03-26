<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form action="/edit-post/{{$post->id}}" method="POST">
        @csrf
        @method('PUT')
        <label>
            <input type="text" name="title" value="{{$post->title}}">
        </label>
        <label>
            <textarea name="body">{{$post->body}}</textarea>
        </label>
        <button>Save Changes</button>
    </form>
</body>
</html>
