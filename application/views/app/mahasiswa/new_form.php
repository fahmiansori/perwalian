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
                                <li><a href="<?= site_url('mahasiswa') ?>">Back</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="body">
                    <form action="<?php echo site_url('mahasiswa/add') ?>" method="post" enctype="multipart/form-data" >
                        <label for="nim">NIM</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="nim" name="nim" class="form-control <?php echo form_error('nim') ? 'error':'' ?>" placeholder="Masukkan NIM" required>
                            </div>

                            <?php if(form_error('nim')){ ?>
                                <label id="nim-error" class="error" for="nim"><?php echo form_error('nim') ?></label>
                            <?php } ?>
                        </div>

                        <label for="tahun_masuk">Tahun Masuk</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number" id="tahun_masuk" name="tahun_masuk" class="form-control <?php echo form_error('tahun_masuk') ? 'error':'' ?>" placeholder="Masukkan tahun" required>
                            </div>

                            <?php if(form_error('tahun_masuk')){ ?>
                                <label id="tahun_masuk-error" class="error" for="tahun_masuk"><?php echo form_error('tahun_masuk') ?></label>
                            <?php } ?>
                        </div>

                        <label for="nama_mahasiswa">Nama</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="nama_mahasiswa" name="nama_mahasiswa" class="form-control <?php echo form_error('nama_mahasiswa') ? 'error':'' ?>" placeholder="Masukkan nama user" required>
                            </div>

                            <?php if(form_error('nama_mahasiswa')){ ?>
                                <label id="nama_mahasiswa-error" class="error" for="nama_mahasiswa"><?php echo form_error('nama_mahasiswa') ?></label>
                            <?php } ?>
                        </div>

                        <label for="alamat_mahasiswa">Alamat</label>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea type="text" id="alamat_mahasiswa" name="alamat_mahasiswa" class="form-control <?php echo form_error('alamat_mahasiswa') ? 'error':'' ?>" placeholder="Masukkan alamat" required rows="8" cols="80"></textarea>
                            </div>

                            <?php if(form_error('alamat_mahasiswa')){ ?>
                                <label id="alamat_mahasiswa-error" class="error" for="alamat_mahasiswa"><?php echo form_error('alamat_mahasiswa') ?></label>
                            <?php } ?>
                        </div>

                        <label for="dosen_id">Dosen Wali</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select id="dosen_id" name="dosen_id" class="form-control show-tick <?php echo form_error('dosen_id') ? 'error':'' ?>" required>
                                    <option value="">-- Please select --</option>
                                    <?php foreach ($dosen as $row): ?>
                                        <option value="<?php echo $row->id; ?>"><?php echo $row->nama_dosen; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <?php if(form_error('dosen_id')){ ?>
                                <label id="dosen_id-error" class="error" for="dosen_id"><?php echo form_error('dosen_id') ?></label>
                            <?php } ?>
                        </div>

                        <label for="program_studi_id">Program Studi</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select id="program_studi_id" name="program_studi_id" class="form-control show-tick <?php echo form_error('program_studi_id') ? 'error':'' ?>" required>
                                    <option value="">-- Please select --</option>
                                    <?php foreach ($program_studi as $row): ?>
                                        <option value="<?php echo $row->id; ?>"><?php echo $row->nama_prodi; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <?php if(form_error('program_studi_id')){ ?>
                                <label id="program_studi_id-error" class="error" for="program_studi_id"><?php echo form_error('program_studi_id') ?></label>
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
