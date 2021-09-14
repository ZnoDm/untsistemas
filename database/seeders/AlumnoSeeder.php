<?php

namespace Database\Seeders;

use App\Models\Alumno;
use App\Models\User;
use Illuminate\Database\Seeder;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'id' => 13,
            'name' => 'Administrador',
            'email' => 'administrador@hotmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRole('Admin');
        Alumno::create([
            'codigo' => 1023300119,
            'user_id' =>$user->id,
            'nombre' => $user->name,
            'apellido' => 'Secretaria',
            'email' => $user->email,
            'fecha_nacimiento'=>'1999-09-09',
            'telefono' => '923983014'
        ]);
        
        $users = User::factory(29)->create();

        foreach($users as $user ){
            Alumno::factory(1)->create(['user_id' =>$user->id,'nombre' => $user->name,'email' => $user->email]);
            $user->assignRole('Alumno');
        }
        
    }
}
