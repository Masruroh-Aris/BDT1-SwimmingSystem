<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\RegistrationSuccess;

class RegisterController extends Controller
{
    public function index()
    {
        // Fetch Upcoming and Ongoing meets
        $meets = \App\Models\Meet::whereIn('status', ['Upcoming', 'Ongoing'])->latest()->get();
        // Fetch all events
        $events = \App\Models\Event::all();
        
        return view('dashboard.admin.actions.register-admin', compact('meets', 'events'));
    }

    public function store(Request $request)
    {
        // Simple validation
        $request->validate([
            'athlete' => 'required', // Still hardcoded/mocked for now
            'meet' => 'required|exists:meets,id',
            'event' => 'required|exists:events,id',
            'proof_image' => 'nullable|string',
        ]);

        // Mapping Data (Simulating Real DB Relations for Athletes)
        $athletes = [
            '1' => 'Athlete 1 - AT001',
            '2' => 'Samsul - AT002'
        ];
        
        // Resolve Meet and Event from DB
        $meet = \App\Models\Meet::findOrFail($request->meet);
        $event = \App\Models\Event::findOrFail($request->event);

        // Fee Calculation
        $eventFee = $event->fee;
        $regFee = 20000;
        $totalFee = $eventFee + $regFee;

        // Determine Status
        $status = 'Pending';

        $reg = \App\Models\Registration::create([
            'athlete_name' => $athletes[$request->athlete] ?? 'Unknown Athlete',
            'meet_name' => $meet->name,
            'event_name' => $event->name,
            'fee' => $totalFee,
            'status' => $status,
            'input_by' => 'Admin', 
            'payment_method' => $request->input('payment_method'),
            'proof_image' => $request->input('proof_image'),
        ]);

        // Send Email Notification
        if(Auth::user() && Auth::user()->email) {
            try {
                Mail::to(Auth::user()->email)->send(new RegistrationSuccess($reg));
            } catch (\Exception $e) {
                // Log error but don't stop the flow
                \Log::error('Email sending failed: ' . $e->getMessage());
            }
        }

        return redirect()->route('admin.dashboard')->with('success', 'Registration submitted successfully!');
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:registrations,id',
            'status' => 'required|string'
        ]);

        $reg = \App\Models\Registration::findOrFail($request->id);
        $reg->update(['status' => $request->status]);

        return back()->with('success', 'Registration status updated to ' . $request->status);
    }
}
