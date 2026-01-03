<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function athletes(Request $request)
    {
        $query = \App\Models\Athlete::with(['club', 'institution']);

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $athletes = $query->paginate(12);

        return view('public.athletes.index', compact('athletes'));
    }

    public function showAthlete($id)
    {
        return view('public.athletes.athlete-detail');
    }

    public function meets()
    {
        // Fetch upcoming and ongoing meets with events
        $meets = \App\Models\Meet::with('events')
                    ->whereIn('status', ['Upcoming', 'Ongoing', 'Registration Open'])
                    ->orderBy('start_date', 'asc')
                    ->get();

        return view('public.meets.index', compact('meets'));
    }

    public function showMeet($id)
    {
        $meet = \App\Models\Meet::findOrFail($id);
        return view('public.meets.meet-detail', compact('meet'));
    }

    public function meetEvents(Request $request, $id)
    {
        $meet = \App\Models\Meet::findOrFail($id);
        
        $query = $meet->events();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $events = $query->orderBy('id', 'asc')->get();

        return view('public.meets.event.events', compact('meet', 'events'));
    }

    public function meetSchedule($id)
    {
        $meet = \App\Models\Meet::findOrFail($id);
        
        // Fetch events with count of entries
        $events = $meet->events()
                       ->withCount('registrations')
                       ->orderBy('id', 'asc') // or start_time if consistent
                       ->get();

        // Group into sessions if needed, for now just passing all events
        return view('public.meets.schedule', compact('meet', 'events'));
    }

    public function meetResults($id)
    {
        $meet = \App\Models\Meet::findOrFail($id);
        
        // Fetch results for this meet (using name matching as per schema)
        // Group by event_name so we can display per-event tables
        $results = \App\Models\Result::where('meet_name', $meet->name)
                                     ->get()
                                     ->groupBy('event_name');

        // Optional: Sort each group by time_result ASC to determine rank
        $results = $results->map(function($group) {
            return $group->sortBy('time_result')->values(); // values() resets keys for easy ranking
        });

        return view('public.meets.results', compact('meet', 'results'));
    }





    public function meetFullResult($id)
    {
        $meet = \App\Models\Meet::findOrFail($id);
        $resultsQuery = \App\Models\Result::where('meet_name', $meet->name)->get();

        // 1. Competition Results (Group by Event, Sort by Time)
        $groupedResults = $resultsQuery->groupBy('event_name')->map(function($group) {
            return $group->sortBy('time_result')->values();
        });

        // 2. Best Swimmer (Group by Athlete, Sum Points)
        $bestSwimmers = $resultsQuery->groupBy('athlete_name')->map(function ($athleteResults, $name) {
            return (object) [
                'athlete_name' => $name,
                'sex' => '-',
                'ag' => '-',
                'team_name' => '-',
                'gold' => $athleteResults->where('rank', 1)->count(),
                'silver' => $athleteResults->where('rank', 2)->count(),
                'bronze' => $athleteResults->where('rank', 3)->count(),
                'point' => $athleteResults->sum('points'),
            ];
        })->sortByDesc('point')->values();

        // 3. Medal Tally (Group by Team, Sum Medals)
        $medalTally = $resultsQuery->groupBy(function($item) {
            return $item->team_name ?? '-'; 
        })->map(function ($teamResults, $teamName) {
            $gold = $teamResults->where('rank', 1)->count();
            $silver = $teamResults->where('rank', 2)->count();
            $bronze = $teamResults->where('rank', 3)->count();
            
            return (object) [
                'team_name' => $teamName,
                'gold' => $gold,
                'silver' => $silver,
                'bronze' => $bronze,
                'total_medal' => $gold + $silver + $bronze,
                'total_point' => $teamResults->sum('points'),
            ];
        })->sort(function ($a, $b) {
            if ($a->gold !== $b->gold) return $b->gold <=> $a->gold;
            if ($a->silver !== $b->silver) return $b->silver <=> $a->silver;
            return $b->bronze <=> $a->bronze;
        })->values();

        return view('public.meets.full-result', compact('meet', 'groupedResults', 'bestSwimmers', 'medalTally'));
    }

    public function meetMedalTally($id)
    {
        $meet = \App\Models\Meet::findOrFail($id);
        
        // Fetch results for this meet
        $results = \App\Models\Result::where('meet_name', $meet->name)->get();

        // Group by Team Name (fallback to '-')
        $medals = $results->groupBy(function($item) {
            return $item->team_name ?? '-'; 
        })->map(function ($teamResults, $teamName) {
            $gold = $teamResults->where('rank', 1)->count();
            $silver = $teamResults->where('rank', 2)->count();
            $bronze = $teamResults->where('rank', 3)->count();
            
            return (object) [
                'team_name' => $teamName,
                'gold' => $gold,
                'silver' => $silver,
                'bronze' => $bronze,
                'total_medal' => $gold + $silver + $bronze,
                'total_point' => $teamResults->sum('points'),
            ];
        })->sort(function ($a, $b) {
            // Sort by Gold DESC, then Silver DESC, then Bronze DESC
            if ($a->gold !== $b->gold) return $b->gold <=> $a->gold;
            if ($a->silver !== $b->silver) return $b->silver <=> $a->silver;
            return $b->bronze <=> $a->bronze;
        })->values();

        // Calculate Grand Totals for Footer
        $totalGold = $medals->sum('gold');
        $totalSilver = $medals->sum('silver');
        $totalBronze = $medals->sum('bronze');
        $totalMedals = $medals->sum('total_medal');
        $totalPoints = $medals->sum('total_point');

        return view('public.meets.medal-tally', compact('meet', 'medals', 'totalGold', 'totalSilver', 'totalBronze', 'totalMedals', 'totalPoints'));
    }

    public function meetBestSwimmer($id)
    {
        $meet = \App\Models\Meet::findOrFail($id);
        
        // Fetch all results for this meet
        $results = \App\Models\Result::where('meet_name', $meet->name)->get();

        // Group by Athlete Name
        $bestSwimmers = $results->groupBy('athlete_name')->map(function ($athleteResults, $name) {
            return (object) [
                'athlete_name' => $name,
                'sex' => '-', // Not in DB
                'ag' => '-',  // Not in DB
                'team_name' => '-', // Not in DB
                'gold' => $athleteResults->where('rank', 1)->count(),
                'silver' => $athleteResults->where('rank', 2)->count(),
                'bronze' => $athleteResults->where('rank', 3)->count(),
                'point' => $athleteResults->sum('points'),
            ];
        })->sortByDesc('point')->values(); // Sort by Data Points DESC

        return view('public.meets.best-swimmer', compact('meet', 'bestSwimmers'));
    }

    public function meetNewRecord($id)
    {
        return view('public.meets.new-record');
    }

    public function scanSertif()
    {
        return view('public.sertif.scan-sertif');
    }

    public function sertifResult($code)
    {
        return view('public.sertif.sertif-result');
    }
}
