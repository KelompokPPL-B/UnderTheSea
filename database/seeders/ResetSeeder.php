<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ResetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

DB::table('likes')->truncate();
DB::table('favorites')->truncate();
DB::table('user_views')->truncate();
DB::table('aksi_pelestarian')->truncate();
DB::table('ekosistem')->truncate();
DB::table('ikan')->truncate();
DB::table('users')->truncate();

DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
