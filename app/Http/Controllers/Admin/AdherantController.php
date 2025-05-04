<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdherantController extends Controller
{
    public function index()
    {
        return view('Frontend.user.admin.espace.gestion_adherants.visualiser_adherants');
    }
    
}
