<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalInput" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center navigation text-white pb-0">
                <h5 class="modal-title mb-3" id="modalInput">Pertemuan Ke-2</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>Kapita Selekta - TI 8A</h6>
                <form>
                    <?php echo $id_bap?>
                    <div class="form-group">
                        <select class="form-control">
                            <option>MongoDB</option>
                            <option>Topik Utama</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" value="" placeholder="Capaian Pertemuan">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" type="text" placeholder="Deskripsi" rows="2">Membahas Keunggulan dan Kelemahan MongoDB</textarea>
                    </div>
                    <div class="input-group form-group mb-3 ">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar" style="font-size: 15px;"></i></span>
                        </div>
                        <input class="form-control" id="datepickerEdit" date-date-format="dd-month-yyyy">
                    </div>
                    <div class="form-group">
                        <select class="form-control">
                            <option>Pengganti</option>
                            <option>Normal</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="<?php echo site_url('pertemuan') ?>">
                    <button type="button" class="btn btn-primary">Update</button>
                </a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#datepickerEdit').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
</script>