<?php

namespace Database\Seeders;

use App\Models\Pemeriksaan;
use App\Models\Progres;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pemeriksaan::create([
            'jenis_pemeriksaan' => 'Pemeriksaan Laporan Keuangan',
        ]);
        Pemeriksaan::create([
            'jenis_pemeriksaan' => 'Pemeriksaan Dengan Tujuan Tertentu',
        ]);
        Pemeriksaan::create([
            'jenis_pemeriksaan' => 'Pemeriksaan Kinerja',
        ]);
        Progres::create([
            'progres_pemeriksaan' => 'Penyusunan Rencana Kerja Pemeriksaan (RKP)',
            'tanggal' => '2024-12-12',
            'lampiran' => 'Lampiran',
            'keterangan' => 'Keterangan',
            'pemeriksaan_id' => '1',
            'user_id' => '2',
        ]);
        Progres::create([
            'progres_pemeriksaan' => 'Penyusunan Rencana Kerja Pemeriksaan (RKP)',
            'tanggal' => '2024-12-12',
            'lampiran' => 'Lampiran',
            'keterangan' => 'Keterangan',
            'pemeriksaan_id' => '2',
            'user_id' => '2',
        ]);
        Progres::create([
            'progres_pemeriksaan' => 'Penyusunan Rencana Kerja Pemeriksaan (RKP)',
            'tanggal' => '2024-12-12',
            'lampiran' => 'Lampiran',
            'keterangan' => 'Keterangan',
            'pemeriksaan_id' => '3',
            'user_id' => '2',
        ]);
    }
}
