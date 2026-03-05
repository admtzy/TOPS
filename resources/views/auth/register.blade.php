@extends('layouts.app')

@section('content')
<main class="focus:outline-none bg-zinc-950">
  <section class="relative w-full h-full py-20 min-h-screen">
    <div class="absolute top-0 w-full h-full bg-zinc-950 z-0"></div>

    <div class="container mx-auto px-4 h-full relative z-10">
      <div class="flex content-center items-center justify-center h-full">
        <div class="w-full lg:w-5/12 px-4">
          
          <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-2xl rounded-2xl bg-zinc-900 border border-zinc-800">
            <div class="rounded-t mb-0 px-6 py-8 text-center">
                <div class="inline-flex items-center justify-center w-14 h-14 mb-3 shadow-inner rounded-full bg-zinc-800 border border-zinc-700">
                    <i class="fas fa-user-plus text-zinc-400 text-xl"></i>
                </div>
                <h3 class="text-zinc-100 text-2xl font-bold">
                  Daftar Akun
                </h3>
                <p class="text-zinc-500 text-sm mt-2">Bergabunglah dengan ekosistem Sirkel App</p>
            </div>

            <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
              <form method="POST" action="/register">
                @csrf

                <div class="relative w-full mb-4">
                  <label class="block uppercase text-zinc-400 text-[10px] font-black mb-2 tracking-widest" for="name">
                    Nama Lengkap
                  </label>
                  <input 
                    type="text" 
                    name="name"
                    class="border border-zinc-700 px-4 py-3 placeholder-zinc-600 text-zinc-200 bg-zinc-800/50 rounded-xl text-sm shadow-inner focus:outline-none focus:ring-2 focus:ring-zinc-600 w-full ease-linear transition-all duration-150"
                    placeholder="Contoh: John Doe"
                    required
                  />
                </div>

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

                <div class="flex flex-wrap -mx-2">
                    <div class="relative w-full md:w-1/2 px-2 mb-4">
                        <label class="block uppercase text-zinc-400 text-[10px] font-black mb-2 tracking-widest" for="password">
                            Password
                        </label>
                        <input 
                            type="password" 
                            name="password"
                            class="border border-zinc-700 px-4 py-3 placeholder-zinc-600 text-zinc-200 bg-zinc-800/50 rounded-xl text-sm shadow-inner focus:outline-none focus:ring-2 focus:ring-zinc-600 w-full ease-linear transition-all duration-150"
                            placeholder="••••••••"
                            required
                        />
                    </div>

                    <div class="relative w-full md:w-1/2 px-2 mb-4">
                        <label class="block uppercase text-zinc-400 text-[10px] font-black mb-2 tracking-widest" for="password_confirmation">
                            Konfirmasi
                        </label>
                        <input 
                            type="password" 
                            name="password_confirmation"
                            class="border border-zinc-700 px-4 py-3 placeholder-zinc-600 text-zinc-200 bg-zinc-800/50 rounded-xl text-sm shadow-inner focus:outline-none focus:ring-2 focus:ring-zinc-600 w-full ease-linear transition-all duration-150"
                            placeholder="••••••••"
                            required
                        />
                    </div>
                </div>

                <div class="text-center mt-8">
                  <button
                    class="bg-zinc-100 text-zinc-950 active:bg-zinc-300 text-sm font-bold uppercase px-6 py-4 rounded-xl shadow-lg hover:shadow-zinc-500/10 outline-none focus:outline-none w-full ease-linear transition-all duration-150 transform hover:-translate-y-0.5"
                    type="submit">
                    Buat Akun Sekarang
                  </button>
                </div>
              </form>
            </div>
          </div>

          <div class="text-center mt-6 relative z-10 text-zinc-500 font-medium">
            <small>Sudah menjadi bagian dari kami? <a href="/login" class="text-zinc-200 hover:underline">Masuk di sini</a></small>
          </div>

        </div>
      </div>
    </div>
  </section>
</main>
@endsection