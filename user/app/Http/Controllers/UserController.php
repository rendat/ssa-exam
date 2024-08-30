<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


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

    public function store(Request $request)
{
    // Validate the form input
    $request->validate([
        'prefixname' => ['nullable', 'string', 'max:255'],
        'firstname' => ['required', 'string', 'max:255'],
        'middlename' => ['nullable', 'string', 'max:255'],
        'lastname' => ['required', 'string', 'max:255'],
        'suffixname' => ['nullable', 'string', 'max:255'],
        'username' => ['required', 'string', 'max:255', 'unique:users'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'photo' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048'],
    ]);

    // Handle the photo upload
    $photoPath = null;
    if ($request->hasFile('photo')) {
        $photo = $request->file('photo');
        $photoPath = $photo->store('photos', 'public');
    }

    // Create a new user
    User::create([
        'prefixname' => $request->prefixname,
        'firstname' => $request->firstname,
        'middlename' => $request->middlename, 
        'lastname' => $request->lastname,
        'suffixname' => $request->suffixname, 
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password), 
        'photo' => $photoPath,
    ]);

    // Redirect or show success message
    return redirect()->back()->with('success', 'User created successfully!');
}

public function edit(User $user)
{
    return response()->json($user);
}
public function destroy(User $user)
{
   
    $user->delete();

 
    return response()->json(['success' => 'User deleted successfully!']);
}
public function trashed()
{
    $trashedUsers = User::onlyTrashed()->get(); 
    return view('users.trashed', compact('trashedUsers'));
}

public function trasheds()
{
   
    $trashedUsers = User::onlyTrashed()->get(); 
    return view('users.trashed', compact('trashedUsers'));
}



public function restore($id)
{
    $user = User::withTrashed()->findOrFail($id);
    $user->restore(); // Restore the soft-deleted user

    return redirect()->route('users.trashed')->with('success', 'User restored successfully.');
}

public function forceDelete($id)
{
    $user = User::onlyTrashed()->findOrFail($id);
    $user->forceDelete();

    return redirect()->route('users.trashed')->with('success', 'User permanently deleted!');
}


public function update(Request $request, User $user)
{
    // Validate the form input
    $request->validate([
        'prefixname' => ['nullable', 'string', 'max:255'],
        'firstname' => ['required', 'string', 'max:255'],
        'middlename' => ['nullable', 'string', 'max:255'],
        'lastname' => ['required', 'string', 'max:255'],
        'suffixname' => ['nullable', 'string', 'max:255'],
        'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        'photo' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048'],
    ]);

    // Handle the photo upload
    if ($request->hasFile('photo')) {
        $photo = $request->file('photo');
        $photoPath = $photo->store('photos', 'public');
        $user->photo = $photoPath;
    }

    // Update user data
    $user->prefixname = $request->prefixname;
    $user->firstname = $request->firstname;
    $user->middlename = $request->middlename;
    $user->lastname = $request->lastname;
    $user->suffixname = $request->suffixname;
    $user->username = $request->username;
    $user->email = $request->email;

    // Update password if provided
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    // Return success response
    return response()->json(['success' => 'User updated successfully!']);
}


}
    




