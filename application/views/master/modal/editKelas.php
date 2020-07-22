<div class="modal fade" id="editKelas" tabindex="-1" role="dialog" aria-labelledby="modalInput" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center navigation text-white pb-0">
                <h5 class="modal-title mb-3" id="modalInput">Edit Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-0">
                <!-- <h6>Tambah Kelas</h6> -->
                <form method="post" action="<?php echo site_url('kelas/editKelas') ?>">
                    <input hidden id="idKelas" name="id">
                    <input hidden id="namaKelasAwal" name="kelasAwal">
                    <input hidden id="tahunKelasAwal" name="tahunAwal">
                    <div class="form-group">
                        <label for="namaKelas">Kelas</label>
                        <input class="form-control" id="namaKelas" name="kelas" placeholder="Nama Kelas" type="text">
                    </div>
                    <div class="form-group">
                    <label for="prodiTIK">Prodi</label>
                        <select class="form-control" id="prodiTIK" name="prodi">
                            <option hidden id="namaProdi">Prodi</option>
                            <option value="TI">TI</option>
                            <option value="TMJ">TMJ</option>
                            <option value="TMD">TMD</option>
                        </select>
                        <!-- <select class="form-control">
                            <option>Topik Utama</option>
                            <option>MongoDB</option>
                        </select> -->
                    </div>
                    <div class="form-group">
                    <label for="semesterKelas">Semester Ke-</label>
                        <input class="form-control" id="semesterKelas" name="semester" placeholder="Semester" type="number" min="1" max="8">
                    </div>
                    <div class="form-group">
                    <label for="tahunKelas">Tahun Masuk</label>
                        <input class="form-control" id="tahunKelas" name="tahun" placeholder="Tahun Masuk" type="text">
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
</script>