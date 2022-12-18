<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\User;
use App\Models\Anggota as member;
use Faker\Factory as Faker;
use carbon;

class Anggota extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
 
    	// for($i = 1; $i <= 1000; $i++){
            $name = $faker->name;
            $email = str_replace(' ', '', $name).'@gmail.com';

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt('12345678')
            ]);
            $user->assignRole('anggota');

    		$anggota = member::create([
    			'nis_anggota' => $faker->numberBetween(10000000,99999999),
                'id_user' => $user->id,
    			'nama_anggota' => $name,
    			'alamat_anggota' => $faker->address,
    			'nomor_telepon_anggota' => $faker->phoneNumber,
                'email_anggota' => $email,
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now()
    		]);

            
    	// }
    }
}
