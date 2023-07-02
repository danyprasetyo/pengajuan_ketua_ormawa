@extends('layouts.dashboard.master')
@section('pageTitle')
    Kelola Periode Pendaftaran
@stop
@section('pageName')
    Kelola Periode Pendaftaran
@stop
@section('pageLink')
    {{ route('dashboard.periode.index') }}
@stop
@section('pageNow')
    Periode Pendaftaran
@stop
@section('content')
    <!-- Row -->
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <button type="button" onclick="clearInput('formPeriode','Buat Periode','dashboard/periode')"
                        class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalPeriode">
                        Tambah
                    </button>
                    <a href="{{ url()->previous() }}" class="btn btn-primary">
                        Kembali
                    </a>
                </div>

                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTable">
                        <thead class="thead-light">
                            <th>Periode</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($periodes as $no => $periode)
                                <tr>
                                    <td>{{$periode->periode}}</td>
                                    <td>{!! $periode->status_pembukaan == 1
                                        ? '<p class="badge bg-success">Dibuka</p>'
                                        : '<p class="badge bg-danger">Ditutup</p>' !!}
                                    </td>
                                    <td>
                                        <form action="{{ route('dashboard.periode.update', $periode->id) }}" method="post">
                                            @method('patch')
                                            @csrf
                                            <a href="{{route('dashboard.periode.show', $periode->id)}}" class="btn btn-sm btn-info">Lihat</a>
                                            @if ($periode->status_pembukaan == 1)
                                                <input type="hidden" value="0" name="status_aktif">
                                                <button type="button" onclick="formConfirmation(`Tutup pendaftaran periode {{$periode->periode}}?`)"
                                                    class="btn btn-sm btn-danger">Tutup</button>
                                            @else
                                                <input type="hidden" value="1" name="status_aktif">
                                                <button type="button" onclick="formConfirmation(`Buka pendaftaran periode {{$periode->periode}}?`)"
                                                    class="btn btn-sm btn-success">Buka</button>
                                            @endif
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
    @include('admin.periode.modal_periode')
@stop
@push('js')
    <script>
        function editBuatAkun(idData, idModal) {
            $.ajax({
                type: "get",
                url: `{{ url('dashboard/buat_akun/${idData}/edit') }}`,
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                    $("#inputUsername").val(res.username);
                    $("#inputEmail").val(res.email);
                    $("#inputPassword").val(res.password);
                    $(`#labelModal`).text('Edit Akun');
                    $(`#btn-submit`).text('Update');
                    $('#update').append(
                        `@method('put')`
                    );
                    document.getElementById('formBuatAkun').action =
                        `{{ url('dashboard/buat_akun/${res.id}') }}`;
                    $(idModal).modal('show');
                }
            });
        }
    </script>
@endpush
