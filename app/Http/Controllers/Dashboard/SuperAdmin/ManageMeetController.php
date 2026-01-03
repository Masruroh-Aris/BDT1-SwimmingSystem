<?php

namespace App\Http\Controllers\Dashboard\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meet;

class ManageMeetController extends Controller
{
    /**
     * Display a listing of the meets.
     */
    public function index(Request $request)
    {
        $query = Meet::latest();
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('code', 'LIKE', "%{$search}%")
                  ->orWhere('venue', 'LIKE', "%{$search}%");
        }

        $meets = $query->get();
        return view('dashboard.superadmin.actions.ManageMeet.index-sadm', compact('meets'));
    }

    /**
     * Show the form for creating a new meet.
     */
    public function create()
    {
        return view('dashboard.superadmin.actions.ManageMeet.create-sadm');
    }

    /**
     * Store a newly created meet in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:meets,code|max:50',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'venue' => 'required|string|max:255',
            'status' => 'required|string',
            'created_by' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $imageName = time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('uploads/meets/logos'), $imageName);
            $validatedData['logo'] = 'uploads/meets/logos/' . $imageName;
        }

        Meet::create($validatedData);

        return redirect()->route('superadmin.manage-meet')->with('success', 'Meet created successfully!');
    }

    /**
     * Show the form for editing the specified meet.
     */
    public function edit($id)
    {
        $meet = Meet::findOrFail($id);
        return view('dashboard.superadmin.actions.ManageMeet.edit-meet-sadm', compact('meet'));
    }

    /**
     * Update the specified meet in storage.
     */
    public function update(Request $request, $id)
    {
        $meet = Meet::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:meets,code,' . $meet->id,
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'venue' => 'required|string|max:255',
            'status' => 'required|string',
            'created_by' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            // Delete old image if exists
            if ($meet->logo && file_exists(public_path($meet->logo))) {
                unlink(public_path($meet->logo));
            }

            $imageName = time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('uploads/meets/logos'), $imageName);
            $validatedData['logo'] = 'uploads/meets/logos/' . $imageName;
        }

        $meet->update($validatedData);

        return redirect()->route('superadmin.manage-meet')->with('success', 'Meet updated successfully!');
    }

    /**
     * Remove the specified meet from storage.
     */
    public function destroy($id)
    {
        $meet = Meet::findOrFail($id);
        $meet->delete();

        return redirect()->route('superadmin.manage-meet')->with('success', 'Meet deleted successfully!');
    }
}
