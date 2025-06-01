<?php


namespace App\Http\Controllers\Membre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        // On récupère les posts de l'admin uniquement (tu peux filtrer sur user->role == admin)
        $posts = Post::with(['user', 'likes', 'comments.user'])
                    ->whereHas('user', function ($q) {
                        $q->where('role', 'admin');
                    })
                    ->latest()
                    ->get();

        return view('Frontend.user.member.posts.index', compact('posts'));
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


    public function comment(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string|max:1000',
        ]);

        $post = Post::findOrFail($request->post_id);
        $post->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return back();
    }
}
