<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\Structure;
use App\Models\User;
use Carbon\Carbon;

class AgendaApiController extends Controller
{
    public function getAgenda(Request $request)
    {
        $question = strtolower($request->query('q', ''));
        $user = $request->user();
        $response = "";

        try {

            // ================= GREETING =================
            if ($this->hasKeyword($question, ['halo','hai','hi'])) {

                $hour = now()->hour;
                $greeting = "Selamat ";
                if($hour < 12) $greeting .= "pagi";
                elseif($hour < 15) $greeting .= "siang";
                elseif($hour < 18) $greeting .= "sore";
                else $greeting .= "malam";

                $response = "$greeting, {$user->name}!";

            }

            // ================= MEMBER LIST =================
            elseif ($this->hasKeyword($question, ['member'])) {

                $members = User::where('role','member')->pluck('name')->toArray();
                $response = empty($members)
                    ? "Tidak ada member."
                    : "Daftar Member: " . implode(', ', $members);

            }

            // ================= ADMIN LIST =================
            elseif ($this->hasKeyword($question, ['admin'])) {

                $admins = User::where('role','admin')->pluck('name')->toArray();
                $response = empty($admins)
                    ? "Tidak ada admin."
                    : "Daftar Admin: " . implode(', ', $admins);

            }

            // ================= AGENDA HARI INI =================
            elseif ($this->hasKeyword($question, ['agenda']) 
                    && $this->hasKeyword($question, ['hari ini'])) {

                $today = now()->toDateString();

                $agendas = Agenda::whereDate('date',$today)
                                ->orderBy('date')
                                ->get();

                if ($agendas->isEmpty()) {
                    $response = "Tidak ada agenda hari ini.";
                } else {
                    foreach($agendas as $a){
                        $response .= "📌 {$a->title} | "
                            . $a->date->format('H:i') 
                            . " | {$a->location}\n";
                    }
                }

            }

            // ================= SEMUA AGENDA =================
            elseif ($this->hasKeyword($question, ['agenda'])) {

                $agendas = Agenda::orderBy('date')->get();

                if ($agendas->isEmpty()) {
                    $response = "Belum ada agenda.";
                } else {
                    foreach($agendas as $a){
                        $response .= "📌 {$a->title} | "
                            . $a->date->format('Y-m-d H:i') 
                            . " | {$a->location}\n";
                    }
                }

            }

            // ================= CEK PEMBAYAR =================
            elseif ($this->hasKeyword($question, ['bayar'])) {

                $agendas = Agenda::all();
                foreach($agendas as $agenda){

                    if(str_contains($question, strtolower($agenda->title))){

                        $paidUsers = $agenda->users()
                            ->wherePivot('paid',true)
                            ->pluck('name')
                            ->toArray();

                        if(empty($paidUsers)){
                            $response = "Belum ada yang membayar untuk {$agenda->title}.";
                        } else {
                            $response = "Yang sudah bayar {$agenda->title}: "
                                        . implode(', ', $paidUsers);
                        }

                        break;
                    }
                }

                if($response == "") {
                    $response = "Agenda tidak ditemukan.";
                }
            }

            // ================= CEK POSISI =================
            elseif ($this->hasKeyword($question, ['posisi','jabatan'])) {

                $users = User::all();

                foreach($users as $u){
                    if(str_contains($question, strtolower($u->name))){

                        $structure = Structure::where('member_id',$u->id)->first();

                        if(!$structure){
                            $response = "{$u->name} tidak memiliki jabatan.";
                        } else {
                            $response = "{$u->name} menjabat sebagai "
                                        . ucfirst($structure->position);
                        }

                        break;
                    }
                }

                if($response == ""){
                    $response = "Nama tidak ditemukan.";
                }
            }

            // ================= FALLBACK =================
            else {
                $response = "Maaf, saya tidak mengerti pertanyaanmu.";
            }

            return response()->json([
                'status'=>'ok',
                'data'=>$response
            ]);

        } catch (\Throwable $e){
            return response()->json([
                'status'=>'error',
                'message'=>$e->getMessage()
            ],500);
        }
    }
    private function hasKeyword($text, $keywords)
    {
        foreach($keywords as $keyword){
            if(str_contains($text, $keyword)){
                return true;
            }
        }
        return false;
    }

}

