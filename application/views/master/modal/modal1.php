<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="modalInput" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center navigation text-white pb-0">
                <h5 class="modal-title mb-3" id="modalInput">Pertemuan Ke-<span id="headerDetail"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <h6><?php echo $matkul.' - '.$kelas?> </h6>
                <form>
                    <input hidden id="id-bap-detail" name="id-bap">
                    <div class="form-group">
                        <select disabled name="topik-utama" class="form-control">
                            <option id="topik-detail"></option>
                        </select>
                    </div>
                    <div class="form-group" id="cp-p">
                        <select disabled id="cp-d" class="form-control" name="cp-edit">
                            <option id="cp-detail">Capaian Pertemuan</option>
                        </select>
                        <!-- <input id="cp-pertemuan" class="form-control" name="cp-pertemuan" placeholder="Capaian Pertemuan"> -->
                    </div>
                    <div class="form-group">
                        <textarea disabled class="form-control" type="text" id="desk-detail" name="deskripsi" placeholder="Deskripsi" rows="2"></textarea>
                    </div>
                    <div class="input-group form-group mb-3 ">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar" style="font-size: 15px;"></i></span>
                        </div>
                        <input class="form-control" disabled name="tanggal" id="datepickerDetail" date-date-format="yyyy-month-dd">
                    </div>
                    <div class="form-group">
                        <select id="status-detail" disabled name="status-perkuliahan" class="form-control">
                            <option id="status1-detail" value="" hidden></option>
                            <option id="status2-detail" value="Normal">Normal</option>
                            <option value="Pengganti">Pengganti</option>
                        </select>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#datepickerDetail').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
</script>