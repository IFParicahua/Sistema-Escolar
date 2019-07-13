<?php

use Illuminate\Database\Seeder;

class TablaAreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            'nombre'=>'lenguas',
            'estado'=>'0'
        ]);
    }
}
