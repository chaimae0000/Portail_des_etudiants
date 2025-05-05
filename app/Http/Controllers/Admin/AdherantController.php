<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdherantController extends Controller
{
    /**
     * Afficher la liste de tous les adhérents (utilisateurs avec le rôle 'membre').
     */
    public function index()
{
    // Récupérer tous les utilisateurs avec le rôle 'membre'
    $users = User::where('role', 'membre')->get();

    // Test simple pour vérifier que des utilisateurs sont récupérés
    if ($users->isEmpty()) {
        // Si aucun utilisateur n'est trouvé, retourner une erreur ou un message
        return view('Frontend.user.admin.espace.gestion_adherants.visualiser_adherants', ['message' => 'Aucun utilisateur trouvé']);
    }

    // Sinon passer les utilisateurs à la vue
    return view('Frontend.user.admin.espace.gestion_adherants.visualiser_adherants', compact('users'));
}
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'membre',
    ]);

    return redirect()->route('visualiser_adherants')->with('success', 'Adhérent ajouté avec succès.');
}
public function show($id)
{
    $user = User::findOrFail($id);
    return view('Frontend.user.admin.espace.gestion_adherants.show', compact('user'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
    ]);

    $user = User::findOrFail($id);
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    return redirect()->route('adherants.show', $id)->with('success', 'Adhérent mis à jour.');
}

public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('visualiser_adherants')->with('success', 'Adhérent supprimé.');
}

}
