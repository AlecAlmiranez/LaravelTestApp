<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Idea $idea){

        $comment = new comment();
        $comment->idea_id = $idea->id;
        $comment->content = request()->get('content');
        $comment->user_id = auth()->id();
        $comment->save();

        return redirect()->route('idea.show',$idea->id)->with('success', 'Comment posted successfully');
    }
}
