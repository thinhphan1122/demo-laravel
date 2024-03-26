<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function deletePost(Post $post)
    {
        if(auth()->user()->id === $post['user_id']){
            $post->delete();
        }
        return redirect('/home');
    }

    public function actuallyUpdatePost(Post $post, Request $request)
    {
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/home');
        }

        $incomingFieldValues = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFieldValues['title'] = strip_tags($incomingFieldValues['title']);
        $incomingFieldValues['body'] = strip_tags($incomingFieldValues['body']);

        $post->update($incomingFieldValues);

        return view('/home');
    }

    public function showEditScreen(Post $post)
    {
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/home');
        }
        return view('/edit-post', ['post' => $post]);
    }

    public function createPost(Request $request)
    {
        $incomingFieldValues = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFieldValues['title'] = strip_tags($incomingFieldValues['title']);
        $incomingFieldValues['body'] = strip_tags($incomingFieldValues['body']);
        $incomingFieldValues['user_id'] = auth()->id();
        Post::create($incomingFieldValues);
        return redirect('/home');
    }
}
