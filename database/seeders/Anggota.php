<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
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
 
    	for($i = 1; $i <= 1000; $i++){
 
    		DB::table('anggotas')->insert([
    			'nis_anggota' => $faker->numberBetween(10000000,99999999),
    			'nama_anggota' => $faker->name,
    			'alamat_anggota' => $faker->address,
    			'nomor_telepon_anggota' => $faker->phoneNumber,
                'email_anggota' => $faker->freeEmail,
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now()
    		]);
    	}
    }
}
