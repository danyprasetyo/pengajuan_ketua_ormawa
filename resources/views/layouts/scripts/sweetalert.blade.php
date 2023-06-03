<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    })

    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type') }}";

        switch (type) {
            case 'info':
                Toast.fire({
                    icon: 'info',
                    title: "{{ Session::get('message') }}"
                })
                break;
            case 'success':
                Toast.fire({
                    icon: 'success',
                    title: "{{ Session::get('message') }}"
                })
                break;
            case 'warning':
                Toast.fire({
                    icon: 'warning',
                    title: "{{ Session::get('message') }}"
                })
                break;
            case 'error':
                Swal.fire({
                    icon: 'error',
                    title: "Gagal",
                    html: "{{ Session::get('message') }}",
                })
                break;
            case 'dialog_error':
                Swal.fire({
                    icon: 'error',
                    title: "Oppssss",
                    text: "{{ Session::get('message') }}",
                    timer: 3000
                })
                break;
        }
    @endif
    @if ($errors->any())
        @php
            $message = '';
            foreach ($errors->all() as $error) {
                $message .= "<li> $error </li>";
            }
        @endphp
        Swal.fire({
            text: 'Error',
            html: `{!! $message !!}`,
            icon: 'error',
        })
    @endif

    function formConfirmation(message) {
            var form = event.target.form;
            Swal.fire({
                title: message,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        }

        function formConfirmationId(idForm, message) {
            var form = $(`${idForm}`);
            console.log();
            Swal.fire({
                title: message,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        }
</script>
