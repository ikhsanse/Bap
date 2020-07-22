<div class="modal fade" id="addKelas" tabindex="-1" role="dialog" aria-labelledby="modalInput" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center navigation text-white pb-0">
                <h5 class="modal-title mb-3" id="modalInput">Tambah Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-0">
                <!-- <h6>Tambah Kelas</h6> -->
                <form method="post" action="<?php echo site_url('kelas/addKelas') ?>">
                    <div class="form-group">
                        <input class="form-control" name="kelas" placeholder="Nama Kelas" type="text">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="prodi">
                            <option value="">Prodi</option>
                            <option value="111">TI</option>
                            <option value="112">TMJ</option>
                            <option value="113">TMD</option>
                        </select>
                        <!-- <select class="form-control">
                            <option>Topik Utama</option>
                            <option>MongoDB</option>
                        </select> -->
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="semester" placeholder="Semester" type="number" min="1" max="8">
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="tahun" placeholder="Tahun Masuk" type="text">
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
</script>