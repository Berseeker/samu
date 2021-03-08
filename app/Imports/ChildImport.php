<?php

namespace App\Imports;

use App\Models\Categoria;
use App\Models\Subcategoria;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Illuminate\Support\Str;

class ChildImport implements OnEachRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function onRow(Row $row)
    {

        $categoria = Categoria::where('nombre',Str::title(Str::lower($row[1])))->get();
        $subcategoria = Subcategoria::where('nombre',Str::title(Str::lower($row[2])))->get();
        $nombre = Str::title(Str::lower($row[3]));
        if($nombre != "")
        {
            Subcategoria::firstOrCreate([
                'nombre' => $nombre,
                'tag' => Str::slug(Str::lower($row[3])),
                'categoria_id' => $categoria[0]->id,
                'child' => ($subcategoria->isEmpty()) ? 0 : $subcategoria[0]->id,
            ]);
        }
        
    }
}
