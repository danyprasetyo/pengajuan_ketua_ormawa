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
        <tr id="pdf"></tr>
    </table>
    {{-- {{ public_path('storage/sertifikat/'.$pengajuan->sertifikat)} --}}
    <div id="viewerContainer"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.8.162/pdf.min.js"
        integrity="sha512-9Wd08apcJEwm8g3lBTg1UW/njdN0iuuOVWKpyinK3uA7ISAE5PmEZ4y8bZYTXVOE3tlt7aFlCBBLmLt5cUxe2Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.8.162/pdf.worker.min.js"
        integrity="sha512-kYruxZBxGQJy6pFwz9JVe6FCgCZEPPvxC3eoy4A+fCMWcSGqPxxGC7M1S6eyXCBfm/4d7l4cf8XNoULZQQ+MtQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.8.162/pdf_viewer.min.js"
        integrity="sha512-4OIgtzKMwM3LvyUNlYaXtoeccZK3T+UGWdQ0rSnFj8B5uwgUFINQEMXPQIiBx7k2+bqAjl/A6LqYPzqRAj7Ewg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // Path or URL to the PDF file
        var pdfPath = `{{ url('storage/sertifikat/' . $pengajuan->sertifikat) }}`;

        // Load the PDF file
       const loadingTask = pdfjsLib.getDocument(pdfPath);
            
            loadingTask.promise.then((pdf) => {
                // Fetch the first page of the PDF
                pdf.getPage(1).then((page) => {
                    // Set the desired scale (e.g., 1.5 for 150%)
                    const scale = 1.5;
                    
                    // Set the canvas element to render the PDF page
                    const canvas = document.createElement('canvas');
                    const context = canvas.getContext('2d');
                    canvas.width = page.view[2] * scale;
                    canvas.height = page.view[3] * scale;
                    // Render the PDF page into the canvas
                    const renderContext = {
                        canvasContext: context,
                        viewport: page.getViewport({ scale: scale }),
                    };
                    page.render(renderContext).promise.then(() => {
                        // Convert the canvas to an image
                        const image = new Image();
                        image.src = canvas.toDataURL('image/png');
                        
                        // Display the image on the page
                        document.getElementById("pdf").appendChild(image);

                    });
                });
            });
    </script>

</body>
</html>
