<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tambah index pada kolom yang sering di-query untuk optimasi
        Schema::table('favorites', function (Blueprint $table) {
            // Index untuk query filter by type (sering dipakai di FavoriteController)
            if (!$this->indexExists('favorites', 'favorites_type_item_id_index')) {
                $table->index(['type', 'item_id'], 'favorites_type_item_id_index');
            }
        });

        Schema::table('user_views', function (Blueprint $table) {
            // Index untuk query count views per content
            if (!$this->indexExists('user_views', 'user_views_content_type_content_id_index')) {
                $table->index(['content_type', 'content_id'], 'user_views_content_type_content_id_index');
            }
        });

        Schema::table('aksi_pelestarian', function (Blueprint $table) {
            // Index untuk filter user-generated content
            if (!$this->indexExists('aksi_pelestarian', 'aksi_pelestarian_is_user_generated_index')) {
                $table->index('is_user_generated', 'aksi_pelestarian_is_user_generated_index');
            }
        });
    }

    public function down(): void
    {
        Schema::table('favorites', function (Blueprint $table) {
            $table->dropIndex('favorites_type_item_id_index');
        });

        Schema::table('user_views', function (Blueprint $table) {
            $table->dropIndex('user_views_content_type_content_id_index');
        });

        Schema::table('aksi_pelestarian', function (Blueprint $table) {
            $table->dropIndex('aksi_pelestarian_is_user_generated_index');
        });
    }

    private function indexExists(string $table, string $indexName): bool
    {
        $indexes = \Illuminate\Support\Facades\DB::select(
            "SHOW INDEX FROM `{$table}` WHERE Key_name = ?",
            [$indexName]
        );
        return count($indexes) > 0;
    }
};