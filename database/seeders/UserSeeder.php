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
            'name' => 'JuanPi',
            'email' => 'juan.alucard.02@gmail.com',
            'telefono' => 9983208924,
            'password' => Hash::make('Harimakenji01@'),
            'rol_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('teams')->insert([
            'user_id' => 1,
            'name' => "JuanPi's Team",
            'personal_team' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
