<?php

namespace App\Http\Controllers\Dashboard\Operator;

use App\Http\Controllers\Controller;
use App\Models\Athlete;
use App\Models\User;
use Illuminate\Http\Request;

class AthleteController extends Controller
{
    /**
     * Menampilkan daftar atlet (Read)
     */
    public function index()
    {
        // Mengambil data athlete beserta relasinya (Club atau Institution)
        $athletes = Athlete::with(['club', 'institution'])->latest()->paginate(10);
        
        return view('dashboard.operator.athletes.index', compact('athletes'));
    }

    /**
     * Menampilkan form tambah atlet (Create)
     */
    public function create()
    {
        // Ambil user yang role-nya 'admin'
        $organizations = User::where('role', 'admin')->get();

        return view('dashboard.operator.athletes.create', compact('organizations'));
    }

    /**
     * Menyimpan data atlet baru (Store)
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'place_of_birth' => 'nullable|string|max:255',
            'organization_id' => 'required|exists:users,id',
        ]);

        $org = User::findOrFail($request->organization_id);
        
        $athleteData = $validatedData;
        
        // Logika penentuan kolom berdasarkan sub_role admin
        if (strtolower($org->sub_role) == 'club') {
            $athleteData['club_id'] = $org->id;
            $athleteData['institution_id'] = null;
        } else {
            // school atau university
            $athleteData['institution_id'] = $org->id;
            $athleteData['club_id'] = null;
        }

        Athlete::create($athleteData);

        return redirect()->route('operator.athletes.index')->with('success', 'Athlete created successfully.');
    }

    /**
     * Menampilkan form edit atlet (Edit)
     */
    public function edit($id)
    {
        $athlete = Athlete::findOrFail($id);
        $organizations = User::where('role', 'admin')->get();

        return view('dashboard.operator.athletes.edit', compact('athlete', 'organizations'));
    }

    /**
     * Memperbarui data atlet (Update)
     */
    public function update(Request $request, $id)
    {
        $athlete = Athlete::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'place_of_birth' => 'nullable|string|max:255',
            'organization_id' => 'required|exists:users,id',
        ]);

        $org = User::findOrFail($request->organization_id);
        
        $athleteData = $validatedData;
        
        if (strtolower($org->sub_role) == 'club') {
            $athleteData['club_id'] = $org->id;
            $athleteData['institution_id'] = null;
        } else {
            $athleteData['institution_id'] = $org->id;
            $athleteData['club_id'] = null;
        }

        $athlete->update($athleteData);

        return redirect()->route('operator.athletes.index')->with('success', 'Athlete updated successfully.');
    }

    /**
     * Menghapus data atlet (Delete)
     */
    public function destroy($id)
    {
        $athlete = Athlete::findOrFail($id);
        $athlete->delete();

        return redirect()->route('operator.athletes.index')->with('success', 'Athlete deleted successfully.');
    }
}
