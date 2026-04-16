<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ikan', function (Blueprint $table) {
            $table->id('id_ikan');
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('habitat')->nullable();
            $table->text('karakteristik')->nullable();
            $table->string('status_konservasi', 100)->nullable();
            $table->text('fakta_unik')->nullable();
            $table->string('gambar')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ikan');
    }
};
