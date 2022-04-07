<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BarangLokasiSeeder::class);
        $this->call(BarangSatuanSeeder::class);
        $this->call(BarangSeeder::class);
        $this->call(BarangStatusSeeder::class);
        $this->call(DepartemenSeeder::class);
        $this->call(UserLevelSeeder::class);
        $this->call(UsersSeeder::class);
    }
}
