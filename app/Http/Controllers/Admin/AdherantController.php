<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
    // Validate the incoming data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
    ]);

    
    // Handle photo upload if it exists
    $photoPath = null;
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('photos', 'public');
        // Debugging: Output the path to verify the file is stored
    }

    // Create the user (Adhérent)
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'membre',
        'photo' => $photoPath, // Ensure the path is saved in the database
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
        'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user = User::findOrFail($id);


    // S’il y a une nouvelle photo, la stocker
    if ($request->hasFile('photo')) {
        // Supprimer l'ancienne photo si elle existe
        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        $photoPath = $request->file('photo')->store('photos', 'public');
        $user->photo = $photoPath;
    }

    $user->name = $request->name;
    $user->email = $request->email;
    $user->save();

    return redirect()->route('adherants.show', $id)->with('success', 'Adhérent mis à jour.');
}

public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('visualiser_adherants')->with('danger', 'Adhérent supprimé.');
}


}
