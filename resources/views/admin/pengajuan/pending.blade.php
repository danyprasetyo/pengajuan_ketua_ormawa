@extends('layouts.dashboard.master')
@section('pageTitle')
    Data Pengajuan
@stop
@section('pageName')
    Pengajuan Membutuhkan Konfirmasi
@stop
@section('pageLink')
    {{ route('dashboard.pengajuan.pending') }}
@stop
@section('pageNow')
    Konfirmasi
@stop
@section('content')
    <!-- Row -->
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <a href="{{ url()->previous() }}" class="btn btn-primary">
                        Kembali
                    </a>
                </div>

                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTable">
                        <thead class="thead-light">
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>NPM</th>
                            <th>Pengajuan Ormawa</th>
                            <TH>Aksi</TH>
                        </thead>
                        <tbody>
                            @foreach ($pengajuans as $no => $pengajuan)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $pengajuan->nama_mahasiswa }}</td>
                                    <td>{{ $pengajuan->npm }}</td>
                                    <td>{{ $pengajuan->ormawa->nama_ormawa }}</td>
                                    <td>
                                        <form action="{{ route('dashboard.pengajuan.konfirmasi') }}"
                                            id="formPersetujuan" method="post">
                                            @method('patch')
                                            @csrf
                                            <input type="hidden" name="status_pengajuan" id="status_pengajuan">
                                            <input type="hidden" name="id" id="id">
                                            <input type="hidden" name="keterangan" id="keterangan">
                                            <button type="button"
                                                onclick="getDataPengajuan('{{ $pengajuan->id }}','#modalPengajuan')"
                                                class="btn btn-sm btn-info">Lihat</button>
                                            <button type="button" class="btn btn-sm btn-success"
                                                onclick="persetujuan('{{ $pengajuan->id }}','#formPersetujuan','1','Setujui pengajuan?')">Setujui</button>
                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="tolak({{ $pengajuan->id }})">Tolak</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('admin.pengajuan.modal_pengajuan')
@stop
@push('js')
    <script>
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
                    $(`#nama_mahasiswa`).val(res.nama_mahasiswa);
                    $(`#npm`).val(res.npm);
                    $(`#angkatan`).val(res.angkatan);
                    $(`#semester`).val(res.semester);
                    $(`#video`).val(res.video);
                    $(`#program_studi option[value="${res.program_studi}"]`).attr("selected", "selected").attr(
                        'class', 'kapilih');
                    $(`#ormawa`).val(res.ormawa.nama_ormawa)
                    $("#pp").append(
                        `<img src="{{ url('storage/photo_mhs/${res.photo}') }}" class="img-fluid mb-1" width="40%" alt="" srcset="">`
                    );
                    $("#serti").append(
                        `<iframe src="{{ url('storage/sertifikat_mhs/${res.sertifikat}') }}" class="mb-1" width="80%" height="500px"></iframe>`
                    )
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

        function persetujuan(dataId, formId, persetujuan, message) {
            $('#status_pengajuan').val(persetujuan);
            $('#id').val(dataId);

            formConfirmationId(formId, message);
        }
    </script>
@endpush
