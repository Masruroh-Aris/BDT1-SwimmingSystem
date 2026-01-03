<?php

namespace App\Http\Controllers\Dashboard\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('dashboard.operator.edit-profil');
    }

    public function update(Request $request)
    {
        // Validation and update logic will go here
        return redirect()->route('operator.profile.edit')->with('success', 'Profile updated successfully!');
    }
}
