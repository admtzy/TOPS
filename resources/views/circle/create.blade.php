@extends('layouts.app')

@section('content')

@role('admin')
<div class="container mx-auto pb-12">
    {{-- Header --}}
    <div class="mb-8">
        <h2 class="text-white text-3xl font-extrabold tracking-tight italic uppercase">Manage Circle</h2>
        <p class="text-zinc-500 text-sm mt-1">Konfigurasi identitas guild dan atur hierarki kepengurusan.</p>
    </div>

    <div class="flex flex-wrap -mx-4">
        {{-- ================= FORM GENERAL INFO ================= --}}
        <div class="w-full lg:w-5/12 px-4 mb-8">
            <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8 shadow-2xl overflow-hidden relative">
                <div class="absolute top-0 right-0 p-6 opacity-10">
                    <i class="fas fa-id-card text-6xl text-white"></i>
                </div>
                
                <h4 class="text-zinc-100 font-black text-sm uppercase tracking-[0.3em] mb-8 flex items-center">
                    <i class="fas fa-info-circle mr-3 text-blue-500"></i> General Information
                </h4>

                <form action="{{ isset($circle) ? route('circle.update',$circle->id) : route('circle.store') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      class="space-y-6">
                    @csrf
                    @if(isset($circle))
                        @method('PUT')
                    @endif

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Nama Circle</label>
                        <input type="text" name="name" value="{{ $circle->name ?? '' }}"
                               class="w-full bg-zinc-950 border border-zinc-800 text-zinc-100 text-sm rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500/30 transition-all placeholder-zinc-700 shadow-inner"
                               placeholder="Contoh: Alpha Squad">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Deskripsi Singkat</label>
                        <textarea name="description" rows="3"
                                  class="w-full bg-zinc-950 border border-zinc-800 text-zinc-100 text-sm rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500/30 transition-all placeholder-zinc-700 shadow-inner">{{ $circle->description ?? '' }}</textarea>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Logo Guild</label>
                        <div class="flex items-center gap-4">
                            @if(isset($circle) && $circle->logo)
                                <img src="{{ asset('storage/'.$circle->logo) }}" class="w-12 h-12 rounded-xl object-cover border border-zinc-800">
                            @endif
                            <input type="file" name="logo"
                                   class="block w-full text-xs text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-zinc-800 file:text-zinc-300 hover:file:bg-zinc-700 transition-all">
                        </div>
                    </div>

                    <button class="w-full bg-blue-600 hover:bg-blue-500 text-white text-xs font-black uppercase py-4 rounded-xl shadow-lg transition-all active:scale-95 flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>

        {{-- ================= STRUKTUR ORGANISASI ================= --}}
        @if(isset($circle))
        <div class="w-full lg:w-7/12 px-4">
            <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8 shadow-2xl">
                <h4 class="text-zinc-100 font-black text-sm uppercase tracking-[0.3em] mb-8 flex items-center">
                    <i class="fas fa-sitemap mr-3 text-emerald-500"></i> Struktur Organisasi
                </h4>

                {{-- List Struktur --}}
                <div class="space-y-4 mb-10">
                    @forelse($circle->structures as $structure)
                    <div class="bg-zinc-950/50 border border-zinc-800 p-4 rounded-2xl flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-zinc-800 flex items-center justify-center text-zinc-500 mr-3 border border-zinc-700">
                                <i class="fas fa-user text-xs"></i>
                            </div>
                            <div>
                                <p class="text-zinc-100 text-xs font-bold">{{ $structure->member?->name ?? '-' }}</p>
                                <p class="text-[9px] text-zinc-600 uppercase font-black tracking-widest">Jabatan Saat Ini</p>
                            </div>
                        </div>

                        <div class="flex-grow md:max-w-xs">
                            <form action="{{ route('structure.update',$structure->id) }}" method="POST" class="flex gap-2">
                                @csrf @method('PUT')
                                <input type="text" name="position" value="{{ $structure->position }}"
                                       class="flex-grow bg-zinc-900 border border-zinc-800 text-zinc-100 text-[11px] rounded-lg px-3 py-2 focus:ring-1 focus:ring-blue-500/50 outline-none transition-all">
                                <button class="bg-zinc-800 hover:bg-zinc-700 text-zinc-300 p-2 px-3 rounded-lg text-[10px] transition-colors">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </form>
                        </div>

                        <form action="{{ route('structure.destroy',$structure->id) }}" method="POST" onsubmit="return confirm('Hapus posisi ini?')">
                            @csrf @method('DELETE')
                            <button class="text-zinc-600 hover:text-red-500 transition-colors p-2">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                    @empty
                    <p class="text-zinc-600 text-center text-xs italic py-4">Belum ada struktur organisasi.</p>
                    @endforelse
                </div>

                <hr class="border-zinc-800 mb-8">

                {{-- ================= TAMBAH STRUKTUR ================= --}}
                <div class="bg-zinc-950/30 border border-zinc-800/50 rounded-2xl p-6">
                    <h5 class="text-zinc-100 font-black text-[10px] uppercase tracking-[0.2em] mb-4 flex items-center">
                        <i class="fas fa-plus-circle mr-2 text-blue-500"></i> Tambah Struktur Baru
                    </h5>

                    <form action="{{ route('structure.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="circle_id" value="{{ $circle->id }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div class="space-y-2">
                                <select name="member_id" class="w-full bg-zinc-900 border border-zinc-800 text-zinc-100 text-xs rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500/30 outline-none transition-all cursor-pointer" required>
                                    <option value="">Pilih Member</option>
                                    @foreach($members as $member)
                                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="space-y-2">
                                <input type="text" name="position" placeholder="Jabatan (Ketua / Wakil / dll)"
                                       class="w-full bg-zinc-900 border border-zinc-800 text-zinc-100 text-xs rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500/30 outline-none transition-all" required>
                            </div>
                        </div>

                        <button class="w-full bg-zinc-100 hover:bg-white text-zinc-900 text-[10px] font-black uppercase py-3 rounded-xl transition-all shadow-xl flex items-center justify-center">
                            Tambahkan Anggota ke Struktur
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endrole

@endsection