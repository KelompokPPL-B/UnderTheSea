<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aksi_pelestarian', function (Blueprint $table) {
            $table->id('id_aksi');
            $table->string('judul_aksi');
            $table->text('deskripsi')->nullable();
            $table->text('manfaat')->nullable();
            $table->text('cara_melakukan')->nullable();
            $table->string('gambar')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->boolean('is_user_generated')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aksi_pelestarian');
    }
};
