<div class="containter-fluid">
    <div class="loginh">
        <div class="row justify-content-center mx-0">
            <div class="col-lg-6 mt-5 card px-0">
                <div class="card-header text-center">
                    <h5>Rekap Berita Acara</h5>
                </div>
                <div class="row justify-content-center card-body py-5">
                    <!-- <div class="col-lg-6 mb-2 image-login d-flex align-items-center justify-content-center">
                        <img src=<?php echo base_url('assets/image/pnj.png') ?>>
                        <span class="pb-5"><i class="fa fa-users" style="font-size: 100px;"></i></span>
                    </div> -->
                    <div class="col-lg-8 pt-1">
                        <form method="POST" action="<?php echo site_url("rekap") ?>">
                            <!-- <div hidden class="form-group">
                                <select class="form-control" name="prodi">
                                    <option value="">Prodi</option>
                                    <option value="">Semua Prodi</option>
                                    <option value="111">TI</option>
                                    <option value="112">TMJ</option>
                                    <option value="113">TMD</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="dosen">
                                    <option value="">Dosen Pengajar</option>
                                    <?php
                                    foreach ($dosen as $dsn) {
                                        echo '<option value="' . $dsn->nip . '">' . $dsn->nip . ' - ' . $dsn->nama . '</option>';
                                    }
                                    ?>
                                </select>
                            </div> -->
                            <div class="form-group">
                                <select class="form-control" name="matkul">
                                    <option value="">Mata Kuliah</option>
                                    <?php
                                    foreach ($matkul as $mkl) {
                                        echo '<option value="' . $mkl->kodemk . '">' . $mkl->namamk . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="input-group form-group mb-2 ">
                                <div class="row">
                                    <div class="input-group-prepend col">
                                        <span class="input-group-text"><i class="fa fa-calendar" style="font-size: 15px;"></i></span>
                                        <input class="form-control" id="monthpickerkps" placeholder="Tanggal Awal" name="tanggal-awal" date-date-format="mm-dd-yyyy">
                                    </div>
                                    <div class="input-group-prepend col">
                                        <span class="input-group-text"><i class="fa fa-calendar" style="font-size: 15px;"></i></span>
                                        <input class="form-control" id="monthpickerkps1" placeholder="Tanggal Akhir" name="tanggal-akhir" date-date-format="mm-dd-yyyy">
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="d-flex justify-content-center mb-1">
                                <span> Sampai Dengan </span>
                            </div>
                            <div class="input-group form-group mb-3 ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar" style="font-size: 15px;"></i></span>
                                </div>
                                <input class="form-control" id="monthpicker1" name="tanggal-akhir" date-date-format="mm-dd-yyyy">
                            </div> -->

                            <div>
                                <button class="btn btn-md btn-block btn-primary" type="submit">Rekap</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#monthpickerkps').datepicker({
        format: 'dd/mm/yyyy',
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
    // $('#monthpicker').datepicker("setDate", new Date());

    $('#monthpickerkps1').datepicker({
        format: 'dd/mm/yyyy',
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
    // $('#monthpicker1').datepicker("setDate", new Date());
</script>