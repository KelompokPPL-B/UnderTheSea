<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ekosistem', function (Blueprint $table) {
            $table->text('cara_menjaga')->nullable()->after('ancaman');
            $table->text('larangan')->nullable()->after('cara_menjaga');
            $table->text('dampak_kerusakan')->nullable()->after('larangan');
        });
    }

    public function down(): void
    {
        Schema::table('ekosistem', function (Blueprint $table) {
            $table->dropColumn(['cara_menjaga', 'larangan', 'dampak_kerusakan']);
        });
    }
};