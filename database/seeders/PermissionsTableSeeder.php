<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //permission for pendataan asset
        Permission::create(['name' => 'pendataan_aset.index']);
        Permission::create(['name' => 'pendataan_aset.create']);
        Permission::create(['name' => 'pendataan_aset.edit']);
        Permission::create(['name' => 'pendataan_aset.delete']);

        //permission for admin
        Permission::create(['name' => 'admin.index']);
        Permission::create(['name' => 'admin.create']);
        Permission::create(['name' => 'admin.edit']);
        Permission::create(['name' => 'admin.delete']);

        //permission for Pinjam Pakai
        Permission::create(['name' => 'pinjam_pakai.index']);
        Permission::create(['name' => 'pinjam_pakai.create']);
        Permission::create(['name' => 'pinjam_pakai.edit']);
        Permission::create(['name' => 'pinjam_pakai.delete']);

        //permission for Mutasi Asset
        Permission::create(['name' => 'mutasi_aset.index']);
        Permission::create(['name' => 'mutasi_aset.create']);
        Permission::create(['name' => 'mutasi_aset.edit']);
        Permission::create(['name' => 'mutasi_aset.delete']);

        //permission for Gallery Asset
        Permission::create(['name' => 'gallery_aset.index']);
        Permission::create(['name' => 'gallery_aset.create']);
        Permission::create(['name' => 'gallery_aset.edit']);
        Permission::create(['name' => 'gallery_aset.delete']);
   
        //permission for roles
        Permission::create(['name' => 'roles.index']);
        Permission::create(['name' => 'roles.create']);
        Permission::create(['name' => 'roles.edit']);
        Permission::create(['name' => 'roles.delete']);
        //permission for permissions
        Permission::create(['name' => 'permissions.index']);
        Permission::create(['name' => 'pimpinan.index']);

        
    }
}
