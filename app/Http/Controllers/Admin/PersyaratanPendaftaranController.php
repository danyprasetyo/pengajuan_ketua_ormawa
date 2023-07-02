<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PersyaratanPendaftaran;
use Illuminate\Http\Request;

class PersyaratanPendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['persyaratans'] = PersyaratanPendaftaran::all();
        return view('admin.persyaratan.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'persyaratan' => 'required'
        ]);
        try {
            PersyaratanPendaftaran::create($request->all());
            $notification = [
                'message' => 'Berhasil menambahkan persyaratan',
                'alert-type' => 'success',
            ];
            return redirect()
                ->back()
                ->with($notification);
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withErrors('Gagal menambahkan persyaratan')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PersyaratanPendaftaran $PersyaratanPendaftaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PersyaratanPendaftaran $PersyaratanPendaftaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PersyaratanPendaftaran $PersyaratanPendaftaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            PersyaratanPendaftaran::where('id',$id)->delete();
            $notification = [
                'message' => 'Berhasil menghapus persyaratan',
                'alert-type' => 'success',
            ];
            return redirect()
                ->back()
                ->with($notification);
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withErrors('Gagal menghapus persyaratan')
                ->withInput();
        }
    }
}
