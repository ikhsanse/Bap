<div class="row mx-0 containter justify-content-center content-body">
        <div class="col-lg-8 mx-auto ml-5 mt-2">
            <table id="list" class="table table-striped text-center ">
                <div class="row">
                    <div class="col-lg-12 mb-0 pb-0" >
                        <ol class="breadcrumb py-2 mb-0">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('kaprodi')?>">Berita Acara Perkuliahan</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="<?php echo site_url('admin')?>">Admin</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $matkul. ' '.$kelas ?></li>
                        </ol>
                    </div>
                </div>

                <thead>
                    <tr>
                        <th hidden>ID</th>
                        <!-- <th scope="col">#</th> -->
                        <th scope="col">Pertemuan</th>
                        <th scope="col">Topik Utama</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody id="listPertemuan">

                </tbody>
            </table>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#alert-input').fadeOut(2000)
        });
        $(document).ready(function() {
            listPertemuan();
            $('#list').DataTable({
                "bPaginate": true,
                "bInfo": false,
                "bFilter": false,
                "bLengthChange": false,
                "pageLength": 5,
                "order": [
                    [0, 'asc']
                ]
            });

            function listPertemuan() {
                $.ajax({
                    type: 'ajax',
                    url: "<?php echo base_url('index.php/pertemuan/getPertemuanList') ?>",
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
                                '<td hidden>' + data[i].id_bap + '</td>' +
                                // '<td>' + no++ + '</td>' +
                                '<td>' + 'Pertemuan Ke-' + data[i].pertemuan + '</td>' +
                                '<td>' + data[i].topik +'</td>' +
                                '<td>' + data[i].tanggal + '</td>' +
                                '<td>' + data[i].status + '</td>' +
                                '<td>' +
                                '<a data-toggle="modal" href="javascript:void(0)"  id="detailPertemuan" class="btn btn-success btn-md detailBap" data-pertemuan="' + data[i].pertemuan + '" data-id="' + data[i].id_bap + '" data-topik="' + data[i].topik + '"data-cp="' + data[i].cp_pertemuan + '"data-deskirpsi="' + data[i].deskripsi + '"data-tanggal="' + data[i].tanggal + '"data-status="' + data[i].status + '">Detail</a>' + ' ' +
                                '</td>' +
                                '</tr>';


                        }
                        $('#listPertemuan').html(html);
                    }
                });
            }
        });
        $('#listPertemuan').on('click', '.detailBap', function() {
            $('#modalDetail').modal('show');
            $("#headerDetail").html($(this).data('pertemuan'));
            $("#id-bap-detail").val($(this).data('id'));
            $("#topik-detail").html($(this).data('topik'));
            $("#cp-detail").html($(this).data('cp'));
            $("#desk-detail").val($(this).data('deskirpsi'));
            $("#datepickerDetail").val($(this).data('tanggal'));
            $("#status1-detail").html($(this).data('status'));
        });
    </script>