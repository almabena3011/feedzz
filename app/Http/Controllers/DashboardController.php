<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function userlist()
    {
        $users = User::all();
        return view('admin.alluser', compact('users'));
    }
}
