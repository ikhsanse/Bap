<div class="modal fade" id="modalKps" tabindex="-1" role="dialog" aria-labelledby="modalInput" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center navigation text-white pb-0">
                <h5 class="modal-title mb-3" id="modalInput"><?php echo $matkul . ' - ' . $kelas ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo site_url('kaprodipertemuan/update') ?>" id="editForm">

                    <input hidden id="id-bap-kps" name="id-bap">
                    <input id="pertemuanAwalKps" hidden name="pertemuan-awal">
                    <div class="form-group">
                        <label for="headerPertemuan">Pertemuan Ke-</label>
                       
                        <input class="form-control" required name="pertemuan-baru" id="pertemuanBaruKps"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="2">
                    </div>
                    <div class="form-group">
                        <label for="tpk">Topik Utama</label>
                        <select id="tpkKps" name="topik-utama" required class="form-control">
                            <option id="topikKps"></option>
                            <?php
                            foreach ($topik as $tpk) {
                                echo '<option value="' . $tpk->kode_tpk . '">' . $tpk->tpk_utama . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" id="cp-p">
                        <label for="cp-edit">Capaian Pertemuan</label>
                        <select readonly id="cp-edit-kps" required class="form-control" name="cp-edit">
                            <option id="cpKps">Capaian Pertemuan</option>
                        </select>
                        <!-- <input id="cp-pertemuan" class="form-control" name="cp-pertemuan" placeholder="Capaian Pertemuan"> -->
                    </div>
                    <div class="form-group">
                        <label for="desk">Deskripsi</label>
                        <textarea class="form-control" required type="text" id="deskKps" name="deskripsi" placeholder="Deskripsi" rows="2"></textarea>
                    </div>
                    <div class="input-group form-group mb-3 ">
                        <!-- <label for="datePickerEdit">Tanggal</label> -->
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar" style="font-size: 15px;"></i></span>
                        </div>

                        <input class="form-control" name="tanggal" id="datepickerEditKps" date-date-format="yyyy-mm-dd">
                    </div>
                    <div class="form-group">
                        <label for="status">Status Perkuliahan</label>
                        <select id="status" name="status-perkuliahan" class="form-control">
                            <option id="status1Kps" hidden></option>
                            <option id="status2Kps" value="Normal">Normal</option>
                            <option value="Pengganti">Pengganti</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </a>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $('#datepickerEditKps').datepicker({
        format:'dd/mm/yyyy',
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
    $('#tpkKps').on('change', function() {
        $.ajax({
            type: 'GET',
            url: 'getCp/' + this.value + '',
            dataType: 'html',
            success: function(response) {
                // console.log(response);
                // $('#cp-pertemuan').show();
                $('select[name="cp-edit-kps"]').append(response);
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
    // $('#editForm').on('submit', function() {
    //     var selectorStatus = document.getElementById('status');
    //     var selectorCp = document.getElementById('cp-edit');
    //     var selectorTopik = document.getElementById('tpk');

    //     var id = $('#id-bap').val();
    //     var topik = selectorTopik[selector.selectedIndex].value;
    //     var cp = selectorCp[selector.selectedIndex].value;
    //     var deskripsi = $('#desk').val();
    //     var tanggal = $('#date').val();
    //     var status = selectorStatus[selector.selectedIndex].value;
    //     $.ajax({
    //         type: "POST",
    //         url: "update/",
    //         dataType: "JSON",
    //         data: {
    //             id_bap: id,
    //             topik: topik,
    //             cp: cp,
    //             deskripsi:deskripsi,
    //             tanggal:tanggal,
    //             status: status
    //         },
    //         success: function(data) {
    //             $("#id-bap").val("");
    //             $("#tpk").val("");
    //             $('#cp-edit').val("");
    //             $("#desk").val("");
    //             $("#date").val("");
    //             $('#status').val("");
    //             $('#modalEdit').modal('hide');
    //             listPertemuan();
    //         }
    //     });
    //     return false;
    // });

    // function checkStatus(){
    //         var values = document.getElementById('status1').value;
    //         if(values == 'Normal'){
    //             document.getElementById('status2').value = 'Pengganti';
    //         } else {
    //             document.getElementById('status2').value = 'Normal';
    //         }
    //     }
</script>