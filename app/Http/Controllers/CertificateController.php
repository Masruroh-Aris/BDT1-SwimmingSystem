<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;
use App\Models\Certificate;

class CertificateController extends Controller
{
    public function show($id)
    {
        $data = Result::findOrFail($id);
        
        return $this->renderCertificate($data);
    }

    public function showRegistration($id)
    {
        $data = \App\Models\Registration::findOrFail($id);
        
        return $this->renderCertificate($data);
    }

    private function renderCertificate($data)
    {
        // Construct potential keys
        $keys = [$data->event_name];
        
        // If data has meet_name (Registration), add combined key
        if (isset($data->meet_name)) {
            $keys[] = $data->meet_name . ' ' . $data->event_name;
        }

        // Find certificate matching any of the keys
        $certificate = Certificate::whereIn('event_name', $keys)->orderByRaw("LENGTH(event_name) DESC")->first();

        // If no certificate background found, returning 404 or a friendly error page is better
        if (!$certificate) {
            abort(404, 'Certificate background not found for event: ' . implode(' OR ', $keys) . '. Please upload a background with one of these names.');
        }

        return view('certificate.show', compact('data', 'certificate'));
    }
}
