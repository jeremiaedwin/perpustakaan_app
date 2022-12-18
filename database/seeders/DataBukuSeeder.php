<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Haruncpi\LaravelIdGenerator\IdGenerator;

use app\Http\Controller\DataBukuController;
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
        $kategoriList = ['Kelas 1', 'Kelas 2', 'Kelas 3', 'Kelas 4', 'Kelas 5', 'Kelas 6', 'Umum'];
        $topikList = ['Matematika', 'Seni Budaya', 'IPA', 'IPS', 'PJOK', 'Bahasa Inggris', 'Bahasa Indonesia', 'Novel', 'Sains', 'Sejarah'];    
        
        for($i=0; $i <= 2000; $i++){
            
            $kategori = $kategoriList[array_rand($kategoriList)];
            $topik = $topikList[array_rand($topikList)];
            
            $id = IdGenerator::generate([
                'table' => 'data_buku', 
                'field'=> 'id_buku',
                'length' => 15, 
                'reset_on_prefix_change' => true,
                'prefix' => $this->prefixGenerator(array_search($kategori, $kategoriList), array_search($topik, $topikList)) . date('y') . '-'
            ]);

            $stok = $faker->numberBetween(50,200);

            \DB::table('data_buku')->insert([
                'id_buku' => $id,
                'judul_buku' => $faker->text($maxNbChars = 50),
                'penerbit_buku' => $faker->company,
                'penulis_buku' => $faker->name,
                'kategori' => $kategori,
                'topik' => $topik,
                'jumlah_stok' => $stok,
                'jumlah_tersedia' => $stok
            ]);
        }
        
    }

    public function prefixGenerator($category_id, $topic_id){
        
        $kategori_tag = ['01', '02', '03', '04', '05', '06', 'UM'];
        $topic_tag = ['MTK', 'SBD', 'IPA', 'IPS', 'OLG', 'ING', 'IND', 'NOV', 'SAI', 'SEJ'];

        $prefix = 'BK' . '-' . $kategori_tag[$category_id] . '-'. $topic_tag[$topic_id] . '-'; 

        return $prefix;
    }
}
