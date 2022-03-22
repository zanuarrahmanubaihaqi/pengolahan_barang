<?php

use Illuminate\Database\Seeder;
use App\Barang;

class BarangSeeder extends Seeder
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
            Barang::create([
                'brg_nama' => "barang" . $i,
                'brg_status_id' => rand(1, 3),
                'brg_stok' => rand(1, 20) + $i,
                'brg_satuan_id' => rand(1, 5),
                'brg_lokasi_id' => rand(1, 10),
                'created_at' => date('Y-m-d H:i:s')
            ]);   
        }
    }
}
