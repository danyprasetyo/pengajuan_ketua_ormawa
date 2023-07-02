<div class="modal fade text-left" id="modalPeriode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="labelModal">
                </h4>
                <button type="button" class="btn btn-outline-danger btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dashboard.buat_akun.store') }}" method="post" id="formPeriode">
                    @csrf
                    <div id="update">
                
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputUsername" name="periode" type="text" placeholder="2022/2023" />
                        <label for="inputUsername">Periode</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                    <button type="button" id="btn-submit" onclick="formConfirmation('Simpan Data?','#formPeriode')"
                    class="btn btn-primary ms-1">
                    Tambah
                </button>
            </form>
            </div>
        </div>
    </div>
</div>
