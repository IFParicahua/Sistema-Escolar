<?php

use Illuminate\Database\Seeder;

class TablaGestionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gestiones')->insert([
            'fecha_inicial'=>'2019-02-01',
            'fecha_final'=>'2019-02-28',
            'nombre'=>'enero',
            'descripcion'=>'inicio de clases',
            'estado'=>'0'
        ]);
    }
}
