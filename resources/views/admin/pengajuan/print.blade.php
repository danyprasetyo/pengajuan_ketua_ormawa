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
            
          await  loadingTask.promise.then((pdf) => {
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
                        document.getElementById("tes").appendChild(image);

                    });
                });
            });
    </script>

</body>

</html>
