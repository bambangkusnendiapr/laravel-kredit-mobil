<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(15)->create();
        $this->call(LaratrustSeeder::class);
        // DB::table('cars')->insert([
        //     ['type' => 'Mobil Satu', 'price_nett' => 120000000, 'price_sales' => 10000000, 'price_list' => 130000000, 'hadiah' => '-', 'ket' => '-'],
        //     ['type' => 'Mobil Dua', 'price_nett' => 130000000, 'price_sales' => 10000000, 'price_list' => 140000000, 'hadiah' => '-', 'ket' => '-'],
        //     ['type' => 'Mobil Tiga', 'price_nett' => 140000000, 'price_sales' => 10000000, 'price_list' => 150000000, 'hadiah' => '-', 'ket' => '-'],
        //     ['type' => 'Mobil Empat', 'price_nett' => 150000000, 'price_sales' => 10000000, 'price_list' => 160000000, 'hadiah' => '-', 'ket' => '-'],
        //     ['type' => 'Mobil Lima', 'price_nett' => 130000000, 'price_sales' => 10000000, 'price_list' => 140000000, 'hadiah' => '-', 'ket' => '-'],
        //     ['type' => 'Mobil Enam', 'price_nett' => 100000000, 'price_sales' => 10000000, 'price_list' => 110000000, 'hadiah' => '-', 'ket' => '-'],
        //     ['type' => 'Mobil Tujuh', 'price_nett' => 190000000, 'price_sales' => 10000000, 'price_list' => 200000000, 'hadiah' => '-', 'ket' => '-'],
        //     ['type' => 'Mobil Delapan', 'price_nett' => 110000000, 'price_sales' => 10000000, 'price_list' => 120000000, 'hadiah' => '-', 'ket' => '-'],
        //     ['type' => 'Mobil Sembilan', 'price_nett' => 110000000, 'price_sales' => 10000000, 'price_list' => 120000000, 'hadiah' => '-', 'ket' => '-'],
        //     ['type' => 'Mobil Sepuluh', 'price_nett' => 127000000, 'price_sales' => 10000000, 'price_list' => 128000000, 'hadiah' => '-', 'ket' => '-'],
        //     ['type' => 'Mobil Sebelas', 'price_nett' => 180000000, 'price_sales' => 10000000, 'price_list' => 190000000, 'hadiah' => '-', 'ket' => '-'],
        //     ['type' => 'Mobil Dua Belas', 'price_nett' => 150000000, 'price_sales' => 10000000, 'price_list' => 160000000, 'hadiah' => '-', 'ket' => '-'],
        //     ['type' => 'Mobil Tiga Belas', 'price_nett' => 220000000, 'price_sales' => 10000000, 'price_list' => 230000000, 'hadiah' => '-', 'ket' => '-'],
        //     ['type' => 'Mobil Empat Belas', 'price_nett' => 210000000, 'price_sales' => 10000000, 'price_list' => 220000000, 'hadiah' => '-', 'ket' => '-'],
        //     ['type' => 'Mobil Lima Belas', 'price_nett' => 310000000, 'price_sales' => 10000000, 'price_list' => 320000000, 'hadiah' => '-', 'ket' => '-'],
        // ]);
        DB::table('mobils')->insert([
            ['tipe' => 'CARRY', 'ket' => '-'],
            ['tipe' => 'APV', 'ket' => '-'],
            ['tipe' => 'KARIMUN', 'ket' => '-'],
            ['tipe' => 'ERTIGA', 'ket' => '-'],
            ['tipe' => 'XL7', 'ket' => '-'],
            ['tipe' => 'IGNIS', 'ket' => '-'],
            ['tipe' => 'BALENO', 'ket' => '-'],
            ['tipe' => 'S CROSS', 'ket' => '-'],
            ['tipe' => 'JIMMY', 'ket' => '-'],
        ]);
        DB::table('banks')->insert([
            ['nama' => 'BCA Finance', 'ket' => '-'],
            ['nama' => 'Suzuki Finance', 'ket' => '-'],
            ['nama' => 'Buana Finance', 'ket' => '-'],
            ['nama' => 'Maybank Finance', 'ket' => '-'],
            ['nama' => 'Mandiri Utama Finance', 'ket' => '-'],
            ['nama' => 'Mandiri Tunas Finance', 'ket' => '-'],
            ['nama' => 'PT. Nusantara Jaya Sentosa', 'ket' => '-'],
        ]);
        \App\Models\Buyer::factory(15)->create();
    }
}
