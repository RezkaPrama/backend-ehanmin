<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransUsulanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            DB::table('trans_usulans')->insert([
                'nik' => '320231190000' . $i,
                'nama' => 'Fulan ' . $i ,
                'tanggal_usulan' => '2023-06-02',
                'periode' => '1 April (1-4)',
                'tahun' => '2023',
                'satuans_id' => 1,
                'jenis_kenaikan_id' => 1,
                'ke_pangkat' => 'Lettu',
                'status' => 'Selesai Input',
                'keterangan' => 'Sedang dalam Proses',
                'nama_dokumen' => 'Sample_' . $i . '.pdf'
            ]);
        }
    }
}
