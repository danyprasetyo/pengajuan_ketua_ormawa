<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengajuan;

class KelolaPengajuanController extends Controller
{
    public function pending()
    {
        $data['pengajuans'] = Pengajuan::where('status_pengajuan', 2)
            ->orderBy('created_at')
            ->get();
        return view('admin.pengajuan.pending')->with($data);
    }
    public function diterima()
    {
        $data['pengajuans'] = Pengajuan::where('status_pengajuan', 1)
            ->orderBy('updated_at', 'desc')
            ->get();
        return view('admin.pengajuan.diterima')->with($data);
    }
    public function ditolak()
    {
        $data['pengajuans'] = Pengajuan::where('status_pengajuan', 0)
            ->orderBy('updated_at', 'desc')
            ->get();
        return view('admin.pengajuan.ditolak')->with($data);
    }
    public function show($id)
    {
        return Pengajuan::where('id', $id)->with('ormawa')->first();
    }
    public function konfirmasi(Request $request)
    {
        $id = $request->id;
        $pengajuan = Pengajuan::where('id', $id)->first();
        $status = $request->status_pengajuan;
        try {
            $pengajuan->where('id', $id)->update([
                'status_pengajuan' => $status,
                'keterangan' => $request->keterangan
            ]);
            return redirect()
            ->back()
            ->with(['alert-type' => 'success','message' => 'Aksi Berhasil Dilakukan']);
            
        } catch (\Throwable $th) {
            return redirect()
            ->back()
            ->withErrors($th->getMessage());
        }
    }
}
