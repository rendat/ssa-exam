<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SoftDeleteController extends Controller
{
    public function trashed()
    {
        $trashedUsers = User::onlyTrashed()->get();
        return view('users.trashed', compact('trashedUsers'));
    }

    public function restore(User $user)
    {
        $user->restore();
        return redirect()->route('users.trashed')->with('success', 'User restored successfully.');
    }

    public function delete(User $user)
    {
        $user->forceDelete();
        return redirect()->route('users.trashed')->with('success', 'User permanently deleted.');
    }
}
