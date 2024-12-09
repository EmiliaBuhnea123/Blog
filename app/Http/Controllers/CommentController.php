<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index($id)
    {
        $comments = Comment::where('article_id', $id)->with(['article', 'user'])->get();

        return view('home', ['comments' => $comments]);
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:1000', 
        ]);

        Comment::create([
            'comment' => $request->input('comment'),
            'article_id' => $id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('home', $id);
    }

    public function show($id)
    {
        $comment = Comment::where('article_id', $id)
            ->with(['article', 'user'])
            ->get();

        $this->authorize('view', $comment);

        return view('home', [
            'comments' => $comment,
        ]);
    }
}
