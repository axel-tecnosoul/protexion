<?php

namespace App\Exports;

use App\Origen;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrigensExport implements FromCollection
{
    public function collection()
    {
        return Origen::all();
    }
}