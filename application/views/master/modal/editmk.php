<div class="modal fade" id="editMk" tabindex="-1" role="dialog" aria-labelledby="modalInput" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center navigation text-white pb-0">
                <h5 class="modal-title mb-3" id="modalInput">Update Mata Kuliah Dosen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-0">
                <!-- <h6>Tambah Kelas</h6> -->
                <form method="post" action="<?php echo site_url('kelasmk/editDosenMatkul') ?>">
                <input hidden id="idMkDosen" name="id-mkdosen">
                    <input hidden id="namaKelasAwalMk" name="kelas-awal">
                    <div class="form-group">
                        <label for="mkKelasEdit">Kelas</label>
                        <select class="form-control" id="mkKelasEdit" name="kelas"> 
                            <option id="namaKelasMk">Kelas</option>
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
                    <input hidden id="tahunKelasAwalMk" name="tahun-awal">
                    <label for="mkTahunEdit">Tahun Masuk</label>
                    <div class="form-group">
                        <select class="form-control"  id="mkTahunEdit" name="tahun"> 
                            <option id="tahunKelasMk" >Tahun Masuk</option>
                            <?php
                                foreach($tahun as $thn) {
                                    echo '<option value="'.$thn->thn_masuk.'">'.$thn->thn_masuk.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <input hidden id="kodeMatkulMk" name="kode">
                    <input hidden id="kodeMatkulAwalMk" name="kode-awal">
                    <div class="form-group">
                        <label for="namaMk">Mata Kuliah</label>
                        <select class="form-control" id="namaMk" name="matkul"> 
                            <option hidden id="namaMatkulMk">Mata Kuliah</option>
                            <?php
                                foreach($matkul as $mkl) {
                                    echo '<option value="'.$mkl->kodemk.'">'.$mkl->namamk.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <input hidden id="nipDosenMk" name="nip">
                    <input hidden id="nipDosenAwalMk" name="nip-awal">
                    <div class="form-group">
                        <label for="dosenMk">Dosen Pengajar</label>
                        <select class="form-control"  id="dosenMk" name="dosen"> 
                            <option hidden id="namaDosenMk">Dosen Pengajar</option>
                            <?php
                                foreach($dosen as $dsn) {
                                    echo '<option value="'.$dsn->nip.'">'.$dsn->nip.' - '.$dsn->nama.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <select class="form-control" name="status"> 
                            <option hidden id="statusMk"></option>
                            <option value="active">active</option>
                            <option value="non-active">non-active</option>
                        </select>
                    </div>
                    <div class="modal-footer mb-0">
                        <a>
                            <button type="submit" class="btn btn-primary btn-lg">Update</button>
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
  $('#namaMk').on('change', function() {
        $.ajax({
            type: 'GET',
            url: 'kelasmk/getKodeMatkul/' + this.value + '',
            dataType: 'html',
            success: function(response) {
                console.log(response);
                // $('#cp-pertemuan').show();
                $('#kodeMatkulMk').val(response);
                // $('#cp-p').load();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log({
                    XMLHttpRequest,
                    textStatus,
                    errorThrown
                })
            }
        })

    });

    $('#dosenMk').on('change', function() {
        $.ajax({
            type: 'GET',
            url: 'kelasmk/getNipDosen/' + this.value + '',
            dataType: 'html',
            success: function(response) {
                console.log(response);
                // $('#cp-pertemuan').show();
                $('#nipDosenMk').val(response);
                // $('#cp-p').load();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log({
                    XMLHttpRequest,
                    textStatus,
                    errorThrown
                })
            }
        })

    });
</script>