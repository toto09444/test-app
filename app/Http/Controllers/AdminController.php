<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        // Your admin dashboard logic here
        $listings = Listing::latest()->paginate();
        return view('admin.listings.index', compact('listings'));
    }

    // Show Register/Create Form
    public function create() {
        return view('admin.auth.register');
    }

    // Create New User
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'role' => ['required'],
            'password' => 'required|confirmed|min:6'
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create User
        $user = User::create($formFields);
       return redirect('/admin/auth/manage')->with('message', 'User created successfully');
    }

      // Delete Listing
      public function destroy(User $user) {        
        $user->delete();
        return redirect('/admin/auth/manage')->with('message', 'User deleted successfully');
    }
}
