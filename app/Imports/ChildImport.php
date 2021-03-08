<?php

namespace App\Imports;

use App\Models\Categoria;
use App\Models\Subcategoria;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Str;

class ChildImport implements ToModel,WithBatchInserts,WithChunkReading
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

        $nombre = Str::title(Str::lower($row[3]));
        $prev = Subcategoria::where('nombre',$nombre)->get();

        $subcategoria = Subcategoria::where('nombre',Str::title(Str::lower($row[2])))->get();

        if($prev->isEmpty() && $row[3] != "")
        {
            return new Subcategoria([
                'nombre' => $nombre,
                'tag' => Str::slug(Str::lower($row[3])),
                'categoria_id' => $categoria[0]->id,
                'child' => ($subcategoria->isEmpty()) ? 0 : $subcategoria[0]->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
    public function batchSize(): int
    {
        return 20;
    }
    
    public function chunkSize(): int
    {
        return 20;
    }
}
