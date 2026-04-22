<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToAksiPelestarianTable extends Migration
{
    public function up()
    {
        Schema::table('aksi_pelestarian', function (Blueprint $table) {
            $table->index('judul_aksi'); // ✅ cuma ini
        });
    }

    public function down()
    {
        Schema::table('aksi_pelestarian', function (Blueprint $table) {
            $table->dropIndex(['judul_aksi']);
        });
    }
}