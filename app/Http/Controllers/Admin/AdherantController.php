<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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

}
