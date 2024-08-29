<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Fetch all users from the database
        return view('users.index', compact('users')); // Pass the users to the view
    }

    public function show(User $user)
    {
        return response()->json($user);
    }
    

}


