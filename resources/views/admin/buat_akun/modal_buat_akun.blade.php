<div class="modal fade text-left" id="modalBuatAkun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="labelModal">
                </h4>
                <button type="button" class="btn btn-outline-danger btn-close" data-bs-dismiss="modal"
                    aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dashboard.buat_akun.store') }}" method="post" id="formBuatAkun">
                    @csrf
                    <div id="update">
                
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputUsername" name="username" type="text" placeholder="Username" />
                        <label for="inputUsername">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputEmail" name="email" type="email" placeholder="Email" />
                        <label for="inputEmail">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Password" />
                        <label for="inputPassword">Password</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                    <button type="button" id="btn-submit" onclick="formConfirmation('Simpan Data?','#formBuatAkun')"
                    class="btn btn-primary ms-1">
                    Simpan
                </button>
            </form>
            </div>
        </div>
    </div>
</div>
