<?php

namespace App\Imports;

use App\Models\Categoria;
use App\Models\Subcategoria;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;

class SubcategoriaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $categoria_string = Str::title(Str::lower($row[1]));
        $categoria = Categoria::where('nombre',$categoria_string)->get();

        $nombre = Str::title(Str::lower($row[2]));
        $prev = Subcategoria::where('nombre',$nombre)->get();

        if($prev->isEmpty() && $row[2] != "")
        {
            return new Subcategoria([
                'nombre' => $nombre,
                'tag' => Str::slug(Str::lower($row[2])),
                'categoria_id' => $categoria[0]->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
