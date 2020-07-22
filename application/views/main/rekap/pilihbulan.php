<div class="containter-fluid">
    <div class="loginh">
        <div class="row justify-content-center mx-0">
            <div class="col-lg-6 mt-5 card px-0">
                <div class="card-header text-center">
                    <h5>Pilih Bulan Rekap</h5>
                </div>
                <div class="row justify-content-center card-body py-5">
                    <!-- <div class="col-lg-6 mb-2 image-login d-flex align-items-center justify-content-center">
                        <img src=<?php echo base_url('assets/image/pnj.png') ?>>
                        <span class="pb-5"><i class="fa fa-users" style="font-size: 100px;"></i></span>
                    </div> -->
                    <div class="col-lg-8 pt-1">
                        <form method="POST" action="<?php echo site_url("rekap") ?>">
                            <div class="input-group form-group mb-3 ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar" style="font-size: 15px;"></i></span>
                                </div>
                                <input class="form-control" id="monthpicker" name="bulan" date-date-format="mm-dd-yyyy">
                            </div>
                            <div>
                                <button class="btn btn-md btn-block btn-primary" type="submit">Rekap</button>
                                </di>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#monthpicker').datepicker({
        format: 'mm-yyyy',
        // weekStart: 1,
        startView: "months",
        minViewMode: "months",
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
    $('#monthpicker').datepicker("setDate", new Date());
</script>