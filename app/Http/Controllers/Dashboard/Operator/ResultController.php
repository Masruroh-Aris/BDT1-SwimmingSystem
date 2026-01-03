<?php

namespace App\Http\Controllers\Dashboard\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Result;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'athlete' => 'required', // ID
            'event' => 'required', // ID
            'lane' => 'nullable|string',
            'meet_program' => 'required', // ID - Meet
            'time_result' => 'required|string',
            'points' => 'nullable|integer',
            'note' => 'nullable|string',
            'status' => 'nullable|string',
            'input_by' => 'nullable|string',
        ]);

        // Resolve Names from IDs
        // Athlete is now free text input
        $athleteName = $validated['athlete'];
        $eventName = \App\Models\Event::find($validated['event'])?->name ?? 'Unknown Event';
        $meetName = \App\Models\Meet::find($validated['meet_program'])?->name ?? 'Unknown Meet';

        // 1. Simpan Data Baru
        $result = Result::create([
            'athlete_name' => $athleteName,
            'event_name' => $eventName,
            'lane' => $validated['lane'],
            'meet_name' => $meetName,
            'time_result' => $validated['time_result'],
            'points' => $validated['points'],
            'note' => $validated['note'],
            'status' => $validated['status'] ?? 'Done',
            'input_by' => $validated['input_by'],
        ]);

        // 2. Hitung Ulang Rank & Medal untuk Event & Meet yang sama
        $this->recalculateRanks($result->event_name, $result->meet_name);

        return redirect()->route('operator.dashboard')->with('success', 'Result created and ranked successfully!');
    }

    /**
     * Recalculate ranks and medals for a specific event in a meet.
     */
    private function recalculateRanks($eventName, $meetName)
    {
        // Ambil semua hasil untuk event & meet ini, urutkan berdasarkan waktu tercepat (ASC)
        // Asumsi format waktu string 'mm:ss.ms' yang bisa di-sort lexicographically dengan benar
        // ATAU dikonversi jika perlu. Untuk saat ini pakai string sort sederhana.
        $results = Result::where('event_name', $eventName)
                        ->where('meet_name', $meetName)
                        ->orderBy('time_result', 'asc') // Tercepat = waktu terkecil
                        ->get();

        $rank = 1;
        foreach ($results as $res) {
            $medal = null;
            if ($rank === 1) $medal = 'Gold';
            elseif ($rank === 2) $medal = 'Silver';
            elseif ($rank === 3) $medal = 'Bronze';

            // Update rank & medal
            $res->update([
                'rank' => $rank,
                'medal' => $medal
            ]);

            $rank++;
        }
    }
}
