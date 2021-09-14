<?php

namespace Database\Seeders;

use App\Models\Docente;
use App\Models\User;
use Illuminate\Database\Seeder;

class DocenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(12)->create();

        foreach($users as $user ){
            $user->assignRole('Docente');
        }
        Docente::create([
            'nombre' => 'ARELLANO SALAZAR, CÉSAR',
            'status' => rand(0,3),
            'user_id' => 1
        ]);
        Docente::create([
            'nombre' => 'BOY CHAVIL, LUIS ENRRIQUE',
            'status' => rand(0,3),
            'user_id' => 2
        ]);
        Docente::create([
            'nombre' => 'CÓRDOVA OTERO, JUAN LUIS',
            'status' => rand(0,3),
            'user_id' => 3
        ]);
        Docente::create([
            'nombre' => 'GÓMEZ AVILA, JOSÉ ALBERTO',
            'status' => rand(0,3),
            'user_id' => 4
        ]);
        Docente::create([
            'nombre' => 'MENDOZA DE LOS SANTOS, ALBERTO CARLOS',
            'status' => rand(0,3),
            'user_id' => 5
        ]);
        Docente::create([
            'nombre' => 'MENDOZA RIVERA, RICARDO DARÍO',
            'status' => rand(0,3),
            'user_id' => 6
        ]);
        Docente::create([
            'nombre' => 'OBANDO ROLDÁN, JUAN CARLOSR',
            'status' => rand(0,3),
            'user_id' => 7
        ]);
        Docente::create([
            'nombre' => 'SÁNCHEZ TICONA, ROBERT JERRY',
            'status' => rand(0,3),
            'user_id' => 8
        ]);
        Docente::create([
            'nombre' => 'SANTOS FERNÁNDEZ, JUAN PEDRO',
            'status' => rand(0,3),
            'user_id' => 9
        ]);
        Docente::create([
            'nombre' => 'TENORIO CABRERA, JULIO LUIS',
            'status' => rand(0,3),
            'user_id' => 10
        ]);
        Docente::create([
            'nombre' => 'TORRES VILLANUEVA, MARCELINO',
            'status' => rand(0,3),
            'user_id' => 11
        ]);
        Docente::create([
            'nombre' => 'VIDAL MELGAREJO, ZORAIDA YANET',
            'status' => rand(0,3),
            'user_id' => 12
        ]);
    }
}
