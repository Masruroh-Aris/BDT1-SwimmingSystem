<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.edit-profil');
    }

    public function update(Request $request)
    {
        // Validation and update logic will go here
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
