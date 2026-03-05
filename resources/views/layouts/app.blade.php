<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#09090b" />
    <title>Markas Digital Sirkel</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* Mengatur scrollbar agar tetap gelap */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: #09090b; }
        ::-webkit-scrollbar-thumb { background: #27272a; border-radius: 10px; }
    </style>
</head>

<body class="bg-zinc-950 text-zinc-200 antialiased" x-data="{ sidebarOpen: false }">
    <div id="root">
        
        @if(auth()->check())
        <nav 
            class="fixed top-0 bottom-0 left-0 z-50 w-64 bg-zinc-900 border-r border-zinc-800 transition-transform duration-300 transform md:translate-x-0 overflow-y-auto"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            
            <div class="flex flex-col min-h-full px-6 py-4">
                <div class="flex items-center justify-between mb-6">
                    <a class="text-zinc-100 text-sm uppercase font-black tracking-widest flex items-center" href="{{ route('dashboard') }}">
                        <i class="fas fa-circle-notch mr-2 text-zinc-400"></i> Sirkel App
                    </a>
                    <button @click="sidebarOpen = false" class="text-zinc-400 md:hidden text-xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <hr class="mb-6 border-zinc-800" />

                <ul class="flex flex-col list-none space-y-2 flex-grow">
                    <li>
                        <a href="{{ route('dashboard') }}" 
                           class="text-xs uppercase py-3 px-4 font-bold rounded-xl flex items-center transition-all duration-200 {{ request()->routeIs('dashboard') ? 'text-zinc-100 bg-zinc-800 shadow-lg' : 'text-zinc-500 hover:text-zinc-300 hover:bg-zinc-800/50' }}">
                            <i class="fas fa-tv mr-3 text-sm"></i> Dashboard
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('circle.index') }}" 
                           class="text-xs uppercase py-3 px-4 font-bold rounded-xl flex items-center transition-all duration-200 {{ request()->routeIs('circle.*') ? 'text-zinc-100 bg-zinc-800 shadow-lg' : 'text-zinc-500 hover:text-zinc-300 hover:bg-zinc-800/50' }}">
                            <i class="fas fa-users mr-3 text-sm"></i> Circle
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('agenda.index') }}" 
                           class="text-xs uppercase py-3 px-4 font-bold rounded-xl flex items-center transition-all duration-200 {{ request()->routeIs('agenda.*') ? 'text-zinc-100 bg-zinc-800 shadow-lg' : 'text-zinc-500 hover:text-zinc-300 hover:bg-zinc-800/50' }}">
                            <i class="fas fa-calendar-alt mr-3 text-sm"></i> Agenda
                        </a>
                    </li>
                </ul>

                <div class="mt-auto pt-6 border-t border-zinc-800">
                    <div class="flex items-center p-2 bg-zinc-800/30 rounded-xl">
                        <div class="w-8 h-8 rounded-full bg-zinc-700 flex items-center justify-center text-xs font-bold mr-3">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-[10px] text-zinc-500 font-bold uppercase tracking-tighter truncate">{{ auth()->user()->name }}</p>
                            <p class="text-[9px] text-emerald-500 font-bold uppercase tracking-widest">{{ auth()->user()->role }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 z-40 md:hidden" x-transition.opacity></div>
        @endif

        <div class="relative flex flex-col min-h-screen {{ auth()->check() ? 'md:ml-64' : '' }}">
            
            @if(auth()->check())
            <nav class="absolute top-0 left-0 w-full z-10 bg-transparent flex items-center p-4">
                <div class="w-full flex justify-between items-center md:px-10 px-4">
                    <button @click="sidebarOpen = true" class="md:hidden text-zinc-100 text-xl focus:outline-none">
                        <i class="fas fa-bars"></i>
                    </button>

                    <span class="text-zinc-400 text-[10px] uppercase hidden lg:inline-block font-black tracking-[0.2em]">
                        Markas / <span class="text-zinc-100">{{ request()->segment(1) ?? 'Home' }}</span>
                    </span>
                    
                    <div class="flex items-center">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-zinc-800/80 backdrop-blur hover:bg-red-900/40 text-zinc-100 text-[10px] font-black uppercase px-4 py-2 rounded-lg shadow-xl transition-all border border-zinc-700 hover:border-red-800 tracking-widest">
                                Logout <i class="fas fa-sign-out-alt ml-2 opacity-50"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </nav>

            <div class="relative bg-zinc-900 md:pt-32 pb-48 pt-20 border-b border-zinc-800">
                <div class="px-4 md:px-10 mx-auto w-full">
                    <h1 class="text-white text-2xl font-bold md:block hidden">Selamat Datang, {{ explode(' ', auth()->user()->name)[0] }}!</h1>
                </div>
            </div>
            @endif

            <main class="flex-grow px-4 md:px-10 mx-auto w-full {{ auth()->check() ? '-mt-32' : '' }}">
                @yield('content')
            </main>
            
            <footer class="w-full py-6 mt-12 bg-zinc-950">
                <div class="px-4 md:px-10 mx-auto">
                    <hr class="mb-6 border-zinc-800" />
                    <div class="flex flex-wrap items-center md:justify-between justify-center">
                        <div class="w-full md:w-4/12">
                            <div class="text-[10px] text-zinc-600 font-bold py-1 text-center md:text-left uppercase tracking-[0.3em]">
                                © 2026 <span class="text-zinc-500">Sirkel App Digital Markas</span>
                            </div>
                        </div>
                        <div class="w-full md:w-8/12 hidden md:block">
                            <ul class="flex list-none justify-end space-x-6">
                                <li><a href="#" class="text-zinc-600 hover:text-zinc-400 text-[10px] font-bold uppercase tracking-widest transition-colors">Documentation</a></li>
                                <li><a href="#" class="text-zinc-600 hover:text-zinc-400 text-[10px] font-bold uppercase tracking-widest transition-colors">Support</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
    </div>
</body>
</html>