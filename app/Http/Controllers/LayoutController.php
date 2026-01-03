<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function app()
    {
        return view('layouts.app');
    }

    public function navbar()
    {
        return view('layouts.navbar');
    }

    public function footer()
    {
        return view('layouts.footer');
    }
}
