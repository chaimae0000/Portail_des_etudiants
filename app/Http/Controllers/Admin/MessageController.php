<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with('user')->latest()->get(); // assuming 'user_id' in Message table
        return view('frontend.user.admin.espace.gestion_msgs.index', compact('messages'));
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        $message = Message::findOrFail($id);

        // Simulate sending an email (you can replace with actual Mail::send logic)
        Mail::raw($request->reply, function ($mail) use ($message) {
            $mail->to($message->user->email)
                ->subject('Réponse à votre message');
        });

        return back()->with('success', 'Réponse envoyée avec succès.');
    }
}
