<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Arturo Saldivar',
            'email' => 'damonbalam@gmail.com',
            'telefono' => 9831820506,
            'password' => Hash::make('pomada0405'),
            'rol_id' => 5,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('teams')->insert([
            'user_id' => 1,
            'name' => "Damon's Team",
            'personal_team' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
