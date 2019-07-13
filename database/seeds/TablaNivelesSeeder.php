<?php

use Illuminate\Database\Seeder;

class TablaNivelesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('niveles')->insert([
            'nombre'=>'nivel1',
            'estado'=>'0'
        ]);
    }
}
