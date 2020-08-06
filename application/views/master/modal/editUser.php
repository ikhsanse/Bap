<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="modalInput" aria-hidden="true">
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
                <form method="post" action="<?php echo site_url('ListUser/updateUser') ?>">
                <input id="nipAwal" name="nip-awal">
                    <div class="form-group">
                        <input class="form-control" id="nama" name="user" placeholder="Nama User" type="text">
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="nipUser" name="nip" placeholder="Nomor Induk Pegawai" type="text">
                    </div>
                    <div class="form-group">
                        <div class="input-group" id="show_hide_password_edit">
                            <input class="form-control" id="editPass" placeholder="Password" name="password" type="password">
                            <div class="input-group-append">
                                <a class="input-group-text" href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    <input id="roles" name="id-role">
                    <div class="form-group">
                        <select class="form-control" id="editRole" name="roles">
                            <option hidden id="namaRole" value="">Roles</option>
                            <?php
                            foreach ($roles as $role) {
                                echo '<option value="' . $role->id_role . '">' . $role->role . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="status">
                            <option hidden id="status" >Status</option>
                            <option value="active">active</option>
                            <option value="non-active">non-active</option>
                        </select>
                    </div>
                    <div class="modal-footer mb-0">
                        <a>
                            <button type="submit" class="btn btn-primary btn-lg">Update</button>
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#show_hide_password_edit a").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_password_edit input').attr("type") == "text") {
                $('#show_hide_password_edit input').attr('type', 'password');
                $('#show_hide_password_edit i').addClass("fa-eye-slash");
                $('#show_hide_password_edit i').removeClass("fa-eye");
            } else if ($('#show_hide_password_edit input').attr("type") == "password") {
                $('#show_hide_password_edit input').attr('type', 'text');
                $('#show_hide_password_edit i').removeClass("fa-eye-slash");
                $('#show_hide_password_edit i').addClass("fa-eye");
            }
        });
    });

    $('#editRole').on('change', function() {
        // $.ajax({
        //     type: 'GET',
        //     url: 'kelasmk/getNipDosen/' + this.value + '',
        //     dataType: 'html',
        //     success: function(response) {
        //         console.log(response);
        //         // $('#cp-pertemuan').show();
        //         $('#nipDosenMk').val(response);
        //         // $('#cp-p').load();
        //     },
        //     error: function(XMLHttpRequest, textStatus, errorThrown) {
        //         console.log({
        //             XMLHttpRequest,
        //             textStatus,
        //             errorThrown
        //         })
        //     }
        // })

        $('#roles').val(this.value);
    });
</script>