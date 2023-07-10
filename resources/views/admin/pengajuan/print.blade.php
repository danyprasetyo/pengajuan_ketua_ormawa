<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Document</title>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> --}}
    <style>
        h3 {
            text-align: center;
            text-transform: uppercase
        }
        @page { size: A4 }

    h1 {
        font-weight: bold;
        font-size: 20pt;
        text-align: center;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    .table th {
        padding: 8px 8px;
        border:1px solid #000000;
        text-align: center;
    }

    .table td {
        padding: 3px 3px;
        border:1px solid #000000;
    }

    .text-center {
        text-align: center;
    }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.8.162/pdf_viewer.min.css"
        integrity="sha512-P2VSYzrccFBKmHDD0SzVGs/iy/78fBfDLT16RbgC6sRKDdGh5PJVYiU8m+8g43Hc36j6CUQjE1itcIjcWtdDYQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="A4">
    <table>
        <tr>
            <td rowspan="5"><img src="{{public_path('images/ftunsur.jpg')}}" alt="" width="100px"></td>
            <td style="font-size:20px;" class="text-center"><b>PANITIA KHUSUS</b></td>
            <td rowspan="5"><img src="{{public_path('images/pansus.jpg')}}" alt="" width="100px"></td>
        </tr>
        <tr>
            <td style="font-size:20px;" class="text-center"><b>FAKULTAS TEKNIK</b></td>
        </tr>
        <tr>
            <td style="font-size:20px;" class="text-center"><b>UNIVERSITAS SURYAKANCANA</b></td>
        </tr>
        <tr>
            <td style="font-size:14px;" class="text-center">Jl. Pasir Gede Raya Kel. Bojongherang
                 Kec. Cianjur - Cilaku 43216</td>
        </tr>
        <tr>
            <td style="font-size:14px;" class="text-center">Email sensus.teknik@gmail.com No. Telp/WhatsApp : 0858-7234-9758</td>
        </tr>
    </table>

    <section class="sheet padding-10mm">
    <hr/>
    <h3>Formulir Pendaftaran Calon Ketua Ormawa FT Unsur <br/>Periode {{$pengajuan->periode->periode}}</h3>
    <br/>
    <h4 class="text-center">Bakal Calon Ketua {{$pengajuan->ormawa->nama_ormawa}}</h4>
    <br/>
    <table class="table">>
        <tr>
            <td><b>NO</b></td>
            <td colspan="2" class="text-center"><b>IDENTITAS PENDAFTAR</b></td>
        </tr>
        <tr>
            <td class="text-center" width="20" >1</td>
            <td>Nama</td>
            <td>{{$pengajuan->nama_mahasiswa}}</td>
        </tr>
        <tr>
            <td class="text-center">2</td>
            <td>NPM</td>
            <td>{{$pengajuan->npm}}</td>
        </tr>
        <tr>
            <td class="text-center">3</td>
            <td>Program Studi</td>
            <td>{{$pengajuan->program_studi}}</td>
        </tr>
        <tr>
            <td class="text-center">4</td>
            <td>Semester</td>
            <td>{{$pengajuan->semester}}</td>
        </tr>
        <tr>
            <td class="text-center">5</td>
            <td>NO HP</td>
            <td>{{$pengajuan->no_hp}}</td>
        </tr>
        <tr>
            <td class="text-center">6</td>
            <td>Alamat</td>
            <td>{{$pengajuan->alamat}}</td>
        </tr>
    </table>
    <br><br><br>
    <table>
        <tr>
            <td><img src="{{ public_path('storage/photo_mhs/'.$pengajuan->photo)}}" width="151px" height="226px"/></td>
        </tr>
        @if ($pengajuan->ormawa_id == 1 || $pengajuan->ormawa_id == 2 || $pengajuan->ormawa_id == 3)
        <tr><img src="{{ public_path('storage/sertifikat/'.$pengajuan->sertifikat)}}" width="100%"/></tr>
        @else
        <tr><img src="{{ public_path('storage/sertifikat/'.$pengajuan->sertifikat)}}" width="100%"/></tr>
        <hr/>
        <tr><img src="{{ public_path('storage/ktm/'.$pengajuan->scan_ktm)}}" width="100%"/></tr>
        <hr/>
        <tr><img src="{{ public_path('storage/suketMhs/'.$pengajuan->suket_mhs_aktif)}}" width="100%"/></tr>
        <hr/>
        <tr><img src="{{ public_path('storage/suratKebersediaan/'.$pengajuan->surat_kebersediaan)}}" width="100%"/></tr>
        <hr/>
        <tr><img src="{{ public_path('storage/suratRekomendasi/'.$pengajuan->suket_rekomendasi)}}" width="100%"/></tr>
        <hr/>
        <tr><img src="{{ public_path('storage/nilai/'.$pengajuan->nilai_ipk)}}" width="100%"/></tr>
        @endif
    </table>

</body>
</html>
