<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Circle;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $agendas = Agenda::with('users')->latest()->get();

        // ambil circle pertama
        $circle = Circle::with('structures.member')->first();

        // ambil semua member
        $members = User::where('role','member')->get();

        return view('dashboard', compact(
            'agendas',
            'circle',
            'members'
        ));
    }
}