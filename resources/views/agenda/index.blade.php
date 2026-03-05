@extends('layouts.app')

@section('content')
<div class="container mx-auto pb-12 px-4">
    {{-- Header --}}
{{-- Header --}}
    <div class="flex flex-wrap items-center justify-between mb-10 gap-4">
        <div>
            <h2 class="text-white text-3xl font-extrabold tracking-tight italic uppercase">Daftar Agenda</h2>
            <p class="text-zinc-500 text-sm mt-1 tracking-wide">Pantau jadwal kegiatan dan koordinasi anggaran sirkel.</p>
        </div>
        
        {{-- TOMBOL CREATE AGENDA --}}
        <div class="flex items-center">
            <a href="{{ route('agenda.create') }}" 
               class="bg-blue-600 hover:bg-blue-500 text-white text-xs font-black uppercase px-6 py-4 rounded-2xl shadow-[0_0_20px_rgba(37,99,235,0.4)] transition-all flex items-center group scale-105 active:scale-95">
                <i class="fas fa-plus-circle mr-2 text-lg"></i> 
                + Buat Agenda
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        @foreach($agendas as $agenda)
        <div class="bg-zinc-900 border border-zinc-800 rounded-[2.5rem] p-8 shadow-2xl relative overflow-hidden group">
            {{-- Aksen Dekoratif --}}
            <div class="absolute top-0 right-0 p-8 opacity-5">
                <i class="fas fa-calendar-alt text-7xl text-white"></i>
            </div>

            <div class="relative z-10">
                {{-- Badge Status Berbayar --}}
                @if($agenda->is_paid)
                    <span class="inline-block px-3 py-1 bg-amber-500/10 text-amber-500 text-[9px] font-black uppercase rounded-lg border border-amber-500/20 mb-4 tracking-widest">
                        <i class="fas fa-wallet mr-1"></i> Berbayar
                    </span>
                @else
                    <span class="inline-block px-3 py-1 bg-emerald-500/10 text-emerald-500 text-[9px] font-black uppercase rounded-lg border border-emerald-500/20 mb-4 tracking-widest">
                        <i class="fas fa-check-circle mr-1"></i> Free Event
                    </span>
                @endif

                <h4 class="text-zinc-100 text-2xl font-black uppercase tracking-tight mb-2 group-hover:text-blue-400 transition-colors">
                    {{ $agenda->title }}
                </h4>
                
                <div class="flex flex-wrap gap-4 text-xs mb-6">
                    <div class="flex items-center text-zinc-400">
                        <i class="fas fa-clock mr-2 text-zinc-600"></i> {{ $agenda->date }}
                    </div>
                    <div class="flex items-center text-zinc-400">
                        <i class="fas fa-map-marker-alt mr-2 text-zinc-600"></i> {{ $agenda->location }}
                    </div>
                </div>

                <p class="text-zinc-500 text-sm leading-relaxed mb-6 bg-zinc-950/50 p-4 rounded-2xl border border-zinc-800 italic">
                    "{{ $agenda->description }}"
                </p>

                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-zinc-800 flex items-center justify-center text-[10px] font-black border border-zinc-700 mr-3 text-zinc-300 uppercase">
                            {{ substr($agenda->creator->name, 0, 1) }}
                        </div>
                        <p class="text-[10px] text-zinc-500 font-bold uppercase tracking-widest">By: {{ $agenda->creator->name }}</p>
                    </div>

                    <div class="flex gap-2">
                        @if($agenda->created_by == auth()->id())
                            <a href="{{ route('agenda.edit',$agenda->id) }}" 
                               class="bg-zinc-800 hover:bg-amber-600 hover:text-white text-zinc-400 p-2.5 rounded-xl border border-zinc-700 transition-all text-xs">
                                <i class="fas fa-edit"></i>
                            </a>
                        @endif

                        <form method="POST" action="{{ route('agenda.join',$agenda->id) }}">
                            @csrf
                            <button class="bg-blue-600 hover:bg-blue-500 text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg transition-all active:scale-95">
                                <i class="fas fa-user-plus mr-1"></i> Join
                            </button>
                        </form>
                    </div>
                </div>

                <hr class="border-zinc-800 mb-6">

                {{-- Peserta Section --}}
                <div class="mb-8">
                    <h6 class="text-zinc-100 font-black text-[10px] uppercase tracking-[0.3em] mb-4 flex items-center">
                        <i class="fas fa-users mr-2 text-blue-500"></i> Daftar Peserta
                    </h6>
                    <div class="space-y-2 max-h-40 overflow-y-auto pr-2 custom-scrollbar">
                        @foreach($agenda->users as $user)
                        <div class="flex items-center justify-between p-3 bg-zinc-950/50 border border-zinc-800 rounded-xl hover:border-zinc-700 transition-colors">
                            <span class="text-xs font-bold text-zinc-300 uppercase tracking-tighter">{{ $user->name }}</span>
                            
                            @if($agenda->is_paid)
                                @if($user->pivot->paid)
                                    <span class="text-[9px] font-black uppercase text-emerald-500 bg-emerald-500/10 px-2 py-1 rounded">✅ Paid</span>
                                @else
                                    <span class="text-[9px] font-black uppercase text-red-500 bg-red-500/10 px-2 py-1 rounded">❌ Unpaid</span>
                                @endif
                            @else
                                <span class="text-[9px] font-black uppercase text-blue-500 bg-blue-500/10 px-2 py-1 rounded">Joined</span>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Payment Section --}}
                @if($agenda->is_paid)
                <div class="bg-zinc-950/80 border border-zinc-800 p-6 rounded-3xl">
                    <div class="flex items-center justify-between mb-4">
                        <h6 class="text-zinc-400 font-black text-[10px] uppercase tracking-widest">Budgeting</h6>
                        <span class="text-emerald-500 font-black text-sm">Rp {{ number_format($agenda->amount) }}</span>
                    </div>

                    @if($agenda->qris)
                    <div class="flex justify-center mb-6">
                        <div class="p-3 bg-white rounded-2xl shadow-xl hover:scale-105 transition-transform duration-300">
                            <img src="{{ asset('storage/'.$agenda->qris) }}" width="160" class="rounded-lg">
                        </div>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('agenda.upload',$agenda->id) }}" enctype="multipart/form-data" class="space-y-3">
                        @csrf
                        <div class="relative">
                            <input type="file" name="payment_proof" 
                                   class="block w-full text-[10px] text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-zinc-800 file:text-zinc-300 hover:file:bg-zinc-700 cursor-pointer">
                        </div>
                        <button class="w-full bg-zinc-100 hover:bg-white text-zinc-900 text-[10px] font-black uppercase py-3 rounded-xl transition-all shadow-xl flex items-center justify-center">
                            <i class="fas fa-cloud-upload-alt mr-2"></i> Upload Bukti
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection