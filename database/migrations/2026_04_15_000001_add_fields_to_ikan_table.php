<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ikan', function (Blueprint $table) {
            if (!Schema::hasColumn('ikan', 'scientific_name')) {
                $table->string('scientific_name')->nullable()->after('nama');
            }
            if (!Schema::hasColumn('ikan', 'diet')) {
                $table->text('diet')->nullable()->after('deskripsi');
            }
            if (!Schema::hasColumn('ikan', 'size')) {
                $table->string('size')->nullable()->after('diet');
            }
        });
    }

    public function down(): void
    {
        Schema::table('ikan', function (Blueprint $table) {
            if (Schema::hasColumn('ikan', 'scientific_name')) {
                $table->dropColumn('scientific_name');
            }
            if (Schema::hasColumn('ikan', 'diet')) {
                $table->dropColumn('diet');
            }
            if (Schema::hasColumn('ikan', 'size')) {
                $table->dropColumn('size');
            }
        });
    }
};
