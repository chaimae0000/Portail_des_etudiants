<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
    $userId = Auth::id();

    // Vérifie si déjà liké
    $alreadyLiked = $post->likes()->where('user_id', $userId)->exists();

    if (!$alreadyLiked) {
        // Ajoute un like uniquement si ce n'est pas déjà fait
        $post->likes()->create(['user_id' => $userId]);
    }

    return back(); // ou return redirect()->route(...); selon ta logique
}
public function unlike(Post $post)
{
    $userId = Auth::id();

    $post->likes()->where('user_id', $userId)->delete();

    return back();
}


    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Autoriser uniquement le créateur à supprimer
        if (Auth::id() !== $post->user_id) {
            abort(403, 'Action non autorisée');
        }

        // Supprimer l'image si elle existe
        if ($post->image_path && Storage::disk('public')->exists($post->image_path)) {
            Storage::disk('public')->delete($post->image_path);
        }

        $post->delete();

        return redirect()->back()->with('success', 'Post supprimé avec succès.');
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if (Auth::id() !== $post->user_id) {
            abort(403, 'Action non autorisée');
        }

        $request->validate([
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // Gestion de l'image
        if ($request->hasFile('image')) {
            // Supprimer ancienne image si elle existe
            if ($post->image_path && Storage::disk('public')->exists($post->image_path)) {
                Storage::disk('public')->delete($post->image_path);
            }
            $imagePath = $request->file('image')->store('posts', 'public');
            $post->image_path = $imagePath;
        } elseif ($request->has('delete_image') && $post->image_path) {
            // Supprimer l'image si la case est cochée
            if (Storage::disk('public')->exists($post->image_path)) {
                Storage::disk('public')->delete($post->image_path);
            }
            $post->image_path = null;
        }

        $post->content = $request->content;
        $post->save();

        return redirect()->back()->with('success', 'Post mis à jour avec succès.');
    }
}