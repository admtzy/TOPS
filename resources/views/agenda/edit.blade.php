@extends('layouts.app')

@section('content')
<div class="container mx-auto pb-12 px-4">
    {{-- Header --}}
    <div class="mb-10">
        <h2 class="text-white text-3xl font-extrabold tracking-tight italic uppercase">Edit Agenda</h2>
        <p class="text-zinc-500 text-sm mt-1 tracking-wide">Perbarui informasi kegiatan untuk anggota sirkel.</p>
    </div>

    <div class="max-w-3xl mx-auto">
        <div class="bg-zinc-900 border border-zinc-800 rounded-[2.5rem] p-8 shadow-2xl relative overflow-hidden">
            {{-- Aksen Dekoratif --}}
            <div class="absolute -top-10 -right-10 opacity-5">
                <i class="fas fa-edit text-9xl text-white"></i>
            </div>

            <form method="POST" action="{{ route('agenda.update',$agenda->id) }}" class="relative z-10 space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Judul --}}
                    <div class="md:col-span-2 space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 ml-1">Judul Agenda</label>
                        <input type="text" name="title" value="{{ $agenda->title }}" required
                               class="w-full bg-zinc-950 border border-zinc-800 text-zinc-100 text-sm rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-amber-500/30 transition-all">
                    </div>

                    {{-- Tanggal --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 ml-1">Tanggal & Waktu</label>
                        <input type="datetime-local" name="date" 
                               value="{{ date('Y-m-d\TH:i', strtotime($agenda->date)) }}" required
                               class="w-full bg-zinc-950 border border-zinc-800 text-zinc-100 text-sm rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-amber-500/30 transition-all [color-scheme:dark]">
                    </div>

                    {{-- Lokasi --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 ml-1">Lokasi</label>
                        <input type="text" name="location" value="{{ $agenda->location }}" required
                               class="w-full bg-zinc-950 border border-zinc-800 text-zinc-100 text-sm rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-amber-500/30 transition-all">
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 ml-1">Deskripsi Kegiatan</label>
                    <textarea name="description" rows="5"
                              class="w-full bg-zinc-950 border border-zinc-800 text-zinc-100 text-sm rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-amber-500/30 transition-all">{{ $agenda->description }}</textarea>
                </div>

                {{-- Submit Button --}}
                <div class="pt-4">
                    <button type="submit" 
                            class="w-full bg-amber-600 hover:bg-amber-500 text-white text-xs font-black uppercase py-5 rounded-[1.5rem] shadow-[0_10px_20px_rgba(245,158,11,0.2)] transition-all active:scale-[0.98] flex items-center justify-center">
                        <i class="fas fa-sync-alt mr-2"></i> Update Agenda
                    </button>
                    
                    <a href="{{ route('agenda.index') }}" 
                       class="block text-center mt-6 text-zinc-600 hover:text-zinc-400 text-[10px] font-black uppercase tracking-widest transition-colors">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection