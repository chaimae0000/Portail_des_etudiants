<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class Espace extends Controller
{
    public function index()
    {
        return view('Frontend.user.admin.espace.espace');
    }
    
}
