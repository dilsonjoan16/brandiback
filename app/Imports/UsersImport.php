<?php

namespace App\Imports;

use App\Models\TipoCurso;
// use Maatwebsite\Excel\Concerns\ToCollection;
// use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class UsersImport implements ToModel /*ToCollection*/, WithHeadingRow, WithBatchInserts, WithChunkReading
{

    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
            return new TipoCurso([
                'id' => $row['id'],
                'modalidad_id' => $row['modalidad'],
                'nombre' => $row['nombre'],
                'estado' => $row['estado'],
                'UsuarioCreacion' => $row['usuario_creador'],
                'UsuarioModificacion' => $row['usuario_modificador'],
                'created_at' => $row['fecha_de_creacion'],
                'updated_at' => $row['fecha_de_modificacion']
            ]);
    }

    public function batchSize():int{
        return 5;
    }

    public function chunkSize():int{
        return 5;
    }
}
