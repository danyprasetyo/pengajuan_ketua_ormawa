@extends('layouts.dashboard.master')
@section('pageTitle')
    Data Akun
@stop
@section('pageName')
    Data Akun
@stop
@section('pageLink')
    {{route('dashboard.buat_akun.index')}}
@stop
@section('pageNow')
    Akun
@stop
@section('content')
    <!-- Row -->
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <button type="button" onclick="clearInput('formBuatAkun','Tambah Akun','dashboard/buat_akun')" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalBuatAkun">
                        Tambah
                    </button>
                    <a href="{{url()->previous()}}" class="btn btn-primary">
                        Kembali
                    </a >
                </div>

                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTable">
                        <thead class="thead-light">
                            <th>No</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($users as $no => $user)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        <form action="{{ route('dashboard.buat_akun.destroy', $user->id) }}"
                                            id="formDeleteUser" method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="{{ route('dashboard.buat_akun.show', $user->id) }}"
                                                class="btn btn-info">Lihat</a>
                                            <button type="button" class="btn btn-warning"
                                                onclick="editBuatAkun('{{ $user->id }}','#modalBuatAkun')">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-danger"
                                                onclick="formConfirmation('Hapus Data {{ $user->nama_user }}')">Hapus</button>
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
@include('admin.buat_akun.modal_buat_akun')
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
