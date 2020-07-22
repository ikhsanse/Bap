<div class="modal fade" id="modalBAP" tabindex="-1" role="dialog" aria-labelledby="modalInput" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center navigation text-white pb-0">
                <h5 class="modal-title mb-3" id="modalInput">Berita Acara Perkuliahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-0">
                <h6><?php echo $matkul ?> - <?php echo $kelas ?></h6>
                <form method="post" action="<?php echo site_url('pertemuan/setBap') ?>">
                    <div class="form-group">
                        <input class="form-control" name="pertemuan" min="1" max="18" placeholder="Pertemuan Ke-" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="2">
                    </div>
                    <div class="form-group">
                        <select id="tpk-utama" class="form-control" name="topik">
                            <option value="">Topik Utama</option>
                            <?php
                            foreach ($topik as $tpk) {
                                echo '<option value="' . $tpk->kode_tpk . '">' . $tpk->tpk_utama . '</option>';
                            }
                            ?>
                        </select>
                        <!-- <select class="form-control">
                            <option>Topik Utama</option>
                            <option>MongoDB</option>
                        </select> -->
                    </div>
                    <div class="form-group" id="cp-p">
                        <select readonly id="cp-pertemuan" class="form-control" name="cp-pertemuan">
                            <option>Capaian Pertemuan</option>
                        </select>
                        <!-- <input id="cp-pertemuan" class="form-control" name="cp-pertemuan" placeholder="Capaian Pertemuan"> -->
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" type="text" placeholder="Deskripsi" name="deskripsi" rows="2"></textarea>
                    </div>
                    <div class="input-group form-group mb-3 ">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar" style="font-size: 15px;"></i></span>
                        </div>
                        <input class="form-control" id="datepicker" name="tanggal" date-date-format="mm-dd-yyyy">
                    </div>
                    <div class="form-group">
                        <select name="status" class="form-control">
                            <option value="Normal">Normal</option>
                            <option value="Pengganti">Pengganti</option>
                        </select>
                    </div>
                    <div hidden class="form-group">
                        <input class="form-control" type="text" name="matkul" value="<?php echo $matkul ?>" placeholder="">
                        <input class="form-control" type="text" name="kelas" value="<?php echo $kelas ?>" placeholder="">
                        <input class="form-control" type="text" name="prodi" value="<?php echo $prodi ?>" placeholder="">
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
    $('#datepicker').datepicker({
        format: 'dd/mm/yyyy',
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
    $('#datepicker').datepicker("setDate", new Date());

    $('#tpk-utama').on('change', function() {
        $.ajax({
            type: 'GET',
            url: 'getCp/' + this.value + '',
            dataType: 'html',
            success: function(response) {
                console.log(response);
                // $('#cp-pertemuan').show();
                $('select[name="cp-pertemuan"]').append(response);
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