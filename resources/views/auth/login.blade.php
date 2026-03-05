@extends('layouts.app')

@section('content')
<main class="focus:outline-none bg-zinc-950">
  <section class="relative w-full h-full py-40 min-h-screen">
    <div class="absolute top-0 w-full h-full bg-zinc-950 z-0"></div>

    <div class="container mx-auto px-4 h-full relative z-10">
      <div class="flex content-center items-center justify-center h-full">
        <div class="w-full lg:w-4/12 px-4">
          
          <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-2xl rounded-2xl bg-zinc-900 border border-zinc-800">
            <div class="rounded-t mb-0 px-6 py-8 text-center">
                <div class="inline-flex items-center justify-center w-14 h-14 mb-3 shadow-inner rounded-full bg-zinc-800 border border-zinc-700">
                    <i class="fas fa-fingerprint text-zinc-400 text-xl"></i>
                </div>
                <h3 class="text-zinc-100 text-2xl font-bold">
                  Masuk ke Sirkel
                </h3>
                <p class="text-zinc-500 text-sm mt-2">Gunakan akun Anda untuk melanjutkan</p>
            </div>

            <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
              @if(session('error'))
                <div class="bg-red-900/50 border border-red-800 text-red-200 text-xs font-bold px-4 py-3 rounded-lg mb-4 shadow-md">
                  <i class="fas fa-exclamation-triangle mr-2"></i> {{ session('error') }}
                </div>
              @endif

              <form method="POST" action="/login">
                @csrf

                <div class="relative w-full mb-4">
                  <label class="block uppercase text-zinc-400 text-[10px] font-black mb-2 tracking-widest" for="email">
                    Alamat Email
                  </label>
                  <input 
                    type="email" 
                    name="email"
                    class="border border-zinc-700 px-4 py-3 placeholder-zinc-600 text-zinc-200 bg-zinc-800/50 rounded-xl text-sm shadow-inner focus:outline-none focus:ring-2 focus:ring-zinc-600 w-full ease-linear transition-all duration-150"
                    placeholder="nama@email.com"
                    required
                  />
                </div>

                <div class="relative w-full mb-4">
                  <label class="block uppercase text-zinc-400 text-[10px] font-black mb-2 tracking-widest" for="password">
                    Kata Sandi
                  </label>
                  <input 
                    type="password" 
                    name="password"
                    class="border border-zinc-700 px-4 py-3 placeholder-zinc-600 text-zinc-200 bg-zinc-800/50 rounded-xl text-sm shadow-inner focus:outline-none focus:ring-2 focus:ring-zinc-600 w-full ease-linear transition-all duration-150"
                    placeholder="••••••••"
                    required
                  />
                </div>

                <div class="flex justify-between items-center mt-4">
                  <label class="inline-flex items-center cursor-pointer">
                    <input
                      id="customCheckLogin"
                      type="checkbox"
                      name="remember"
                      class="form-checkbox border-zinc-700 rounded bg-zinc-800 text-zinc-600 w-5 h-5 ease-linear transition-all duration-150"
                    />
                    <span class="ml-2 text-sm font-medium text-zinc-500 hover:text-zinc-300 transition-colors">
                      Ingat sesi saya
                    </span>
                  </label>
                </div>

                <div class="text-center mt-8">
                  <button
                    class="bg-zinc-100 text-zinc-950 active:bg-zinc-300 text-sm font-bold uppercase px-6 py-4 rounded-xl shadow-lg hover:shadow-zinc-500/10 outline-none focus:outline-none w-full ease-linear transition-all duration-150 transform hover:-translate-y-0.5"
                    type="submit">
                    Masuk Sekarang
                  </button>
                </div>
              </form>
            </div>
          </div>

          <div class="flex flex-wrap mt-6 relative z-10 text-zinc-500 font-medium">
            <div class="w-1/2">
              <a href="#" class="hover:text-zinc-200 transition-colors duration-150">
                <small>Lupa akses akun?</small>
              </a>
            </div>
            <div class="w-1/2 text-right">
              <a href="/register" class="hover:text-zinc-200 transition-colors duration-150">
                <small>Belum punya akun?</small>
              </a>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
</main>
@endsection