<?php

namespace App\Http\Controllers\Membre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EspaceController extends Controller
{
    public function index()
    {
        return view('Frontend.user.member.espace.espace');
    }
    public function profile()
    {
        return view('frontend.user.member.espace.profile.profile');
    }

    public function messages()
    {
        return view('frontend.user.admin.espace.gestion_msgs.msgs');
       
    }
}
