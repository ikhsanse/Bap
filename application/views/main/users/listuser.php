<div class="row mx-0 containter justify-content-center content-body">
    <div class="col-lg-9 mx-auto mt-2">
        <div class="row">
            <div class="col-lg-6">
                <?php if ($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <h4 class="alert-heading">Success</h4>
                        <?php echo $this->session->flashdata('success'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php } else if ($this->session->flashdata('error')) {  ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <h4 class="alert-heading">Error</h4>
                        <?php echo $this->session->flashdata('error'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php } else if ($this->session->flashdata('warning')) {  ?>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <?php echo $this->session->flashdata('warning'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php } else if ($this->session->flashdata('info')) {  ?>
                    <div class="alert alert-info alert-dismissible" role="alert">
                        <?php echo $this->session->flashdata('info'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php } ?>
            </div>
        </div>
        <table class="table table-striped text-center" id="listUserTik">
            <thead>
                <tr>
                    <!-- <th scope="col">#</th> -->
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Nomor Induk</th>
                    <th scope="col">Roles</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="listUser">

            </tbody>
        </table>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        listUser();
        var table = $('#listUserTik').DataTable({
            "bPaginate": true,
            "bInfo": false,
            "bFilter": true,
            "bLengthChange": false,
            "pageLength": 5,
            "order": [
                [0, 'asc']
            ],
            "buttons": [{
                'text': 'Tambah User',
                'action': function(e, dt, node, config) {
                    $('#addUser').modal('show')
                }
            }]

        });
        table.buttons().container().appendTo('#listUserTik_wrapper .col-md-6:eq(0)');

        function listUser() {
            $.ajax({
                type: 'ajax',
                url: "listuser/getAllUser",
                async: false,
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    var html = '';
                    var i;
                    var no = 1;
                    // var_dump(data);exit;
                    for (i = 0; i < data.length; i++) {
                        html += '<tr>' +
                            //    '<td hidden>' + data[i].id_bap + '</td>' +
                            '<td>' + no++ + '</td>' +
                            '<td>' + data[i].nama + '</td>' +
                            '<td>' + data[i].nip + '</td>' +
                            '<td>' + data[i].role + '</td>' +
                            '<td>' + data[i].status + '</td>' +
                            '<td>' +
                            '<a data-toggle="modal" href="javascript:void(0)"  class="btn btn-warning btn-md editUser" data-user="' + data[i].nama + '" data-nip="' + data[i].nip + '" data-status="' + data[i].status + '"data-idrole="' + data[i].roles + '"data-role="' + data[i].role + '"data-pass="' + data[i].password + '">Edit</a>' + ' ' +
                            // '<a data-toggle="modal" href="javascript:void(0)"  id="detailPertemuan" class="btn btn-success btn-md detailBap" data-pertemuan="' + data[i].pertemuan + '" data-id="' + data[i].id_bap + '" data-topik="' + data[i].topik + '"data-cp="' + data[i].cp_pertemuan + '"data-deskirpsi="' + data[i].deskripsi + '"data-tanggal="' + data[i].tanggal + '"data-status="' + data[i].status + '">Detail</a>' + ' ' +
                            '</td>' +
                            '</tr>';


                    }
                    $('#listUser').html(html);
                }
            });
        }
    });

    $('#listUser').on('click', '.editUser', function() {
        $('#editUser').modal('show');
        $("#nama").val($(this).data('user'));
        $("#nipUser").val($(this).data('nip'));
        $("#nipAwal").val($(this).data('nip'));
        $("#status").html($(this).data('status'));
        $("#roles").val($(this).data('idrole'));
        $("#namaRole").html($(this).data('role'));
        $("#editPass").val($(this).data('pass'));
    });
</script>