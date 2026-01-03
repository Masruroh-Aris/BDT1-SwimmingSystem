<?php

namespace App\Http\Controllers\Dashboard\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Result;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $query = Result::orderBy('updated_at', 'desc');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('athlete_name', 'LIKE', "%{$search}%")
                  ->orWhere('event_name', 'LIKE', "%{$search}%")
                  ->orWhere('meet_name', 'LIKE', "%{$search}%")
                  ->orWhere('medal', 'LIKE', "%{$search}%");
        }

        $results = $query->get();
        return view('dashboard.operator.index-op', compact('results'));
    }

    public function inputResult()
    {
        $meets = \App\Models\Meet::whereIn('status', ['Upcoming', 'Ongoing'])->latest()->get();
        $events = \App\Models\Event::all();
        $athletes = \App\Models\User::where('role', 'user')->get();

        return view('dashboard.operator.input-result', compact('meets', 'events', 'athletes'));
    }

    public function show($id)
    {
        $result = Result::findOrFail($id);
        return view('dashboard.operator.show-result', compact('result'));
    }
}
