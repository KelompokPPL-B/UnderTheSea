<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Owner: Grace Magaretha Sirait
     * PBI-26: Fitur Feedback/Komentar setelah aksi ditandai
     */
    public function up(): void
    {
        if (!Schema::hasTable('aksi_feedback')) {
            Schema::create('aksi_feedback', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('aksi_id');
                $table->foreign('aksi_id')
                      ->references('id_aksi')
                      ->on('aksi_pelestarian')
                      ->onDelete('cascade');
                $table->string('nama_peserta', 100);
                $table->text('komentar');
                $table->string('session_id', 255)->nullable();
                $table->timestamps();

                // Satu session hanya bisa memberikan satu feedback per aksi pelestarian
                $table->unique(['aksi_id', 'session_id']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('aksi_feedback');
    }
};