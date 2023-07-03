<div class="modal fade text-left" id="modalPengajuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="labelModal">
                </h4>
                <button type="button" class="btn btn-outline-danger btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input class="form-control" disabled id="nama_mahasiswa" name="nama_mahasiswa" type="text"
                            placeholder="Nama Lengkap" />
                        <label for="inputUsername">Nama Lengkap</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" disabled id="npm" name="npm" type="number" placeholder="NPM" />
                        <label for="inputEmail">NPM</label>
                    </div>
                    <div class="form-group mb-3">
                        <select name="program_studi" disabled id="program_studi" class="form-control">
                            <option value="">--> Program Studi <-- </option>
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Teknik Sipil">Teknik Sipil</option>
                            <option value="Teknik Industri">Teknik Industri</option>
                        </select>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" disabled id="no_hp" name="no_hp" type="number"
                            placeholder="No HP yang bisa dihubungi" />
                        <label for="inputPassword">NO HP</label>
                    </div>
                    <div class="form-group mb-3">
                        <label for="inputPassword">Alamat</label>
                       <textarea name="alamat" disabled id="alamat" class="form-control" placeholder="Alamat" cols="10" rows="3"></textarea>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" disabled id="semester" name="semester" type="number"
                            placeholder="Semester" />
                        <label for="inputPassword">Semester</label>
                    </div>
                    <div class="form-group mb-3">
                        <label for="inputPassword">Photo Profile</label>
                        <div id="pp"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="inputPassword">Lampiran</label>
                        <div id="serti"></div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" disabled id="video" name="video" type="text"
                            placeholder="Video Klarifikasi" />
                        <label for="inputPassword">Link Video Klarifikasi</label>
                        <span class="text-hint">*video diupload di youtube atau instagram</span>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" disabled id="ormawa" name="ormawa" type="text"
                            placeholder="Angkatan" />
                        <label for="inputPassword">Ormawa Pilihan</label>
                    </div>
            </div>
            <div class="modal-footer">
                <div id="button">
                    <form action="{{ route('dashboard.pengajuan.print') }}" method="post">
                        @csrf
                        <input name="id" id="id_pengajuan" hidden>
                        <button type="submit" class="btn btn-info"><i class="fa fa-print" aria-hidden="true"></i> Cetak
                            PDF</button>
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Tutup</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
