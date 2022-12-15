<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class DataBukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        //$book_faker = new Faker\Generator();
        //$book_faker->addProvider(new Faker\Provider\Book($book_faker));
        $kategori = ['Kelas 1', 'Kelas 2', 'Kelas 3', 'Kelas 4', 'Kelas 5', 'Kelas 6', 'Umum'];
        $topik = ['Matematika', 'Seni Budaya', 'IPA', 'IPS', 'PJOK', 'Bahasa Inggris', 'Bahasa Indonesia', 'Novel', 'Sains', 'Sejarah'];    
        
        for($i=11; $i <= 20; $i++){
            $stok = $faker->numberBetween(50,200);
            \DB::table('data_buku')->insert([
                'id_buku' => $i,
                'judul_buku' => $faker->text($maxNbChars = 50),
                'penerbit_buku' => $faker->company,
                'penulis_buku' => $faker->name,
                'kategori' => $kategori[array_rand($kategori)],
                'topik' => $topik[array_rand($topik)],
                'jumlah_stok' => $stok,
                'jumlah_tersedia' => $stok
            ]);
        }
        
    }
}
