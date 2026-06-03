<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Owner: Mutiara
     * PBI-13: Manage Action Content — Add detail fields
     */
    public function up(): void
    {
        Schema::table('aksi_pelestarian', function (Blueprint $table) {
            $table->string('lokasi', 255)->nullable()->after('cara_melakukan');
            $table->date('tanggal_kegiatan')->nullable()->after('lokasi');
            $table->string('tujuan_konservasi', 500)->nullable()->after('tanggal_kegiatan');
            $table->string('isu_lingkungan', 500)->nullable()->after('tujuan_konservasi');
            $table->unsignedInteger('volunteer_dibutuhkan')->nullable()->after('isu_lingkungan');
            $table->text('dampak_aksi')->nullable()->after('volunteer_dibutuhkan');
        });
    }

    public function down(): void
    {
        Schema::table('aksi_pelestarian', function (Blueprint $table) {
            $table->dropColumn([
                'lokasi',
                'tanggal_kegiatan',
                'tujuan_konservasi',
                'isu_lingkungan',
                'volunteer_dibutuhkan',
                'dampak_aksi',
            ]);
        });
    }
};