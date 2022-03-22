<?php

use Illuminate\Database\Seeder;
use App\BarangSatuan;

class BarangSatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jml = 5;
        $satuan = [
            "pak",
            "lusin",
            "kg",
            "kodi",
            "rim"
        ];
        for ($i = 0; $i <= ($jml - 1) ; $i++) {
            BarangSatuan::create([
                'satuan_ket' => $satuan[$i],
            ]);   
        }
    }
}
