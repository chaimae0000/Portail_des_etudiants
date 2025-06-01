<?php

namespace App\Http\Controllers\Membre;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Affiche la page du profil du membre connecté.
     */
    public function show()
    {
        $user = Auth::user();
        return view('Frontend.user.member.espace.profile.profile', compact('user'));
    }

    /**
     * Met à jour le profil du membre.
     */
    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            $photoPath = $request->file('photo')->store('photos', 'public');
            $user->photo = $photoPath;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('membre.profile.show')->with('success', 'Profil mis à jour avec succès.');
    }
    public function destroy(Request $request)
{
    /** @var User $user */
    $user = Auth::user();

    // Optionnel : tu peux demander la confirmation du mot de passe avant suppression
    // $request->validate([
    //     'password' => 'required',
    // ]);
    // if (!Hash::check($request->password, $user->password)) {
    //     return back()->withErrors(['password' => 'Mot de passe incorrect.']);
    // }

    Auth::logout(); // Déconnecte l'utilisateur

    $user->delete(); // Supprime le compte

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/')->with('success', 'Votre compte a bien été supprimé.');
}

}
