@extends('layouts.app')

@section('content')
<div class="container mx-auto pb-12 px-4">
    {{-- Header --}}
    <div class="mb-10 text-center md:text-left">
        <h2 class="text-white text-3xl font-extrabold tracking-tight italic uppercase">Pengaturan Profil</h2>
        <p class="text-zinc-500 text-sm mt-1 tracking-wide">Kelola identitas publik Anda di halaman landing sirkel.</p>
    </div>

    <div class="max-w-2xl mx-auto">
        <div class="bg-zinc-900 border border-zinc-800 rounded-[2.5rem] p-8 md:p-12 shadow-2xl relative overflow-hidden">
            {{-- Form Start --}}
            <form action="{{ route('landing.member.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8 relative z-10">
                @csrf
                @method('PUT')

                {{-- Foto Section --}}
                <div class="flex flex-col items-center justify-center mb-10">
                    <div class="relative group">
                        @if($member->photo)
                            <img src="{{ asset('storage/'.$member->photo) }}" 
                                 class="w-32 h-32 rounded-[2.5rem] object-cover border-4 border-zinc-800 shadow-2xl transition-transform group-hover:scale-105">
                        @else
                            <div class="w-32 h-32 rounded-[2.5rem] bg-zinc-800 flex items-center justify-center border-4 border-zinc-700 shadow-inner">
                                <i class="fas fa-user text-4xl text-zinc-600"></i>
                            </div>
                        @endif
                        <div class="absolute -bottom-2 -right-2 bg-emerald-600 w-10 h-10 rounded-2xl flex items-center justify-center border-4 border-zinc-900 shadow-lg">
                            <i class="fas fa-camera text-white text-xs"></i>
                        </div>
                    </div>
                    <div class="mt-6 w-full max-w-xs text-center">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 block mb-3">Ganti Foto Profil</label>
                        <input type="file" name="photo" 
                               class="block w-full text-[10px] text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[9px] file:font-black file:uppercase file:bg-zinc-800 file:text-zinc-300 hover:file:bg-zinc-700 cursor-pointer">
                    </div>
                </div>

                <hr class="border-zinc-800">

                {{-- Nama --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 ml-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ $member->name }}" required
                           class="w-full bg-zinc-950 border border-zinc-800 text-zinc-100 text-sm rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-emerald-500/30 transition-all">
                </div>

                {{-- Deskripsi --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 ml-1">Deskripsi / Bio Singkat</label>
                    <textarea name="description" rows="4"
                              class="w-full bg-zinc-950 border border-zinc-800 text-zinc-100 text-sm rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-emerald-500/30 transition-all placeholder-zinc-700"
                              placeholder="Ceritakan sedikit tentang peranmu...">{{ $member->description }}</textarea>
                </div>

                {{-- Action Button --}}
                <div class="pt-6">
                    <button type="submit" 
                            class="w-full bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-black uppercase py-5 rounded-[1.5rem] shadow-[0_10px_20px_rgba(16,185,129,0.2)] transition-all active:scale-[0.98] flex items-center justify-center">
                        <i class="fas fa-check-circle mr-2 text-lg"></i> Simpan Perubahan
                    </button>
                    
                    <a href="{{ route('dashboard') }}" 
                       class="block text-center mt-6 text-zinc-600 hover:text-zinc-400 text-[10px] font-black uppercase tracking-widest transition-colors">
                        Batal & Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection