<?php

namespace App\Imports;

use App\Paciente;
use Maatwebsite\Excel\Concerns\ToModel;

class PacientesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Paciente([
            'apellidos'=>$row[0],
            'nombres'=>$row[1],            
            'documento' => $row[7],
            'estado_id' => 1
        ]);
    }
}
