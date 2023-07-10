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
                'id' => 1,
                'nama_ormawa' => 'Ethnic FT Unsur',
                'tipe_ormawa' => 'Unit Kegiatan Mahasiswa'
            ],
            [
                'id' => 2,
                'nama_ormawa' => 'Sinergi FT Unsur',
                'tipe_ormawa' => 'Unit Kegiatan Mahasiswa'
            ],
            [
                'id' => 3,
                'nama_ormawa' => 'Great FT Unsur',
                'tipe_ormawa' => 'Unit Kegiatan Mahasiswa'
            ],
            [
                'id' => 4,
                'tipe_ormawa' => 'Badan Teknik',
                'nama_ormawa' => 'Badan Eksekutif Mahasiswa'
            ],
            [
                'id' => 5,
                'tipe_ormawa' => 'Badan Teknik',
                'nama_ormawa' => 'Badan Legislatif Mahasiswa'
            ],
            [
                'id' => 6,
                'tipe_ormawa' => 'Himpunan Jurusan',
                'nama_ormawa' => 'Himpunan Mahasiswa Teknik Sipil'
            ],
            [
                'id' => 7,
                'tipe_ormawa' => 'Himpunan Jurusan',
                'nama_ormawa' => 'Himpunan Mahasiswa Teknik Industri'
            ],
            [
                'id' => 8,
                'tipe_ormawa' => 'Himpunan Jurusan',
                'nama_ormawa' => 'Himpunan Mahasiswa Teknik Informatika'
            ]   
        ];
        Ormawa::insert($datas);
    }
}
