<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
        //Show all listings
    public function index() {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    //Show single listing
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

     // Show Edit Form
     public function edit(Listing $listing) {
        return view('admin.listings.edit', ['listing' => $listing]);
    }

    // Manage Listings
    public function manage() {
        // return view('admin.listings.manage', ['listings' => auth()->user()->listings()->get()]);
        return view('admin.listings.manage', ['listings' => Listing::latest()->paginate(10)]);

    }
}
