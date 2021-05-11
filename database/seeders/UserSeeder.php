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
        //Admin
        DB::table('users')->insert([
            'name' => 'JuanPi',
            'email' => 'juan.alucard.02@gmail.com',
            'telefono' => 9983208924,
            'password' => Hash::make('Harimakenji01@'),
            'rol_id' => 5,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        //Cliente
        DB::table('users')->insert([
            'name' => 'Pedro',
            'email' => 'juan_alucard@hotmail.com',
            'telefono' => 9983208924,
            'password' => Hash::make('Harimakenji01@'),
            'rol_id' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        //Proveedor
        DB::table('users')->insert([
            'name' => 'Sofia',
            'email' => 'one_piece_i@hotmail.com',
            'telefono' => 9983208924,
            'password' => Hash::make('Harimakenji01@'),
            'rol_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
