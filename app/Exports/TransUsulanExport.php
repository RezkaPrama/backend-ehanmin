<?php

namespace App\Exports;

use App\Models\TransUsulan;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransUsulanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TransUsulan::all();
    }
}
