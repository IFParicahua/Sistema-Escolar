<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TablaAreasSeeder::class);
        $this->call(TablaGestionesSeeder::class);
        $this->call(TablaNivelesSeeder::class);
        $this->call(TablaPersonasSeeder::class);
        $this->call(TablaRolesSeeder::class);
        $this->call(TablaTipoCalificacionesSeeder::class);
        $this->call(TablaTurnosSeeder::class);
    }
}
