@extends('layouts.app')

@section('content')
<div class="container mx-auto pb-12 px-4">
    
    {{-- HEADER SECTION --}}
    <div class="flex flex-wrap items-center justify-between mb-10 gap-4 px-2">
        <div class="z-20">
            <h2 class="text-white text-3xl font-black tracking-tighter uppercase">Ringkasan Aktivitas</h2>
            <p class="text-zinc-500 text-xs mt-1 font-medium tracking-wide">Pantau perkembangan sirkel dan agenda Anda secara real-time.</p>
        </div>
        
        <div class="z-20">
            @if(auth()->user()->role == 'admin')
                <div class="bg-blue-500/10 border border-blue-500/20 text-blue-400 px-5 py-2.5 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] flex items-center backdrop-blur-md shadow-lg shadow-blue-500/5">
                    <span class="relative flex h-2 w-2 mr-3">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                    </span>
                    Admin Control Active
                </div>
            @else
                <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-5 py-2.5 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] flex items-center backdrop-blur-md">
                    <i class="fas fa-shield-alt mr-2"></i> Member Area
                </div>
            @endif
        </div>
    </div>

    {{-- STATISTIK CARDS (Gaya Modern Baru) --}}
    <div class="flex flex-wrap -mx-4 mb-12">
        {{-- Total Circle --}}
        <div class="w-full sm:w-6/12 xl:w-3/12 px-4 mb-6">
            <div class="group relative flex flex-col bg-zinc-900 border border-zinc-800 rounded-[2rem] p-6 shadow-2xl transition-all duration-300 hover:border-blue-500/50 hover:-translate-y-1 overflow-hidden">
                <div class="absolute -right-4 -top-4 w-20 h-20 bg-blue-600/5 blur-2xl group-hover:bg-blue-600/10 transition-all"></div>
                <div class="flex items-center justify-between relative z-10">
                    <div>
                        <p class="text-zinc-500 uppercase font-black text-[9px] tracking-[0.2em]">Total Circle</p>
                        <h3 class="text-zinc-100 text-2xl font-black mt-1 uppercase tracking-tighter">12 <span class="text-[10px] text-zinc-600">Grup</span></h3>
                    </div>
                    <div class="w-12 h-12 bg-zinc-800 border border-zinc-700 rounded-2xl flex items-center justify-center text-blue-500 transition-all group-hover:bg-blue-600 group-hover:text-white group-hover:shadow-[0_0_15px_rgba(37,99,235,0.4)]">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="mt-6 pt-4 border-t border-zinc-800/50">
                    <a href="{{ route('circle.index') }}" class="text-blue-400 hover:text-blue-300 text-[10px] font-black flex items-center uppercase tracking-widest">
                        Explore <i class="fas fa-chevron-right ml-2 text-[8px]"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Agenda Aktif --}}
        <div class="w-full sm:w-6/12 xl:w-3/12 px-4 mb-6">
            <div class="group relative flex flex-col bg-zinc-900 border border-zinc-800 rounded-[2rem] p-6 shadow-2xl transition-all duration-300 hover:border-emerald-500/50 hover:-translate-y-1 overflow-hidden">
                <div class="absolute -right-4 -top-4 w-20 h-20 bg-emerald-600/5 blur-2xl group-hover:bg-emerald-600/10 transition-all"></div>
                <div class="flex items-center justify-between relative z-10">
                    <div>
                        <p class="text-zinc-500 uppercase font-black text-[9px] tracking-[0.2em]">Agenda Aktif</p>
                        <h3 class="text-zinc-100 text-2xl font-black mt-1 uppercase tracking-tighter">5 <span class="text-[10px] text-zinc-600">Event</span></h3>
                    </div>
                    <div class="w-12 h-12 bg-zinc-800 border border-zinc-700 rounded-2xl flex items-center justify-center text-emerald-500 transition-all group-hover:bg-emerald-600 group-hover:text-white">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                </div>
                <div class="mt-6 pt-4 border-t border-zinc-800/50">
                    <a href="{{ route('agenda.index') }}" class="text-emerald-400 hover:text-emerald-300 text-[10px] font-black flex items-center uppercase tracking-widest">
                        Check Schedule <i class="fas fa-chevron-right ml-2 text-[8px]"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Akses Menu --}}
        <div class="w-full sm:w-6/12 xl:w-3/12 px-4 mb-6">
            <div class="group relative flex flex-col bg-zinc-900 border border-zinc-800 rounded-[2rem] p-6 shadow-2xl transition-all duration-300 hover:border-orange-500/50 hover:-translate-y-1 overflow-hidden">
                <div class="absolute -right-4 -top-4 w-20 h-20 bg-orange-600/5 blur-2xl group-hover:bg-orange-600/10 transition-all"></div>
                <div class="flex items-center justify-between relative z-10">
                    <div>
                        <p class="text-zinc-500 uppercase font-black text-[9px] tracking-[0.2em]">Akses Menu</p>
                        <h3 class="text-zinc-100 text-2xl font-black mt-1 uppercase tracking-tighter">{{ auth()->user()->role == 'admin' ? 'Manager' : 'Personal' }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-zinc-800 border border-zinc-700 rounded-2xl flex items-center justify-center text-orange-500 transition-all group-hover:bg-orange-600 group-hover:text-white">
                        <i class="fas fa-sliders-h"></i>
                    </div>
                </div>
                <div class="mt-6 pt-4 border-t border-zinc-800/50">
                    @if(auth()->user()->role == 'admin')
                        <a href="{{ route('landing.admin') }}" class="text-orange-400 hover:text-orange-300 text-[10px] font-black flex items-center uppercase tracking-widest">
                            Control Panel <i class="fas fa-chevron-right ml-2 text-[8px]"></i>
                        </a>
                    @else
                        <a href="{{ route('landing.member') }}" class="text-orange-400 hover:text-orange-300 text-[10px] font-black flex items-center uppercase tracking-widest">
                            Edit Profile <i class="fas fa-chevron-right ml-2 text-[8px]"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Status Sistem --}}
        <div class="w-full sm:w-6/12 xl:w-3/12 px-4 mb-6">
            <div class="relative flex flex-col bg-zinc-900 border border-zinc-800 rounded-[2rem] p-6 shadow-2xl overflow-hidden">
                <div class="flex items-center justify-between relative z-10">
                    <div>
                        <p class="text-zinc-500 uppercase font-black text-[9px] tracking-[0.2em]">Status Sistem</p>
                        <h3 class="text-emerald-500 text-2xl font-black mt-1 italic uppercase tracking-tighter">Stable</h3>
                    </div>
                    <div class="w-12 h-12 bg-zinc-800 border border-zinc-700 rounded-2xl flex items-center justify-center text-zinc-400">
                        <i class="fas fa-bolt text-lg"></i>
                    </div>
                </div>
                <div class="mt-6 pt-4 border-t border-zinc-800/50">
                    <p class="text-[9px] text-zinc-600 font-black uppercase flex items-center tracking-widest">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2 animate-pulse shadow-[0_0_8px_rgba(16,185,129,0.5)]"></span>
                        Latency: 24ms
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-wrap -mx-4">
        {{-- ================= KIRI: IDENTITY & MEMBERS ================= --}}
        <div class="w-full lg:w-4/12 px-4 mb-8">
            <div class="sticky top-24 space-y-6">
                
                {{-- Card Profil Sirkel --}}
                <div class="bg-zinc-900 border border-zinc-800 rounded-[2.5rem] p-8 shadow-2xl overflow-hidden relative group">
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-600/10 blur-3xl rounded-full group-hover:bg-blue-600/20 transition-all"></div>
                    
                    <div class="relative z-10 text-center">
                        @if(isset($circle) && $circle && $circle->logo)
                            <img src="{{ asset('storage/'.$circle->logo) }}" class="w-24 h-24 rounded-3xl object-cover mx-auto mb-4 border-4 border-zinc-800 shadow-2xl">
                        @else
                            <div class="w-24 h-24 bg-zinc-800 rounded-3xl mx-auto mb-4 flex items-center justify-center border-2 border-zinc-700 shadow-inner group-hover:border-blue-500/50 transition-all">
                                <i class="fas fa-shield-alt text-3xl text-zinc-600 group-hover:text-blue-500"></i>
                            </div>
                        @endif
                        
                        <h3 class="text-white text-xl font-black uppercase tracking-tighter">
                            {{ $circle->name ?? 'Nama Sirkel' }}
                        </h3>
                        <p class="text-zinc-500 text-xs mt-2 italic px-4 leading-relaxed line-clamp-2">
                            "{{ $circle->description ?? 'Deskripsi sirkel belum diatur.' }}"
                        </p>
                    </div>

                    <div class="mt-8 pt-6 border-t border-zinc-800/50 space-y-4">
                        <div class="flex items-center justify-between text-[10px] font-black uppercase tracking-widest text-zinc-500">
                            <span>Kekuatan Member</span>
                            <span class="text-emerald-500">{{ count($members ?? []) }} User</span>
                        </div>
                        {{-- Avatar Stack --}}
                        <div class="flex -space-x-3 overflow-hidden justify-center">
                            @foreach(($members ?? collect())->take(5) as $m)
                                <div class="inline-block h-8 w-8 rounded-full ring-2 ring-zinc-900 bg-zinc-800 flex items-center justify-center text-[10px] font-bold text-zinc-400 border border-zinc-700">
                                    {{ substr($m->name, 0, 1) }}
                                </div>
                            @endforeach
                            @if(count($members ?? []) > 5)
                                <div class="flex items-center justify-center h-8 w-8 rounded-full ring-2 ring-zinc-900 bg-zinc-700 text-[8px] font-black text-white">+{{ count($members ?? []) - 5 }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Struktur Organisasi --}}
                <div class="bg-zinc-900 border border-zinc-800 rounded-[2.5rem] p-7 shadow-xl relative overflow-hidden">
                    <div class="absolute -bottom-10 -left-10 w-24 h-24 bg-blue-600/5 blur-3xl rounded-full"></div>
                    <h4 class="relative z-10 text-zinc-100 font-black text-[10px] uppercase tracking-[0.3em] mb-6 flex items-center">
                        <span class="w-2 h-2 bg-blue-500 rounded-full mr-2 shadow-[0_0_10px_rgba(59,130,246,0.5)]"></span> Struktur Organisasi
                    </h4>
                    <div class="relative z-10 space-y-3">
                        @forelse(($circle->structures ?? collect()) as $structure)
                        <div class="flex items-center p-3 bg-zinc-950/40 border border-zinc-800/50 rounded-2xl hover:bg-zinc-800/50 hover:border-blue-500/30 transition-all group">
                            <div class="w-9 h-9 rounded-xl bg-zinc-800 flex items-center justify-center text-blue-500 text-xs border border-zinc-700 group-hover:scale-110 transition-all">
                                <i class="fas fa-crown"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-[8px] font-black text-zinc-600 uppercase tracking-widest leading-none mb-1">{{ $structure->position }}</p>
                                <p class="text-zinc-200 text-xs font-bold uppercase tracking-tight">{{ $structure->member?->name ?? '-' }}</p>
                            </div>
                        </div>
                        @empty
                        <p class="text-zinc-700 text-[10px] text-center font-black uppercase tracking-widest py-4 italic">Belum ada hirarki.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= KANAN ================= --}}
        <div class="w-full lg:w-8/12 px-4 space-y-8">
            
            {{-- Agenda Section --}}
            <div>
                <div class="flex items-center justify-between mb-6 px-2">
                    <h4 class="text-white font-black text-xs uppercase tracking-[0.3em] flex items-center">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2 shadow-[0_0_10px_rgba(16,185,129,0.5)]"></span> Agenda Terdekat
                    </h4>
                    <a href="{{ route('agenda.index') }}" class="text-zinc-500 hover:text-blue-400 text-[10px] font-black uppercase transition-all flex items-center gap-2">
                        Lihat Semua <i class="fas fa-arrow-right text-[8px]"></i>
                    </a>
                </div>
                
                <div class="flex gap-6 overflow-x-auto pb-6 no-scrollbar">
                    @forelse(($agendas ?? []) as $agenda)
                    <div class="min-w-[320px] bg-zinc-900 border border-zinc-800 p-7 rounded-[2.5rem] shadow-2xl hover:border-blue-500/40 transition-all group relative overflow-hidden">
                        <div class="absolute -top-10 -right-10 w-20 h-20 bg-blue-600/5 blur-2xl group-hover:bg-blue-600/10 transition-colors"></div>
                        <div class="flex justify-between items-start mb-5 relative z-10">
                            <span class="text-[9px] font-black uppercase px-3 py-1.5 border border-zinc-800 {{ $agenda->is_paid ? 'bg-amber-500/10 text-amber-500 border-amber-500/20' : 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' }} rounded-xl">
                                {{ $agenda->is_paid ? 'Premium' : 'Free' }}
                            </span>
                            <span class="text-zinc-600 text-[10px] font-black uppercase tracking-tighter italic pt-1">
                                <i class="far fa-calendar-alt mr-1"></i> {{ $agenda->date }}
                            </span>
                        </div>
                        <h5 class="text-zinc-100 font-black text-lg mb-2 group-hover:text-blue-400 transition-colors tracking-tight">{{ $agenda->title }}</h5>
                        <p class="text-zinc-500 text-xs line-clamp-2 italic mb-6 leading-relaxed">"{{ $agenda->description }}"</p>
                        <div class="flex items-center justify-between mt-auto pt-5 border-t border-zinc-800/50 relative z-10">
                            <div class="flex -space-x-2">
                                @foreach(($agenda->users ?? collect())->take(3) as $u)
                                    <div class="w-8 h-8 rounded-full bg-zinc-800 border-2 border-zinc-900 text-[9px] flex items-center justify-center font-black text-zinc-400">{{ substr($u->name,0,1) }}</div>
                                @endforeach
                            </div>
                            <form action="{{ route('agenda.join',$agenda->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-zinc-800 hover:bg-blue-600 text-white px-5 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all active:scale-95 border border-zinc-700 hover:border-blue-400">Join +</button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="w-full py-12 text-center bg-zinc-900/30 border border-dashed border-zinc-800 rounded-[2.5rem]">
                        <p class="text-zinc-600 text-[10px] font-black uppercase tracking-widest">Belum ada agenda aktif</p>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- CHATBOT AI SECTION --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-[2.5rem] shadow-3xl overflow-hidden flex flex-col h-[600px] relative transition-all duration-500 hover:border-zinc-700">
                <div class="absolute -top-20 -left-20 w-48 h-48 bg-blue-600/5 blur-[100px] rounded-full"></div>
                
                <div class="p-6 bg-zinc-800/40 border-b border-zinc-800 backdrop-blur-xl flex items-center justify-between relative z-10">
                    <div class="flex items-center">
                        <div class="relative group">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-emerald-500 rounded-2xl flex items-center justify-center shadow-lg group-hover:rotate-6 transition-transform duration-300">
                                <i class="fas fa-robot text-white text-lg"></i>
                            </div>
                            <span class="absolute -bottom-1 -right-1 w-4 h-4 bg-emerald-500 border-4 border-zinc-900 rounded-full"></span>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-zinc-100 font-black text-xs uppercase tracking-widest">Sirkel Assistant AI</h3>
                            <div class="flex items-center mt-1">
                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse mr-2"></span>
                                <span class="text-emerald-500/80 text-[8px] font-black uppercase tracking-tighter">Gemini 3 Flash Connected</span>
                            </div>
                        </div>
                    </div>
                    <button class="w-10 h-10 rounded-xl bg-zinc-800/50 flex items-center justify-center text-zinc-500 hover:text-white transition-colors">
                        <i class="fas fa-cog text-xs"></i>
                    </button>
                </div>

                <div id="chatContainer" class="flex-grow p-8 overflow-y-auto space-y-6 bg-zinc-950/20 scroll-smooth custom-scrollbar relative z-10">
                    {{-- Welcome Message --}}
                    <div class="flex justify-start animate-fade-in-up">
                        <div class="bg-zinc-800 border border-zinc-700/50 text-zinc-200 px-6 py-4 rounded-[1.8rem] rounded-tl-none max-w-[85%] text-sm shadow-xl leading-relaxed">
                            Halo <strong>{{ auth()->user() ? explode(' ',auth()->user()->name)[0] : 'User' }}</strong> 👋
                            <br>Ada yang bisa saya bantu terkait sirkel atau agenda Anda hari ini?
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-zinc-900 border-t border-zinc-800 relative z-10">
                    <div class="flex gap-3 relative">
                        <div class="flex-grow relative">
                            <input type="text" id="userInput"
                                class="w-full bg-zinc-950 border border-zinc-800 text-zinc-100 text-sm rounded-2xl px-6 py-5 pr-14 focus:outline-none focus:ring-2 focus:ring-blue-500/30 transition-all placeholder-zinc-700 shadow-inner"
                                placeholder="Tanyakan instruksi sirkel..." />
                            <div class="absolute right-5 top-1/2 -translate-y-1/2 text-zinc-600">
                                <i class="fas fa-microphone hover:text-blue-500 cursor-pointer transition-colors"></i>
                            </div>
                        </div>
                        <button id="sendBtn"
                            class="bg-blue-600 hover:bg-blue-500 text-white w-14 h-14 rounded-2xl transition-all shadow-lg flex items-center justify-center group active:scale-95 border border-blue-400/20">
                            <i class="fas fa-paper-plane transition-transform group-hover:rotate-12"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- LOGIC JAVASCRIPT --}}
