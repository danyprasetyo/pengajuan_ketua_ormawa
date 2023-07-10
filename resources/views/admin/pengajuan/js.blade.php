@push('js')
    <script>
                let ukm = `<div class="form-group mb-3">
                        <label for="sertifikat">Sertifikat Keorganisasian</label>
                        <div id="sertifikat_organisasi"></div>
                    </div>`;
        let nonUkm = `<div class="form-group mb-3">
                                        <label for="sertifikat">Sertifikat Keorganisasian</label>
                                        <div id="sertifikat_organisasi"></div>
                                        
                                    </div>
                                    <div class="form-group mb-3">
                                        <div id="ktm_img"></div>
                                        <label for="scan_ktm">Scan KTM</label>
                                       
                                        
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="suket_mhs_aktif">Surat Keterangan Mahasiswa Aktif Semester 4</label>
                                        <div id="suket_mhs_aktif_img"></div>
                                        
                                        
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="surat_kebersediaan">Surat Pernyataan Kebersediaan Menjadi Ketua</label>
                                        <div id="suket_kebersediaan_img"></div>
                                        
                                        
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nilai_ipk">Lampiran Nilai IPK. Minimal 2.8</label>
                                        <div id="nilai_ipk_img"></div>
                                        
                                        
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="suket_rekomendasi">Surat Rekomendasi Dari Program Studi</label>
                                        <div id="suket_rekomendasi_img"></div>
                                       
                                        
                                    </div>
                                    `;
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
            $('#pp').empty();
            $('#serti').empty();
            $('#ormawa').empty();
            let id = id_pengajuan;
            $.ajax({
                type: "get",
                url: `{{ url('dashboard/pengajuan/${id}') }}`,
                dataType: 'json',
                success: function(res) {
                    $('#id_pengajuan').val(id);
                    $(`#nama_mahasiswa`).val(res.nama_mahasiswa);
                    $(`#npm`).val(res.npm);
                    $(`#no_hp`).val(res.no_hp);
                    $(`#alamat`).val(res.alamat);
                    $(`#semester`).val(res.semester);
                    $(`#video`).val(res.video);
                    $(`#program_studi option[value="${res.program_studi}"]`).attr("selected", "selected").attr(
                        'class', 'kapilih');
                    $(`#ormawa_id`).val(res.ormawa.nama_ormawa)
                    $("#pp").append(
                        `<img src="{{ url('storage/photo_mhs/${res.photo}') }}" class="img-fluid mb-1" width="60%" alt="" srcset="">`
                    );
                    cekOrmawa(res.ormawa_id);
                    $("#sertifikat_organisasi").append(
                        `<img src="{{ url('storage/sertifikat/${res.sertifikat}') }}" class="img-fluid mb-1" width="100%">`
                    );
                    $("#ktm_img").append(
                        `<img src="{{ url('storage/ktm/${res.scan_ktm}') }}" class="img-fluid mb-1" width="100%">`
                    );
                    $("#suket_mhs_aktif_img").append(
                        `<img src="{{ url('storage/suketMhs/${res.suket_mhs_aktif}') }}" class="img-fluid mb-1" width="100%">`
                    );
                    $("#suket_kebersediaan_img").append(
                        `<img src="{{ url('storage/suratKebersediaan/${res.surat_kebersediaan}') }}" class="img-fluid mb-1" width="100%">`
                    );
                    $("#nilai_ipk_img").append(
                        `<img src="{{ url('storage/nilai/${res.nilai_ipk}') }}" class="img-fluid mb-1" width="100%">`
                    );
                    $("#suket_rekomendasi_img").append(
                        `<img src="{{ url('storage/suratRekomendasi/${res.suket_rekomendasi}') }}" class="img-fluid mb-1" width="100%">`
                    );
                    $(`#labelModal`).text(`Formulir Pengajuan ${res.nama_mahasiswa}`);
                    $(id_modal).modal('show');
                },
                error: function(err) {
                    alert(err);
                }
            });
        }
        async function tolak(idData) {
            const {
                value: text
            } = await Swal.fire({
                input: 'textarea',
                inputLabel: 'Pesan Penolakan',
                inputPlaceholder: 'Alasan Penolakan',
                inputAttributes: {
                    'aria-label': 'Type your message here'
                },
                showCancelButton: true
            })
            if (text) {
                $("#keterangan").val(text);
                persetujuan(idData, '#formPersetujuan', '0', 'Tolak Pengajuan Ini?')
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Alasan Penolakan Tidak Boleh Kosong!',
                })
            }
        }
        async function perbarui(idData) {
            const {
                value: text
            } = await Swal.fire({
                input: 'textarea',
                inputLabel: 'Pesan Perbarui',
                inputPlaceholder: 'Alasan Perbarui',
                inputAttributes: {
                    'aria-label': 'Type your message here'
                },
                showCancelButton: true
            })
            if (text) {
                $("#keterangan").val(text);
                persetujuan(idData, '#formPersetujuan', '3', 'Anda Yakin?')
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Deskripsi Tidak Boleh Kosong!',
                })
            }
        }

        function persetujuan(dataId, formId, persetujuan, message) {
            $('#status_pengajuan').val(persetujuan);
            $('#id').val(dataId);

            formConfirmationId(formId, message);
        }
    </script>
@endpush