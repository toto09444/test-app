<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Listing;
use Illuminate\Http\Request;

class StatusController extends Controller
{
   // Create New Status
   public function store(Request $request) {

    dd( $request);
    $formFields = $request->validate([
        'applied' => 'boolean', // Validate the checkbox value
    ]);

    $listingId = $request->input('listing_id');
    $userId = auth()->id();




    // Create status
    // Status::create(array_merge($formFields, ['user_id'=>$userId]));
    Status::create([
        'applied' => $formFields['applied'],
        'listing_id' => $listingId,
        'user_id' => $userId,
    ]);



    // Login

    return redirect('/')->with('message', 'User created and logged in');
}}
