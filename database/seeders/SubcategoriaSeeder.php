<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subcategorias')->insert([
            'nombre' => 'Zapatillas deportivas',
            'tag' => 'zapatillas deportivas',
            'categoria_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('subcategorias')->insert([
            'nombre' => 'zapatos elegantes',
            'tag' => 'zapatos elegantes',
            'categoria_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
