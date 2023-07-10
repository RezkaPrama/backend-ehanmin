<?php

namespace App\Exports;

use App\Models\TransUsulan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransUsulanExport implements FromCollection, WithHeadings
{
    protected $results;

    public function __construct($results)
    {
        $this->results = $results;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings(): array
    {
        return [
            'Id',
            'NIP/NRP',
            'Nama',
            'Tanggal Usulan',
            'Periode',
            'Tahun',
            'Instansi',
            'Jenis KP',
            'Pangkat',
            'Status',
            'Keterangan',
            'created_at',
            'updated_at'
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return TransUsulan::all();
        return $this->results;
    }
}
