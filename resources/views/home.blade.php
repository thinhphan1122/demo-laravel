<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

@auth()
    <p>Congrats! You are logged in.</p>
    <form action="/logout" method="POST">
        @csrf
        <button>Log out</button>
    </form>

    <div style="border: 3px solid black">
        <h2>Create a New Post</h2>
        <form action="/create-post" method="POST">
            @csrf
            <label>
                <input type="text" name="title" placeholder="post title">
            </label>
            <label>
                <textarea name="body" placeholder="body content..."></textarea>
            </label>
            <button>Save Post</button>
        </form>
    </div>

    <div style="border: 3px solid black">
        <h2>All Posts</h2>
        @foreach($posts as $post)
            <div style="background-color: gray; padding: 10px; margin: 10px;">
                <h3>{{ $post->title }}</h3>
                {{ $post->body }}
                <p><a href="/edit-post/{{ $post->id }}">Edit</a></p>
                <form action="/delete-post/{{ $post->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button>Delete</button>
                </form>
            </div>
        @endforeach
    </div>
@else
    <div style="border: 3px solid black">
        <h2>Register</h2>
        <form action="/register" method="POST">
            @csrf
            <label>
                <input name="name" type="text" placeholder="name"/>
            </label>
            <label>
                <input name="email" type="text" placeholder="email"/>
            </label>
            <label>
                <input name="password" type="password" placeholder="password"/>
            </label>
            <button>Register</button>
        </form>
    </div>
    <div style="border: 3px solid black">
        <h2>Login</h2>
        <form action="/login" METHOD="POST">
            @csrf
            <label>
                <input name="login-name" type="text" placeholder="name"/>
            </label>
            <label>
                <input name="login-password" type="password" placeholder="password"/>
            </label>
            <button>Login</button>
        </form>
    </div>
@endauth

</body>
</html>
