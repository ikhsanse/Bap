<div class="row mx-0 containter justify-content-center content-body">
    <div class="col-lg-10 mx-auto mt-2">
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
        <table class="table table-striped text-center" id="listKelasMk">
            <thead>
                <tr>
                    <!-- <th scope="col">#</th> -->
                    <th scope="col">#</th>
                    <th scope="col">Mata Kuliah</th>
                    <!-- <th scope="col">Prodi</th> -->
                    <th scope="col">Kelas</th>
                    <th scope="col">Tahun Masuk</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Pengajar</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="listMk">

            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        listMk();
        var table = $('#listKelasMk').DataTable({
            "bPaginate": true,
            "bInfo": false,
            "bFilter": true,
            "bLengthChange": false,
            "pageLength": 7,
            "order": [
                [0, 'asc']
            ],
            "buttons": [{
                'text': 'Tambah',
                'action': function(e, dt, node, config) {
                    $('#addMk').modal('show')
                }
            }]
        });
        table.buttons().container().appendTo('#listKelasMk_wrapper .col-md-6:eq(0)');

        //fungsi tampil barang
        function listMk() {
            $.ajax({
                type: 'ajax',
                url: 'kelasmk/getAllMk/',
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    var no = 1;
                    // var nama_prodi
                    // var_dump(data);exit;
                    for (i = 0; i < data.length; i++) {
                        html += '<tr>' +
                            // '<td>' + data[i].id_mkdosen + '</td>' +
                            '<td>' + no++ + '</td>' +
                            '<td>' + data[i].namamk + '</td>' +
                            // '<td>' + data[i].namaprod + '</td>' +
                            '<td>' + data[i].nama_kelas + '</td>' +
                            '<td>' + data[i].thn_masuk_kls + '</td>' +
                            '<td>' + data[i].semester + '</td>' +
                            '<td>' + data[i].nama + '</td>' +
                            '<td>' + data[i].status + '</td>' +
                            '<td>' +
                            '<a data-toggle="modal" href="javascript:void(0)" class="btn btn-warning btn-md editMkAdm" data-kelas="' + data[i].nama_kelas + '" data-idmkdosen="' + data[i].id_mkdosen + '" data-kodemk="' + data[i].kode_matkul + '" data-mk="' + data[i].namamk + '" data-id="' + data[i].id_kelas + '" data-semester="' + data[i].semester + '"data-tahun="' + data[i].thn_masuk_kls + '"data-prodi="' + data[i].namaprod + '"data-idprodi="' + data[i].id_prodi + '"data-status="' + data[i].status + '"data-namados="' + data[i].nip_dosen +' - '+ data[i].nama  + '"data-nip="' + data[i].nip_dosen + '">Edit</a>' + ' ' +
                            // '<a data-toggle="modal" href="javascript:void(0)" class="btn btn-success btn-md detailMkAdm" data-kelas="' + data[i].nama_kelas + '" data-idmkdosen="' + data[i].id_mkdosen + '" data-kodemk="' + data[i].kode_matkul + '" data-mk="' + data[i].namamk + '" data-id="' + data[i].id_kelas + '" data-semester="' + data[i].semester + '"data-tahun="' + data[i].thn_masuk_kls + '"data-prodi="' + data[i].namaprod + '"data-idprodi="' + data[i].id_prodi + '"data-status="' + data[i].status + '"data-namados="' + data[i].nip_dosen +' - '+ data[i].nama  + '"data-nip="' + data[i].nip_dosen + '">Detail</a>' + ' ' +
                            '</td>' +
                            '</tr>';
                    }
                    $('#listMk').html(html);
                }

            });
        }

    });
    $('#listMk').on('click', '.editMkAdm', function() {
        $('#editMk').modal('show');
        $("#idMkDosen").val($(this).data('idmkdosen'));
        $("#namaKelasAwalMk").val($(this).data('kelas'));
        $("#namaKelasMk").html($(this).data('kelas'));
        $("#idKelasMk").val($(this).data('id'));
        // $("#namaMatkulAwalMk").html($(this).data('mk'));
        $("#namaMatkulMk").html($(this).data('mk'));
        $("#kodeMatkulAwalMk").val($(this).data('kodemk'));
        $("#kodeMatkulMk").val($(this).data('kodemk'));

        // $("#namaDosenAwalMk").html($(this).data('namados'));
        $("#namaDosenMk").html($(this).data('namados'));
        $("#nipDosenAwalMk").val($(this).data('nip'));
        $("#nipDosenMk").val($(this).data('nip'));

        $("#statusMk").html($(this).data('status'));
        // $("#semesterKelas").val($(this).data('semester'));
        $("#tahunKelasAwalMk").val($(this).data('tahun'));
        $("#tahunKelasMk").html($(this).data('tahun'));
        $("#idProdiMk").val($(this).data('idprodi'));
    });
    $('#listMk').on('click', '.detailMkAdm', function() {
        $('#detailMk').modal('show');
        $("#namaKelasAwalMkDetail").val($(this).data('kelas'));
        $("#namaMatkulMkDetail").val($(this).data('mk'));
        $("#namaDosenMkDetail").val($(this).data('namados'));
        $("#statusMkDetail").val($(this).data('status'));
        $("#semesterKelasDetail").val($(this).data('semester'));
        $("#tahunKelasAwalMkDetail").val($(this).data('tahun'));
    });
</script>