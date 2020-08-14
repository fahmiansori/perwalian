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
                        NEW <?= ucfirst($this->uri->segment(1)) ?>
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="<?= site_url('dosen') ?>">Back</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="body">
                    <form action="<?php echo site_url('dosen/add') ?>" method="post" enctype="multipart/form-data" >
                        <label for="nip">NIP</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="nip" name="nip" class="form-control <?php echo form_error('nip') ? 'error':'' ?>" placeholder="Masukkan NIP">
                            </div>

                            <?php if(form_error('nip')){ ?>
                                <label id="nip-error" class="error" for="nip"><?php echo form_error('nip') ?></label>
                            <?php } ?>
                        </div>

                        <label for="nama_dosen">Nama</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="nama_dosen" name="nama_dosen" class="form-control <?php echo form_error('nama_dosen') ? 'error':'' ?>" placeholder="Masukkan nama user" required>
                            </div>

                            <?php if(form_error('nama_dosen')){ ?>
                                <label id="nama_dosen-error" class="error" for="nama_dosen"><?php echo form_error('nama_dosen') ?></label>
                            <?php } ?>
                        </div>

                        <label for="alamat_dosen">Alamat</label>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea type="text" id="alamat_dosen" name="alamat_dosen" class="form-control <?php echo form_error('alamat_dosen') ? 'error':'' ?>" placeholder="Masukkan alamat" required rows="8" cols="80"></textarea>
                            </div>

                            <?php if(form_error('alamat_dosen')){ ?>
                                <label id="alamat_dosen-error" class="error" for="alamat_dosen"><?php echo form_error('alamat_dosen') ?></label>
                            <?php } ?>
                        </div>

                        <label for="username">Username (untuk login)</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="username" name="username" class="form-control <?php echo form_error('username') ? 'error':'' ?>" placeholder="Masukkan username" required>
                            </div>

                            <?php if(form_error('username')){ ?>
                                <label id="username-error" class="error" for="username"><?php echo form_error('username') ?></label>
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
