<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengajuan;
use PDF;

class KelolaPengajuanController extends Controller
{
    public function pending()
    {
        $data['pengajuans'] = Pengajuan::whereIn('status_pengajuan', [2,3])
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
        return Pengajuan::where('id', $id)
            ->with('ormawa')
            ->first();
    }
    public function konfirmasi(Request $request)
    {
        $id = $request->id;
        $pengajuan = Pengajuan::where('id', $id)->first();
        $status = $request->status_pengajuan;
        try {
            $pengajuan->where('id', $id)->update([
                'status_pengajuan' => $status,
                'keterangan' => $request->keterangan,
            ]);
            return redirect()
                ->back()
                ->with(['alert-type' => 'success', 'message' => 'Aksi Berhasil Dilakukan']);
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withErrors($th->getMessage());
        }
    }
    public function print(Request $request)
    {
        $id = $request->id;
        $data = Pengajuan::where('id', $id)->first();
        $pdf = PDF::loadview('admin.pengajuan.print', ['pengajuan' => $data]);
        // return $pdf->stream();
        return $pdf->download('formulir_'.$data->nama_mahasiswa.'.pdf');
    }
}
