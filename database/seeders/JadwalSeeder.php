<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jadwals')->insert([
            'nama' => 'reguler',
            'jam_masuk' => '07:00:00',
            'toleransi_waktu' => 5,
        ]);
    }
}
