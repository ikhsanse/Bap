<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="modalInput" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center navigation text-white pb-0">
                <h5 class="modal-title mb-3" id="modalInput">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-0">
                <!-- <h6>Tambah Kelas</h6> -->
                <form method="post" action="<?php echo site_url('ListUser/addUser') ?>">
                    <div class="form-group">
                        <input class="form-control" name="user" placeholder="Nama User" type="text">
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="nip" placeholder="Nomor Induk Pegawai" type="text">
                    </div>
                    <div class="form-group">
                        <div class="input-group" id="show_hide_password">
                            <input class="form-control" placeholder="Password" name="password" type="password">
                            <div class="input-group-append">
                                <a class="input-group-text" href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="roles">
                            <option value="">Roles</option>
                            <option value="2">Dosen</option>
                            <option value="3">KPS-TI</option>
                            <option value="4">KPS-TMD</option>
                            <option value="5">KPS-TMJ</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="status">
                            <option value="">Status</option>
                            <option value="active">active</option>
                            <option value="non-active">non-active</option>
                        </select>
                    </div>
                    <div class="modal-footer mb-0">
                        <a>
                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("fa-eye-slash");
                $('#show_hide_password i').removeClass("fa-eye");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("fa-eye-slash");
                $('#show_hide_password i').addClass("fa-eye");
            }
        });
    });
</script>