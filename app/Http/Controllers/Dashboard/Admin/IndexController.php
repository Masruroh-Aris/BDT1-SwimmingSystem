<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Registration;
use App\Models\Certificate;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Fetch latest registrations with search
            $query = \App\Models\Registration::latest();

            if ($request->has('search') && !empty(trim($request->search))) {
                $search = trim($request->search);
                $query->where(function($q) use ($search) {
                    $q->where('athlete_name', 'LIKE', "%{$search}%")
                      ->orWhere('meet_name', 'LIKE', "%{$search}%")
                      ->orWhere('event_name', 'LIKE', "%{$search}%")
                      ->orWhere('status', 'LIKE', "%{$search}%");
                });
            }

            $registrations = $query->take(10)->get();

            // Fetch events that have certificate backgrounds
            $validEvents = \App\Models\Certificate::distinct()->pluck('event_name')->toArray();

            // Pass to view
            return view('dashboard.admin.indexdsbadmin', compact('registrations', 'validEvents'));
        } catch (\Exception $e) {
            \Log::error('Error in admin dashboard: ' . $e->getMessage(), [
                'user_id' => auth()->id(),
                'trace' => $e->getTraceAsString()
            ]);

            // Return view with empty data
            return view('dashboard.admin.indexdsbadmin', [
                'registrations' => collect(),
                'validEvents' => [],
                'error' => 'Terjadi kesalahan saat memuat data. Silakan coba lagi.'
            ]);
        }
    }
}
