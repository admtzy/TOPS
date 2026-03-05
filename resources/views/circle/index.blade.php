@extends('layouts.app')

@section('content')
<div class="container mx-auto pb-12 px-4">
    {{-- Header & Navigasi Utama --}}
    <div class="flex flex-wrap items-center justify-between mb-10 gap-4">
        <div>
            <h2 class="text-white text-3xl font-extrabold tracking-tight italic uppercase">Eksplorasi Circle</h2>
            <p class="text-zinc-500 text-sm mt-1 tracking-wide">Informasi mendalam mengenai guild dan struktur kepengurusan.</p>
        </div>
        
        <div class="flex items-center">
            {{-- TOMBOL CREATE STRUKTUR (FIX KE ROUTE CREATE) --}}
            <a href="{{ route('circle.create') }}" 
              class="bg-blue-600 hover:bg-blue-500 text-white text-xs font-black uppercase px-6 py-4 rounded-2xl shadow-[0_0_20px_rgba(37,99,235,0.4)] transition-all flex items-center group scale-105 active:scale-95">
               <i class="fas fa-plus-circle mr-2 text-lg"></i> 
                Create Structure
            </a>

            <a href="{{ route('circle.create') }}" 
               class="bg-zinc-800 hover:bg-zinc-700 text-zinc-300 text-xs font-black uppercase px-6 py-4 rounded-2xl border border-zinc-700 transition-all flex items-center group">
                <i class="fas fa-cog mr-2 group-hover:rotate-90 transition-transform"></i> 
                Manage
            </a>
        </div>
    </div>

    <div class="flex flex-wrap -mx-4">
        {{-- ================= KIRI: GENERAL INFO (CARD) ================= --}}
        <div class="w-full lg:w-4/12 px-4 mb-8">
            <div class="bg-zinc-900 border border-zinc-800 rounded-[2.5rem] p-8 shadow-2xl sticky top-24">
                <div class="text-center">
                    @if($circle && $circle->logo)
                        <div class="relative inline-block mb-6">
                            <img src="{{ asset('storage/'.$circle->logo) }}" 
                                 class="w-32 h-32 rounded-[2rem] object-cover shadow-2xl border-4 border-zinc-800 mx-auto">
                        </div>
                    @else
                        <div class="w-32 h-32 bg-zinc-800 rounded-[2rem] mx-auto mb-6 flex items-center justify-center border-4 border-zinc-700 shadow-inner">
                            <i class="fas fa-shield-alt text-4xl text-zinc-600"></i>
                        </div>
                    @endif

                    @if($circle)
                        <h3 class="text-zinc-100 text-2xl font-black uppercase tracking-widest">{{ $circle->name }}</h3>
                        <div class="mt-4 px-4 py-3 bg-zinc-950/50 rounded-2xl border border-zinc-800/50">
                            <p class="text-zinc-400 text-sm leading-relaxed italic">
                                "{{ $circle->description }}"
                            </p>
                        </div>
                    @else
                        <div class="bg-zinc-950/50 rounded-2xl p-4 border border-zinc-800 border-dashed">
                            <p class="text-zinc-600 text-xs italic font-bold uppercase tracking-widest leading-loose text-center">Data circle belum tersedia. <br> Klik "Create Structure" untuk memulai.</p>
                        </div>
                    @endif
                </div>

                <div class="mt-10 pt-6 border-t border-zinc-800">
                    <div class="flex items-center justify-between text-[10px] font-black uppercase tracking-widest mb-3">
                        <span class="text-zinc-500">Kekuatan Pasukan</span>
                        <span class="text-emerald-500">{{ count($members) }} Member</span>
                    </div>
                    <div class="w-full bg-zinc-800 rounded-full h-1.5 overflow-hidden">
                        <div class="bg-emerald-600 h-full rounded-full" style="width: 80%"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= KANAN: STRUKTUR & MEMBERS ================= --}}
        <div class="w-full lg:w-8/12 px-4">
            
            {{-- List Struktur (List Hirarki Modern) --}}
            <div class="mb-12">
                <h4 class="text-zinc-100 font-black text-[11px] uppercase tracking-[0.4em] mb-6 flex items-center border-l-4 border-emerald-500 pl-4">
                    Struktur Hirarki
                </h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @forelse($circle->structures ?? [] as $structure)
                        <div class="bg-zinc-900 border border-zinc-800 p-6 rounded-[1.5rem] flex items-center hover:border-emerald-500/50 hover:bg-zinc-800/30 transition-all group shadow-lg">
                            <div class="w-14 h-14 rounded-2xl bg-zinc-950 flex items-center justify-center text-emerald-500 border border-zinc-800 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-500">
                                <i class="fas fa-crown text-xl"></i>
                            </div>
                            <div class="ml-5">
                                <p class="text-emerald-500 text-[9px] font-black uppercase tracking-[0.2em] mb-1">{{ $structure->position }}</p>
                                <p class="text-zinc-100 font-extrabold text-lg tracking-tight">{{ $structure->member?->name ?? 'Belum Diisi' }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 py-14 bg-zinc-900/30 border-2 border-dashed border-zinc-800 rounded-[2rem] text-center">
                            <i class="fas fa-project-diagram text-zinc-800 text-4xl mb-4"></i>
                            <p class="text-zinc-600 text-xs font-black uppercase tracking-widest">Hirarki Masih Kosong</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- All Members (Modern Grid Card) --}}
            <div>
                <h4 class="text-zinc-100 font-black text-[11px] uppercase tracking-[0.4em] mb-6 flex items-center border-l-4 border-zinc-500 pl-4">
                    List Member Guild
                </h4>
                
                <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-4">
                    @forelse($members as $member)
                        <div class="bg-zinc-950/50 border border-zinc-800 p-5 rounded-[1.5rem] text-center hover:border-zinc-600 transition-all hover:scale-105 group shadow-inner">
                            <div class="w-12 h-12 rounded-full bg-zinc-800 mx-auto mb-4 flex items-center justify-center border border-zinc-700 group-hover:border-emerald-500 transition-colors shadow-lg">
                                <span class="text-xs font-black text-zinc-400 group-hover:text-emerald-400 uppercase tracking-tighter">{{ substr($member->name, 0, 1) }}</span>
                            </div>
                            <p class="text-zinc-100 text-[11px] font-black uppercase tracking-tight truncate mb-2">{{ $member->name }}</p>
                            <span class="px-3 py-1 bg-zinc-900 text-zinc-500 text-[8px] font-black uppercase rounded-lg border border-zinc-800 group-hover:text-emerald-500">
                                {{ $member->role }}
                            </span>
                        </div>
                    @empty
                        <div class="col-span-full py-10 text-center text-zinc-700 italic text-xs">Belum ada member.</div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>
@endsection