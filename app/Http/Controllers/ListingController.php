<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


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

    // Show Create Form
    public function create() {
        return view('admin.listings.create');
    }

      // Store Listing Data
      public function store(Request $request) {
        // dd(auth()->check(), auth()->user(), session()->all());
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        if (auth()->check()) {
            $formFields['user_id'] = auth()->id();
        }

    
        Listing::create($formFields);

        // return redirect()->route('admin.listings.index')->with('message', 'Job created successfully!');  
        return redirect('/')->with('message', 'Listing created successfully!');

      }

     // Show Edit Form
     public function edit(Listing $listing) {
        return view('admin.listings.edit', ['listing' => $listing]);
    }

    // Manage Listings
    public function manage() {
        return view('admin.listings.manage', ['listings' => Listing::latest()->paginate(10)]);
    }

    // Update Listing Data
    public function update(Request $request, Listing $listing) {              
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);
        $listings = auth()->user()->listings()->get(); // Fetch updated list of listings
        return redirect()->route('admin.listings.manage', compact('listings'))->with('message', 'Listing updated successfully!');

    }

    // Delete Listing
    public function destroy(Listing $listing) {
        
        if($listing->logo && Storage::disk('public')->exists($listing->logo)) {
            Storage::disk('public')->delete($listing->logo);
        }
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully');
    }
}
