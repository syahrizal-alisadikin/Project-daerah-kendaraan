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
        Permission::create(['name' => 'pendataan_aset']);
       

        //permission for admin
        Permission::create(['name' => 'admin']);
        

        //permission for Pinjam Pakai
        Permission::create(['name' => 'pinjam_pakai']);
       

        //permission for Mutasi Asset
        Permission::create(['name' => 'mutasi_aset']);
      

        //permission for Gallery Asset
        Permission::create(['name' => 'gallery_aset']);
        
   
        //permission for roles
        Permission::create(['name' => 'roles']);
       
        //permission for permissions
        Permission::create(['name' => 'permissions']);
        Permission::create(['name' => 'pimpinan']);

        
    }
}
