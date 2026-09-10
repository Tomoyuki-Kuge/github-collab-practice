<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(20);
        return view('users.index', ['users' => $users]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|uniqid:users',
            'pasword' => 'required|min:8',
        ]);

        User::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => Hash::make($validate['name']),
        ]);

        return redirect('/users');
    }
}
