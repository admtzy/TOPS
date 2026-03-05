<?php

namespace App\Http\Controllers;

use App\Models\Circle;
use App\Models\User;
use App\Models\Structure;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CircleController extends Controller
{
    public function index()
    {
        $circle = Circle::with('structures.member')->first();

        $members = User::where('role','member')->get();

        return view('circle.index', compact('circle','members'));
    }

    /* ================= GENERAL CREATE ================= */

    public function create()
    {
        $circle = Circle::with('structures.member')->first();

        $members = User::where('role','member')->get();

        return view('circle.create', compact('circle','members'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')
                ->store('circle_logo', 'public');
        }

        Circle::create($data);

        return back()->with('success', 'Circle created!');
    }

    /* ================= GENERAL UPDATE ================= */

    public function update(Request $request, Circle $circle)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($request->hasFile('logo')) {

            if ($circle->logo) {
                Storage::disk('public')->delete($circle->logo);
            }

            $data['logo'] = $request->file('logo')
                ->store('circle_logo', 'public');
        }

        $circle->update($data);

        return back()->with('success', 'Circle updated!');
    }

    /* ================= STRUCTURE STORE ================= */

    public function storeStructure(Request $request)
    {
        $request->validate([
            'circle_id' => 'required',
            'member_id' => 'required',
            'position' => 'required'
        ]);

        Structure::create($request->only(
            'circle_id',
            'member_id',
            'position'
        ));

        return back()->with('success','Structure added!');
    }

    /* ================= STRUCTURE UPDATE ================= */

    public function updateStructure(Request $request, Structure $structure)
    {
        $request->validate([
            'position' => 'required'
        ]);

        $structure->update([
            'position' => $request->position
        ]);

        return back()->with('success','Structure updated!');
    }

    /* ================= STRUCTURE DELETE ================= */

    public function destroyStructure(Structure $structure)
    {
        $structure->delete();
        return back()->with('success','Structure removed!');
    }
}