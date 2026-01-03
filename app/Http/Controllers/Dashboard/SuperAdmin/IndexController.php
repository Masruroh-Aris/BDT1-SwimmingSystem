<?php

namespace App\Http\Controllers\Dashboard\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Meet;

class IndexController extends Controller
{
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
        return view('dashboard.superadmin.index-admdef', compact('meets'));
    }

    public function show($id)
    {
        $meet = Meet::findOrFail($id);
        return view('dashboard.superadmin.show-meet', compact('meet'));
    }
}
