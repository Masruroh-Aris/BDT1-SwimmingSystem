<?php

namespace App\Http\Controllers\Dashboard\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Certificate;
use App\Models\Result;

class CertificateController extends Controller
{
    public function index()
    {
        $currentCertificates = Certificate::orderBy('updated_at', 'desc')->get();
        
        $resultEvents = Result::select('event_name')->distinct()->pluck('event_name')->toArray();
        $regEvents = \App\Models\Registration::select('event_name')->distinct()->pluck('event_name')->toArray();
        
        $regCombined = \App\Models\Registration::select('meet_name', 'event_name')
            ->distinct()
            ->get()
            ->map(function ($reg) {
                return $reg->meet_name . ' ' . $reg->event_name;
            })
            ->toArray();
        
        $events = array_unique(array_merge($resultEvents, $regEvents, $regCombined));
        sort($events); 

        return view('dashboard.operator.certificate.upload', compact('currentCertificates', 'events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_name' => 'required|string',
            'certificate_bg' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('certificate_bg')) {
            $image = $request->file('certificate_bg');
            $imageName = 'certificate_bg_' . time() . '_' . str_replace(' ', '_', $request->event_name) . '.' . $image->getClientOriginalExtension();
            
            $destinationPath = public_path('images/admin');
            $image->move($destinationPath, $imageName);
            
            $layoutData = json_decode($request->layout, true);
            $layoutData['serial_number_format'] = $request->serial_number_format; // Save custom format

            Certificate::updateOrCreate(
                ['event_name' => $request->event_name],
                [
                    'image_path' => 'images/admin/' . $imageName,
                    'uploaded_by' => 'Operator', 
                    'layout' => $layoutData, 
                ]
            );
            
            return back()->with('success', 'Certificate background for "' . $request->event_name . '" uploaded successfully!');
        }

        return back()->with('error', 'Please select an image to upload.');
    }
}
