<?php

namespace App\Http\Controllers;

use App\Models\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'content' => ['required'],
            'post_id' => ['required', 'integer', 'exists:posts,id'],
        ]) ;

        $attributes['user_id'] = Auth::id();

        comment::create($attributes);
        return redirect()->route('posts.show', $request->post_id)->with('success', 'Comment added!');
    }

 
    public function edit(comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, comment $comment)
    {

        $attributes = $request->validate([
            'content' => ['required'],
        ]);

        $comment->update($attributes);

        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment updated!');
   
    }

    public function destroy(comment $comment)
    {
        // use this if your not using can / dont want to use can 

        // if (Gate::denies('edit-comment', $comment)) {
        //     abort(403, 'Unauthorized action.');
        // }

        $comment->delete();

        return back()->with('success', 'Comment deleted!');
    }
}
