<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string|max:1000',
        ]);
    
        Comment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::user()->id,
            'content' => $request->content,
        ]);
    
        return back();
    }
    
}
