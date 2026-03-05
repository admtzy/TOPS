@extends('layouts.app')

@section('content')
<div class="container mx-auto pb-12 px-4">
    {{-- Header --}}
    <div class="mb-10 text-center md:text-left">
        <h2 class="text-white text-3xl font-extrabold tracking-tight italic uppercase">Edit Profil</h2>
        <p class="text-zinc-500 text-sm mt-1 tracking-wide">Perbarui identitas dan keamanan akun sirkel Anda.</p>
    </div>

    <div class="max-w-2xl mx-auto">
        {{-- Alert Success --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-500 text-xs font-black uppercase tracking-widest rounded-2xl flex items-center shadow-lg">
                <i class="fas fa-check-circle mr-3 text-lg"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-zinc-900 border border-zinc-800 rounded-[2.5rem] p-8 md:p-12 shadow-2xl relative overflow-hidden">
            <form action="{{ route('member.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6 relative z-10">
                @csrf
                @method('PUT')

                {{-- Foto Section --}}
                <div class="flex flex-col items-center justify-center mb-8">
                    <div class="relative group">
                        @if($member->photo)
                            <img src="{{ asset('storage/'.$member->photo) }}" 
                                 class="w-32 h-32 rounded-full object-cover border-4 border-zinc-800 shadow-2xl transition-transform group-hover:scale-105">
                        @else
                            <div class="w-32 h-32 rounded-full bg-zinc-800 flex items-center justify-center border-4 border-zinc-700 shadow-inner">
                                <i class="fas fa-user text-4xl text-zinc-600"></i>
                            </div>
                        @endif
                        <div class="absolute bottom-0 right-0 bg-blue-600 w-9 h-9 rounded-full flex items-center justify-center border-4 border-zinc-900 shadow-lg">
                            <i class="fas fa-pen text-white text-[10px]"></i>
                        </div>
                    </div>
                    <div class="mt-4 w-full max-w-xs text-center">
                        <input type="file" name="photo" 
                               class="block w-full text-[10px] text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[9px] file:font-black file:uppercase file:bg-zinc-800 file:text-zinc-300 hover:file:bg-zinc-700 cursor-pointer transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Nama --}}
                    <div class="md:col-span-2 space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 ml-1">Nama</label>
                        <input type="text" name="name" value="{{ $member->name }}" required
                               class="w-full bg-zinc-950 border border-zinc-800 text-zinc-100 text-sm rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500/30 transition-all">
                    </div>

                    {{-- Deskripsi --}}
                    <div class="md:col-span-2 space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 ml-1">Deskripsi</label>
                        <input type="text" name="description" value="{{ $member->description }}"
                               class="w-full bg-zinc-950 border border-zinc-800 text-zinc-100 text-sm rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500/30 transition-all">
                    </div>

                    {{-- Password --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 ml-1">Password Baru</label>
                        <input type="password" name="password" placeholder="••••••••"
                               class="w-full bg-zinc-950 border border-zinc-800 text-zinc-100 text-sm rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-red-500/30 transition-all">
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 ml-1">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" placeholder="••••••••"
                               class="w-full bg-zinc-950 border border-zinc-800 text-zinc-100 text-sm rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-red-500/30 transition-all">
                    </div>
                </div>

                <p class="text-[9px] text-zinc-600 italic px-1 tracking-wider uppercase font-bold">
                    * Kosongkan password jika tidak ingin mengganti keamanan.
                </p>

                {{-- Action Button --}}
                <div class="pt-6">
                    <button type="submit" 
                            class="w-full bg-blue-600 hover:bg-blue-500 text-white text-xs font-black uppercase py-5 rounded-[1.5rem] shadow-[0_10px_20px_rgba(37,99,235,0.2)] transition-all active:scale-[0.98] flex items-center justify-center">
                        Simpan Perubahan
                    </button>
                    
                    <a href="{{ route('dashboard') }}" 
                       class="block text-center mt-6 text-zinc-600 hover:text-zinc-400 text-[10px] font-black uppercase tracking-widest transition-colors">
                        Kembali ke Dashboard
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection