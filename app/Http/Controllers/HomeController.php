<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
        // Validate input fields
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Fetch the user from the database based on email
        $user = DB::table('users')->where('email', $request->email)->first();

        // Check if user exists and the password matches
        if ($user && Hash::check($request->password, $user->password)) {
            // Store the user object in session (ensure it's stored correctly)
            Session::put('user', $user);

            // Redirect based on user role
            if ($user->role === 'admin') {
                return redirect()->route('admin.index');
            } elseif ($user->role === 'membre') {
                return redirect()->route('member.dashboard');
            } else {
                // If the credentials are incorrect, show an error
                return redirect()->back()->withErrors(['login' => 'Invalid email or password'])->withInput();
            }
        }
        else {
        // ✅ Handle failed login
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
        $user = Session::get('user');
        if (!$user || $user->role !== 'admin') {
            return redirect('/login');
        }

        return view('frontend.user.admin.index', ['user' => $user]);
    }

    public function memberDashboard()
    {
        $user = Session::get('user');
        if (!$user || $user->role !== 'membre') {
            return redirect('/login');
        }

        return view('frontend.user.member.dashboard', ['user' => $user]);
    }
}
