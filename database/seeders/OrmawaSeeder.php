<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ormawa;

class OrmawaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
            'nama_ormawa' => 'Ethnic FT Unsur',
            'tipe_ormawa' => 'Unit Kegiatan Mahasiswa'
            ],
            [
                'nama_ormawa' => 'Sinergi FT Unsur',
                'tipe_ormawa' => 'Unit Kegiatan Mahasiswa'
            ],
            [
                'nama_ormawa' => 'Great FT Unsur',
                'tipe_ormawa' => 'Unit Kegiatan Mahasiswa'
            ],
            [
                'tipe_ormawa' => 'Badan Teknik',
                'nama_ormawa' => 'Badan Eksekutif Mahasiswa'
            ],
            [
                'tipe_ormawa' => 'Badan Teknik',
                'nama_ormawa' => 'Badan Legislatif Mahasiswa'
            ],
            [
                'tipe_ormawa' => 'Himpunan Jurusan',
                'nama_ormawa' => 'Himpunan Mahasiswa Teknik Sipil'
            ],
            [
                'tipe_ormawa' => 'Himpunan Jurusan',
                'nama_ormawa' => 'Himpunan Mahasiswa Teknik Industri'
            ],
            [
                'tipe_ormawa' => 'Himpunan Jurusan',
                'nama_ormawa' => 'Himpunan Mahasiswa Teknik Informatika'
            ]   
        ];
        Ormawa::insert($datas);
    }
}
