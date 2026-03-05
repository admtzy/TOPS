@extends('layouts.app')

@section('content')
<div class="container mx-auto pb-12 px-4">
    {{-- Header --}}
    <div class="mb-10">
        <h2 class="text-white text-3xl font-extrabold tracking-tight italic uppercase">Buat Agenda Baru</h2>
        <p class="text-zinc-500 text-sm mt-1 tracking-wide">Rencanakan kegiatan sirkel dan atur koordinasi anggaran.</p>
    </div>

    <div class="max-w-3xl mx-auto">
        <div class="bg-zinc-900 border border-zinc-800 rounded-[2.5rem] p-8 shadow-2xl relative overflow-hidden">
            {{-- Form Start --}}
            <form method="POST" action="{{ route('agenda.store') }}" enctype="multipart/form-data" 
                  x-data="{ isPaid: '0' }" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Judul --}}
                    <div class="md:col-span-2 space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 ml-1">Judul Agenda</label>
                        <input type="text" name="title" required
                               class="w-full bg-zinc-950 border border-zinc-800 text-zinc-100 text-sm rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500/30 transition-all placeholder-zinc-700"
                               placeholder="Contoh: Gathering Bulanan">
                    </div>

                    {{-- Tanggal --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 ml-1">Tanggal & Waktu</label>
                        <input type="datetime-local" name="date" required
                               class="w-full bg-zinc-950 border border-zinc-800 text-zinc-100 text-sm rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500/30 transition-all [color-scheme:dark]">
                    </div>

                    {{-- Lokasi --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 ml-1">Lokasi</label>
                        <input type="text" name="location" required
                               class="w-full bg-zinc-950 border border-zinc-800 text-zinc-100 text-sm rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500/30 transition-all placeholder-zinc-700"
                               placeholder="Nama Tempat / Link Maps">
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 ml-1">Deskripsi Kegiatan</label>
                    <textarea name="description" rows="4"
                              class="w-full bg-zinc-950 border border-zinc-800 text-zinc-100 text-sm rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500/30 transition-all placeholder-zinc-700"
                              placeholder="Detail agenda..."></textarea>
                </div>

                {{-- Status Berbayar --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 ml-1">Agenda Berbayar?</label>
                    <select name="is_paid" x-model="isPaid"
                            class="w-full bg-zinc-950 border border-zinc-800 text-zinc-100 text-sm rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500/30 transition-all cursor-pointer">
                        <option value="0">Tidak (Gratis)</option>
                        <option value="1">Ya (Butuh Budget)</option>
                    </select>
                </div>

                {{-- Budget Section (Tampil Jika Ya) --}}
                <div x-show="isPaid == '1'" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform -translate-y-4"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     class="p-6 bg-zinc-950/50 border border-zinc-800 rounded-[2rem] space-y-6">
                    
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-amber-500 ml-1">Jumlah Budget (Rp)</label>
                        <input type="number" name="amount" min="0" max="99999999"
                               class="w-full bg-zinc-900 border border-zinc-800 text-zinc-100 text-sm rounded-xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-amber-500/30 transition-all shadow-inner"
                               placeholder="0">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-amber-500 ml-1">Upload QRIS Pembayaran</label>
                        <div class="relative group">
                            <input type="file" name="qris"
                                   class="block w-full text-xs text-zinc-500 file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-zinc-800 file:text-zinc-200 hover:file:bg-zinc-700 transition-all cursor-pointer">
                        </div>
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="pt-4">
                    <button type="submit" 
                            class="w-full bg-blue-600 hover:bg-blue-500 text-white text-xs font-black uppercase py-5 rounded-[1.5rem] shadow-[0_10px_20px_rgba(37,99,235,0.2)] transition-all active:scale-[0.98] flex items-center justify-center">
                        <i class="fas fa-save mr-2 text-lg"></i> Simpan Agenda
                    </button>
                    <a href="{{ route('agenda.index') }}" 
                       class="block text-center mt-4 text-zinc-600 hover:text-zinc-400 text-[10px] font-black uppercase tracking-widest transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection