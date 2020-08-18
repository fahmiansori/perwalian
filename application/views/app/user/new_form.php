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

    <!-- Vertical Layout -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        NEW <?= ucfirst($this->uri->segment(1)) ?>
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
                    <form action="<?php echo site_url('user/add') ?>" method="post" enctype="multipart/form-data" >
                        <label for="full_name">Nama</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="full_name" name="full_name" class="form-control <?php echo form_error('full_name') ? 'error':'' ?>" placeholder="Masukkan nama user" required>
                            </div>

                            <?php if(form_error('full_name')){ ?>
                                <label id="full_name-error" class="error" for="full_name"><?php echo form_error('full_name') ?></label>
                            <?php } ?>
                        </div>

                        <label for="username">Username</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="username" name="username" class="form-control <?php echo form_error('username') ? 'error':'' ?>" placeholder="Masukkan username" required>
                            </div>

                            <?php if(form_error('username')){ ?>
                                <label id="username-error" class="error" for="username"><?php echo form_error('username') ?></label>
                            <?php } ?>
                        </div>

                        <label for="email">Email</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="email" name="email" class="form-control <?php echo form_error('email') ? 'error':'' ?>" placeholder="Masukkan email">
                            </div>

                            <?php if(form_error('email')){ ?>
                                <label id="email-error" class="error" for="email"><?php echo form_error('email') ?></label>
                            <?php } ?>
                        </div>

                        <label for="role" style="display:none;">Role</label>
                        <div class="form-group" style="display:none;">
                            <div class="form-line">
                                <select id="role" name="role" class="form-control show-tick <?php echo form_error('role') ? 'error':'' ?>" required>
                                    <option value="">-- Please select --</option>
                                    <option value="1" selected>Admin</option>
                                    <option value="2">Dosen</option>
                                    <option value="3">Mahasiswa</option>
                                </select>
                            </div>

                            <?php if(form_error('role')){ ?>
                                <label id="role-error" class="error" for="role"><?php echo form_error('role') ?></label>
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
