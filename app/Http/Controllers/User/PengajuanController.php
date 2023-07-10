<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use App\Models\Ormawa;
use Storage;
use App\Models\Periode;
use App\Models\PersyaratanPendaftaran;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $data['pengajuan'] = Pengajuan::where('user_id', Auth::user()->id)->first();
        $data['periode'] = Periode::where('status_pembukaan', 1)->first();
        $data['ormawas'] = Ormawa::all();
        $data['persyaratans'] = PersyaratanPendaftaran::all();
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
            'semester' => 'required|numeric',
            'photo' => 'required|image|mimes:jpg,bmp,png',
            'sertifikat' => 'required|mimes:pdf',
            'video' => 'required',
            'program_studi' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);
        $photo = $request->file('photo');
        $sertifikat = $request->file('sertifikat');
        try {
            $extPhoto = $photo->extension();
            $photoFilename = 'photo_' . $request->nama_mahasiswa . '_' . time() . '.' . $extPhoto;
            $photo->storeAs('public/photo_mhs/', $photoFilename);

            $extSertifikat = $sertifikat->extension();
            $sertifikatFilename = 'lampiran_' . $request->nama_mahasiswa . '_' . time() . '.' . $extSertifikat;
            $sertifikat->storeAs('public/lampiran_mhs/', $sertifikatFilename);

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
            'semester' => 'required|numeric',
            'photo' => 'image|mimes:jpg,bmp,png',
            'sertifikat' => 'mimes:pdf',
            'video' => 'required',
            'program_studi' => 'required',
        ]);
        $photo = $request->file('photo');
        $sertifikat = $request->file('sertifikat');
        $pengajuan = Pengajuan::where('id', $id)->first();
        $data = $request->all();
        try {
            if ($request->hasFile('photo')) {
                $extPhoto = $photo->extension();
                $photoFilename = 'photo_' . $request->nama_mahasiswa . '_' . time() . '.' . $extPhoto;
                $photo->storeAs('public/photo_mhs/', $photoFilename);
                $data['photo'] = $photoFilename;
                Storage::delete('public/photo_mhs/'.$pengajuan->photo);
            } else {
                $data['photo'] = $pengajuan->photo;
            }
            if ($request->hasFile('sertifikat')) {
                Storage::delete('public/lampiran_mhs/'.$pengajuan->sertifikat);
                $extSertifikat = $sertifikat->extension();
                $sertifikatFilename = 'lampiran_' . $request->nama_mahasiswa . '_' . time() . '.' . $extSertifikat;
                $sertifikat->storeAs('public/lampiran_mhs/', $sertifikatFilename);
                $data['sertifikat'] = $sertifikatFilename;
                Storage::delete('public/lampiran_mhs/'.$pengajuan->sertifikat);
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
