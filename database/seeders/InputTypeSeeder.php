<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InputTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('input_types')->insert([
            'nombre' => 'DropDown List',
            'tag' => 'dropdown_list',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('input_types')->insert([
            'nombre' => 'Radio Buttons',
            'tag' => 'radio_buttons',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('input_types')->insert([
            'nombre' => 'Size',
            'tag' => 'size',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('input_types')->insert([
            'nombre' => 'Checkboxes',
            'tag' => 'checkboxes',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('input_types')->insert([
            'nombre' => 'Text Field',
            'tag' => 'text_field',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('input_types')->insert([
            'nombre' => 'Text Area',
            'tag' => 'text_area',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('input_types')->insert([
            'nombre' => 'Date Picker',
            'tag' => 'date_picker',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('input_types')->insert([
            'nombre' => 'Upload Files',
            'tag' => 'upload_files',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
