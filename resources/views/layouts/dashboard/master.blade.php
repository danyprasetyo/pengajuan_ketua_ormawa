<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Sidenav Light - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            a{
                text-decoration: none;
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
       @include('layouts.dashboard.partial.navbar')
        <div id="layoutSidenav">
            @include('layouts.dashboard.partial.sidebar')
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">@yield('pageTitle')</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="@yield('pageLink')">@yield('pageName')</a></li>
                            <li class="breadcrumb-item active">@yield('pageNow')</li>
                        </ol>
                        @yield('content')
                    </div>
                </main>
                @include('layouts.dashboard.partial.sidebar')
            </div>
        </div>
        <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('assets/vendor/datatables/datatables-simple-demo.js')}}"></script>
    
        @include('layouts.scripts.sweetalert')
        <script>
            function clearInput(formId, label = "", action = "") {
                document.getElementById(formId).reset();
                $(".file").val("");
                $('.image-preview').empty();
                $(".kapilih").removeAttr('selected');
                $("#update").empty();
                $(`#labelModal`).text(label);
                $(`#btn-submit`).text('Simpan');
                document.getElementById(formId).action =
                    `{{ url('${action}') }}`;
            }
        </script>
        <script src="{{asset("assets/js/scripts.js")}}"></script>
        @stack('js')
    </body>
</html>
