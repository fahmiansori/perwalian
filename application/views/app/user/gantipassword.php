<?php $this->load->view('app/_template/1head.php'); ?>
<!-- HEAD HERE -->
<link href="<?php echo base_url('assets/plugins/bootstrap-select/css/bootstrap-select.css'); ?>" rel="stylesheet" />
<!-- #END HEAD HERE -->


<?php $this->load->view('app/_template/2topbar.php'); ?>


<?php $this->load->view('app/_template/3sidebar.php'); ?>


<?php $this->load->view('app/_template/4content.php'); ?>
<!-- CONTENT HERE -->
<div class="">
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('failed')): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $this->session->flashdata('failed'); ?>
        </div>
    <?php endif; ?>

    <!-- Vertical Layout -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Ganti Password
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="<?= site_url('user') ?>">Back</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="body">
                    <form action="" method="post" enctype="multipart/form-data" >
                        <?php
                            $user = $this->session->userdata("user_logged");
                        ?>

                        <input type="hidden" name="id" value="<?php echo $user->id?>" />

                        <label for="password">Password</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" id="password" name="password" class="form-control <?php echo form_error('password') ? 'error':'' ?>" placeholder="Masukkan password" required>
                            </div>

                            <?php if(form_error('password')){ ?>
                                <label id="password-error" class="error" for="password"><?php echo form_error('password') ?></label>
                            <?php } ?>
                        </div>

                        <label for="password_confirm">Konfirmasi Password</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" id="password_confirm" name="password_confirm" class="form-control <?php echo form_error('password_confirm') ? 'error':'' ?>" placeholder="Masukkan konfirmasi password" required>
                            </div>

                            <?php if(form_error('password_confirm')){ ?>
                                <label id="password_confirm-error" class="error" for="password_confirm"><?php echo form_error('password_confirm') ?></label>
                            <?php } ?>
                        </div>

                        <br>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Vertical Layout -->
</div>
<!-- #END CONTENT HERE -->


<?php $this->load->view('app/_template/5js.php'); ?>
<!-- JS HERE -->
<script src="<?php echo base_url('assets/plugins/bootstrap-select/js/bootstrap-select.js'); ?>"></script>
<!-- #END JS HERE -->


<?php $this->load->view('app/_template/6end.php'); ?>
