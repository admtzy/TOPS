<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HighlightPhoto;
use App\Models\MemberProfile;
use Illuminate\Support\Facades\Auth;

class LandingController extends Controller
{
    // Landing page publik (read-only)
    public function index()
    {
        $highlights = HighlightPhoto::all();
        $members = MemberProfile::all();
        return view('landing.index', compact('highlights','members'));
    }

    /* ================= ADMIN ================= */
    public function adminIndex()
    {
        $highlights = HighlightPhoto::all();
        $members = MemberProfile::all();
        return view('landing.admin', compact('highlights','members'));
    }

    // CRUD Highlight untuk admin
    public function storeHighlight(Request $request)
    {
        $request->validate([
            'image'=>'required|image',
            'caption'=>'nullable|string'
        ]);
        $path = $request->file('image')->store('highlights','public');
        HighlightPhoto::create([
            'image'=>$path,
            'caption'=>$request->caption,
            'user_id'=>auth()->id()
        ]);
        return back();
    }

    public function updateHighlight(Request $request, $id)
    {
        $highlight = HighlightPhoto::findOrFail($id);
        if(!auth()->user()->is_admin) abort(403);

        if($request->hasFile('image')){
            $highlight->image = $request->file('image')->store('highlights','public');
        }
        $highlight->caption = $request->caption;
        $highlight->save();
        return back();
    }

    public function destroyHighlight($id)
    {
        $highlight = HighlightPhoto::findOrFail($id);
        if(!auth()->user()->is_admin) abort(403);
        $highlight->delete();
        return back();
    }

    // CRUD Member untuk admin
    public function storeMember(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
            'photo'=>'nullable|image',
            'description'=>'nullable|string'
        ]);

        $path = $request->hasFile('photo') ? $request->file('photo')->store('members','public') : null;

        MemberProfile::create([
            'name'=>$request->name,
            'photo'=>$path,
            'description'=>$request->description,
            'user_id'=>$request->user_id // admin bisa pilih user_id
        ]);

        return back();
    }

    public function updateMember(Request $request, $id)
    {
        $member = MemberProfile::findOrFail($id);
        if(!auth()->user()->is_admin) abort(403);

        if($request->hasFile('photo')){
            $member->photo = $request->file('photo')->store('members','public');
        }
        $member->name = $request->name;
        $member->description = $request->description;
        $member->save();
        return back();
    }

    public function destroyMember($id)
    {
        $member = MemberProfile::findOrFail($id);
        if(!auth()->user()->is_admin) abort(403);
        $member->delete();
        return back();
    }

    /* ================= MEMBER ================= */
// Tampilkan form edit profil member (hanya untuk member login)
    public function memberProfile()
    {
        $member = auth()->user()->memberProfile;
        return view('landing.member_profile', compact('member'));
    }

    // Update profil member
    public function updateMemberProfile(Request $request)
    {
        $member = auth()->user()->memberProfile;

        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image',
            'description' => 'nullable|string',
        ]);

        if($request->hasFile('photo')){
            $member->photo = $request->file('photo')->store('members','public');
        }

        $member->name = $request->name;
        $member->description = $request->description;
        $member->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}