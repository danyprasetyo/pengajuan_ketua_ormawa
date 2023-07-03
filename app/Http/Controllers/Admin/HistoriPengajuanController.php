<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengajuan;

class HistoriPengajuanController extends Controller
{
    public function index()
    {
        $data['pengajuans'] = Pengajuan::orderBy('nama_mahasiswa', 'asc')
            ->get();
        return view('admin.histori_pengajuan.index')->with($data);
    }
}
