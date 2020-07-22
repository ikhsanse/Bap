   <div class="row mx-0 containter justify-content-center content-body">
       <div class="col-lg-8 mx-auto ml-5 mt-2">
           <table id="list" class="table table-striped text-center ">
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
       </div>
       <div class="row">
           <!-- <div class="col-lg-8 mb-0 pb-0">
               <ol class="breadcrumb py-2 mb-0">
                   <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Berita Acara Perkuliahan</a></li>
                   <li class="breadcrumb-item active" aria-current="page"><?php echo $matkul . ' ' . $kelas ?></li>
               </ol>
           </div> -->
           <!-- <div class="col-lg-4 d-flex justify-content-start">
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalBAP">Add BAP</button>
           </div> -->
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
           listPertemuan();
           var table = $('#list').DataTable({
               "bPaginate": true,
               "bInfo": false,
               "bFilter": true,
               "bLengthChange": false,
               "pageLength": 5,
               "order": [
                   [0, 'asc']
               ],
               "buttons": [{
                   'text': 'Add BAP',
                   'action': function(e, dt, node, config) {
                       $('#modalBAP').modal('show')
                   }
               }]

           });
           table.buttons().container().appendTo('#list_wrapper .col-md-6:eq(0)');

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
                               '<td>' + data[i].topik + '</td>' +
                               '<td>' + data[i].tanggal + '</td>' +
                               '<td>' + data[i].status + '</td>' +
                               '<td>' +
                               '<a data-toggle="modal" href="javascript:void(0)"  id="editPertemuan" class="btn btn-warning btn-md editBap" data-pertemuan="' + data[i].pertemuan + '" data-id="' + data[i].id_bap + '" data-topik="' + data[i].topik + '"data-cp="' + data[i].cp_pertemuan + '"data-deskirpsi="' + data[i].deskripsi + '"data-tanggal="' + data[i].tanggal + '"data-status="' + data[i].status + '">Edit</a>' + ' ' +
                               '<a data-toggle="modal" href="javascript:void(0)"  id="detailPertemuan" class="btn btn-success btn-md detailBap" data-pertemuan="' + data[i].pertemuan + '" data-id="' + data[i].id_bap + '" data-topik="' + data[i].topik + '"data-cp="' + data[i].cp_pertemuan + '"data-deskirpsi="' + data[i].deskripsi + '"data-tanggal="' + data[i].tanggal + '"data-status="' + data[i].status + '">Detail</a>' + ' ' +
                               '</td>' +
                               '</tr>';


                       }
                       $('#listPertemuan').html(html);
                   }
               });
           }
       });

       $('#listPertemuan').on('click', '.editBap', function() {
           $('#modalEdit').modal('show');
           $("#pertemuanAwal").val($(this).data('pertemuan'));
           $("#pertemuanBaru").val($(this).data('pertemuan'));
           $("#id-bap").val($(this).data('id'));
           $("#topik").html($(this).data('topik'));
           $("#cp").html($(this).data('cp'));
           $("#desk").val($(this).data('deskirpsi'));
           $("#datepickerEdit").val($(this).data('tanggal'));
           $("#status1").html($(this).data('status'));
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