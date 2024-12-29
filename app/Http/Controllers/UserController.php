<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Ambil semua data user dari database
        $users = User::where('role', 'user')->get();


        // Kirim data user ke view
        return view('pages.user', compact('users'));
    }
}
