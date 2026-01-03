<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index($id = null)
    {
        // If ID is provided, fetch specific registration, otherwise fetch latest or error
        // Given the flow, we expect an ID.
        if ($id) {
            $registration = \App\Models\Registration::findOrFail($id);
        } else {
            // Fallback or list view? For now, let's just abort or fetch first for safety if accessed directly
            $registration = \App\Models\Registration::latest()->first();
            if (!$registration) {
                 return redirect()->route('admin.dashboard')->with('error', 'No history available.');
            }
        }

        return view('dashboard.admin.actions.history-admin', compact('registration'));
    }
}
