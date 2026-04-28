<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ekosistem', function (Blueprint $table) {
            if (!Schema::hasColumn('ekosistem', 'karakteristik')) {
                $table->text('karakteristik')->nullable()->after('deskripsi');
            }
            if (!Schema::hasColumn('ekosistem', 'manfaat')) {
                $table->text('manfaat')->nullable()->after('karakteristik');
            }
            if (!Schema::hasColumn('ekosistem', 'cara_pelestarian')) {
                $table->text('cara_pelestarian')->nullable()->after('manfaat');
            }
        });
    }

    public function down(): void
    {
        Schema::table('ekosistem', function (Blueprint $table) {
            if (Schema::hasColumn('ekosistem', 'cara_pelestarian')) {
                $table->dropColumn('cara_pelestarian');
            }
            if (Schema::hasColumn('ekosistem', 'manfaat')) {
                $table->dropColumn('manfaat');
            }
            if (Schema::hasColumn('ekosistem', 'karakteristik')) {
                $table->dropColumn('karakteristik');
            }
        });
    }
};
