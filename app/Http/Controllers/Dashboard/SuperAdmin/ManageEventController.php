<?php

namespace App\Http\Controllers\Dashboard\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Meet;
use Illuminate\Http\Request;

class ManageEventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with('meet'); // Eager load meet

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('code', 'LIKE', "%{$search}%")
                  ->orWhere('gender', 'LIKE', "%{$search}%")
                  ->orWhere('age_group', 'LIKE', "%{$search}%");
        }

        $events = $query->get();
        return view('dashboard.superadmin.actions.manage-event', compact('events'));
    }

    public function create()
    {
        $meets = Meet::whereIn('status', ['Upcoming', 'Ongoing', 'Registration Open'])->get();
        return view('dashboard.superadmin.actions.ManageMeet.create-event-sadm', compact('meets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'meet_id' => 'required|exists:meets,id',
            'name' => 'required',
            'code' => 'required|unique:events,code',
            'start_time' => 'required',
            'fee' => 'required|numeric',
            'gender' => 'required',
            'age_group' => 'required',
            'heat' => 'required|integer',
            'relay' => 'boolean',
            'status' => 'required',
        ]);

        Event::create($request->all());

        return redirect()->route('superadmin.manage-event')->with('success', 'Event created successfully!');
    }

    public function show($id)
    {
        $event = Event::with('meet')->findOrFail($id);
        return view('dashboard.superadmin.actions.show-event', compact('event'));
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $meets = Meet::whereIn('status', ['Upcoming', 'Ongoing', 'Registration Open'])->get();
        return view('dashboard.superadmin.actions.ManageMeet.edit-event-sadm', compact('event', 'meets'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'meet_id' => 'required|exists:meets,id',
            'name' => 'required',
            'code' => 'required|unique:events,code,' . $id,
            'start_time' => 'required',
            'fee' => 'required|numeric',
            'gender' => 'required',
            'age_group' => 'required',
            'heat' => 'required|integer',
            'relay' => 'boolean',
            'status' => 'required',
        ]);

        $event = Event::findOrFail($id);
        $event->update($request->all());

        return redirect()->route('superadmin.manage-event')->with('success', 'Event updated successfully!');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('superadmin.manage-event')->with('success', 'Event deleted successfully!');
    }
}
