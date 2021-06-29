<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'nombre' => 'Proveedor',
            'tag' => 'proveedor',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('roles')->insert([
            'nombre' => 'Team Proveedor',
            'tag' => 'team_proveedor',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('roles')->insert([
            'nombre' => 'Cliente',
            'tag' => 'cliente',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        
        DB::table('roles')->insert([
            'nombre' => 'Monitor',
            'tag' => 'monitor',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('roles')->insert([
            'nombre' => 'Admin',
            'tag' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
