<?php

namespace App\Jobs;

use DB;
use App\Models\User;
use App\Models\Anggota as member;
use Faker\Factory as Faker;
use carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class createAnggotaJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $faker = Faker::create('id_ID');
 
    	 for($i = 1; $i <= 1000; $i++){
            $name = $faker->unique()->name;
            $email = str_replace(' ', '', $name).'@gmail.com';

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt('12345678')
            ]);

            $user->assignRole('anggota');
            $user_id = User::where('email', '=', $email)->first();
    		$anggota = member::create([
    			'nis_anggota' => $faker->numberBetween(10000000,99999999),
                'id_user' => $user_id->id,
    			'nama_anggota' => $name,
    			'alamat_anggota' => $faker->address,
    			'nomor_telepon_anggota' => $faker->phoneNumber,
                'email_anggota' => $email,
                'tahun_ajaran' => intval(Carbon\Carbon::now()->format('Y')),
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now()
    		]);
        }
    }
}
