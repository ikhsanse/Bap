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
        <table class="table table-striped text-center" id="listKelasJurusan">
            <thead>
                <tr>
                    <!-- <th scope="col">#</th> -->
                    <th scope="col">#</th>
                    <th scope="col">Nama Kelas</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Prodi</th>
                    <th scope="col">Tahun Masuk</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="listKelas">

            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        listKelas();
        var table = $('#listKelasJurusan').DataTable({
            "bPaginate": true,
            "bInfo": false,
            "bFilter": true,
            "bLengthChange": false,
            "pageLength": 5,
            "order": [
                [0, 'asc']
            ],
            "buttons": [{
                'text': 'Add Kelas',
                'action': function(e, dt, node, config) {
                    $('#addKelas').modal('show')
                }
            }]
        });
        table.buttons().container().appendTo('#listKelasJurusan_wrapper .col-md-6:eq(0)');

        //fungsi tampil barang
        function listKelas() {
            $.ajax({
                type: 'ajax',
                url: 'kelas/getAllKelas',
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    var no = 1;
                    var nama_prodi;
                    // var_dump(data);exit;
                    for (i = 0; i < data.length; i++) {
                        html += '<tr>' +
                            // '<td>' + data[i].id_mkdosen + '</td>' +
                            '<td>' + no++ + '</td>' +
                            '<td>' + data[i].nama_kelas + '</td>' +
                            '<td>' + data[i].semester + '</td>' +
                            '<td>' + data[i].namaprod + '</td>' +
                            '<td>' + data[i].thn_masuk + '</td>' +
                            '<td>' +
                            '<a data-toggle="modal" href="javascript:void(0)"  id="editKelasAdm" class="btn btn-warning btn-md editKelas" data-kelas="' + data[i].nama_kelas + '" data-id="' + data[i].id_kelas + '" data-semester="' + data[i].semester + '"data-tahun="' + data[i].thn_masuk + '"data-prodi="' + data[i].namaprod + '"data-idprodi="' + data[i].id_prodi + '">Edit</a>' + ' ' +
                            // '<a href="javascript:void(0);" class="btn btn-danger btn-sm deleteRecord" data-id="' + data[i].id + '">Delete</a>' +
                            '</td>' +
                            '</tr>';
                    }
                    $('#listKelas').html(html);
                }

            });
        }

    });
    $('#listKelas').on('click', '.editKelas', function() {
        $('#editKelas').modal('show');
        $("#namaKelasAwal").val($(this).data('kelas'));
        $("#namaKelas").val($(this).data('kelas'));
        $("#idKelas").val($(this).data('id'));
        $("#semesterKelas").val($(this).data('semester'));
        $("#tahunKelasAwal").val($(this).data('tahun'));
        $("#tahunKelas").val($(this).data('tahun'));
        $("#namaProdi").html($(this).data('prodi'));
    });
</script>