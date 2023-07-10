@extends('layouts.dashboard.master')
@section('pageTitle')
    Pengajuan Ketua Ormawa
@endsection
@section('pageLink')
    Pengajuan
@endsection
@section('content')

    <div class="row">
        @if (Auth::user()->status_pendaftaran == 1)
            <h3>Hello {{ Auth::user()->username }}</h3>

            <div class="col-xl-6 col-sm-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5>Persyaratan Pendaftaran Menjadi Calon Ketua Ormawa di Fakultas Teknik Universitas Suryakancana
                        </h5>
                        <hr />
                        <ul class="list-group list-group-flush">
                            @forelse ($persyaratans as $no => $persyaratan)
                                <li class="list-group-item">{{ $no + 1 }}. {{ $persyaratan->persyaratan }}</li>
                        </ul>
                    @empty
                        <h6>Belum ada persyaratan</h6>
        @endforelse
    </div>
    </div>

    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card text-center">
            <div class="card-header">
                Pengajuan Ketua Ormawa @if ($periode)
                    Periode
                    {{ $periode->periode }}
                @endif
            </div>
            <div class="card-body">
                @if (!$periode)

                    <h5 class="card-title"><strong>Pendaftaran belum dibuka</strong></h5>
                @else
                    @if (!$pengajuan)
                        <h5 class="card-title"><strong>Klik Tombol Dibawah Untuk Mengisi Formulir Pengajuan Menjadi Ketua
                                Ormawa</strong></h5>
                        <br />
                        <button type="button" data-bs-toggle="modal" data-bs-target="#modalPengajuan"
                            class="btn btn-primary">Isi Formulir Pengajuan</button>
                    @elseif($pengajuan->status_pengajuan == 2)
                        <h5 class="card-title"><strong>Pengajuan Berhasil Dibuat</strong></h5>
                        <h6 class="card-text">Formulir Kamu Sedang Ditinjau Oleh Panitia Pansus</h6>
                        <br />
                        <button type="button" onclick="getDataPengajuan('{{ $pengajuan->id }}','#modalPengajuan')"
                            class="btn btn-info">Lihat Formulir Pengajuan</button>
                    @elseif($pengajuan->status_pengajuan == 1)
                        <h4 class="card-text">Selamat {{ $pengajuan->nama_mahasiswa }}</h4>
                        <h5 class="card-text text-success"><strong>Pengajuan Berhasil Diterima</strong></h5>
                        <h6 class="card-text">Panitia Pansus Akan Menghubungi Kamu Dalam 3x4 Hari Kerja</h6>
                    @elseif($pengajuan->status_pengajuan == 3)
                        <h4 class="card-text">Halo!! {{ $pengajuan->nama_mahasiswa }}</h4>
                        <h5 class="card-text text-warning"><strong>Mohon periksa kembali pengajuan anda!</strong>
                        </h5>
                        <br />
                        <h6 class="card-title"><strong>Alasan</strong></h6>
                        <h6 class="card-text"><strong> {{ $pengajuan->keterangan }}</strong></h6>
                        <button type="button" onclick="getDataPengajuan('{{ $pengajuan->id }}','#modalPengajuan')"
                            class="btn btn-info">Lihat Formulir Pengajuan</button>

                        @endif
                    @endif
            </div>

        </div>
    </div>
@else
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                Pengajuan Ketua Ormawa @if ($periode)
                    Periode
                    {{ $periode->periode }}
                @endif
            </div>
            <div class="card-body">
                <h5>Persyaratan Pendaftaran Menjadi Calon Ketua Ormawa di Fakultas Teknik Universitas Suryakancana
                </h5>
                <hr />
                <ul class="list-group list-group-flush">
                    @forelse ($persyaratans as $no => $persyaratan)
                    <li class="list-group-item">{{ $no + 1 }}. {{ $persyaratan->persyaratan }}</li>
                </ul>
            @empty
                <h6>Belum ada persyaratan</h6>
                @endforelse
            </div>
            <div class="card-footer">
                <form action="{{ route('dashboard.persyaratan.setuju') }}" method="post" id="formSyarat">
                    @csrf
                    @method('patch')
                    <div class="form-check">
                        <label class="form-check-label" for="inputRememberPassword">Saya menyetujui & memenuhi semua
                            persyaratan diatas.</label>
                        <input class="form-check-input" id="inputRememberPassword" name="syarat" type="checkbox"
                            value="1" />
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button"
                            onclick="formConfirmation('Kamu menyetujui & memenuhi semua persyaratan diatas.')"
                            class="btn btn-sm btn-primary">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    </div>
    @if ($periode)
        @include('user.pengajuan.modal_pengajuan')
    @endif
