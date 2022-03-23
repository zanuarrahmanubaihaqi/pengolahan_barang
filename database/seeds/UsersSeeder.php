<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory as Faker;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nik = $this->createNIK();
        User::create([
          'username' => 'admin',
          'password' => bcrypt('passw0rd'),
          'email' => 'adminroot@mail.co.id',
          'name' => 'System Administrator',
          'nik' => $nik,
          'level' => $faker->randomElement($array = array (1, 2, 3)),
          'dept_id' => $faker->randomElement($array = array (1, 2, 3, 4)),
          'remember_token' => Str::random(10),
          'created_at' => date('Y-m-d H:i:s')
        ]);

        for ($i=0; $i < 9; $i++) {
          $nik0 = $this->createNIK();
          User::create([
            'username' => $faker->userName,
            'password' => bcrypt('akses123'),
            'email' => 'root@mail.co.id',
            'name' => $faker->name,
            'nik' => $nik0,
            'level' => $faker->randomElement($array = array (1,2,3)),
            'dept_id' => $faker->randomElement($array = array (1, 2, 3, 4)),
            'remember_token' => Str::random(10),
            'created_at' => date('Y-m-d H:i:s')
          ]);
        }
    }

    public function createNIK() {
        $faker = Faker::create('id_ID');
        $rno = rand(700, 799);
        $rtgl = rand(1, 12);
        $rbln = rand(1, 12);
        $rthn = rand(1, 12);
        $randno = rand(1, 1000);
        $nik = "321" . "" . $rno . "" . $rtgl . "" . $rbln . "" . $rthn . "" . $randno;

        return $nik;
    }
}
