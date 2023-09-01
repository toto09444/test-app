<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Show Register/Create Form
    public function create() {
        return view('auth.register');
    }

    // Create New User
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create User
        $user = User::create($formFields);

        // Login
        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in');
    }

    // Logout User
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');

    }

    // Show Login Form
    public function login() {
        return view('auth.login');
    }

    // Authenticate User
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();
            $user = auth()->user();
             
            if ($user->role === 'admin') {
                // dd($user->role);

                return redirect()->route('admin.listings.index')->with('message', 'You are now logged in as an admin.');
            } else {
                return redirect('/')->with('message', 'You are now logged in!');
            }

            // return redirect('/')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }


    // Manage users
    public function manage() {
        return view('admin.auth.manage', ['users' => User::latest()->paginate(10)]);
    }

     // Show Edit Form
     public function edit(User $user) {
        return view('admin.auth.edit', ['user' => $user]);
    }

    // Update User Data
public function update(Request $request, User $user) {              
    $formFields = $request->validate([
        'name' => 'required',
        'role' => 'required',
    ]);

    $user->update($formFields);
    return redirect()->route('admin.auth.manage')->with('message', 'User updated successfully!');
}

//Show single user
public function show(User $user) {
    // dd($user);
    return view('admin.auth.show', [
        'user' => $user
    ]);
}

}
