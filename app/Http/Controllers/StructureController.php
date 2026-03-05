<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StructureController extends Controller
{
    public function store(Request $request)
    {
        Structure::create($request->all());
        return back()->with('success','Structure added!');
    }

    public function update(Request $request, Structure $structure)
    {
        $structure->update($request->only('position'));
        return back()->with('success','Structure updated!');
    }

    public function destroy(Structure $structure)
    {
        $structure->delete();
        return back()->with('success','Structure removed!');
    }
}
