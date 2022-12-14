<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'get all peminjaman']);
        Permission::create(['name' => 'show peminjaman']);
        Permission::create(['name' => 'add peminjaman']);
        Permission::create(['name' => 'add pengembalian']);
        Permission::create(['name' => 'add buku']);
        Permission::create(['name' => 'edit buku']);
        Permission::create(['name' => 'hapus buku']);
        Permission::create(['name' => 'get buku']);
        Permission::create(['name' => 'add anggota']);
        Permission::create(['name' => 'edit anggota']);
        Permission::create(['name' => 'hapus anggota']);
        Permission::create(['name' => 'get anggota']);
        Permission::create(['name' => 'get riwayat']);

        $admin = Role::create(['name'=>'admin']);
        $admin->givePermissionTo('get all peminjaman');
        $admin->givePermissionTo('show peminjaman');
        $admin->givePermissionTo('add peminjaman');
        $admin->givePermissionTo('add pengembalian');
        $admin->givePermissionTo('add buku');
        $admin->givePermissionTo('edit buku');
        $admin->givePermissionTo('hapus buku');
        $admin->givePermissionTo('get buku');
        $admin->givePermissionTo('add anggota');
        $admin->givePermissionTo('edit anggota');
        $admin->givePermissionTo('hapus anggota');
        $admin->givePermissionTo('get anggota');

        $anggota = Role::create(['name'=>'anggota']);
        $anggota->givePermissionTo('get riwayat');

        $user = User::factory()->create([
            'name' => 'Example Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($admin);
        
        $user = User::factory()->create([
            'name' => 'Example Anggota',
            'email' => 'anggota@mail.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($anggota);
    }
}
