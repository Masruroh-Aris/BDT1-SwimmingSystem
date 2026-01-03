<?php

namespace App\Http\Controllers\Dashboard\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.superadmin.edit-profil');
    }

    public function update(Request $request)
    {
        // Validation and update logic will go here
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