@stop
@push('js')
    <script>
        let ukm = `<div class="form-group mb-3">
                        <label for="sertifikat">Sertifikat Keorganisasian</label>
                        <div id="sertifikat_organisasi"></div>
                        <input class="form-control" id="sertifikat" name="sertifikat" type="file"
                            placeholder="Sertifikat Keorganisasian" />
                        <span class="text-hint">*Lampiran disimpan dalam format gambar</span>
                    </div>`;
        let nonUkm = `<div class="form-group mb-3">
                                        <label for="sertifikat">Sertifikat Keorganisasian</label>
                                        <div id="sertifikat_organisasi"></div>
                                        <input class="form-control" id="sertifikat" name="sertifikat" type="file"
                                            placeholder="Sertifikat Keorganisasian" />
                                        <span class="text-hint">*Lampiran disimpan dalam format gambar</span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div id="ktm_gambar"></div>
                                        <label for="scan_ktm">Scan KTM</label>
                                        <input class="form-control" id="scan_ktm" name="scan_ktm" type="file"
                                            placeholder="Scan KTM" />
                                        <span class="text-hint">*Lampiran disimpan dalam format gambar</span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="suket_mhs_aktif">Surat Keterangan Mahasiswa Aktif Semester 4</label>
                                        <div id="suket_mhs_aktif_gambar"></div>
                                        <input class="form-control" id="suket_mhs_aktif" name="suket_mhs_aktif" type="file"
                                            placeholder="Sertifikat" />
                                        <span class="text-hint">*Lampiran disimpan dalam format gambar</span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="surat_kebersediaan">Surat Pernyataan Kebersediaan Menjadi Ketua</label>
                                        <div id="suket_kebersediaan_gambar"></div>
                                        <input class="form-control" id="surat_kebersediaan" name="surat_kebersediaan" type="file"
                                            placeholder="Sertifikat" />
                                        <span class="text-hint">*Lampiran disimpan dalam format gambar</span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nilai_ipk">Lampiran Nilai IPK. Minimal 2.8</label>
                                        <div id="nilai_ipk_gambar"></div>
                                        <input class="form-control" id="nilai_ipk" name="nilai_ipk" type="file"
                                            placeholder="Sertifikat" />
                                        <span class="text-hint">*Lampiran disimpan dalam format gambar</span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="suket_rekomendasi">Surat Rekomendasi Dari Program Studi</label>
                                        <div id="suket_rekomendasi_gambar"></div>
                                        <input class="form-control" id="suket_rekomendasi" name="suket_rekomendasi" type="file"
                                            placeholder="Sertifikat" />
                                        <span class="text-hint">*Lampiran disimpan dalam format gambar</span>
                                    </div>
                                    `;

        function ganti() {
            let ormawa = $('#ormawa_id').val();
            cekOrmawa(ormawa);
        }

        function cekOrmawa(ormawa) {
            $("#data_sertifikat").empty();
            let sertifikat = document.getElementById("data_sertifikat");
            if (ormawa == 1 || ormawa == 2 || ormawa == 3) {
                sertifikat.innerHTML = ukm;
            } else if (ormawa === "") {
                sertifikat.innerHTML = '';
            } else {
                sertifikat.innerHTML = nonUkm;
            }
            return sertifikat;
        }




        function getDataPengajuan(id_pengajuan, id_modal) {
            clearInput('fromPengajuan');
            $('#pp').empty();
            $("#data_sertifikat").empty();
            $('#update').empty();
            let id = id_pengajuan;
            $.ajax({
                type: "get",
                url: `{{ url('dashboard/pengajuan/${id}/edit') }}`,
                dataType: 'json',
                success: function(res) {
                    $(`#nama_mahasiswa`).val(res.nama_mahasiswa);
                    $(`#npm`).val(res.npm);
                    $(`#angkatan`).val(res.angkatan);
                    $(`#semester`).val(res.semester);
                    $(`#no_hp`).val(res.no_hp);
                    $(`#alamat`).val(res.alamat);
                    $(`#video`).val(res.video);
                    $(`#program_studi option[value="${res.program_studi}"]`).attr("selected", "selected").attr(
                        'class', 'kapilih');
                    $(`#ormawa_id option[value="${res.ormawa_id}"]`).attr("selected", "selected").attr(
                        'class', 'kapilih');
                    $("#pp").append(
                        `<img src="{{ url('storage/photo_mhs/${res.photo}') }}" class="img-fluid mb-1" alt="" srcset="">`
                    );
                    cekOrmawa(res.ormawa_id);
                    $("#sertifikat_organisasi").append(
                        `<img src="{{ url('storage/sertifikat/${res.sertifikat}') }}" class="img-fluid mb-1" width="100%">`
                    );
                    $("#ktm_gambar").append(
                        `<img src="{{ url('storage/ktm/${res.scan_ktm}') }}" class="img-fluid mb-1" width="100%">`
                    );
                    $("#suket_mhs_aktif_gambar").append(
                        `<img src="{{ url('storage/suketMhs/${res.suket_mhs_aktif}') }}" class="img-fluid mb-1" width="100%">`
                    );
                    $("#suket_kebersediaan_gambar").append(
                        `<img src="{{ url('storage/suratKebersediaan/${res.surat_kebersediaan}') }}" class="img-fluid mb-1" width="100%">`
                    );
                    $("#nilai_ipk_gambar").append(
                        `<img src="{{ url('storage/nilai/${res.nilai_ipk}') }}" class="img-fluid mb-1" width="100%">`
                    );
                    $("#suket_rekomendasi_gambar").append(
                        `<img src="{{ url('storage/suratRekomendasi/${res.suket_rekomendasi}') }}" class="img-fluid mb-1" width="100%">`
                    );
                    $(`#labelModal`).text('Edit Pengajuan');
                    $(`#btn-submit`).text('Update');
                    $('#update').append(
                        `@method('put')`
                    );
                    document.getElementById('fromPengajuan').action =
                        `{{ url('dashboard/pengajuan/${res.id}') }}`;
                    $(id_modal).modal('show');
                }
            });
        }
    </script>
@endpush
