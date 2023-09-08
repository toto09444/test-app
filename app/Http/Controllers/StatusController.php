<?php

namespace App\Http\Controllers;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
   // Create New Status
   public function store(Request $request) {
    // dd($request->all());
    $formFields = $request->validate([
        'applied' => 'required',
        'listing_id' => 'required', // Validate the checkbox value
    ]);

    $userId = auth()->id();
    Status::create(array_merge($formFields, ['user_id'=>$userId, 'applied_on' => now()]));
    return redirect('/')->with('message', 'User applied for this role');
}}