<script>
const chatContainer = document.getElementById('chatContainer');
const userInput = document.getElementById('userInput');
const sendBtn = document.getElementById('sendBtn');

function addMessage(sender, text) {
    const isAi = sender === 'Gemini AI';
    const wrapper = document.createElement('div');
    wrapper.className = `flex ${isAi ? 'justify-start' : 'justify-end'} mb-4 animate-fade-in-up`;
    
    const div = document.createElement('div');
    div.className = `${isAi ? 'bg-zinc-800 border border-zinc-700/50 text-zinc-200 rounded-tl-none shadow-lg' : 'bg-blue-600 text-white rounded-tr-none shadow-[0_10px_20px_rgba(37,99,235,0.2)]'} px-6 py-4 rounded-[1.8rem] max-w-[85%] text-sm leading-relaxed`;
    
    div.innerHTML = `
        <span class="text-[9px] font-black uppercase tracking-widest opacity-40 block mb-1.5">${sender}</span>
        ${text.replace(/\n/g,'<br>')}
    `;
    
    wrapper.appendChild(div);
    chatContainer.appendChild(wrapper);
    chatContainer.scrollTop = chatContainer.scrollHeight;
}

sendBtn.addEventListener('click', async () => {
    const question = userInput.value.trim();
    if (!question) return;
    
    addMessage('You', question);
    userInput.value = '';

    try {
        const res = await fetch("{{ route('agenda.api') }}?q=" + encodeURIComponent(question), {
            credentials: 'same-origin'
        });
        const data = await res.json();
        addMessage('Gemini AI', data.data || "Maaf, saya tidak mendapatkan respon dari sistem.");
    } catch (err) {
        addMessage('Gemini AI', "Koneksi terputus. Pastikan server Anda aktif.");
    }
});

userInput.addEventListener('keypress', (e) => { if (e.key === 'Enter') sendBtn.click(); });
</script>

<style>
@keyframes fade-in-up {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in-up { animation: fade-in-up 0.4s ease-out forwards; }

/* Custom Scrollbar for Chat */
.custom-scrollbar::-webkit-scrollbar { width: 4px; }
.custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
.custom-scrollbar::-webkit-scrollbar-thumb { background: #27272a; border-radius: 10px; }
.custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #3f3f46; }

.no-scrollbar::-webkit-scrollbar { display: none; }
.no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endsection