    <div class="row mx-0 containter justify-content-center content-body">
        <div class="col-lg-8 mx-auto ml-5 mt-2">
            <table id="list" class="table table-striped text-center ">
                <button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#modalBAP">Add BAP</button>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Pertemuan</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody id="listPertemuan">

                    <!-- <tr>
                    <th scope="row">1</th>
                    <td>Pertemuan Ke-1</td>
                    <td>17-Juli-2020</td>
                    <td>Normal</td>
                    <td>
                        <button type="button" class="btn btn-warning">Edit</button>
                        <button type="button" class="btn btn-success">Detail</button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Pertemuan Ke-2</td>
                    <td>22-Juli-2020</td>
                    <td>Pengganti</td>
                    <td>
                        <button type="button" class="btn btn-warning">Edit</button>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalDetail">Detail</button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Pertemuan Ke-3</td>
                    <td>-</td>
                    <td>Normal</td>
                    <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEdit">Edit</button>
                        <button type="button" class="btn btn-success">Detail</button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Pertemuan Ke-4</td>
                    <td>-</td>
                    <td>Normal</td>
                    <td>
                        <button type="button" class="btn btn-warning">Edit</button>
                        <button type="button" class="btn btn-success">Detail</button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">5</th>
                    <td>Pertemuan Ke-5</td>
                    <td>-</td>
                    <td>Normal</td>
                    <td>
                        <button type="button" class="btn btn-warning">Edit</button>
                        <button type="button" class="btn btn-success">Detail</button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">6</th>
                    <td>Pertemuan Ke-6</td>
                    <td>-</td>
                    <td>Normal</td>
                    <td>
                        <button type="button" class="btn btn-warning">Edit</button>
                        <button type="button" class="btn btn-success">Detail</button>
                    </td>
                </tr> -->
                </tbody>
            </table>
            <!-- <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav> -->
        </div>
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
                "pageLength": 5
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
                                '<td>' + no++ + '</td>' +
                                '<td>' + 'Pertemuan Ke-' + data[i].pertemuan + '</td>' +
                                '<td>' + data[i].tanggal + '</td>' +
                                '<td>' + data[i].status + '</td>' +
                                '<td>' +
                                '<a data-toggle="modal" href="<?php echo site_url("getPertemuan/?id_bap='+ data[i].id_bap+'")?>" data-target="#modalEdit" id="editPertemuan" class="btn btn-warning btn-md " data-id="' + data[i].id_bap + '" data-topik="' + data[i].topik + '"data-cp="' + data[i].cp_pertemuan + '"data-deskirpsi="' + data[i].deskripsi + '"data-tanggal="' + data[i].tanggal + '"data-status="' + data[i].status + '">Edit</a>' + ' ' +
                                '<a data-toggle="modal" data-target="#modalDetail"  class="btn btn-success btn-md text-white " data-id="' + data[i].id_bap + '">Detail</a>' +
                                '</td>' +
                                '</tr>';


                        }
                        $('#listPertemuan').html(html);
                    }

                });
            }


            // $('#list').on('click', '#editPertemuan', function() {
            //     // $('#editUserModal').modal('show');
            //     $("#bapId").val($(this).data('id'));
            //     $("#topik").val($(this).data('topik'));
            //     $("#cp").val($(this).data('cp'));
            //     $("#deskripsi").val($(this).data('deskripsi'));
            //     $("#anggal").val($(this).data('tanggal'));
            //     $("#status").val($(this).data('status'));
            // });
            // s 
        });
    </script>