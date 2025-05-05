<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller{
    public function index()
    {
        return view('frontend.user.admin.index');
    }
    //add html for create user
   public function create()
    {
        return view('frontend.user.admin.create');
    }
    public function store(Request $request)
    {
        // Validate input fields
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,membre'
        ]);

        // Create a new user instance
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.index')->with('success', 'User created successfully!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('frontend.user.admin.setting', compact('user'));
    }

    
    public function update(Request $request, $id)
    {
        // Validate input fields
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,membre'
        ]);

        // Find the user and update their information
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.index')->with('success', 'User updated successfully!');
    }


    public function destroy($id)
    {
        // Find the user and delete them
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.index')->with('success', 'User deleted successfully!');
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('frontend.user.admin.show', compact('user'));
    }
    public function list()
    {
        $users = User::all();
        return view('frontend.user.admin.list', compact('users'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $users = User::where('name', 'LIKE', "%$query%")
            ->orWhere('email', 'LIKE', "%$query%")
            ->get();

        return view('frontend.user.admin.list', compact('users'));
    }
    public function filter(Request $request)
    {
        $role = $request->input('role');
        $users = User::where('role', $role)->get();

        return view('frontend.user.admin.list', compact('users'));
    }



}






