<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToEkosistemTable extends Migration
{
    public function up()
    {
        Schema::table('ekosistem', function (Blueprint $table) {
            $table->index('nama_ekosistem');
            $table->index('lokasi');
        });
    }

    public function down()
    {
        Schema::table('ekosistem', function (Blueprint $table) {
            $table->dropIndex(['nama_ekosistem']);
            $table->dropIndex(['lokasi']);
        });
    }
}