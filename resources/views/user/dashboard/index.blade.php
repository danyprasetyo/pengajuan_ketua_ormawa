@extends('layouts.dashboard.master')
@section('pageTitle')
    Dashboard
@endsection
@section('pageLink')
    Dashboard
@endsection
@section('content')
<div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
        <h3>Hello {{Auth::user()->username}}</h3>
        <div class="card text-center">
            <div class="card-body">
              <h5 class="card-title"><strong>Untuk Melakukan Pengajuan Menjadi Ketua Ormawa Kamu Bisa Klik Tombol Dibawah.</strong></h5>
              <br/>
              {{-- <p class="card-text">Kamu diwajibkan untuk melengkapi profile kamu dulu nih. <br/>Kamu bisa klik tombol Profile dibawah ini</p> --}}
              <a href="{{route('dashboard.pengajuan.index')}}" class="btn btn-primary">Klik Disini</a>
            </div>
          </div>
      </div>
</div>
@endsection