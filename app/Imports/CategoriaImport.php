<?php

namespace App\Imports;

use App\Models\Categoria;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Illuminate\Support\Str;

class CategoriaImport implements OnEachRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function onRow(Row $row)
    {
        $categoria = Str::title(Str::lower($row[1]));

        $group = Categoria::firstOrCreate([
            'nombre' => $categoria,
            'tag' => Str::slug(Str::lower($row[1])),
        ]);
    }
}
