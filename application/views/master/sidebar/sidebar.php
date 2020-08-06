<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <nav id="sidebar">
        <div class="sidebar-header pl-2">
            <h2 class="text-white">Berita Acara Perkuliahan</h2>
        </div>

        <ul class="list-unstyled components text-white">
            <li class="active">
                <a href="<?php echo site_url('admin')?>">Home</a>
            </li>
            <li>
                <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Rekap</a>
                <ul class="collapse list-unstyled ml-3" id="pageSubmenu1">
                    <li>
                        <a href="<?php echo site_url('PilihRekapBulan')?>">Rekap</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('RekapMatkul')?>">Per Matakuliah</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('RekapKelas')?>">Per Kelas</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('RekapDosen')?>">Per Dosen</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Kelas</a>
                <ul class="collapse list-unstyled ml-3" id="pageSubmenu">
                    <li>
                        <a href="<?php echo site_url('Kelas')?>">Daftar Kelas</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('Kelasmk')?>">Matakuliah</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?php echo site_url('ListUser')?>">Tambah User</a>
            </li>
        </ul>
    </nav>
</div>