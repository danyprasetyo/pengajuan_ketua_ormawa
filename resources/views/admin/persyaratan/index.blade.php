@extends('layouts.dashboard.master')
@section('pageTitle')
    Kelola Persyaratan Pendaftaran
@stop
@section('pageName')
Kelola Persyaratan Pendaftaran
@stop
@section('pageLink')
    {{ route('dashboard.persyaratan.index') }}
@stop
@section('pageNow')
Persyaratan Pendaftaran
@stop
@section('content')
    <!-- Row -->
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <button type="button" onclick="clearInput('formPersyaratan','Tambah Persyaratan','dashboard/persyaratan')"
                        class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalPersyaratan">
                        Tambah
                    </button>
                    <a href="{{ url()->previous() }}" class="btn btn-primary">
                        Kembali
                    </a>
                </div>

                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTable">
                        <thead class="thead-light">
                            <th>No</th>
                            <th>Persyaratan</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($persyaratans as $no => $persyaratan)
                                <tr>
                                    <td>{{$no+1}}</td>
                                    <td>{{$persyaratan->persyaratan}}</td>
                                    <td>
                                        <form action="{{ route('dashboard.persyaratan.destroy', $persyaratan->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="button" onclick="formConfirmation(`Hapus persyaratan {{$persyaratan->persyaratan}}?`)"
                                                class="btn btn-sm btn-danger">Hapus</button>
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
    @include('admin.persyaratan.modal_persyaratan')
@stop
