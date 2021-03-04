<?php

namespace App\Imports;

use App\Models\Categoria;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;

class CategoriaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $categoria = Str::title(Str::lower($row[1]));
        $prev = Categoria::where('nombre',$categoria)->get();
        if($prev->isEmpty() && $row[1] != "")
        {
            return new Categoria([
                'nombre' => $categoria,
                'tag' => Str::slug(Str::lower($row[1])),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
