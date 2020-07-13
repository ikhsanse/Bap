<div class="containter-fluid">
    <div class="loginh">
        <div class="row justify-content-center mx-0">
            <div class="col-lg-6 mt-5 card px-0">
                <div class="card-header text-center">
                    <h5>User Login</h5>
                    <?php if (isset($error)) {
                        echo $error;
                    } ?>
                </div>
                <div class="row card-body py-5">
                    <div class="col-lg-6 mb-2 image-login d-flex align-items-center justify-content-center">
                        <img src=<?php echo base_url('assets/image/pnj.png') ?>>
                        <!-- <span class="pb-5"><i class="fa fa-users" style="font-size: 100px;"></i></span> -->
                    </div>
                    <div class="col-lg-6 pt-1">
                        <form method="POST" action="<?php echo site_url("auth") ?>">
                            <div class="form-group">
                                <input class="form-control" placeholder="Username/NIP" name="username" type="text">
                                <?php echo form_error('username'); ?>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password">
                                <?php echo form_error('password'); ?>
                            </div>
                            <div>
                                <button class="btn btn-md btn-block btn-primary" type="submit">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>