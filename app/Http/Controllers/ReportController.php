<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function report($id)
    {
        $user = Auth::user();
        $comment = Comment::findOrFail($id);

        Report::create([
            'user_id' => $user->id,
            'comment_id' => $id
        ]);

        return redirect('/post/' . $comment->post->id);
    }
}
