<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rols')->insert([
            'rol' => 'Administrador'
        ]);
        DB::table('rols')->insert([
            'rol' => 'Contador'
        ]);
        DB::table('rols')->insert([
            'rol' => 'Logistico'
        ]);
        DB::table('rols')->insert([
            'Rol' => 'Gerente'
        ]);
    }
}
