<?php

namespace App\Http\Controllers;

use App\Models\Memory;
use Illuminate\Http\Request;

class MemoryController extends Controller
{
    public function store(Request $request)
    {
        $path = $request->file('image')->store('memories','public');

        Memory::create([
            'agenda_id'=>$request->agenda_id,
            'user_id'=>auth()->id(),
            'image'=>$path,
            'caption'=>$request->caption
        ]);

        return back();
    }

    public function destroy($id)
    {
        $memory = Memory::findOrFail($id);

        // hanya admin bisa take down
        if(!auth()->user()->is_admin){
            abort(403);
        }

        $memory->delete();
        return back();
    }

    public function landing($circle_id)
    {
        $circle = Circle::with(['memories.user','memories.comments.user','memories.likes'])->findOrFail($circle_id);

        return view('circle.landing', compact('circle'));
    }

    public function comment(Request $request, $memory_id)
    {
        Comment::create([
            'memory_id'=>$memory_id,
            'user_id'=>auth()->id(),
            'comment'=>$request->comment
        ]);

        return back();
    }

    public function like($memory_id)
    {
        $memory = Memory::findOrFail($memory_id);

        $memory->likes()->firstOrCreate(['user_id'=>auth()->id()]);

        return back();
    }
}