@extends('layouts.dashboard.master')
@section('pageTitle')
    Data Pengajuan
@stop
@section('pageName')
    Pengajuan Diterima
@stop
@section('pageLink')
    {{ route('dashboard.pengajuan.diterima') }}
@stop
@section('pageNow')
    Diterima
@stop
@section('content')
    <!-- Row -->
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <a href="{{url()->previous()}}" class="btn btn-primary">
                        Kembali
                    </a >
                </div>

                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTable">
                        <thead class="thead-light">
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>NPM</th>
                            <th>Pengajuan Ormawa</th>
                            <TH>Status</TH>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($pengajuans as $no => $pengajuan)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $pengajuan->nama_mahasiswa }}</td>
                                    <td>{{ $pengajuan->npm }}</td>
                                    <td>{{ $pengajuan->ormawa->nama_ormawa }}</td>
                                    <td><span class="badge bg-success">Diterima</span></td>
                                    <td><form action="{{ route('dashboard.pengajuan.konfirmasi') }}"
                                        id="formPersetujuan" method="post">
                                        @method('patch')
                                        @csrf
                                        <input type="hidden" name="status_pengajuan" id="status_pengajuan">
                                        <input type="hidden" name="id" id="id">
                                        <input type="hidden" name="keterangan" id="keterangan">
                                        <button type="button"
                                                onclick="getDataPengajuan('{{ $pengajuan->id }}','#modalPengajuan')"
                                                class="btn btn-sm btn-info">Lihat</button>
                                        {{-- <button type="button" class="btn btn-sm btn-danger"
                                            onclick="tolak({{ $pengajuan->id }})">Tolak</button> --}}
                                    </form></td>
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
@include('admin.pengajuan.js')
