<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('Frontend.user.admin.posts.posts', compact('posts'));

    }
    public function store(Request $request)
{
    $request->validate([
        'content' => 'required|string',
        'image' => 'nullable|image|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('posts', 'public');
    }

    $post = new Post();
    $post->user_id = Auth::user()->id;
    $post->content = $request->content;
    $post->image_path = $imagePath;
    $post->save();

    return redirect()->back()->with('success', 'Post publié avec succès.');
}

    public function like(Post $post)
    {
        $userId = Auth::user()->id;
    
        // Vérifie si l'utilisateur a déjà liké ce post
        $existing = $post->likes()->where('user_id', $userId)->first();
    
        if ($existing) {
            // Option : on enlève le like s'il existe déjà (toggle)
            $existing->delete();
        } else {
            $post->likes()->create([
                'user_id' => $userId,
            ]);
        }
    
        return back();
    }
    public function destroy($id)
{
    $post = Post::findOrFail($id);

    // Optionnel : autoriser uniquement le créateur à supprimer
    if (Auth::id() !== $post->user_id) {
        abort(403, 'Action non autorisée');
    }

    $post->delete();

    return redirect()->route('posts.index')->with('success', 'Post supprimé avec succès.');
}
public function edit($id)
{
    $post = Post::findOrFail($id);

    if (Auth::id() !== $post->user_id) {
        abort(403, 'Action non autorisée');
    }

    return view('posts.edit', compact('post'));
}

public function update(Request $request, $id)
{
    $post = Post::findOrFail($id);

    if (Auth::id() !== $post->user_id) {
        abort(403, 'Action non autorisée');
    }

    $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'required|string',
    ]);

    $post->update([
        'title' => $request->title,
        'body' => $request->body,
    ]);

    return redirect()->route('posts.show', $post->id)->with('success', 'Post mis à jour avec succès.');
}



}
