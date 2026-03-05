<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('memories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agenda_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('image');
            $table->text('caption')->nullable();
            $table->boolean('is_active')->default(true); // bisa di-takedown admin
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('memories');
    }
};