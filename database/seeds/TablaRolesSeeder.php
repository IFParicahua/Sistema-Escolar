<?php

use Illuminate\Database\Seeder;

class TablaRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'categoria_rol'=>'Profesor'
        ]);
    }
}