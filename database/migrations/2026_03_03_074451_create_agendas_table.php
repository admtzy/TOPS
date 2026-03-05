<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // langsung ke user
            $table->string('title');
            $table->dateTime('date');
            $table->string('location');
            $table->text('description')->nullable();
            $table->boolean('is_paid')->default(false);
            $table->decimal('amount', 10, 2)->nullable(); // max 99999999.99
            $table->string('qris')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};