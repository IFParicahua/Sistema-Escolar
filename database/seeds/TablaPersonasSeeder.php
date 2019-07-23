<?php

use Illuminate\Database\Seeder;

class TablaPersonasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('personas')->insert([
            [
                'nombre'=>'Carlos',
                'apellidopat'=>'Perez',
                'apellidomat'=>'Mendoza',
                'direccion'=>'Radial 27 esq. Calle San Lorenzo, 580',
                'ci'=>'8675889',
                'telefono'=>'78876553',
                'sexo'=>'M'
            ],[
                'nombre'=>'Marta',
                'apellidopat'=>'Soliz',
                'apellidomat'=>'Mendoza',
                'direccion'=>'Radial 27 esq. Calle San Lorenzo, 580',
                'ci'=>'8675889',
                'telefono'=>'78876553',
                'sexo'=>'F'
            ],[
                'nombre'=>'Pablo',
                'apellidopat'=>'Perez',
                'apellidomat'=>'Mendoza',
                'direccion'=>'Radial 27 esq. Calle San Lorenzo, 580',
                'ci'=>'8675889',
                'telefono'=>'78876553',
                'sexo'=>'M'
            ],[
                'nombre'=>'Fernanda',
                'apellidopat'=>'Perez',
                'apellidomat'=>'Mendoza',
                'direccion'=>'Radial 27 esq. Calle San Lorenzo, 580',
                'ci'=>'8675889',
                'telefono'=>'78876553',
                'sexo'=>'F'
            ],[
                'nombre'=>'Jose',
                'apellidopat'=>'Perez',
                'apellidomat'=>'Mendoza',
                'direccion'=>'Radial 27 esq. Calle San Lorenzo, 580',
                'ci'=>'8675889',
                'telefono'=>'78876553',
                'sexo'=>'M'
            ],[
                'nombre'=>'Martina',
                'apellidopat'=>'Perez',
                'apellidomat'=>'Mendoza',
                'direccion'=>'Radial 27 esq. Calle San Lorenzo, 580',
                'ci'=>'8675889',
                'telefono'=>'78876553',
                'sexo'=>'F'
            ]
        ]);
    }
}
