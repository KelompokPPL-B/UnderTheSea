<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Owner: Grace Magaretha Sirait
     * PBI-26: Mark Completed Action
     * Tabel untuk menyimpan data user yang menandai aksi pelestarian
     */
    public function up(): void
    {
        // Ditambahkan pengecekan ini supaya kebal dari error "Table already exists"
        if (!Schema::hasTable('aksi_tandai')) {
            Schema::create('aksi_tandai', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('aksi_id');
                $table->foreign('aksi_id')
                      ->references('id_aksi')
                      ->on('aksi_pelestarian')
                      ->onDelete('cascade');
                $table->string('nama_peserta', 100);
                $table->string('session_id', 255)->nullable();
                $table->timestamp('ditandai_pada')->useCurrent();
                $table->timestamps();

                // Satu session hanya bisa tandai satu aksi sekali
                $table->unique(['aksi_id', 'session_id']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('aksi_tandai');
    }
};