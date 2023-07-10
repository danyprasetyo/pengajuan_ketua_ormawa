<div class="modal fade text-left" id="modalPengajuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="labelModal">Formulir Pengajuan
                </h4>
                <button type="button" class="btn btn-outline-danger btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dashboard.pengajuan.store') }}" method="post" id="fromPengajuan"
                    enctype="multipart/form-data">
                    @csrf
                    <div id="update">

                    </div>
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <input type="hidden" name="periode_id" value="{{$periode->id}}">
                    <div class="form-floating mb-3">
                        <input class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" type="text"
                            placeholder="Nama Lengkap" />
                        <label for="inputUsername">Nama Lengkap</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="npm" name="npm" type="number" placeholder="NPM" />
                        <label for="inputEmail">NPM</label>
                    </div>
                    <div class="form-group mb-3">
                        <select name="program_studi" id="program_studi" class="form-control">
                            <option value="">--> Program Studi <-- </option>
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Teknik Sipil">Teknik Sipil</option>
                            <option value="Teknik Industri">Teknik Industri</option>
                        </select>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="semester" name="semester" type="number"
                            placeholder="Semester" />
                        <label for="inputPassword">Semester</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="no_hp" name="no_hp" type="number"
                            placeholder="No HP yang bisa dihubungi" />
                        <label for="inputPassword">NO HP</label>
                    </div>
                    <div class="form-group mb-3">
                        <label for="inputPassword">Alamat</label>
                       <textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat" cols="10" rows="3"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="inputPassword">Photo Profile</label>
                        <div id="pp"></div>
                        <input class="form-control" accept="image/*" id="photo" name="photo" type="file"
                            placeholder="Photo Profile" />
                        <span class="text-hint text-secondari">*3x4 background biru dengan kemeja biru.</span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="inputPassword">Lampiran berupa : Sertifikat, Photo KTM, Surat Pernyataan menjadi ketua, Scan Dokumen FHS IPK Min (2.80), Surat Rekomendasi oleh Ketua Prodi</label>
                        <div id="serti"></div>
                        <input class="form-control" id="inputPassword" name="sertifikat" type="file"
                            placeholder="Sertifikat" />
                        <span class="text-hint">*Lampiran disimpan dalam satu file pdf</span>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="video" name="video" type="text"
                            placeholder="Video Klarifikasi" />
                        <label for="inputPassword">Link Video Klarifikasi</label>
                        <span class="text-hint">*video diupload di youtube atau instagram</span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="inputPassword">Pengajuan Menjadi Ketua Ormawa</label>
                        <select name="ormawa_id" id="ormawa_id" class="form-control">
                            <option value="">--> Ormawa <-- </option>
                            @foreach ($ormawas as $ormawa)
                                <option value="{{$ormawa->id}}">{{$ormawa->nama_ormawa}}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <div id="button">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                    <button type="button" id="btn-submit" onclick="formConfirmation('Simpan Data Pengajuan?')"
                        class="btn btn-primary ms-1">
                        Simpan
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
