@extends('layouts.dashboard.master')
@section('pageTitle')
    Pengajuan Ketua Ormawa
@endsection
@section('pageLink')
    Pengajuan
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <h3>Hello {{ Auth::user()->username }}</h3>
            <div class="card text-center">
                <div class="card-header">
                    Pengajuan Ketua Ormawa @if ($periode) Periode {{$periode->periode}} @endif  
                </div>
                <div class="card-body">
                    @if (!$periode)
                        <h5 class="card-title"><strong>Pendaftaran belum dibuka</strong></h5>
                    @else
                        @if (!$pengajuan)
                            <h5 class="card-title"><strong>Klik Tombol Dibawah Untuk Mengisi Form Pengajuan Menjadi Ketua
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
                        @else
                            <h4 class="card-text">Mohon maaf {{ $pengajuan->nama_mahasiswa }}</h4>
                            <h5 class="card-text text-danger"><strong>Pengajuan Kamu Tidak Dapat Kami Terima</strong></h5>
                            <br />
                            <h6 class="card-title"><strong>Alasan Penolakan</strong></h6>
                            <h6 class="card-text"><strong> {{ $pengajuan->keterangan }}</strong></h6>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('user.pengajuan.modal_pengajuan')
@stop
@push('js')
    <script>
        function getDataPengajuan(id_pengajuan, id_modal) {
            clearInput('fromPengajuan');
            $('#pp').empty();
            $('#serti').empty();
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
                    $("#serti").append(
                        `<iframe src="{{ url('storage/sertifikat_mhs/${res.sertifikat}') }}" class="mb-1" width="100%" height="500px"></iframe>`
                    )
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
