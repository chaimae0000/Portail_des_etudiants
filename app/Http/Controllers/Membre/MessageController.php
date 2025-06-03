<?php

namespace App\Http\Controllers\Membre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Affiche toutes les conversations et les utilisateurs pour l'utilisateur connecté.
     */
    public function msgs()
{
    $userId = Auth::id();

    // Récupère les conversations où l'utilisateur est l'un des participants
    $conversations = Conversation::where('user_one_id', $userId)
        ->orWhere('user_two_id', $userId)
        ->with(['userOne', 'userTwo'])
        ->get();

    // Filtrer les conversations, supprimer celles dont un utilisateur n'existe plus
    foreach ($conversations as $conversation) {
        if (!$conversation->userOne || !$conversation->userTwo) {
            // Supprime la conversation si un des deux utilisateurs n'existe plus
            $conversation->delete();
        }
    }

    // Récupère à nouveau les conversations valides (après suppression)
    $conversations = Conversation::where('user_one_id', $userId)
        ->orWhere('user_two_id', $userId)
        ->with(['userOne', 'userTwo'])
        ->get();

    // Récupère les autres utilisateurs (destinataires possibles)
    $users = User::where('id', '!=', $userId)->get();

    return view('frontend.user.member.espace.gestion_msgs.index', compact('conversations', 'users'));
}


    /**
     * Affiche les messages d’une conversation.
     */
    public function show($id)
{
    $conversation = Conversation::with(['messages' => function ($query) {
        $query->orderBy('created_at', 'asc');
    }, 'messages.sender'])->findOrFail($id);

    $userId = Auth::id();

    if ($conversation->user_one_id !== $userId && $conversation->user_two_id !== $userId) {
        abort(403);
    }

    return view('frontend.user.member.espace.gestion_msgs.show', compact('conversation'));
}


    /**
     * Envoie un nouveau message et crée une conversation si elle n’existe pas.
     */
    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id|different:' . Auth::id(),
            'body' => 'required|string|max:2000',
        ]);

        $senderId = Auth::id();
        $receiverId = $request->receiver_id;

        $conversation = $this->getOrCreateConversation($senderId, $receiverId);

        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id'       => $senderId,
            'receiver_id'     => $receiverId,
            'body'            => $request->body,
        ]);

        return redirect()->route('membre.messages.show', $conversation->id)
                         ->with('success', 'Message envoyé.');
    }

    /**
     * Répond à une conversation existante.
     */
    public function reply(Request $request, $id)
    {
        $request->validate([
            'body' => 'required|string|max:2000',
        ]);

        $conversation = Conversation::findOrFail($id);
        $userId = Auth::id();

        if (!in_array($userId, [$conversation->user_one_id, $conversation->user_two_id])) {
            abort(403); // Accès non autorisé
        }

        $receiverId = $conversation->user_one_id === $userId
            ? $conversation->user_two_id
            : $conversation->user_one_id;

        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id'       => $userId,
            'receiver_id'     => $receiverId,
            'body'            => $request->body,
        ]);

        return redirect()->back()->with('success', 'Réponse envoyée.');
    }

    /**
     * Récupère ou crée une conversation entre deux utilisateurs.
     */
    private function getOrCreateConversation($user1, $user2)
    {
        return Conversation::firstOrCreate(
            [
                'user_one_id' => min($user1, $user2),
                'user_two_id' => max($user1, $user2),
            ]
        );
    }
    public function headerData()
{
    $messages = Message::latest()->take(5)->get();
    return view('partials.header', compact('messages'));
}
}
