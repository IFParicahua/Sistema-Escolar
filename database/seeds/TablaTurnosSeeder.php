<?php

use Illuminate\Database\Seeder;

class TablaTurnosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('turnos')->insert([
            'nombre'=>'tarde',
            'estado'=>'0'
        ]);
    }
}
