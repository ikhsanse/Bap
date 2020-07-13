<nav class="navbar navbar-expand navbar-dark navigation justify-content-between" id="content">
    <a class="font-weight-bold navbar-brand mr-1 text-white" style="font-size: 25px;" href="<?php echo base_url('index.php/kaprodi') ?>"><?php echo HEAD_NAME ?></a>

    <div class="d-inline">

        <ul class="navbar-nav align-items-center ml-auto">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="#">Prodi BAP </a>
                    <a class="nav-item nav-link" href="<?php echo base_url('index.php/homebap')?>">User BAP</a>
                </div>
            </div>
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="navbarDropdownUserImage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i id="item-1" class="fa fa-user-circle" style="font-size:40px;"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="navbarDropdownUserImage">
                    <h6 class="dropdown-header d-flex align-items-center">
                        <i id="item-1" class="fa fa-user-circle" style="font-size:40px;"></i>
                        <div class="ml-2 dropdown-user-details">
                            <div class="dropdown-user-details-name"><?php echo $nama ?></div>
                            <div class="dropdown-user-details-id"><?php echo $nip ?></div>
                        </div>
                    </h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo site_url('auth/logout') ?>">Log Out</a>
                </div>
            </li>
        </ul>
    </div>
</nav>