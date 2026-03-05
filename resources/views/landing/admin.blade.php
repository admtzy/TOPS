@extends('layouts.app')

@section('content')
<div class="container mx-auto pb-12 px-4">
    {{-- Header --}}
    <div class="mb-10">
        <h2 class="text-white text-3xl font-extrabold tracking-tight italic uppercase">Admin Panel</h2>
        <p class="text-zinc-500 text-sm mt-1 tracking-wide">Kelola konten landing page: Highlight Slider dan Member Elit.</p>
    </div>

    <div class="grid grid-cols-1 gap-12">
        
        {{-- ================= HIGHLIGHT SECTION ================= --}}
        <div class="bg-zinc-900 border border-zinc-800 rounded-[2.5rem] p-8 shadow-2xl">
            <h4 class="text-zinc-100 font-black text-xs uppercase tracking-[0.4em] mb-8 flex items-center border-l-4 border-blue-500 pl-4">
                Manajemen Highlight
            </h4>

            {{-- Form Tambah Highlight --}}
            <form action="{{ route('highlight.store') }}" method="POST" enctype="multipart/form-data" 
                  class="mb-10 bg-zinc-950/50 p-6 rounded-3xl border border-zinc-800 border-dashed flex flex-wrap lg:flex-nowrap gap-4 items-end">
                @csrf
                <div class="w-full lg:w-1/3 space-y-2">
                    <label class="text-[10px] font-black text-zinc-500 uppercase ml-2 tracking-widest">Pilih Gambar</label>
                    <input type="file" name="image" required 
                           class="block w-full text-xs text-zinc-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-zinc-800 file:text-zinc-300 hover:file:bg-zinc-700 cursor-pointer transition-all">
                </div>
                <div class="w-full lg:flex-grow space-y-2">
                    <label class="text-[10px] font-black text-zinc-500 uppercase ml-2 tracking-widest">Caption</label>
                    <input type="text" name="caption" placeholder="Masukkan caption menarik..." 
                           class="w-full bg-zinc-900 border border-zinc-800 text-zinc-100 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500/30">
                </div>
                <button class="bg-blue-600 hover:bg-blue-500 text-white text-[10px] font-black uppercase px-8 py-3.5 rounded-xl shadow-lg transition-all active:scale-95 whitespace-nowrap">
                    Tambah
                </button>
            </form>

            {{-- List Highlight --}}
            <div class="space-y-4">
                @foreach($highlights as $highlight)
                <div class="bg-zinc-950/40 border border-zinc-800 p-4 rounded-2xl flex flex-wrap md:flex-nowrap items-center gap-4 group hover:border-zinc-600 transition-all">
                    <img src="{{ asset('storage/'.$highlight->image) }}" class="w-24 h-16 object-cover rounded-xl shadow-lg border border-zinc-800">
                    
                    <form action="{{ route('highlight.update',$highlight->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-wrap md:flex-nowrap gap-3 flex-grow">
                        @csrf
                        @method('PUT')
                        <input type="file" name="image" class="block w-full md:w-40 text-[9px] text-zinc-500 file:mr-2 file:py-1 file:px-3 file:rounded-lg file:border-0 file:bg-zinc-800 file:text-zinc-400">
                        <input type="text" name="caption" value="{{ $highlight->caption }}" class="flex-grow bg-zinc-900 border border-zinc-800 text-zinc-200 text-xs rounded-lg px-3 py-2">
                        <button class="bg-amber-600 hover:bg-amber-500 text-white text-[9px] font-black uppercase px-4 py-2 rounded-lg transition-all">Update</button>
                    </form>

                    <form action="{{ route('highlight.destroy',$highlight->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="bg-zinc-800 hover:bg-red-600 text-zinc-500 hover:text-white text-[9px] font-black uppercase px-4 py-2 rounded-lg transition-all">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>

        {{-- ================= MEMBER SECTION ================= --}}
        <div class="bg-zinc-900 border border-zinc-800 rounded-[2.5rem] p-8 shadow-2xl">
            <h4 class="text-zinc-100 font-black text-xs uppercase tracking-[0.4em] mb-8 flex items-center border-l-4 border-emerald-500 pl-4">
                Manajemen Tim Member
            </h4>

            {{-- Form Tambah Member --}}
            <form action="{{ route('member.store') }}" method="POST" enctype="multipart/form-data" 
                  class="mb-10 bg-zinc-950/50 p-6 rounded-3xl border border-zinc-800 border-dashed grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 items-end">
                @csrf
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-500 uppercase ml-2 tracking-widest">Pilih User</label>
                    <select name="user_id" required class="w-full bg-zinc-900 border border-zinc-800 text-zinc-300 text-xs rounded-xl px-4 py-2.5 focus:outline-none">
                        @foreach(\App\Models\User::where('role','member')->get() as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-500 uppercase ml-2 tracking-widest">Nama Tampilan</label>
                    <input type="text" name="name" placeholder="Nama Member" class="w-full bg-zinc-900 border border-zinc-800 text-zinc-100 text-xs rounded-xl px-4 py-2.5 focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-500 uppercase ml-2 tracking-widest">Foto</label>
                    <input type="file" name="photo" class="block w-full text-[9px] text-zinc-500 file:bg-zinc-800 file:text-zinc-300 file:border-0 file:rounded-lg file:py-1.5">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-500 uppercase ml-2 tracking-widest">Deskripsi/Jabatan</label>
                    <input type="text" name="description" placeholder="Ex: Lead Developer" class="w-full bg-zinc-900 border border-zinc-800 text-zinc-100 text-xs rounded-xl px-4 py-2.5 focus:outline-none">
                </div>
                <button class="bg-emerald-600 hover:bg-emerald-500 text-white text-[10px] font-black uppercase h-[42px] rounded-xl shadow-lg transition-all active:scale-95">
                    Tambah
                </button>
            </form>

            {{-- List Member --}}
            <div class="grid grid-cols-1 gap-4">
                @foreach($members as $member)
                <div class="bg-zinc-950/40 border border-zinc-800 p-4 rounded-2xl flex flex-wrap md:flex-nowrap items-center gap-4 group hover:border-emerald-500/30 transition-all">
                    @if($member->photo)
                        <img src="{{ asset('storage/'.$member->photo) }}" class="w-12 h-12 object-cover rounded-full border-2 border-zinc-800 shadow-xl">
                    @else
                        <div class="w-12 h-12 bg-zinc-800 rounded-full flex items-center justify-center text-zinc-600"><i class="fas fa-user"></i></div>
                    @endif

                    <form action="{{ route('member.update',$member->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-wrap md:flex-nowrap gap-3 flex-grow">
                        @csrf
                        @method('PUT')
                        <input type="text" name="name" value="{{ $member->name }}" class="flex-grow bg-zinc-900 border border-zinc-800 text-zinc-200 text-xs rounded-lg px-3 py-2">
                        <input type="file" name="photo" class="block w-full md:w-32 text-[9px] text-zinc-500 file:bg-zinc-800 file:text-zinc-300 file:border-0 file:rounded-lg">
                        <input type="text" name="description" value="{{ $member->description }}" class="flex-grow bg-zinc-900 border border-zinc-800 text-zinc-200 text-xs rounded-lg px-3 py-2">
                        <button class="bg-amber-600 hover:bg-amber-500 text-white text-[9px] font-black uppercase px-4 py-2 rounded-lg transition-all">Update</button>
                    </form>

                    <form action="{{ route('member.destroy',$member->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="bg-zinc-800 hover:bg-red-600 text-zinc-500 hover:text-white text-[9px] font-black uppercase px-4 py-2 rounded-lg transition-all">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection