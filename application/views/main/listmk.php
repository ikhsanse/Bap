<div class="row mx-0 containter justify-content-center content-body">
    <!-- <div class="side px-0 side-border">
        <ul class="sidebar ml-3 navbar-nav mt-3">
            <div class="link-nav inline-nav">
                <li class="nav-item mt-1">
                    <i id="item-1" class="fa fa-user-circle" style="font-size:50px;"></i>
                </li>
                <li class="nav-item ml-2">
                    <p id="item-2" class="mb-0"><?php echo $nama ?></p>
                    <p id="item-3" class="mt-0 mb-0"><?php echo $nip ?></p>
                </li>
            </div>
            <div class="mt-4 link-nav">
                <li class="nav-item dropdown py-2">
                    <a href="<?php echo base_url() ?>" id="item-5">Home</a>
                </li>
                <li class="nav-item dropdown py-2 <?php echo $this->uri->segment(2) == '' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('homebap') ?>" id="item-6">BAP</a>
                </li>
            </div>
        </ul>
    </div> -->

    <div class="col-lg-9 mx-auto mt-5">
        <table class="table table-striped text-center" id="listMatakuliah">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Mata Kuliah</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Semester</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="listMatkul">

            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        listMatkul();
        $('#listMatakuliah').DataTable({
            "bPaginate": false,
            "bInfo": false,
            "bFilter": false,
            "bLengthChange": false,
            "pageLength": 5
        });

        //fungsi tampil barang
        function listMatkul() {
            $.ajax({
                type: 'ajax',
                url: 'homebap/getMatkulList/',
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    var no = 1;
                    // var_dump(data);exit;
                    for (i = 0; i < data.length; i++) {
                        html += '<tr>' +
                            '<td>' + no++ + '</td>' +
                            '<td>' + data[i].namamk + '</td>' +
                            '<td>' + data[i].nama_kelas + '</td>' +
                            '<td>' + data[i].semester + '</td>' +
                            '<td>' +
                            '<a href="pertemuan/?id=' + data[i].id_mkdosen + '" class="btn btn-primary btn-md " data-id="' + data[i].id_mkdosen + '" data-matkul="' + data[i].id_kelas + '"data-matkul="' + data[i].kode_matkul + '">List Pertemuan</a>' + ' ' +
                            // '<a href="javascript:void(0);" class="btn btn-danger btn-sm deleteRecord" data-id="' + data[i].id + '">Delete</a>' +
                            '</td>' +
                            '</tr>';
                    }
                    $('#listMatkul').html(html);
                }

            });
        }

    });
</script>