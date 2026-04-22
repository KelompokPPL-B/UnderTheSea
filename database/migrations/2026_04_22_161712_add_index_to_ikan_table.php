<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('ikan', function (Blueprint $table) {
            $table->index('nama');     // 🔥 untuk search cepat
            $table->index('habitat');  // 🔥 untuk filter/search
        });
    }

    public function down()
    {
        Schema::table('ikan', function (Blueprint $table) {
            $table->dropIndex(['nama']);
            $table->dropIndex(['habitat']);
        });
    }
};