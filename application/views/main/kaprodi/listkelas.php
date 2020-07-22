<div class="row mx-0 containter justify-content-center content-body">
    <div class="col-lg-9 mx-auto mt-2">
        <div class="row">
            <div class="col-lg-6 mb-0 pb-0">
                <ol class="breadcrumb py-2 mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo site_url('kaprodi') ?>">Berita Acara Perkuliahan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Prodi</li>
                </ol>
            </div>
            <div class="col-lg-3 d-flex justify-content-end">
                <a type="button" href="<?php echo site_url('homebap') ?>" class="btn btn-primary">Mengisi Berita Acara</a>
            </div>
            <div class="col-lg-3 d-flex">
                <a type="button" href="<?php echo site_url('pilihrekapbulan') ?>" class="btn btn-warning text-white">Rekap Berita Acara</a>
            </div>
        </div>
        <table class="table table-striped text-center" id="listMatakuliah">
            <thead>
                <tr>
                    <!-- <th scope="col">#</th> -->
                    <th scope="col">#</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Tahun Masuk</th>
                    <th scope="col">Mata Kuliah</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Status</th>
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
            "bPaginate": true,
            "bInfo": false,
            "bFilter": false,
            "bLengthChange": false,
            "pageLength": 5,
            "order": [
                [0, 'asc']
            ]
        });

        //fungsi tampil barang
        function listMatkul() {
            $.ajax({
                type: 'ajax',
                url: 'kaprodi/getKelasProdi/',
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
                            // '<td>' + data[i].id_mkdosen + '</td>' +
                            '<td>' + no++ + '</td>' +
                            '<td>' + data[i].nama_kelas + '</td>' +
                            '<td>' + data[i].thn_masuk_kls + '</td>' +
                            '<td>' + data[i].namamk + '</td>' +
                            '<td>' + data[i].semester + '</td>' +
                            '<td>' + data[i].status + '</td>' +
                            '<td>' +
                            '<a href="kaprodipertemuan/?id=' + data[i].id_mkdosen + '" class="btn btn-success btn-md " data-id="' + data[i].id_mkdosen + '" data-matkul="' + data[i].id_kelas + '"data-matkul="' + data[i].kode_matkul + '">List Pertemuan</a>' + ' ' +
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