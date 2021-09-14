<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name'=>'Ver dashboard',]);
        Permission::create(['name'=>'Ver Docentes',]);
        Permission::create(['name'=>'Ver Alumnos',]);
        Permission::create(['name'=>'Ver Empresas',]);
        Permission::create(['name'=>'Ver Vouchers',]);
        Permission::create(['name'=>'Ver Solicitudes Practicas',]);
        Permission::create(['name'=>'Ver Practicas',]);        
        Permission::create(['name'=>'Ver Solicitudes Tesis',]);
        Permission::create(['name'=>'Ver Sustentaciones',]);
        Permission::create(['name'=>'Ver Tesis',]);
        Permission::create(['name'=>'Ver Estadisticas',]); 
        Permission::create(['name'=>'Ver Roles',]);   
    }
}
