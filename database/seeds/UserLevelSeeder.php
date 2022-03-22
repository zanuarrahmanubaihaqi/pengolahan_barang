<?php

use Illuminate\Database\Seeder;
use App\Level;

class UserLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jml = 3;
        $ket = [
            "admin",
            "operator",
            "member"
        ];
        for ($i = 0; $i <= ($jml - 1) ; $i++) {
            Level::create([
                'keterangan' => $ket[$i],
            ]);   
        }
    }
}
