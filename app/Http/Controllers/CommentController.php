<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $post_id)
    {
        $request->validate([
            'body' => 'required'
        ]);

        $user = Auth::user();

        $user->comments()->create([
            'body' => $request->body,
            'post_id' => $post_id
        ]);
        // $post = Post::find($post_id);

        // $post->comments()->create([
        //     'body' => $request->body,
        //     'user_id' => $user->id
        // ]);
        $this->notify($user, $post_id);

        return redirect('/post/' . $post_id);
    }

    private function notify($user, $post_id)
    {
        $target_id = Post::find($post_id)->user_id;

        if ($user->id != $target_id) {
            Notification::create([
                'user_id' => $target_id,
                'post_id' => $post_id,
                'message' => 'kamu mendapat komentar dari ' . '' . $user->username

            ]);
        }
    }

    public function edit($id)
    {

        $comment = Comment::findOrFail($id);
        $user = Auth::user();

        if ($user->id !== $comment->user_id) {
            abort(404);
        }
        return view('posts.comment-edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'body' => 'required'
        ]);

        $user = Auth::user();
        $comment = Comment::findOrFail($id);

        if ($user->id != $comment->user_id) {
            abort(403);
        }

        $comment->update([
            'body' => $request->body
        ]);

        return redirect('/post/' . $comment->post_id);
    }

    public function destroy($id)
    {

        $comment = Comment::findOrFail($id);
        $user = Auth::user();
        if ($user->id != $comment->user_id)
            abort(403);

        $comment->delete();
        $this->cancelNotify($user, $comment->post_id);
        return redirect('/post/' . $comment->post_id);
    }

    private function cancelNotify($user, $post_id)
    {

        $target_id = Post::find($post_id)->user_id;

        if ($user->id != $target_id) {
            Notification::where('user_id', $target_id)->where('post_id', $post_id)->where('message', 'like', '%komentar%')->delete();
        }
    }
}
