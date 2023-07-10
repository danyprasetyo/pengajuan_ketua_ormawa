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

        td {
            text-size-adjust: 50px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.8.162/pdf_viewer.min.css"
        integrity="sha512-P2VSYzrccFBKmHDD0SzVGs/iy/78fBfDLT16RbgC6sRKDdGh5PJVYiU8m+8g43Hc36j6CUQjE1itcIjcWtdDYQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <hr />
    <h3>Formulir Pendaftaran Calon Ketua Ormawa FT Unsur <br />Periode {{ $pengajuan->periode->periode }}</h3>
    <br />
    <br />
    <table>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{ $pengajuan->nama_mahasiswa }}</td>
        </tr>
        <tr>
            <td>NPM</td>
            <td>:</td>
            <td>{{ $pengajuan->npm }}</td>
        </tr>
        <tr>
            <td>Program Studi</td>
            <td>:</td>
            <td>{{ $pengajuan->program_studi }}</td>
        </tr>
        <tr>
            <td>Fakultas</td>
            <td>:</td>
            <td>Teknik</td>
        </tr>
        <tr>
            <td>Semester</td>
            <td>:</td>
            <td>{{ $pengajuan->semester }}</td>
        </tr>
        <tr>
            <td>NO HP</td>
            <td>:</td>
            <td>{{ $pengajuan->no_hp }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $pengajuan->alamat }}</td>
        </tr>
    </table>
    <br><br><br>
    <table>
        <tr>
            <td><img src="{{ public_path('storage/photo_mhs/' . $pengajuan->photo) }}" width="100px" height="150px" />
            </td>
            <td><div id="tes"></div></td>
        </tr>
    </table>
    {{-- {{ public_path('storage/sertifikat/'.$pengajuan->sertifikat)} --}}
    <div id="viewerContainer"></div>

</body>

</html>
