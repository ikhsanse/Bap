$(document).ready(function() {
    var tablematkul = null;
    listMatkul();
    tablematkul = $('#listMatakuliah').DataTable({
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
                var no =1;
                // var_dump(data);exit;
                for (i = 0; i < data.length; i++) {
                    html += '<tr>' +
                        '<td>' + no++ + '</td>' +
                        '<td>' + data[i].namamk + '</td>' +
                        '<td>' + data[i].nama_kelas + '</td>' +
                        '<td>' + data[i].semester + '</td>' +
                        '<td>' +
						'<a href="pertemuan/?id='+data[i].id_mkdosen+'" class="btn btn-primary btn-md " data-id="' + data[i].id_mkdosen + '" data-matkul="' + data[i].id_kelas + '"data-matkul="' + data[i].kode_matkul + '">List Pertemuan</a>' + ' ' +
						// '<a href="javascript:void(0);" class="btn btn-danger btn-sm deleteRecord" data-id="' + data[i].id + '">Delete</a>' +
						'</td>' +
                        '</tr>';
                }
                $('#listMatkul').html(html);
            }

        });
    }

});

$(document).ready(function() {
    var tablepertemuan = null;
    listPertemuan();
    tablepertemuan = $('#list').DataTable({
        "bPaginate": true,
        "bInfo": false,
        "bFilter": false,
        "bLengthChange": false,
        "pageLength": 5
    });

    function listPertemuan (){
        $.ajax({
            type: 'ajax',
            url: "getPertemuanList/",
            async: false,
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                var html = '';
                var i;
                var no =1;
                // var_dump(data);exit;
                for (i = 0; i < data.length; i++) {
                    html += '<tr>' +
                        '<td>' + no++ + '</td>' +
                        '<td>' +'Pertemuan Ke-'+ data[i].pertemuan + '</td>' +
                        '<td>' + data[i].tanggal + '</td>' +
                        '<td>' + data[i].status + '</td>' +
                        '<td>' +
                        '<a data-toggle="modal" data-target="#modalEdit" class="btn btn-warning btn-md " data-id="' + data[i].id_bap + '" data-topik="' + data[i].topik + '"data-cp="' + data[i].cp_pertemuan + '"data-deskirpsi="'+ data[i].deskripsi + '"data-tanggal="'+ data[i].tanggal +'"data-status="'+ data[i].status+ '">Edit</a>' + ' ' +
                        '<a data-toggle="modal" data-target="#modalDetail"  class="btn btn-success btn-md text-white " data-id="' + data[i].id_bap + '">Detail</a>' +
                        '</td>' +
                        '</tr>';
                }
                $('#listPertemuan').html(html);
            }
    
        });
    }
    
});

