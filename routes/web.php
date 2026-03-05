<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\CircleController;
use App\Http\Controllers\MemoryController;
use App\Http\Controllers\LandingController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\MemberMiddleware;
use App\Http\Controllers\Api\AgendaApiController;



/* ================= PUBLIC LANDING PAGE ================= */

// Landing page publik
Route::get('/', [LandingController::class,'index'])->name('landing');

/* ================= AUTH ================= */

Route::get('/login',[AuthController::class,'showLogin'])->name('login');
Route::post('/login',[AuthController::class,'login']);

Route::get('/register',[AuthController::class,'showRegister'])->name('register');
Route::post('/register',[AuthController::class,'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->get('/agenda-api', [AgendaApiController::class, 'getAgenda'])->name('agenda.api');
/* ================= PROTECTED ROUTES ================= */

Route::middleware('auth')->group(function(){

    // Dashboard
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    /* ================= CIRCLE ================= */

    // Circle view (semua user)
    Route::get('/circle', [CircleController::class, 'index'])->name('circle.index');

    // Circle manage (admin/member login)
    Route::get('/circle/create', [CircleController::class, 'create'])->name('circle.create');
    Route::post('/circle', [CircleController::class, 'store'])->name('circle.store');
    Route::put('/circle/{circle}', [CircleController::class, 'update'])->name('circle.update');

    // Structure (sub bagian Circle)
    Route::post('/structure', [CircleController::class, 'storeStructure'])->name('structure.store');
    Route::put('/structure/{structure}', [CircleController::class, 'updateStructure'])->name('structure.update');
    Route::delete('/structure/{structure}', [CircleController::class, 'destroyStructure'])->name('structure.destroy');

    /* ================= AGENDA ================= */

    Route::get('/agenda', [AgendaController::class,'index'])->name('agenda.index');
    Route::get('/agenda/create', [AgendaController::class,'create'])->name('agenda.create');
    Route::post('/agenda/store', [AgendaController::class,'store'])->name('agenda.store');

    Route::get('/agenda/{id}/edit', [AgendaController::class,'edit'])->name('agenda.edit');
    Route::put('/agenda/{id}', [AgendaController::class,'update'])->name('agenda.update');

    Route::post('/agenda/{id}/join', [AgendaController::class,'join'])->name('agenda.join');
    Route::post('/agenda/{id}/pay', [AgendaController::class,'pay'])->name('agenda.pay');
    Route::post('/agenda/{id}/upload', [AgendaController::class,'uploadPayment'])->name('agenda.upload');

    /* ================= MEMORY ================= */

    Route::post('/memory/store',[MemoryController::class,'store'])->name('memory.store');


    /* ================= LANDING PAGE ADMIN/MEMBER CRUD ================= */

    // Admin landing

    Route::middleware([AdminMiddleware::class])->group(function() {
        Route::get('/admin/landing',[LandingController::class,'adminIndex'])->name('landing.admin');
        Route::post('/highlight/store',[LandingController::class,'storeHighlight'])->name('highlight.store');
        Route::put('/highlight/{id}', [LandingController::class,'updateHighlight'])->name('highlight.update');
        Route::delete('/highlight/{id}', [LandingController::class,'destroyHighlight'])->name('highlight.destroy');

        Route::post('/member/store',[LandingController::class,'storeMember'])->name('member.store');
        Route::put('/member/{id}', [LandingController::class,'updateMember'])->name('member.update');
        Route::delete('/member/{id}', [LandingController::class,'destroyMember'])->name('member.destroy');
    });

   // Untuk member (hanya bisa edit profil sendiri)
    Route::middleware('auth')->group(function() {
        Route::get('/member/profile', [LandingController::class, 'memberProfile'])->name('landing.member');
        Route::put('/member/profile/update', [LandingController::class, 'updateMemberProfile'])->name('landing.member.update');
    });

});
    // Memory