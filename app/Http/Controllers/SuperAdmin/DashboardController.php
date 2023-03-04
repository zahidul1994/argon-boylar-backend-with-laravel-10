<?php

namespace App\Http\Controllers\SuperAdmin;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        
        return view('backend.superadmin.dashboard');
    }
}
