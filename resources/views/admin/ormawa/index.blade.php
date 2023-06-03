@extends('layouts.dashboard.master')
@section('pageTitle')
    Data Ormawa
@stop
@section('pageName')
    Data Ormawa
@stop
@section('pageLink')
    {{route('dashboard.ormawa.index')}}
@stop
@section('pageNow')
    Ormawa
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
                            <th>Nama Ormawa</th>
                            <th>Tipe Ormawa</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($ormawas as $no => $ormawa)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $ormawa->nama_ormawa }}</td>
                                    <td>{{$ormawa->tipe_ormawa}}</td>
                                    <td>
                                        <a href="{{ route('dashboard.ormawa.show', $ormawa->id) }}"
                                            class="btn btn-info">Lihat</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
