<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Periode;
use Exception;

class PeriodeController extends Controller
{
    public function index()
    {
        $data['periodes'] = Periode::all();
        return view('admin.periode.index')->with($data);
    }

    public function store(Request $request)
    {
        try {
            Periode::create($request->all());
            $notification = [
                'message' => 'Berhasil menambahkan periode',
                'alert-type' => 'success',
            ];
            return redirect()
                ->back()
                ->with($notification);
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withErrors('Gagal menambahkan periode')
                ->withInput();
        }
    }

    public function update(Request $request, String $id)
    {
        try {
            $status = $request->status_aktif;
            $periode = Periode::where('status_pembukaan', 1)->first();
            if($periode && $status == 1){
                throw new Exception("Tidak dapat membuka 2 periode pendaftaran sekaligus");
            }
            Periode::where('id', $id)->update([
                'status_pembukaan' => $status
            ]);
            $message = $status == 1 ? 'Berhasil menutup pendaftaran!' : 'Berhasil membuka pendaftaran';
            $notification = [
                'message' => $message,
                'alert-type' => 'success',
            ];
            return redirect()
                ->back()
                ->with($notification);
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    public function show(String $id)
    {
        try {
            Periode::create($request->all());
            $notification = [
                'message' => 'Berhasil menambahkan periode',
                'alert-type' => 'success',
            ];
            return redirect()
                ->back()
                ->with($notification);
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withErrors('Gagal menambahkan periode')
                ->withInput();
        }
    }
}
