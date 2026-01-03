<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.actions.payment-admin');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'proof_file' => 'required|image|max:2048', // 2MB Max
        ]);

        if ($request->hasFile('proof_file')) {
            $path = $request->file('proof_file')->store('proofs', 'public');
            return response()->json(['path' => $path, 'success' => true]);
        }

        return response()->json(['success' => false], 400);
    }
}
