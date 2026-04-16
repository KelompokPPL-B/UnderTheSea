<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id('id_favorite');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('type', ['ikan', 'ekosistem', 'aksi']);
            $table->integer('item_id');
            $table->timestamps();
            $table->unique(['user_id', 'type', 'item_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
