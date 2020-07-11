        <div class="row mx-0">
            <div class="col-lg-3 px-0 side-border">
                <ul class="sidebar navbar-nav">
                    <li class="nav-item text-center">
                        <i id="item-1" class="fa fa-user-circle mt-2" style="font-size:70px;"></i>
                    </li>
                    <li class="nav-item text-center mt-2">
                        <p id="item-2" class="mb-0">Nama Dosen</p>
                        <p id="item-3" class="mt-0 mb-0">NIP</p>
                    </li>
                    <div class="mt-4 link-nav">
                        <li class="nav-item dropdown text-center py-2">
                            <a href="<?php echo base_url() ?>" id="item-5">Home</a>
                        </li>
                        <li class="active-dev nav-item dropdown text-center py-2 <?php echo $this->uri->segment(2) == '' ? 'active' : '' ?>">
                            <a href="<?php echo site_url('homebap') ?>" id="item-6">BAP</a>
                        </li>
                    </div>
                </ul>
            </div>
