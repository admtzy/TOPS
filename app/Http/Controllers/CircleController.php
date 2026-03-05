<?php

namespace App\Http\Controllers;

use App\Models\Circle;
use App\Models\User;
use App\Models\Structure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CircleController extends Controller
{
    /* ================= INDEX ================= */

    public function index()
    {
        $circle = Circle::with('structures.member')->first();

        $members = User::where('role','member')->get();

        return view('circle.index', compact('circle','members'));
    }

    /* ================= CREATE ================= */

    public function create()
    {
        $members = User::where('role','member')->get();

        return view('circle.create', compact('members'));
    }

    /* ================= STORE ================= */

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')
                ->store('circle_logo', 'public');
        }

        $data['created_by'] = Auth::id();

        Circle::create($data);

        return redirect()->route('circle.index')
            ->with('success','Circle berhasil dibuat!');
    }

    /* ================= UPDATE ================= */

    public function update(Request $request, Circle $circle)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($request->hasFile('logo')) {

            if ($circle->logo) {
                Storage::disk('public')->delete($circle->logo);
            }

            $data['logo'] = $request->file('logo')
                ->store('circle_logo','public');
        }

        $circle->update($data);

        return back()->with('success','Circle berhasil diupdate!');
    }

    /* ================= STRUCTURE STORE ================= */

    public function storeStructure(Request $request)
    {
        $data = $request->validate([
            'circle_id' => 'required|exists:circles,id',
            'member_id' => 'required|exists:users,id',
            'position' => 'required|string|max:100'
        ]);

        Structure::create($data);

        return back()->with('success','Struktur berhasil ditambahkan!');
    }

    /* ================= STRUCTURE UPDATE ================= */

    public function updateStructure(Request $request, Structure $structure)
    {
        $data = $request->validate([
            'position' => 'required|string|max:100'
        ]);

        $structure->update($data);

        return back()->with('success','Struktur berhasil diupdate!');
    }

    /* ================= STRUCTURE DELETE ================= */

    public function destroyStructure(Structure $structure)
    {
        $structure->delete();

        return back()->with('success','Struktur berhasil dihapus!');
    }
}