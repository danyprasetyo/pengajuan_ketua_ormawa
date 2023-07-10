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
            'sertifikat' => 'required|image|mimes:jpg,bmp,png',
            'video' => 'required',
            'program_studi' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'scan_ktm' => 'image|mimes:jpg,bmp,png',
            'suket_mhs_aktif' => 'image|mimes:jpg,bmp,png',
            'surat_kebersediaan' => 'image|mimes:jpg,bmp,png',
            'suket_rekomendasi' => 'image|mimes:jpg,bmp,png',
            'nilai_ipk' => 'image|mimes:jpg,bmp,png',
            'ormawa_id' => 'required'
        ]);
        $photo = $request->file('photo');
        $sertifikat = $request->file('sertifikat');
        $ktm = $request->file('scan_ktm');
        $suketMhs = $request->file('suket_mhs_aktif');
        $suratKebersediaan = $request->file('surat_kebersediaan');
        $suratRekomendasi = $request->file('suket_rekomendasi');
        $nilai = $request->file('nilai_ipk');
        $data = $request->all();
        try {
            if ($request->hasFile('photo')) {
                $extPhoto = $photo->extension();
                $photoFilename = 'photo_' . $request->nama_mahasiswa . '_' . time() . '.' . $extPhoto;
                $photo->storeAs('public/photo_mhs/', $photoFilename);
                $data['photo'] = $photoFilename;
            } else {
                $data['photo'] = null;
            }
            if ($request->hasFile('sertifikat')) {
                $extSertifikat = $sertifikat->extension();
                $sertifikatFilename = 'lampiran_' . $request->nama_mahasiswa . '_' . time() . '.' . $extSertifikat;
                $sertifikat->storeAs('public/sertifikat/', $sertifikatFilename);
                $data['sertifikat'] = $sertifikatFilename;
            } else {
                $data['sertifikat'] = null;
            }
            if ($request->hasFile('scan_ktm')) {
                $extKtm = $ktm->extension();
                $ktmFilename = 'lampiran_' . $request->nama_mahasiswa . '_' . time() . '.' . $extKtm;
                $ktm->storeAs('public/ktm/', $ktmFilename);
                $data['scan_ktm'] = $ktmFilename;
            } else {
                $data['scan_ktm'] = null;
            }
            if ($request->hasFile('suket_mhs_aktif')) {
                $extsuketMhs = $suketMhs->extension();
                $suketMhsFilename = 'lampiran_' . $request->nama_mahasiswa . '_' . time() . '.' . $extsuketMhs;
                $suketMhs->storeAs('public/suketMhs/', $suketMhsFilename);
                $data['suket_mhs_aktif'] = $suketMhsFilename;
            } else {
                $data['suket_mhs_aktif'] = null;
            }
            if ($request->hasFile('surat_kebersediaan')) {
                $extsuratKebersediaan = $suratKebersediaan->extension();
                $suratKebersediaanFilename = 'lampiran_' . $request->nama_mahasiswa . '_' . time() . '.' . $extsuratKebersediaan;
                $suratKebersediaan->storeAs('public/suratKebersediaan/', $suratKebersediaanFilename);
                $data['surat_kebersediaan'] = $suratKebersediaanFilename;
            } else {
                $data['surat_kebersediaan'] = null;
            }
            if ($request->hasFile('suket_rekomendasi')) {
                $extsuratRekomendasi = $suratRekomendasi->extension();
                $suratRekomendasiFilename = 'lampiran_' . $request->nama_mahasiswa . '_' . time() . '.' . $extsuratRekomendasi;
                $suratRekomendasi->storeAs('public/suratRekomendasi/', $suratRekomendasiFilename);
                $data['suket_rekomendasi'] = $suratRekomendasiFilename;
            } else {
                $data['suket_rekomendasi'] = null;
            }
            if ($request->hasFile('nilai_ipk')) {
                $extnilai = $nilai->extension();
                $nilaiFilename = 'lampiran_' . $request->nama_mahasiswa . '_' . time() . '.' . $extnilai;
                $nilai->storeAs('public/nilai/', $nilaiFilename);
                $data['nilai_ipk'] = $nilaiFilename;
            } else {
                $data['nilai_ipk'] = null;
            }

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
            'sertifikat' => 'image|mimes:jpg,bmp,png',
            'video' => 'required',
            'program_studi' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'scan_ktm' => 'image|mimes:jpg,bmp,png',
            'suket_mhs_aktif' => 'image|mimes:jpg,bmp,png',
            'surat_kebersediaan' => 'image|mimes:jpg,bmp,png',
            'suket_rekomendasi' => 'image|mimes:jpg,bmp,png',
            'nilai_ipk' => 'image|mimes:jpg,bmp,png',
            'ormawa_id' => 'required'
        ]);
        $photo = $request->file('photo');
        $sertifikat = $request->file('sertifikat');
        $ktm = $request->file('scan_ktm');
        $suketMhs = $request->file('suket_mhs_aktif');
        $suratKebersediaan = $request->file('surat_kebersediaan');
        $suratRekomendasi = $request->file('suket_rekomendasi');
        $nilai = $request->file('nilai_ipk');
        $pengajuan = Pengajuan::where('id', $id)->first();
        $data = $request->all();
        try {
            if ($request->hasFile('photo')) {
                Storage::delete('public/photo_mhs/' . $pengajuan->photo);
                $extPhoto = $photo->extension();
                $photoFilename = 'photo_' . $request->nama_mahasiswa . '_' . time() . '.' . $extPhoto;
                $photo->storeAs('public/photo_mhs/', $photoFilename);
                $data['photo'] = $photoFilename;
                Storage::delete('public/photo_mhs/'.$pengajuan->photo);
            } else {
                $data['photo'] = $pengajuan->photo;
            }
            if ($request->hasFile('sertifikat')) {

                Storage::delete('public/sertifikat/'.$pengajuan->sertifikat);
                $extSertifikat = $sertifikat->extension();
                $sertifikatFilename = 'lampiran_' . $request->nama_mahasiswa . '_' . time() . '.' . $extSertifikat;
                $sertifikat->storeAs('public/sertifikat/', $sertifikatFilename);

                $data['sertifikat'] = $sertifikatFilename;
                Storage::delete('public/sertifikat/'.$pengajuan->sertifikat);
            } else {
                $data['sertifikat'] = $pengajuan->sertifikat;
            }
            if ($request->hasFile('scan_ktm')) {
                Storage::delete('public/ktm/' . $pengajuan->scan_ktm);
                $extKtm = $ktm->extension();
                $ktmFilename = 'lampiran_' . $request->nama_mahasiswa . '_' . time() . '.' . $extKtm;
                $ktm->storeAs('public/ktm/', $ktmFilename);
                $data['scan_ktm'] = $ktmFilename;
            } else {
                $data['scan_ktm'] = $pengajuan->scan_ktm;
            }
            if ($request->hasFile('suket_mhs_aktif')) {
                Storage::delete('public/suketMhs/' . $pengajuan->suket_mhs_aktif);
                $extsuketMhs = $suketMhs->extension();
                $suketMhsFilename = 'lampiran_' . $request->nama_mahasiswa . '_' . time() . '.' . $extsuketMhs;
                $suketMhs->storeAs('public/suketMhs/', $suketMhsFilename);
                $data['suket_mhs_aktif'] = $suketMhsFilename;
            } else {
                $data['suket_mhs_aktif'] = $pengajuan->suket_mhs_aktif;
            }
            if ($request->hasFile('surat_kebersediaan')) {
                Storage::delete('public/suratKebersediaan/' . $pengajuan->surat_kebersediaan);
                $extsuratKebersediaan = $suratKebersediaan->extension();
                $suratKebersediaanFilename = 'lampiran_' . $request->nama_mahasiswa . '_' . time() . '.' . $extsuratKebersediaan;
                $suratKebersediaan->storeAs('public/suratKebersediaan/', $suratKebersediaanFilename);
                $data['surat_kebersediaan'] = $suratKebersediaanFilename;
            } else {
                $data['surat_kebersediaan'] = $pengajuan->surat_kebersediaan;
            }
            if ($request->hasFile('suket_rekomendasi')) {
                Storage::delete('public/suratRekomendasi/' . $pengajuan->suket_rekomendasi);
                $extsuratRekomendasi = $suratRekomendasi->extension();
                $suratRekomendasiFilename = 'lampiran_' . $request->nama_mahasiswa . '_' . time() . '.' . $extsuratRekomendasi;
                $suratRekomendasi->storeAs('public/suratRekomendasi/', $suratRekomendasiFilename);
                $data['suket_rekomendasi'] = $suratRekomendasiFilename;
            } else {
                $data['suket_rekomendasi'] = $pengajuan->suket_rekomendasi;
            }
            if ($request->hasFile('nilai_ipk')) {
                Storage::delete('public/nilai/' . $pengajuan->nilai_ipk);
                $extnilai = $nilai->extension();
                $nilaiFilename = 'lampiran_' . $request->nama_mahasiswa . '_' . time() . '.' . $extnilai;
                $nilai->storeAs('public/nilai/', $nilaiFilename);
                $data['nilai_ipk'] = $nilaiFilename;
            } else {
                $data['nilai_ipk'] = $pengajuan->nilai_ipk;
            }

            $pengajuan->update($data);
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withErrors('Aksi Gagal!');
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
