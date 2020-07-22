<div class="modal fade" id="addMk" tabindex="-1" role="dialog" aria-labelledby="modalInput" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center navigation text-white pb-0">
                <h5 class="modal-title mb-3" id="modalInput">Tambah Mata Kuliah Dosen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-0">
                <!-- <h6>Tambah Kelas</h6> -->
                <form method="post" action="<?php echo site_url('kelasmk/addDosenMatkul') ?>">

                    <div class="form-group">
                        <select class="form-control" id="mkKelas" name="kelas"> 
                            <option value="">Kelas</option>
                            <?php
                                foreach($kelas as $kls) {
                                    echo '<option value="'.$kls->nama_kelas.'">'.$kls->nama_kelas.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <!-- <div hidden class="form-group">
                        <select class="form-control" id="mkAddProdi" name="prodi"> 
                            <option value="">Prodi</option>
                        </select>
                    </div> -->
                    <div class="form-group">
                        <select class="form-control" name="tahun"> 
                            <option value="">Tahun Masuk</option>
                            <?php
                                foreach($tahun as $thn) {
                                    echo '<option value="'.$thn->thn_masuk.'">'.$thn->thn_masuk.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="matkul"> 
                            <option value="">Mata Kuliah</option>
                            <?php
                                foreach($matkul as $mkl) {
                                    echo '<option value="'.$mkl->kodemk.'">'.$mkl->namamk.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="dosen"> 
                            <option value="">Dosen Pengajar</option>
                            <?php
                                foreach($dosen as $dsn) {
                                    echo '<option value="'.$dsn->nip.'">'.$dsn->nip.' - '.$dsn->nama.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer mb-0">
                        <a>
                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
//   $('#mkKelas').on('change', function() {
//         $.ajax({
//             type: 'GET',
//             url: 'kelasmk/getProdiKelas/' + this.value + '',
//             dataType: 'html',
//             success: function(response) {
//                 console.log(response);
//                 // $('#cp-pertemuan').show();
//                 $('select[name="prodi"]').append(response);
//                 // $('#cp-p').load();
//             },
//             error: function(XMLHttpRequest, textStatus, errorThrown) {
//                 console.log({
//                     XMLHttpRequest,
//                     textStatus,
//                     errorThrown
//                 })
//             }
//         })

//     });
</script>