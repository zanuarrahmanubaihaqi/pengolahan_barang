<?php

use Illuminate\Database\Seeder;
use App\BarangLokasi;

class BarangLokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jml = 10;
        for ($i = 0; $i <= ($jml - 1) ; $i++) {
            $lokasi_kode = "LB" . sprintf("%03s", $i + 1);
            BarangLokasi::create([
                'lokasi_kode' => $lokasi_kode,
                'lokasi_ket' => "Gudang Dalam No. " . $i,
                'created_at' => date('Y-m-d H:i:s')
            ]);   
        }
    }
}
