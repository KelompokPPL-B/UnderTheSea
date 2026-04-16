<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ekosistem', function (Blueprint $table) {
            $table->id('id_ekosistem');
            $table->string('nama_ekosistem');
            $table->text('deskripsi')->nullable();
            $table->string('lokasi')->nullable();
            $table->text('peran')->nullable();
            $table->text('ancaman')->nullable();
            $table->string('gambar')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ekosistem');
    }
};
