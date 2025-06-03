<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Event;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Affiche le tableau de bord administrateur
     */
    public function index()
    {
        // Statistiques principales
        $membersCount = User::where('role', 'membre')->count();
        $evenementsCount = Event::count();
        $postsCount = Post::count();
        $commentairesCount = Comment::count();

        // Membres récents (5 derniers inscrits)
        $recentMembers = User::where('role', 'membre')
    ->latest('created_at')
    ->take(5)
    ->select('id', 'name', 'email', 'created_at', 'photo') // <-- on ajoute 'photo'
    ->get();


        // Commentaires récents (5 derniers)
        $latestCommentaires = Comment::with(['user:id,name'])
                                    ->latest('created_at')
                                    ->take(5)
                                    ->select('id', 'user_id', 'content', 'created_at')
                                    ->get();

        $latestMessages = Message::with(['sender:id,name'])
    ->where('receiver_id', Auth::id()) // ou un ID fixe si nécessaire
    ->latest()
    ->take(2)
    ->get(['id', 'sender_id', 'body', 'created_at']);


    

        return view('frontend.user.admin.dashboard', compact(
            'membersCount',
            'evenementsCount',
            'postsCount',
            'commentairesCount',
            'recentMembers',
            'latestCommentaires',
            'latestMessages'
        ));
    }

}