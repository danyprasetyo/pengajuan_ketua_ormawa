<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use App\Models\Ormawa;
use Storage;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $data['pengajuan'] = Pengajuan::where('user_id', Auth::user()->id)->first();
        $data['ormawas'] = Ormawa::all();
        return view('user.pengajuan.index')->with($data);
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
            'nama_mahasiswa' => 'required',
            'npm' => 'required|numeric|unique:pengajuans,npm',
            'angkatan' => 'required|numeric',
            'semester' => 'required|numeric',
            'photo' => 'required|image|mimes:jpg,bmp,png',
            'sertifikat' => 'required|mimes:pdf',
            'video' => 'required',
            'program_studi' => 'required',
        ]);
        $photo = $request->photo;
        $sertifikat = $request->sertifikat;
        try {
            $extPhoto = $photo->extension();
            $photoFilename = 'photo_' . $request->nama_mahasiswa . '_' . Carbon::now() . '.' . $extPhoto;
            $photo->storeAs('public/photo_mhs/', $photoFilename);

            $extSertifikat = $sertifikat->extension();
            $sertifikatFilename = 'sertifikat_' . $request->nama_mahasiswa . '_' . Carbon::now() . '.' . $extSertifikat;
            $sertifikat->storeAs('public/sertifikat_mhs/', $sertifikatFilename);

            $data = $request->all();
            $data['sertifikat'] = $sertifikatFilename;
            $data['photo'] = $photoFilename;

            Pengajuan::create($data);
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withErrors($th->getMessage());
        }
        $notification = [
            'alert-type' => 'success',
            'message' => 'Pengajuan berhasil dibuat',
        ];
        return redirect()
            ->back()
            ->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengajuan $pengajuan)
    {
        return $pengajuan;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'nama_mahasiswa' => 'required',
            'npm' => 'required|numeric',
            'angkatan' => 'required|numeric',
            'semester' => 'required|numeric',
            'photo' => 'image|mimes:jpg,bmp,png',
            'sertifikat' => 'mimes:pdf',
            'video' => 'required',
            'program_studi' => 'required',
        ]);
        $photo = $request->photo;
        $sertifikat = $request->sertifikat;
        $pengajuan = Pengajuan::where('id', $id)->first();
        $data = $request->all();
        try {
            if ($request->hasFile('photo')) {
                Storage::delete('public/photo_mhs/'.$pengajuan->photo);
                $extPhoto = $photo->extension();
                $photoFilename = 'photo_' . $request->nama_mahasiswa . '_' . Carbon::now() . '.' . $extPhoto;
                $photo->storeAs('public/photo_mhs/', $photoFilename);
                $data['photo'] = $photoFilename;
            } else {
                $data['photo'] = $pengajuan->photo;
            }
            if ($request->hasFile('sertifikat')) {
                Storage::delete('public/sertifikat_mhs/'.$pengajuan->sertifikat);
                $extSertifikat = $sertifikat->extension();
                $sertifikatFilename = 'sertifikat_' . $request->nama_mahasiswa . '_' . Carbon::now() . '.' . $extSertifikat;
                $sertifikat->storeAs('public/sertifikat_mhs/', $sertifikatFilename);
                $data['sertifikat'] = $sertifikatFilename;
            } else {
                $data['sertifikat'] = $pengajuan->sertifikat;
            }

            $pengajuan->update($data);
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withErrors($th->getMessage());
        }
        $notification = [
            'alert-type' => 'success',
            'message' => 'Pengajuan berhasil diperbarui',
        ];
        return redirect()
            ->back()
            ->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // try {
        //     Pengajuan::where('id', $id)->delete();
        //     return redirect()
        //         ->back()
        //         ->with($this->notifikasi('success', 'Aksi Berhasil Dilakukan'));
        // } catch (\Throwable $th) {
        //     return redirect()
        //         ->back()
        //         ->with($this->notifikasi('error', $th->getMessage()));
        // }
    }
}