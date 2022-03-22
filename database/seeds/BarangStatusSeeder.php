<?php

use Illuminate\Database\Seeder;
use App\BarangStatus;

class BarangStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jml = 3;
        $satuan = [
            "tersedia",
            "habis",
            "produksi"
        ];
        for ($i = 0; $i <= ($jml - 1) ; $i++) {
            BarangStatus::create([
                'status_ket' => $satuan[$i],
            ]);   
        }
    }
}
