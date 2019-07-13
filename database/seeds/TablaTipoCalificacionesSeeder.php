<?php

use Illuminate\Database\Seeder;

class TablaTipoCalificacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_calificaciones')->insert([
            'nombre'=>'tipo1',
            'estado'=>'0'
        ]);
    }
}
