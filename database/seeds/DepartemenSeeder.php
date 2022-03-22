<?php

use Illuminate\Database\Seeder;
use App\Departemen;

class DepartemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departemen = [
            'produksi',
            'rajut',
            'celup',
            'penjualan',
            'kepegawaian',
            'limbah',
            'konsumsi',
            'design',
            'it',
            'pemerintahan'
        ];
        $jml = (int) count($departemen);
        for ($i = 0; $i <= ($jml - 1) ; $i++) {
            Departemen::create([
                'dept_name' => $departemen[$i],
            ]);   
        }
    }
}
