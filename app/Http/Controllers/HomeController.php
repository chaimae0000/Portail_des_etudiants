<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home');
    }



    public function login()
    {
        return view('frontend.user.userlogin'); // Change this to your login blade path
    }
    public function submitLogin(Request $request)
{
    // Validation
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // Récupérer l'utilisateur depuis la base de données
    $user = DB::table('users')->where('email', $request->email)->first();

    // Vérifier si l'utilisateur existe et que le mot de passe est correct
    if ($user && Hash::check($request->password, $user->password)) {
        // Utiliser Auth::login() au lieu de Session::put()
        Auth::loginUsingId($user->id);

        // Rediriger selon le rôle de l'utilisateur
        if ($user->role === 'admin') {
            return redirect()->route('admin.index');
        } elseif ($user->role === 'membre') {
            return redirect()->route('member.dashboard');
        }
    } else {
        return redirect()->back()->withErrors(['login' => 'Invalid email or password'])->withInput();
    }
}




    public function register()
    {
        return view('frontend.user.register');
    }

    public function storeRegister(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        // Create user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'membre', // set default role
        ]);

        return redirect('/login')->with('success', 'Account created! You can now login.');
    }
    public function adminDashboard()
{
    $user = Auth::user();
    if (!$user || $user->role !== 'admin') {
        return redirect('/login');
    }

    return view('frontend.user.admin.index', ['user' => $user]);
}

public function memberDashboard()
{
    $user = Auth::user();
    if (!$user || $user->role !== 'membre') {
        return redirect('/login');
    }

    return view('frontend.user.member.dashboard', ['user' => $user]);
}

}
