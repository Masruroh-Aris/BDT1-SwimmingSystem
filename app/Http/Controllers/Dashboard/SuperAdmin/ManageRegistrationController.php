<?php

namespace App\Http\Controllers\Dashboard\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registration;

class ManageRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Registration::latest();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('athlete_name', 'LIKE', "%{$search}%")
                  ->orWhere('event_name', 'LIKE', "%{$search}%")
                  ->orWhere('meet_name', 'LIKE', "%{$search}%")
                  ->orWhere('status', 'LIKE', "%{$search}%");
        }

        $registrations = $query->get();

        return view('dashboard.superadmin.actions.manage-regist', compact('registrations'));
    }

    /**
     * Update the registration status.
     */
    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:registrations,id',
            'status' => 'required|in:Paid,Rejected',
            'reject_note' => 'nullable|string',
        ]);

        $registration = Registration::findOrFail($request->id);
        
        $updateData = [
            'status' => $request->status,
        ];

        if ($request->status === 'Rejected') {
            $updateData['reject_note'] = $request->reject_note;
        } else {
            // If approving, maybe clear previous reject note?
            $updateData['reject_note'] = null;
        }

        $registration->update($updateData);

        return back()->with('success', 'Registration status updated successfully.');
    }
}
