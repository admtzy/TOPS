<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::with('creator','users')
                    ->orderBy('date','asc')
                    ->get();

        return view('agenda.index', compact('agendas'));
    }

    public function create()
    {
        return view('agenda.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'date' => 'required|date',
            'location' => 'required',
            'description' => 'nullable',
            'is_paid' => 'required',
            'amount' => 'nullable|numeric|max:99999999.99',
            'qris' => 'nullable|image'
        ]);

        $data['created_by'] = auth()->id();

        if ($request->hasFile('qris')) {
            $data['qris'] = $request->file('qris')->store('qris','public');
        }

        $agenda = Agenda::create($data);

        // otomatis join creator ke agenda
        $agenda->users()->syncWithoutDetaching(auth()->id());

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil dibuat.');
    }

    public function edit($id)
    {
        $agenda = Agenda::findOrFail($id);

        if ($agenda->created_by != auth()->id()) {
            abort(403);
        }

        return view('agenda.edit', compact('agenda'));
    }

    public function update(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);

        if ($agenda->created_by != auth()->id()) {
            abort(403);
        }

        $agenda->update($request->only([
            'title','date','location','description','is_paid','amount','qris'
        ]));

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil diupdate.');
    }

    public function join($id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->users()->syncWithoutDetaching(auth()->id());

        return back();
    }

    public function uploadPayment(Request $request, $id)
    {
        $request->validate([
            'payment_proof' => 'required|image'
        ]);

        $agenda = Agenda::findOrFail($id);

        $proof = $request->file('payment_proof')
                    ->store('payments','public');

        $agenda->users()->updateExistingPivot(auth()->id(), [
            'paid' => true,
            'payment_proof' => $proof
        ]);

        return back();
    }
}