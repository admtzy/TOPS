<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Markas Digital Sirkel | Landing Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  
  <style>
    .swiper { width: 100%; height: 85vh; }
    .swiper-slide { position: relative; display: flex; justify-content: center; align-items: center; overflow: hidden; }
    .swiper-slide img { display: block; width: 100%; height: 100%; object-fit: cover; transform: scale(1.1); transition: transform 6s linear; }
    .swiper-slide-active img { transform: scale(1); }
    .black-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to bottom, rgba(9,9,11,0.4), rgba(9,9,11,0.9)); }
    .shape-fill { fill: #09090b; } /* Warna zinc-950 */
    
    /* Custom Swiper Bullet */
    .swiper-pagination-bullet { background: #fff !important; opacity: 0.5; }
    .swiper-pagination-bullet-active { background: #10b981 !important; opacity: 1; width: 25px; border-radius: 5px; transition: all 0.3s; }
  </style>
</head>
<body class="bg-zinc-950 text-zinc-300 antialiased">

<main>
  {{-- HERO SLIDER --}}
  <section class="relative block h-[85vh]">
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">
        @foreach($highlights as $highlight)
        <div class="swiper-slide">
          <img src="{{ asset('storage/'.$highlight->image) }}" alt="Highlight">
          <div class="black-overlay"></div>
          <div class="absolute container mx-auto px-4 z-10 text-center">
            <span class="bg-emerald-500/20 text-emerald-400 px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-[0.3em] mb-4 inline-block border border-emerald-500/30">Highlight Momen</span>
            <h1 class="text-white font-black text-5xl md:text-7xl uppercase italic tracking-tighter">
              {{ $highlight->caption }}
            </h1>
            <p class="mt-6 text-lg text-zinc-400 max-w-2xl mx-auto font-medium">
              Temukan cerita menarik di balik setiap momen berharga kami dalam membangun ekosistem digital sirkel.
            </p>
          </div>
        </div>
        @endforeach
      </div>
      <div class="swiper-button-next text-white/50 hover:text-white transition-all"></div>
      <div class="swiper-button-prev text-white/50 hover:text-white transition-all"></div>
      <div class="swiper-pagination"></div>
    </div>

    {{-- Shape Divider --}}
    <div class="absolute bottom-0 left-0 right-0 w-full pointer-events-none overflow-hidden h-20" style="transform: translateZ(0);">
      <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
        <polygon class="shape-fill" points="2560 0 2560 100 0 100"></polygon>
      </svg>
    </div>
  </section>

  {{-- CTA CARDS --}}
  <section class="relative py-20 bg-zinc-950">
    <div class="container mx-auto px-4">
      <div class="flex flex-wrap justify-center -mt-40 relative z-30">
        <div class="w-full md:w-5/12 px-4 text-center">
          <div class="relative flex flex-col min-w-0 bg-zinc-900 w-full mb-8 shadow-2xl rounded-[2rem] border border-zinc-800 transition-all hover:-translate-y-4 duration-500 group">
            <div class="px-8 py-12 flex-auto">
              <div class="text-white p-4 text-center inline-flex items-center justify-center w-16 h-16 mb-6 shadow-lg rounded-2xl bg-blue-600 group-hover:rotate-12 transition-transform">
                <i class="fas fa-sign-in-alt text-xl"></i>
              </div>
              <h6 class="text-xl font-black uppercase tracking-widest text-white">Portal Member</h6>
              <p class="mt-3 mb-8 text-zinc-500 text-sm leading-relaxed">Masuk ke markas untuk memantau agenda sirkel dan mengelola peran Anda.</p>
              <a href="{{ route('login') }}" class="block w-full bg-zinc-800 hover:bg-blue-600 text-white py-4 rounded-xl text-xs font-black uppercase tracking-[0.2em] transition-all">Login Markas</a>
            </div>
          </div>
        </div>
        
        <div class="w-full md:w-5/12 px-4 text-center">
          <div class="relative flex flex-col min-w-0 bg-zinc-900 w-full mb-8 shadow-2xl rounded-[2rem] border border-zinc-800 transition-all hover:-translate-y-4 duration-500 group">
            <div class="px-8 py-12 flex-auto">
              <div class="text-white p-4 text-center inline-flex items-center justify-center w-16 h-16 mb-6 shadow-lg rounded-2xl bg-emerald-600 group-hover:rotate-12 transition-transform">
                <i class="fas fa-user-plus text-xl"></i>
              </div>
              <h6 class="text-xl font-black uppercase tracking-widest text-white">Bergabung</h6>
              <p class="mt-3 mb-8 text-zinc-500 text-sm leading-relaxed">Belum terdaftar di sirkel? Daftarkan diri Anda sekarang, gratis tanpa biaya.</p>
              <a href="{{ route('register') }}" class="block w-full bg-emerald-600 hover:bg-emerald-500 text-white py-4 rounded-xl text-xs font-black uppercase tracking-[0.2em] transition-all shadow-[0_10px_20px_rgba(16,185,129,0.2)]">Register Member</a>
            </div>
          </div>
        </div>
      </div>

      {{-- TEAM SECTION --}}
      <div class="flex flex-wrap justify-center text-center mt-32 mb-16">
        <div class="w-full lg:w-6/12 px-4">
          <h4 class="text-emerald-500 font-black text-xs uppercase tracking-[0.5em] mb-2">Our Elite Team</h4>
          <h2 class="text-4xl md:text-5xl font-black text-white uppercase italic">Work with pleasure</h2>
          <p class="text-md leading-relaxed mt-4 text-zinc-500">
            Dibalik kecanggihan sirkel, ada tim solid yang siap berkolaborasi secara profesional.
          </p>
        </div>
      </div>
      
      <div class="flex flex-wrap justify-center gap-y-12">
        @foreach($members as $member)
        <div class="w-full md:w-6/12 lg:w-3/12 px-4">
          <div class="group">
            <div class="relative overflow-hidden rounded-[2.5rem] mb-6 shadow-2xl bg-zinc-900 border border-zinc-800">
              @if($member->photo)
                <img alt="{{ $member->name }}" src="{{ asset('storage/'.$member->photo) }}" 
                     class="w-full h-80 object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-110">
              @else
                <div class="w-full h-80 bg-zinc-800 flex items-center justify-center">
                  <i class="fas fa-user text-6xl text-zinc-700"></i>
                </div>
              @endif
              <div class="absolute bottom-0 left-0 w-full p-6 bg-gradient-to-t from-zinc-950 to-transparent">
                <h5 class="text-xl font-black text-white uppercase tracking-tight">{{ $member->name }}</h5>
                <p class="text-xs text-emerald-500 font-bold uppercase tracking-widest">{{ $member->description }}</p>
              </div>
            </div>
            <div class="flex justify-center gap-4 opacity-40 group-hover:opacity-100 transition-opacity">
              <a href="#" class="text-white hover:text-emerald-500"><i class="fab fa-twitter"></i></a>
              <a href="#" class="text-white hover:text-emerald-500"><i class="fab fa-facebook-f"></i></a>
              <a href="#" class="text-white hover:text-emerald-500"><i class="fab fa-instagram"></i></a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>
</main>

<footer class="bg-zinc-900 border-t border-zinc-800 text-zinc-400 pt-16 pb-12">
  <div class="container mx-auto px-4">
    <div class="flex flex-wrap text-center lg:text-left justify-between items-center">
      <div class="w-full lg:w-6/12 px-4 mb-8 lg:mb-0">
        <h4 class="text-3xl font-black text-white uppercase italic">Mari Berkolaborasi!</h4>
        <h5 class="text-sm mt-2 text-zinc-500 tracking-widest uppercase">Membangun ekosistem digital yang lebih solid.</h5>
      </div>
      <div class="w-full lg:w-4/12 px-4 flex justify-center lg:justify-end gap-3">
        <button class="bg-zinc-800 text-white w-12 h-12 rounded-xl hover:bg-emerald-600 transition-all shadow-lg"><i class="fab fa-twitter"></i></button>
        <button class="bg-zinc-800 text-white w-12 h-12 rounded-xl hover:bg-emerald-600 transition-all shadow-lg"><i class="fab fa-facebook-square"></i></button>
        <button class="bg-zinc-800 text-white w-12 h-12 rounded-xl hover:bg-emerald-600 transition-all shadow-lg"><i class="fab fa-discord"></i></button>
      </div>
    </div>
    <hr class="my-10 border-zinc-800" />
    <div class="text-center text-[10px] font-black uppercase tracking-[0.3em] text-zinc-600">
      Copyright © 2026 <span class="text-zinc-400">Markas Digital Sirkel</span>. Crafted for Excellence.
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  var swiper = new Swiper(".mySwiper", {
    loop: true,
    effect: "fade",
    speed: 1000,
    pagination: { el: ".swiper-pagination", clickable: true },
    navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
    autoplay: { delay: 5000, disableOnInteraction: false },
  });
</script>

</body>
</html>