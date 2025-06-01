<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Espace extends Controller
{
    public function index()
    {
        return view('Frontend.user.admin.espace.espace');
    }
    public function visualiserAdherants()
    {
        return view('frontend.user.admin.espace.gestion_adherants.visualiser_adherants');
    }

    public function messages()
    {
        return view('frontend.user.admin.espace.gestion_msgs.msgs');
       
    }
}
