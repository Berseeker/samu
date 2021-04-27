<?php

namespace App\Imports;

use App\Models\Subcate_hijos;
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
        $subcategoria = Subcategoria::where('nombre',Str::title(Str::lower($row[2])))->get();
        $nombre = Str::title(Str::lower($row[3]));

        if($nombre != "")
        {
            Subcate_hijos::firstOrCreate([
                'nombre' => $nombre,
                'tag' => Str::slug(Str::lower($row[3])),
                'subcategoria_id' => $subcategoria[0]->id,
            ]);
        }
        
    }
}
