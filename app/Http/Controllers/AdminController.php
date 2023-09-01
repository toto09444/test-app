<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Your admin dashboard logic here
        $listings = Listing::paginate();
        return view('admin.listings.index', compact('listings'));
    }

    // Show Register/Create Form
    public function create() {
        return view('admin.auth.register');
    }
}
